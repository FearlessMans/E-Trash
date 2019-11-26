<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Transaksi;
use Carbon\Carbon;

class PageController extends Controller
{

    // Starting Admin Section

    /**
     * Display tables page
     *
     * @return \Illuminate\View\View
     */
    public function tables(TransaksiController $transaksi)
    {
        $transaksi = $transaksi->index();
        foreach($transaksi as $transak){
            if($transak->status === "EXPIRED" || $transak->status === "SELESAI"){
                $transak->tgl_expired = "Kadaluarsa";
            }else{
                $transak->tgl_expired = Carbon::createFromFormat('Y-m-d H:i:s', $transak->tgl_expired, 'Asia/Jakarta')
                    ->setTimezone('UTC')->diffForHumans();
            }
            $transak->tgl_transaksi = Carbon::createFromFormat('Y-m-d H:i:s', $transak->tgl_transaksi, 'Asia/Jakarta')
            ->setTimezone('UTC')->diffForHumans();
            $transak->total_harga = number_format($transak->total_harga, 2);
        }
        return view('pages.tables', compact('transaksi'));
    }

    public function product(ProductsController $product)
    {
        $product = $product->index();
        return view('pages.product', compact('product'));
    }
    // End of Admin Section

    // Starting User Section

    public function home(ProductsController $product)
    {
        $product = $product->index();
        return view ('welcome', compact('product'));
    }

    public function showProduct(ProductsController $product, $id)
    {
        $product = $product->show($id);
        return view('pages.userProduct', compact('product'));
    }

    // End of Admin Section
}
