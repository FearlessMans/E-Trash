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

<div class="modal" id="result">
    <div class="container" id="konten">

    </div>
</div>

<script>
    function kumpul(id, stock){
        let jumlah_sampah = $("input[name=jumlah_sampah]").val();
        let email_pembeli = $("input[name=email_pembeli").val();
        if(stock >= jumlah_sampah){
            $.ajaxSetup({
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            })
            jQuery.ajax({
                url: `/transact/add`,
                method: 'Post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "jumlah_sampah" : jumlah_sampah,
                    "email_pembeli" : email_pembeli,
                    "id_sampah" : id
                },
                success: function(response){
                    const data = JSON.parse(response)
                    HTML =
                        '<h3>Gunakan token ini untuk membayar ke rek: 421-231-234-2(BCA)!</h3>' + data.token +
                        '<hr>'+
                        '<p>Dengan Jumlah : ' + data.total_harga + ', Sebelum</p>' +
                        '<br>'+
                        '<p>'+ data.tgl_expired +'</p>' +
                        '<a href="/" class="btn btn-primary">Home</a>'
                    $('#konten').append(HTML).delay(500),
                    $("#result").modal({
                        fadeDuration: 250,
                        showClose: false,
                        showSpinner: true,
                        escapeClose: false,
                        clickClose: false,
                    });
                }
            })
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
