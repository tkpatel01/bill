@extends('layout.masterlayout')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $total_expnese }}</h3>

                    <p>Total Expense</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('expense')}}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>53<sup style="font-size: 20px">%</sup></h3>

                    <p>Bounce Rate</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $customer }}</h3>

                    <p>Customer Registrations</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{route('customer')}}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>65</h3>

                    <p>Unique Visitors</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>


        <div class="table-responsive">
            <table border="1" cellpadding="6" cellspacing="0" xss="removed" class="table-bordered">
                <thead>
                    <tr xss="removed">
                        <th>ક્રમ</th>
                        <th>ઝોન</th>
                        <th>શહેર નું નામ</th>
                        <th>ક્રમ</th>
                        <th>છાત્રાલય/ઇન્સ્ટિટ્યૂટ બિલ્ડિંગની વિગત</th>
                        <th colspan="3">વિદ્યાર્થીઓને પ્રવેશ આપવાની અંદાજિત ક્ષમતા</th>
                        <th>ઓક્ટોમ્બર-2024 સુધીની પ્રગતિની સ્થિતિ</th>
                    </tr>
                    <tr xss="removed">
                        <th colspan="5"></th>
                        <th>કુમાર</th>
                        <th>કન્યા</th>
                        <th>કુલ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="7"><b>1</b></td>
                        <td rowspan="7"><b>અમદાવાદ-મધ્ય ગુજરાત</b></td>
                        <td rowspan="6">અમદાવાદ</td>
                        <td>1</td>
                        <td>ફેજ-1 (મુખ્ય ભવન)</td>
                        <td colspan="3"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>1.1</td>
                        <td>પી. એન. ડુંગરાણી(આકુરવાળા) કુમાર છાત્રાલય-1 (ફેજ-1)</td>
                        <td rowspan="2">1004</td>
                        <td rowspan="2">0</td>
                        <td rowspan="2">1004</td>
                        <td rowspan="4">છાત્રાલયમાં દીકરા-દીકરીઓ તથા 76 વર્કિંગ વુમન્સ નીવાસ કરી રહ્યા છે.</td>
                    </tr>
                    <tr>
                        <td>1.2</td>
                        <td>ગોપીન કુમાર છાત્રાલય -2 (ફેઝ-1)</td>
                    </tr>
                    <tr>
                        <td>1.3</td>
                        <td>CA. વી.વી. પટેલ-ગગજી સુતરીયા કન્યા છાત્રાલય (ફેજ-1)</td>
                        <td rowspan="2">0</td>
                        <td rowspan="2">806</td>
                        <td rowspan="2">806</td>
                    </tr>
                    <tr>
                        <td>1.4</td>
                        <td>SRK કન્યા છાત્રાલય-2 (ફેઝ-1)</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>(ફેજ -2) શકરીબેન ડાહ્યાભાઈ પટેલ સંકૂલ કન્યા છાત્રાલય</td>
                        <td>0</td>
                        <td>3000</td>
                        <td>3000</td>
                        <td>સંકૂલનું કાર્ય નિર્માણધીન</td>
                    </tr>
                    <tr>
                        <td>વડોદરા</td>
                        <td>1</td>
                        <td>ડો. દુષ્યંત &amp; દક્ષા પટેલ સંકૂલ કુમાર-કન્યા છાત્રાલય</td>
                        <td>0</td>
                        <td>1800</td>
                        <td>1800</td>
                        <td>સંકૂલનું કાર્ય નિર્માણધીન</td>
                    </tr>
                    <tr>
                        <td><b>2</b></td>
                        <td><b>દક્ષિણ ગુજરાત</b></td>
                        <td>સુરત</td>
                        <td>1</td>
                        <td>સરદારધામ યુનિવર્સિટિ</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>સૂચિત</td>
                    </tr>
                    <tr>
                        <td><b>3</b></td>
                        <td><b>ઉતર ગુજરાત</b></td>
                        <td>મહેસાણા</td>
                        <td>1</td>
                        <td>કુમાર-કન્યા છાત્રાલય</td>
                        <td>200</td>
                        <td>200</td>
                        <td>400</td>
                        <td>જમીન સંપાદન થય ગયા છે</td>
                    </tr>
                    <tr>
                        <td rowspan="2"><b>4</b></td>
                        <td rowspan="2"><b>સૌરાસ્ટ્ર-કચ્છ</b></td>
                        <td>રાજકોટ</td>
                        <td>1</td>
                        <td>કુમાર-કન્યા છાત્રાલય</td>
                        <td>500</td>
                        <td>500</td>
                        <td>1000</td>
                        <td>જમીન સંપાદન થય જ્ઞ છે</td>
                    </tr>
                    <tr>
                        <td>ભુજ</td>
                        <td>1</td>
                        <td>સિવિલ સર્વિસ સેન્ટર</td>
                        <td>100</td>
                        <td></td>
                        <td>100</td>
                        <td>સિવિલ સર્વિસ સેન્ટર કાર્યરત છે</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>દિલ્લી</td>
                        <td></td>
                        <td>1</td>
                        <td>સિવિલ સર્વિસ સેન્ટર</td>
                        <td>75</td>
                        <td></td>
                        <td>75</td>
                        <td>સિવિલ સર્વિસ સેન્ટર કાર્યરત છે</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-responsive mt-5">
            <table border="1" cellpadding="6" cellspacing="0" xss="removed" class="table-bordered">
                <thead>
                    <tr xss="removed">
                        <th><b>Sr.</b></th>
                        <th><b>Zone</b></th>
                        <th><b>Name of City</b></th>
                        <th></th>
                        <th><b>Building/Hostel</b></th>
                        <th colspan="3"><b>Capacity to Accommodate Number of Students</b></th>
                        <th><b>Progress as of October 2024</b></th>
                    </tr>
                    <tr xss="removed">
                        <th colspan="5"></th>
                        <th><b>Boys</b></th>
                        <th><b>Girls</b></th>
                        <th><b>Total</b></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="7">1</td>
                        <td rowspan="7"><b>Central Gujarat</b></td>
                        <td rowspan="6">Ahmedabad</td>
                        <td><b>1</b></td>
                        <td><b>Phase -1 (Main Building )</b></td>
                        <td colspan="3"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>1.1</td>
                        <td>P. N. Dungarani (Aakruwala) Boys Hostel-1</td>
                        <td rowspan="2">1004</td>
                        <td rowspan="2">0</td>
                        <td rowspan="2">1004</td>
                        <td rowspan="4">The hostel facilities are 
                            offered to students
                            (boys & girls). 76
                            working women are
                            also living in the hostel.</td>
                    </tr>
                    <tr>
                        <td>1.2</td>
                        <td>Gopin Boys Hostel -2</td>
                    </tr>
                    <tr>
                        <td>1.3</td>
                        <td>V. V. Patel (CA) - Gagji Sutariya Girls Hostel - 1</td>
                        <td rowspan="2">0</td>
                        <td rowspan="2">806</td>
                        <td rowspan="2">806</td>
                    </tr>
                    <tr>
                        <td>1.4</td>
                        <td>SRK Girls Hostel – 2</td>
                    </tr>
                    <tr>
                        <td><b>2</b></td>
                        <td><b>Phase – 2:</b> Shakriben dahayabhai patel sankul <b>Girls Hostel-1</b></td>
                        <td>0</td>
                        <td>3000</td>
                        <td>3000</td>
                        <td>Under Construction</td>
                    </tr>
                    <tr>
                        <td>Vadodara</td>
                        <td>1</td>
                        <td>Dr.Dushyant & Daksha patel sankul Boys & Girls Hostel</td>
                        <td></td>
                        <td></td>
                        <td>1800</td>
                        <td>Under Construction</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><b>South Gujarat</b></td>
                        <td>Surat</td>
                        <td>1</td>
                        <td>Sardardham University</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>Proposed</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><b>North Gujarat</b></td>
                        <td>Mehsana</td>
                        <td>1</td>
                        <td>Boys & Girls Hostel</td>
                        <td>200</td>
                        <td>200</td>
                        <td>400</td>
                        <td>Land Acquired</td>
                    </tr>
                    <tr>
                        <td rowspan="2">4</td>
                        <td rowspan="2"><b>Saurashtra - Kutchh</b></td>
                        <td>Rajkot</td>
                        <td>1</td>
                        <td>Boys & Girls Hostel</td>
                        <td>500</td>
                        <td>500</td>
                        <td>1000</td>
                        <td>Land Acquired</td>
                    </tr>
                    <tr>
                        <td>Bhuj</td>
                        <td>1</td>
                        <td>Civil Service Training</td>
                        <td></td>
                        <td></td>
                        <td>100</td>
                        <td>Civil Service Training</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td><b>Other Places</b></td>
                        <td>Delhi</td>
                        <td>1</td>
                        <td>Civil Service Training</td>
                        <td></td>
                        <td></td>
                        <td>75</td>
                        <td>Civil Service Training</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- ./col -->
    </div>


@endsection

@section('title')
    Dashboard
@endsection