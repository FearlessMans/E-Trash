@extends('layouts.app', ['pageSlug' => 'product'])

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Inputkan Product
                </h4>
            </div>
        </div>
        @if(count($product)>0)
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Product Table
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter">
                            <thead class="text-primary">
                                <tr>
                                    <th>Nama Sampah</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$product->nama_sampah}}</td>
                                    <td>{{$product->harga}}</td>
                                    <td>{{$product->qty}}</td>
                                    <td><button>Check</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
        <div class="container">
            <div class="text-center">Maaf Data Kosong</div>
        </div>
    </div>
</div>
@endif
@endsection
