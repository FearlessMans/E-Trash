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
                        <td>{{$item->email_pembeli}}</td>
                        <td>{{$item->jenis_sampah->nama_sampah}}</td>
                        <td>{{$item->jumlah_sampah}}</td>
                        <td>{{$item->tgl_transaksi}}</td>
                        <td>{{$item->tgl_expired}}</td>
                        <td>{{$item->status}}</td>
                        <td width="270">
                            <button class="btn btn-primary" @if (strcasecmp($item->status, "SELESAI"))
                                @else
                                    disabled
                                @endif>Valid</button>
                            <button class="btn btn-danger" @if (strcasecmp($item->status, "EXPIRED"))
                                @else
                                    disabled
                                @endif>Invalid</button>
                        </td>
                    </tr>
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
