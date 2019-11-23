@extends('layouts.app', ['page' => __('Tables'), 'pageSlug' => 'tables'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Table Transaksi</h4>
            </div>
            @if (count($transaksi)>0)
            <div class="card-body">
                <div class="table-responsive">
                <table class="table tablesorter " id="">
                    <thead class=" text-primary">
                    <tr>
                        <th>Gambar</th>
                        <th>Email Pembeli</th>
                        <th>Jenis Sampah</th>
                        <th>Jumlah Sampah</th>
                        <th>Tanggal Transaksi</th>
                        <th>Tanggal Expired</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($transaksi as $item)
                    <tr>
                        @if ($item->picture != null)
                        <td><img src="{{asset('storage/transaksi/').$item->picture}}" alt="Transaksi"></td>
                        @endif
                        <td><p class="text-primary">Gambar Belum di Upload</p></td>
                    </tr>
                    <tr>{{$item->email_pembeli}}</tr>
                    <tr>{{$item->jenis_sampah}}</tr>
                    <tr>{{$item->jumlah_sampah}}</tr>
                    <tr>{{$item->tgl_transaksi}}</tr>
                    <tr>{{$item->tgl_expired}}</tr>
                    <tr>{{$item->status}}</tr>
                    <tr><button>Click</button></tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        @else
        <div class="card-body">
            <div class="container">
                <h4 class="text-primary text-center">Data Tidak di Temukan</h4>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
