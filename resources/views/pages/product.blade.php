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
                                @foreach ($product as $item)
                                    <tr>
                                        <td>{{$item->nama_sampah}}</td>
                                        <td>{{$item->harga}}</td>
                                        <td>{{$item->qty}}</td>
                                        <td width="200">
                                            <button class="btn btn-danger" id="deletion_{{$item->id}}" onclick="deletion({{$item->id}})">
                                                <i class="tim-icons icon-trash-simple"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
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
                url: '/product/add',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(){
                    document.getElementById("Form").reset();
                    location.reload();
                    $.notify({
                        icon: "tim-icons icon-bell-55",
                        message: "New Product Added"
                    },{
                        type: type['#f6383b'],
                        timer: 5000,
                        placement: {
                            from: 'top',
                            align: 'center'
                        }
                    })
                }
            })
        });
    });

    function deletion(id){
        if(confirm("Are you sure to delete this record ?")){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            })
            $.ajax({
                url: `/product/delete/`+id,
                method: 'delete',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id" : id
                },
                success: function(){
                    location.reload(),
                    $.notify({
                        icon: "tim-icons icon-bell-55",
                        message: "Product removed."
                    },{
                        type: type['#f6383b'],
                        timer: 5000,
                        placement: {
                            from: 'top',
                            align: 'center'
                        }
                    });
                }
            });
        }
    }
</script>
@endsection
