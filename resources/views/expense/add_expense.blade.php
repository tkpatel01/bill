@extends('layout.masterlayout')

@section('add_expense')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Expense</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Expense</li>
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
                    <h3 class="card-title">Add New Expense</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="quickForm" action="/addExpense" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="text">Customer</label>
                                <select name="customer_id" id="customer_id"
                                    class="form-control select2 js-data-example-ajax">
                                    <option value="">Select Customer</option>
                                    {{-- @foreach ($customer as $cus)
                                    <option value="{{ $cus->id}}">{{ $cus->name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="item">Item</label>
                                <input type="text" name="item" class="form-control @error('item') is-invalid @enderror"
                                    id="item" placeholder="Enter Item">
                                @error('item')
                                    <span class="error text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="date">Date</label>
                                <input type="date" name="date" class="form-control @error('date') is-invalid @enderror"
                                    id="date">
                                @error('date')
                                    <span class="error text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="amount">Amount</label>
                                <input type="number" name="amount"
                                    class="form-control @error('amount') is-invalid @enderror" id="amount" placeholder="0">
                                @error('amount')
                                    <span class="error text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-check form-check-inline ">
                            <input class="form-check-input" type="radio" name="payment" id="inlineRadio1" value="credit">
                            <label class="form-check-label" for="inlineRadio1">Credit</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="payment" id="inlineRadio2" value="debit">
                            <label class="form-check-label" for="inlineRadio2">Debit</label>
                        </div>
                        <div class="form-group mt-3 mb-0">
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

    @push('js')
        <script>
            $(document).ready(function () {
                $('#customer_id').select2({
                    ajax: {
                        type: 'get',
                        url: '{!!route('selectName')!!}'
                    }
                });
            });
        </script>
    @endpush
@endsection


@section('title')
    Add User
@endsection