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
                <p>
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <input class="form-control" type="text" name="tok" placeholder="Masukkan Token">
                    <button class="btn btn-primary" id = "submit">Submit</button>
                </p>
            </form>
        </div>
        <div class="container" id="showing_case">

        </div>
    </div>
<hr width="1000">
    <div class="container" id="product">
        <div class="header-body text-center mb-7">
            <h1 class="text-black">Product of E-Trash</h1>
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
                    const data = JSON.parse(response);
                    data.forEach(function(item){
                        console.log(item.status)
                    })
                }
                })
            })
        });
</script>
@endsection
