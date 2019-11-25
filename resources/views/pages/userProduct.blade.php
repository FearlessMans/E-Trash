@extends('layouts.userapp')
@section('content')
<div class="container">
    <div class="text-center">{{$product->nama_sampah}}</div>
    <form id="Form">
        @csrf
        @method('post')
        <div class="form-group">
            <label>Email Perusahaan</label>
            <input type="text" class="email_pembeli" class="form-control" placeholder="Masukkan E-Mail">
            <label>Jumlah {{$product->nama_sampah}}</label>
            <input type="number" class="jumlah_sampah" class="form-control" placeholder="Masukkan Jumlah Sampah">
        </div>
        <button class="btn btn-fill btn-primary" id="submit">Checkout</button>
    </form>
</div>
@endsection
