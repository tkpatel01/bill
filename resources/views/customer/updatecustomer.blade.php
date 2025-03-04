@extends('layout.masterlayout')

@section('updatecustomer')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Customer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Update Customer</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Update Customer</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('update.customer', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="{{$data->name}}"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    placeholder="Enter Name">
                                @error('name')
                                    <span class="error text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="mobile">Mobile</label>
                                <input type="mobile" name="mobile" value="{{$data->mobile}}"
                                    class="form-control @error('mobile') is-invalid @enderror" id="mobile"
                                    placeholder="Enter Mobile No.">
                                @error('mobile')
                                    <span class="error text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" name="email" value="{{$data->email}}"
                                    class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1"
                                    placeholder="Enter email">
                                @error('email')
                                    <span class="error text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="city">City</label>
                                <input type="text" name="city" value="{{$data->city}}"
                                    class="form-control @error('city') is-invalid @enderror" id="city"
                                    placeholder="Enter Your City">
                                @error('city')
                                    <span class="error text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group mb-0">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                                <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of
                                        service</a>.</label>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">

        </div>
        <!--/.col (right) -->
    </div>

@endsection


@section('title')
    Update User
@endsection