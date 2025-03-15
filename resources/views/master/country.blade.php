@extends('layout.masterlayout')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Country</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <button type="button" id="add_country" class="btn btn-default" data-toggle="modal"
                            data-target="#modal">
                            Add Country
                        </button>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="mb-5" id="modal-body">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Country</h3>
                <div class="card-tools"></div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="modal">
        <div class="modal-dialog modal modal-dialog-centered">
            <div class="modal-content">
                <form id="quickForm" action="" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title"><span class="title">Add</span> Country</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id" class="id">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control name @error('name') is-invalid @enderror"
                                    id="name" value='' placeholder="Enter Name">
                                @error('name')
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
                    'ajax': '{!!route('countryReport')!!}',
                    columns: [
                        { data: "id" },
                        { data: "name" },
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
            $(document).on('click', '.update_country', function (e) {
                // update
                const { id, name } = $(this).data();

                $('.title').text('Edit');
                $(".id").val(id);
                $(".name").val(name);
            });

            $('#quickForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '{{route('update_country')}}',
                    data: $('#quickForm').serialize(),
                    type: 'POST',
                    success: function (res) {
                        table.ajax.reload();
                        sweetalert('success', res?.message);
                        $('#modal form').trigger('reset');
                        $('.fade').hide('#modal');
                        // $(this).closest('#modal').modal('toggle');
                    }
                });
            });

            // add
            $('#add_country').click(function () {
                $('#quickForm').attr('action', '{{route('addCountry')}}');
                $('.title').text('Add');
                $('#modal form').trigger('reset');

                $('#quickForm').on('submit', function (c) {
                    c.preventDefault();
                    $.ajax({
                        url: '{{url('addCountry')}}',
                        data: $('#quickForm').serialize(),
                        type: 'POST',
                        success: function (result) {
                            table.ajax.reload();
                            sweetalert('success', result?.message);
                            $('#modal').hide('.fade');
                        }
                    });
                });
            });
        </script>

    @endpush
@endsection

@section('title')
    Country
@endsection