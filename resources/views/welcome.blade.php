@extends('layouts.userapp')

@section('content')
<hr width="1000">
    <div class="container" id="transaksi">
        <div class="header-body text-center mb-7">
            <h1 class="text-black">Transaction Check</h1>
            <p>Loosing your transaction? You now can check it here. Dont forget to use your token after you pay it all.</p>
        </div>
        <div class="container">
            <form class="form-inline justify-content-center" id="Form" >
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <input class="form-control" type="text" name="tok" placeholder="Masukkan Token">
                <button class="btn btn-primary" id = "submit">Submit</button>
            </form>
            <div class="text-center" id="hasil">

            </div>
        </div>
        <div class="container" id="showing_case">

        </div>
    </div>
<hr width="1000">
    <div class="container" id="product">
        <div class="header-body text-center mb-7">
            <h1 class="text-black">Product E-Trash</h1>
        </div> <br>
        <div class="container">
            <div class="row">
                @foreach ($product as $item)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title">{{$item->nama_sampah}}</h4>
                            <p class="card-text">Jumlah saat ini : {{$item->qty}} <small>Kg</small></p>
                            <a href="{{url('/shop/'.$item->id)}}" class="btn btn-primary">Beli</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

<hr width="1000">
    <div class="container" id="about">
        <div class="header-body text-center mb-7">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h1 class="text-black">About E-Trash</h1>
                    <hr>
                    <p>This is our E-Trash website, please enjoy it! Sorry if you found unwork feature because of this version still on Beta version</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container modal" id="result">
        <div class="modal-header">
            <h4 class="modal-title w-100 text-center">Silahkan upload bukti transfer</h4>
        </div>
        <div class="modal-body">
            <form enctype="multipart/form-data" id="inputan">
                {{ csrf_field() }}
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="picture">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
            </form>
        </div>
        <div class="modal-footer" id="footer">
        </div>
    </div>
    <script>
    jQuery(document).ready(function(){
        jQuery('#submit').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            let form = document.getElementById('Form');
            let formData = new FormData (form);
            jQuery.ajax({
                url: 'product/track',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: (response)=>{
                    const data = JSON.parse(response)
                    if(data.status === "PENDING"){
                        if(data.picture === null){
                            HTML =
                                '<p><b><small style="color:orange">Anda belum membayar dan data anda '+data.status+'</small></b></p>' +
                                '<button class="btn btn-primary" onclick="update('+data.id+')">Update</button>'
                                $('#hasil').append(HTML)
                            setTimeout(function(){
                                $('#hasil').html("")
                            },6000)
                        }else{
                            HTML =
                                '<p><b><small style="color:orange">Data anda lengkap dan dalam status '+data.status+'</small></b></p>' +
                                $('#hasil').append(HTML)
                            setTimeout(function(){
                                $('#hasil').html("")
                            },3000)
                        }
                    }else if(data.status === "EXPIRED"){
                        HTML =
                        '<p><small style="color:red">'+data.status+'</small></p>'
                        $('#hasil').append(HTML)
                        setTimeout(function(){
                            $('#hasil').html("")
                        },3000)
                    }else if(data.status === "SELESAI"){
                        HTML =
                        '<p><small style="color:green">'+data.status+'</small></p>'
                        $('#hasil').append(HTML)
                        setTimeout(function(){
                            $('#hasil').html("")
                        },3000)
                    }else{
                        HTML =
                        '<p><small>Token Anda Salah!</small></p>'
                        $('#hasil').append(HTML)
                        setTimeout(function(){
                            $('#hasil').html("")
                        },3000)
                    }
                }
                })
            })
            $('#inputGroupFile01').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                fileName = fileName.substring(fileName.lastIndexOf("\\")+1, fileName.length);
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })
        });

        function update(id){
            $("#result #footer").append('<button class="btn btn-primary" onclick=updating('+id+')>Update</button>')
            $("#result").modal({
                fadeDuration: 250,
                showClose: false,
                showSpinner: true,
                escapeClose: true,
                clickClose: false
            });
        }

        function updating(id){
            // sessionStorage.clear();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            })
            var form = document.getElementById('inputan');
            var formData = new FormData(form);
            formData.append('id', id);
            $.ajax({
                url: `/track/update`,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    const data = JSON.parse(response)
                    console.log(data)
                }
            })
        }
    </script>
@endsection
