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
            <div class="card-body">
                <form id="Form">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label>Nama Product</label>
                        <input type="text" name="nama_sampah" class="form-control" placeholder="Masukkan Nama Product">

                        <label>Banyak Product</label>
                        <input type="number" name="qty" class="form-control" placeholder="Masukkan Banyaknya Product">

                        <label>Harga Product</label>
                        <input type="number" name="harga" class="form-control" placeholder="Masukkan Harga Product">
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-fill btn-primary" id="submit">Submit</button>
                    </div>
                </form>
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

<script>
    jQuery(document).ready(function(){
        jQuery('#submit').click(function(){

        });
    });
</script>
@endsection
