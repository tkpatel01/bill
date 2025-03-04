@extends('layout.masterlayout')


@section('expense')

    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
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
        </div>
    </section>
    <div class="mb-5" id="modal-body">
        <div class="card card-primary">
            <div class="card-header"></div>
            <div class="card-body">
                <select id="payment" class="form-control payment-dropdown  col-md-2">
                    <option value="">All</option>
                    <option value="credit">Credit</option>
                    <option value="debit">Debit</option>
                </select>
            </div>
            <div class="card-footer">
                <div class="float-sm-right">
                    <button type="submit" class="btn btn-primary click">Search</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Expense Report</h3>
            <div class="card-tools">
                {{-- <a href="/newexpense">
                    <button class="btn btn-light">+ Add Expense</button>
                </a> --}}
                <button type="button" id="add-expense" class="btn btn-default" data-toggle="modal" data-target="#modal">
                    Add Expense
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Item</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <div class="modal fade" id="modal">
        <div class="modal-dialog modal modal-dialog-centered">
            <div class="modal-content">
                <form id="quickForm" action="" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title"><span class="title">Add</span> Expense</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" class="id">

                        <div class="customer">
                            <label for="customer_id">Customer</label>
                            <select name="customer_id" id="customer_id" class="form-control customer_id select2 js-data-example-ajax">
                                <option value="">Select Customer</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="item">item</label>
                                <input type="item" name="item" class="form-control item @error('item') is-invalid @enderror"
                                    id="item" value="" placeholder="Enter item">
                                @error('item')
                                    <span class="error text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="date">Date</label>
                                <input type="date" name="date" class="form-control date @error('date') is-invalid @enderror"
                                    value="" id="date">
                                @error('date')
                                    <span class="error text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="number">Amount</label>
                                <input type="number" name="amount"
                                    class="form-control amount @error('amount') is-invalid @enderror" id="amount" value=""
                                    placeholder="0">
                                @error('amount')
                                    <span class="error text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="text">Payment</label>
                                <select name="payment" id="payment" class="payment form-control">
                                    <option value="">Select Payment</option>
                                    <option value="debit">Debit</option>
                                    <option value="credit">credit</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
cd 

    @push('js')

        {{-- axja fetch data --}}
        <script>

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = null;
            $(document).ready(function () {
                table = $('#example').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'serverMethod': 'POST',
                    'dataType': 'json',
                    'ajax': {
                        url: '{!!route('expenseReport')!!}',
                        data: function (e) {
                            e.payment = $(".payment-dropdown").val();
                            return e;
                        }
                    },
                    columns: [
                        { data: "id" },
                        { data: "customer_id" },
                        { data: "item" },
                        { data: "date" },
                        { data: "amount" },
                        { data: "payment" },
                        { data: "status" },
                        { data: "action" }
                    ],
                    layout: {
                        topStart: {
                            buttons: ['pageLength', 'copy', 'csv', 'excel', 'pdf', 'print']
                        }

                    }
                });
                $(document).on('click', '.click', function () {
                    table.ajax.reload();
                });
            });
        </script>

        {{-- select2 ajax --}}
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

        {{-- add-update model --}}
        <script>
            $(document).on('click', '.update_expense', function (e) {
                // update
                const { id, customer_id, item, date, amount, payment } = $(this).data();
                $('.title').text('Edit');
                $(".id").val(id);
                $(".customer_id").val(customer_id);
                $('.item').val(item);
                $('.date').val(date);
                $('.amount').val(amount);
                $('.payment').val(payment);

            });
            $('#quickForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '{{route('update_expense')}}',
                    data: $('#quickForm').serialize(),
                    type: 'post',
                    success: function (res) {
                        table.ajax.reload();
                        sweetalert('success', res?.message);
                        $('#modal form').trigger('reset');
                        $('.fade').hide('#modal');

                    }
                });
            });
            
            // add
            $('#add-expense').click(function () {
                $('#quickForm').attr('action', '{{route('addExpense')}}');
                $('.title').text('Add');
                $('#modal form').trigger('reset');
                $('input').val('');

            });
            $('#quickForm').on('submit', function (c) {
                c.preventDefault();
                $.ajax({
                    url: '{{url('addExpense')}}',
                    data: $('#quickForm').serialize(),
                    type: 'POST',
                    success: function (result) {
                        table.ajax.reload();
                        sweetalert('success', result?.message);
                        $('.fade').hide('#modal');

                    }
                });
            });
        </script>
    @endpush

@endsection

@section('title')
    Expense Report
@endsection