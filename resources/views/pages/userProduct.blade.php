@extends('layouts.userapp')
@section('content')
<div class="container">
    <div class="text-center">{{$product->nama_sampah}}</div>
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
        <button type="submit" class="btn btn-primary" id="submit">Checkout</button>
    </form>
</div>
@endsection
