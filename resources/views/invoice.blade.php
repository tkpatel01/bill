@extends('layout.masterlayout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Invoice</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> {{ Auth::user()->name }}
                                    <small class="float-right">Date: 2/10/2014</small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                From
                                <address>
                                    <strong>{{ Auth::user()->name }}, Inc.</strong><br>
                                    795 Folsom Ave, Suite 600<br>
                                    San Francisco, CA 94107<br>
                                    Phone: {{ Auth::user()->mobile }}<br>
                                    Email: {{ Auth::user()->email }}
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                To
                                <address>
                                    <strong>{{ $data->name }}</strong><br>
                                    795 Folsom Ave, Suite 600<br>
                                    San Francisco, CA 94107<br>
                                    Phone: {{ $data->mobile }}<br>
                                    Email: {{ $data->email }}
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b>Invoice #007612</b><br>
                                <br>
                                <b>Order ID:</b> 4F3S8J<br>
                                <b>Payment Due:</b> 2/22/2014<br>
                                <b>Account:</b> 968-34567
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Item</th>
                                            <th>Serial #</th>
                                            <th>Description</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($expense as $item)

                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->item}} </td>
                                                <td>422-568-642</td>
                                                <td>Tousled lomo letterpress</td>
                                                <td class="amount">{{ $item->amount}} </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">
                                <p class="lead">Payment Methods:</p>
                                <img src="{{ asset('dist/img/credit/visa.png')}}" alt="Visa">
                                <img src="{{ asset('dist/img/credit/mastercard.png')}}" alt="Mastercard">
                                <img src="{{ asset('dist/img/credit/american-express.png')}}" alt="American Express">
                                <img src="{{ asset('dist/img/credit/paypal2.png')}}" alt="Paypal">

                                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya
                                    handango imeem
                                    plugg
                                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                                </p>
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                <p class="lead">Amount Due 2/22/2014</p>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td>{{$item->amount}} </td>
                                        </tr>
                                        <tr>
                                            <th>Tax (0.0%)</th>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping:</th>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td>{{$item->amount}} </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">
                                <button type="button" class="btn btn-defauult float-left"
                                    onclick="javascript:window.print();"><i class="fas fa-print"></i>
                                    Print
                                </button>
                                <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i>
                                    Submit
                                    Payment
                                </button>
                                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Generate PDF
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <script>
        $(document).ready(function () {
            // Function to calculate total sum
            function calculateTotal() {
                var total = 0;
                // Loop through each row in the table's tbody
                $('#myTable tbody tr').each(function () {
                    // Get the price from each row
                    var price = parseFloat($(this).find('.amount').text());
                    if (!isNaN(price)) {
                        total += price;
                    }
                });
                // Display the total in the specified span
                $('#totalSum').text(total);
            }

            // Call the calculateTotal function
            calculateTotal();
        });
    </script>
@endsection

@section('title')
    Invoice
@endsection