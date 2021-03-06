<?php

namespace App\Http\Controllers;

use App\Transaksi;
use App\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = Transaksi::all();
        foreach($transaksi as $trans){
            $trans->jenis_sampah = DB::table('sampah')
                ->select('nama_sampah')
                ->where('id',$trans->id_sampah)
                ->first();
        }
        return $transaksi;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $total = DB::table('sampah')
            ->select('harga')
            ->where('id', $request->id_sampah)
            ->first();
        $transaksi = $request->isMethod('put') ? Transaksi::findOrFail($request->id) : new Transaksi;
        $transaksi->email_pembeli = $request->email_pembeli;
        $transaksi->id_sampah = $request->id_sampah;
        $transaksi->total_harga = $total->harga * $request->jumlah_sampah;
        $transaksi->jumlah_sampah = $request->jumlah_sampah;
        $transaksi->token = Str::random(40);
        $transaksi->tgl_expired = Carbon::now()->addDays(1)->setTimezone('Asia/Jakarta');
        if($transaksi->save()){
            return json_encode([
                "message" => "Save Success",
                "token" => $transaksi->token,
                "tgl_expired" => $transaksi->tgl_expired->toDateTimeString()." (".$transaksi->tgl_expired->diffForHumans().")",
                "total_harga" => number_format($transaksi->total_harga, 2)
            ]);
        }
    }

    public function status(Request $request)
    {
        $transaksi = Transaksi::findOrFail($request->input('id'));
        switch($request->input('status')){
            case 'SELESAI' :
                DB::table('sampah')
                    ->where('id',$request->input('id_sampah'))
                    ->decrement('qty', $request->input('jumlah_sampah'));
                $transaksi->status = $request->input('status');
                if($transaksi->save()){
                    return response()->json([
                        'message' => 'Delete Success'
                    ]);
                }
                break;
            case 'EXPIRED' :
                $transaksi->status = $request->input('status');
                if($transaksi->save()){
                    return response()->json([
                        'message' => 'Delete Success'
                    ]);
                }
                break;
        }
    }

    function track (Request $request){
        $trans = DB::table('transaksi')
                ->select('status', 'picture', 'id')
                ->where('token', $request->tok)
                ->first();
            if($trans === null){
                return json_encode([
                    'status' => 'null'
                ]);
            }else{
                return json_encode($trans);
            }
    }

    function update(Request $request){

        $filenameWithExt = $request->file('picture')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('picture')->getClientOriginalExtension();
        $fileNameToStore = time().'_'.$filename.'.'.$extension;
        $path = $request->file('picture')->storeAs('public/transaksi', $fileNameToStore);

        $transaksi = Transaksi::findOrFail($request->id);
        $transaksi->picture = $fileNameToStore;

        $transaksi->save();

        return json_encode([
            'message' => 'Success'
        ]);
    }

}
