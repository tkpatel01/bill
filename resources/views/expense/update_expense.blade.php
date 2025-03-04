@extends('layout.masterlayout')

@section('update_expense')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Expense</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Update Expense</li>
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
                    <h3 class="card-title">Update Expense</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="quickForm" action="{{ route('update.expense', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="name">Name</label>
                                <select name="customer_id" id="customer_id" class="form-control">
                                    <option value="">Select Customer</option>
                                    @foreach ($customer as $cus)
                                        <option value="{{ $cus->id}}" {{ ($cus->id == $data->customer_id) ? "selected" : ""  }}>{{ $cus->name }}</option>
                                    @endforeach
                                </select>
                                @error('name')
                                    <span class="error text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="item">Item</label>
                                <input type="text" name="item" value="{{$data->item}}"
                                    class="form-control @error('item') is-invalid @enderror" id="item"
                                    placeholder="Enter Item.">
                                @error('item')
                                    <span class="error text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="date">Date</label>
                                <input type="date" name="date" value="{{$data->date}}"
                                    class="form-control @error('date') is-invalid @enderror" id="date"
                                    placeholder="Enter email">
                                @error('date')
                                    <span class="error text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="number">Amount</label>
                                <input type="number" name="amount" value="{{$data->amount}}"
                                    class="form-control @error('amount') is-invalid @enderror" id="number" placeholder="0">
                                @error('amount')
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
                        <a href="{{route('expense')}}" class="btn btn-danger"><i class="fa-solid fa-arrow-left"></i>
                            Back</a>
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
    Update Expense
@endsection