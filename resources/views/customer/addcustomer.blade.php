@extends('layout.masterlayout')

@section('addcustomer')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Customer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Customer</li>
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
                    <h3 class="card-title">Add New Customer</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="quickForm" action="{{ route('addCustomer')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    id="name" placeholder="Enter Name">
                                @error('name')
                                    <span class="error text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="mobile">Mobile</label>
                                <input type="mobile" name="mobile"
                                    class="form-control @error('mobile') is-invalid @enderror"
                                    id="mobile" placeholder="Enter Mobile No.">
                                @error('mobile')
                                    <span class="error text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                    id="exampleInputEmail1" placeholder="Enter email">
                                @error('email')
                                    <span class="error text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="city">City</label>
                                <input type="text" name="city" class="form-control @error('city') is-invalid @enderror"
                                    id="city" placeholder="Enter Your City">
                                @error('city')
                                    <span class="error text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male">
                            <label class="form-check-label" for="inlineRadio1">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female">
                            <label class="form-check-label" for="inlineRadio2">Female</label>
                        </div>

                        <div class="form-group mt-2">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                                <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of
                                        service</a>.</label>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
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
    Add Customer
@endsection