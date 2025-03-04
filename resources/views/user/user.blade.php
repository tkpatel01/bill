@extends('layout.masterlayout')

@section('user')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Users</h3>
            <div class="card-tools">
                {{-- <a href="{{route('newuser')}}">
                    <button class="btn btn-light">+ Add User</button>
                </a> --}}
                <button type="button" id="add-user" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">
                    Add User
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Role</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($data as $id => $user)
                    <tr>
                        <td> {{$user->id}}</td>
                        <td><button class="btn btn-primary"><a href="{{ route('view.user', $user->id) }}"><i
                                        class="fa-solid fa-eye text-white"></i></a></button>

                            <button class="btn btn-warning"><a href="{{ route('update.userpage', $user->id) }}"><i
                                        class="fa-solid fa-pen-to-square text-white"></i></a></button>

                            <button class="btn btn-danger"><a href="{{ route('delete.user', $user->id) }}"><i
                                        class="fa-solid fa-trash text-white"></i></a></button>
                        </td>
                        <td> {{$user->name}}</td>
                        <td>{{$user->mobile}}</td>
                        <td>{{$user->email}}</td>
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
                            <div class="col-md-3">
                                <label for="text">Role</label>
                                <select name="role" id="role" class="role form-select @error('role') is-invalid @enderror"
                                    value="">
                                    <option value="">Select Role</option>
                                    <option value="reader">Reader</option>
                                    <option value="admin">Admin</option>
                                </select>
                                @error('role')
                                    <span class="error text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Email Address</label>
                                <input type="email" name="email"
                                    class="form-control email @error('email') is-invalid @enderror" value=""
                                    id="exampleInputEmail1" placeholder="Enter email">
                                @error('email')
                                    <span class="error text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="password" class="password">Password</label>
                                <input type="password" name="password"
                                    class="form-control password @error('password') is-invalid @enderror" value=""
                                    id="password" placeholder="Enter Paasword">
                                @error('password')
                                    <span class="error text-danger">{{$message}}</span>
                                @enderror
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
                    'ajax': '{!!route('userReport')!!}',
                    columns: [
                        { data: "id" },
                        { data: "role" },
                        { data: "name" },
                        { data: "mobile" },
                        { data: "email" },
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
            $(document).on('click', '.update_user', function (e) {
                // update
                const { id, role, name, mobile, email } = $(this).data();

                $('.title').text('Edit');
                $(".id").val(id);
                $('.role').val(role);
                $(".name").val(name);
                $('.mobile').val(mobile);
                $('.email').val(email);
                $('.password').hide();
            });

            $('#quickForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '{{route('update_user')}}',
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
            $('#add-user').click(function () {
                $('#quickForm').attr('action', '{{route('addCustomer')}}');
                $('.title').text('Add');
                $('#modal-lg form').trigger('reset');
                $('input').val('');
                $(".id").show();
                $('.role').show();
                $(".name").show();
                $('.mobile').show();
                $('.email').show();
                $('.password').show();

                $('#quickForm').on('submit', function (c) {
                    c.preventDefault();
                    $.ajax({
                        url: '{{route('add_user')}}',
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
    User
@endsection