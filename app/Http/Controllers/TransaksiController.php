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
                "tgl_expired" => $transaksi->tgl_expired->toDateTimeString()." (".$transaksi->tgl_expired->diffForHumans().")"
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        //
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
                ->select('status')
                ->where('token', $request->tok)
                ->first();
            return json_encode($trans);

        // switch($request->input('status')){
        //     case 'SELESAI' :
        //         DB::table('sampah')
        //             ->where('id',$request->input('id_sampah'))
        //             ->decrement('qty', $request->input('jumlah_sampah'));
        //         $transaksi->status = $request->input('status');
        //         if($transaksi->save()){
        //             return response()->json([
        //                 'message' => 'Delete Success'
        //             ]);
        //         }
        //         break;
        //     case 'EXPIRED' :
        //         $transaksi->status = $request->input('status');
        //         if($transaksi->save()){
        //             return response()->json([
        //                 'message' => 'Delete Success'
        //             ]);
        //         }
        //         break;
        // }
    }

}
