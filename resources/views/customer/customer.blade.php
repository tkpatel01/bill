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
            <div class="card-tools">
                <button type="button" id="add-customer" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">
                    Add Customer
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
                        <th>Total Sum</th>
                        <th>Gender</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>City</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($data as $id => $customer)
                    <tr>
                        <td> {{$customer->id}}</td>
                        <td><button class="btn btn-primary"><a href="{{ route('view.customer', $customer->id) }}"><i
                                        class="fa-solid fa-eye text-white"></i></a></button>

                            <button class="btn btn-warning"><a href="{{ route('update.customerpage', $customer->id) }}"><i
                                        class="fa-solid fa-pen-to-square text-white"></i></a></button>

                            <button class="btn btn-danger"><a href="{{ route('delete.customer', $customer->id) }}"><i
                                        class="fa-solid fa-trash text-white"></i></a></button>
                        </td>
                        <td> {{$customer->name}}</td>
                        <td>{{ $customer->Expense->sum('amount') }}</td>
                        <td> {{$customer->gender}}</td>
                        <td>{{$customer->mobile}}</td>
                        <td>{{$customer->email}}</td>
                        <td> {{$customer->city}}</td>
                    </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <!-- modal -->
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form id="quickForm" action="" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title"><span class="title">Add</span> Customer</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id" class="id">
                            <div class="form-group col-md-4">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control name @error('name') is-invalid @enderror"
                                    id="name" value='' placeholder="Enter Name">
                                @error('name')
                                    <span class="error text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="mobile">Mobile</label>
                                <input type="mobile" name="mobile"
                                    class="form-control mobile @error('mobile') is-invalid @enderror" id="mobile" value=""
                                    maxlength="10" placeholder="Enter Mobile No.">
                                @error('mobile')
                                    <span class="error text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" name="email"
                                    class="form-control email @error('email') is-invalid @enderror" value=""
                                    id="exampleInputEmail1" placeholder="Enter email">
                                @error('email')
                                    <span class="error text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="city">City</label>
                                <input type="text" name="city" class="form-control city @error('city') is-invalid @enderror"
                                    id="city" value="" placeholder="Enter Your City">
                                @error('city')
                                    <span class="error text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="text">Gender</label>
                                <select name="gender" id="gender" class="gender form-control">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit">Save</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    @push('js')

        {{-- ajax fetch data --}}
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
                    'ajax': '{!!route('customerReport')!!}',
                    columns: [
                        { data: "id" },
                        { data: "name" },
                        { data: "total" },
                        { data: "gender" },
                        { data: "mobile" },
                        { data: "email" },
                        { data: "city" },
                        { data: "action" }
                    ],
                    layout: {
                        topStart: {
                            buttons: ['pageLength', 'copy', 'csv', 'excel', 'pdf', 'print']
                        }
                    }
                });
            });
        </script>

        {{-- add-update model --}}
        <script>
            $(document).on('click', '.update_customer', function (e) {
                // update
                const { id, name, gender, mobile, email, city } = $(this).data();

                $('.title').text('Edit');
                $(".id").val(id);
                $(".name").val(name);
                $('.gender').val(gender);
                $('.mobile').val(mobile);
                $('.email').val(email);
                $('.city').val(city);
            });
            $('#quickForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '{{route('update_customer')}}',
                    data: $('#quickForm').serialize(),
                    type: 'POST',
                    success: function (res) {
                        table.ajax.reload();
                        sweetalert('success', res?.message);
                        $('#modal-lg form').trigger('reset');
                        $('.fade').hide('#modal-lg');
                    }
                });
            });

            // add
            $('#add-customer').click(function () {
                $('#quickForm').attr('action', '{{route('addCustomer')}}');
                $('.title').text('Add');
                $('#modal-lg form').trigger('reset');

                $('#quickForm').on('submit', function (c) {
                    c.preventDefault();
                    $.ajax({
                        url: '{{url('addCustomer')}}',
                        data: $('#quickForm').serialize(),
                        type: 'POST',
                        success: function (result) {
                            table.ajax.reload();
                            sweetalert('success', result?.message);
                            $('#modal-lg').hide('.fade');
                        }
                    });
                });
            });
        </script>

    @endpush
@endsection

@section('title')
    Customer
@endsection