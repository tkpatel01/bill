@extends('layout.masterlayout')

@section('customer')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Customer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Customer</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Customers</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>City</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $id => $customer)
                        <tr>
                            <td> {{$customer->id}}</td>
                            <td> {{$customer->name}}</td>
                            <td> {{$customer->gender}}</td>
                            <td>{{$customer->mobile}}</td>
                            <td>{{$customer->email}}</td>
                            <td> {{$customer->city}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="{{route('customer')}}" class="btn btn-danger"><i class="fa-solid fa-arrow-left"></i>
                Back</a>
        </div>
    </div>

@endsection

@section('title')
    View Customer
@endsection