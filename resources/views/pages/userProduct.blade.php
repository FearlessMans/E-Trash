@extends('layouts.userapp')
@section('content')
<div class="container">
    <div class="text-center"><h3>{{$product->nama_sampah}}</h3></div>
    <hr>
    <form>
        @csrf
        @method('post')
        <div class="form-group">
            <label>Email Perusahaan</label>
            <input type="email" class="form-control" name="email_pembeli" placeholder="Masukkan Email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label>Jumlah {{$product->nama_sampah}}</label>
            <input type="number" class="form-control" name="jumlah_sampah" placeholder="Masukkan Jumlah Sampah">
        </div>
    </form>
    <button class="btn btn-primary" id="{{$product->id}}" onclick="kumpul({{$product->id}}, {{$product->qty}})">Checkout</button>
</div>

<script>
    function kumpul(id, stock){
        let jumlah_sampah = $("input[name=jumlah_sampah]").val();
        if(stock >= jumlah_sampah){
            console.log("Stock Lebih besar")
        }else{
        $.notify({
                style: "error",
                message: "Tidak boleh lebih dari "+stock+" Kg!!"
            },{
                timer: 3000,
                placement: {
                    from: 'top',
                    align: 'center'
                }
            });
        }
    }
</script>
@endsection
