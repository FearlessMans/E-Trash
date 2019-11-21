@extends('layouts.userapp')

@section('content')

    <div class="container product">
        <div class="header-body text-center mb-7">
            <h1 class="text-black">Product of E-Trash</h1>
        </div>
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
    <div class="container about">
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
