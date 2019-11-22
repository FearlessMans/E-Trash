@extends('layouts.userapp')

@section('content')
<hr width="1000">
    <div class="container" id="transaksi">
        <div class="header-body text-center mb-7">
            <h1 class="text-black">Transaction Check</h1>
            <p>Loosing your transaction? You now can check it here. Dont forget to use your token after you pay it all.</p>
        </div>
        <div class="container">
            <form class="form-inline justify-content-center">
                <p>
                    <input class="form-control" type="text" placeholder="Masukkan Token">
                    <button class="btn btn-primary">Submit</button>
                </p>
            </form>
        </div>
    </div>
<hr width="1000">
    <div class="container" id="product">
        <div class="header-body text-center mb-7">
            <h1 class="text-black">Product of E-Trash</h1>
        </div> <br>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img class="card-img-top" src="img_avatar1.png" alt="Card image">
                        <div class="card-body">
                            <h4 class="card-title">John Doe</h4>
                            <p class="card-text">Some example text.</p>
                            <a href="#" class="btn btn-primary">See Profile</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow sm">
                        <img class="card-img-top" src="img_avatar1.png" alt="Card image">
                        <div class="card-body">
                            <h4 class="card-title">John Doe</h4>
                            <p class="card-text">Some example text.</p>
                            <a href="#" class="btn btn-primary">See Profile</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow sm">
                        <img class="card-img-top" src="img_avatar1.png" alt="Card image">
                        <div class="card-body">
                            <h4 class="card-title">John Doe</h4>
                            <p class="card-text">Some example text.</p>
                            <a href="#" class="btn btn-primary">See Profile</a>
                        </div>
                    </div>
                </div>
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

@endsection
