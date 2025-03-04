@extends('layout.masterlayout')

@section('expense')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Expense</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Expense</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Expense</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Item</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Payment-type</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $id => $expense)
                        <tr>
                            <td> {{$expense->id}}</td>
                            <td> {{$expense->name}}</td>
                            <td> {{$expense->item}}</td>
                            <td> {{$expense->date}}</td>
                            <td> {{$expense->amount}}</td>
                            <td> {{$expense->payment}}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        {{-- <th>Total Amount : {{ $expense->Expense->sum('amount') }}</th> --}}
                        
                    </tfoot>
                    @endforeach
            </table>
        </div>
        <div class="card-footer">
            <a href="{{route('expense')}}" class="btn btn-danger"><i class="fa-solid fa-arrow-left"></i>
                Back</a>
        </div>
        <!-- /.card-body -->
    </div>

@endsection

@section('title')
    View Expense
@endsection