@extends('layouts.master')
@section('title')
    <title>Admin PSTIK</title>
@endsection
@section('css')
    <link href="{{url('https://cdnjs.cloudflare.com/ajax/libs/gijgo/1.9.13/combined/css/gijgo.min.css')}}"
          rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('header')
    <section class="content-header">
        <h1>
            Dashboard
            <small>Dinas Kominfo dan Persandian</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
@endsection
@section('content')
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$data->where('id_divisi',1)->count('id_tenaga')}}<sup style="font-size: 20px"> Orang</sup>
                        </h3>
                        <p>Programming</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-code"></i>
                    </div>
                    <a href="{{route('home.show',1)}}" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{$data->where('id_divisi',2)->count('id_tenaga')}}<sup style="font-size: 20px"> Orang</sup>
                        </h3>

                        <p>Networking</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-sitemap"></i>
                    </div>
                    <a href="{{route('home.show',2)}}" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{$data->where('id_divisi',3)->count('id_tenaga')}}<sup style="font-size: 20px"> Orang</sup>
                        </h3>

                        <p>Multimedia</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-image"></i>
                    </div>
                    <a href="{{route('home.show',3)}}" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{$data->where('id_divisi',4)->count('id_tenaga')}}<sup style="font-size: 20px"> Orang</sup>
                        </h3>

                        <p>Keamanan Informasi</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-key"></i>
                    </div>
                    <a href="{{route('home.show',4)}}" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <i class="fa fa-bar-chart"></i>
                        <h3 class="box-title">Grafik Tenaga Teknis TIK</h3>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="myChart" style="height:230px"></canvas>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">

                <!-- Map box -->
                <div class="box box-solid bg-light-blue-gradient">
                    <div class="box-header">
                        <i class="glyphicon glyphicon-education"></i>
                        <h3 class="box-title">
                            Pendidikan
                        </h3>
                        <canvas id="donat" style="height:230px"></canvas>
                    </div>

                </div>
                <!-- /.box -->
            </section>
            <!-- right col -->
        </div>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
                    Tabel Tenaga Teknis TIK
                </h3>
                <a href="{{route('download')}}" class="btn btn-primary pull-right" style="margin-right: 5px;">
                    <i class="fa fa-download"></i> Download
                    <div class="ripple-container"></div>
                </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="data_tenaga" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama Tenaga Teknis</th>
                        <th>Tanggal Lahir</th>
                        <th>No. HP</th>
                        <th>Divisi</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Biodata Tenaga Teknis TIk</h4>
                    <br>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Divisi</th>
                                <td><p id="divisi"></td>
                            </tr>
                            <tr>
                                <th>NIK</th>
                                <td><p id="nik"></td>
                            </tr>
                            <tr>
                                <th>Nama Lengkap & Gelar</th>
                                <td><p id="nm_tenaga"></td>
                            </tr>
                            <tr>
                                <th>Tempat, Tanggal Lahir</th>
                                <td id="ttl"></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td id="alamat"></td>
                            </tr>
                            <tr>
                                <th>E-Mail</th>
                                <td id="email"></td>
                            </tr>
                            <tr>
                                <th>No. HP</th>
                                <td id="hp"></td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td id="jk"></td>
                            </tr>
                            <tr>
                                <th>Pendidikan</th>
                                <td id="pendidikan"></td>
                            </tr>
                            <tr>
                                <th>NPWP</th>
                                <td id="npwp"></td>
                            </tr>
                        </table>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{url('https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js')}}"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Programming', 'Networking', 'Multimedia', 'Keamanan Informasi'],
                datasets: [{
                    label: 'Tenaga Teknis TIK',
                    data: [
                       {{$data1}}
                    ],
                    backgroundColor: [
                        'rgba(0, 192, 239, 1)',
                        'rgba(0, 166, 90, 1)',
                        'rgba(243, 156, 18, 1)',
                        'rgba(221, 75, 57, 1)',
                    ],
                    borderColor: [
                        'rgba(0, 192, 239, 1)',
                        'rgba(0, 166, 90, 1)',
                        'rgba(243, 156, 18, 1)',
                        'rgba(221, 75, 57, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            userCallback: function (label, index, labels) {
                                // when the floored value is the same as the value we have a whole number
                                if (Math.floor(label) === label) {
                                    return label;
                                }

                            },
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    callbacks: {
                        label: function (tooltipItem) {
                            return tooltipItem.yLabel;
                        }
                    }
                }
            }
        });

        var nut = document.getElementById('donat').getContext('2d');
        var donat = new Chart(nut, {
            type: 'doughnut',
            data: {
                labels: ['Diploma 3', 'Strata 1'],
                datasets: [{
                    label: 'Tenaga Teknis TIK',
                    data: [
                        @foreach($donat as $donut)
                        {{$donut->total}},
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(243, 156, 18, 1)',
                        'rgba(221, 75, 57, 1)',
                    ],
                    borderColor: [
                        'rgba(243, 156, 18, 1)',
                        'rgba(221, 75, 57, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });
    </script>
@endpush
@push('scripts')
    <script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            var dt = $('#data_tenaga').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('tenaga.data')}}',
                columns: [
                    {data: 'nik', name: 'nik'},
                    {data: 'nm_tenaga', name: 'nm_tenaga'},
                    {data: 'tgl_lahir', name: 'tgl_lahir'},
                    {data: 'telp', name: 'telp'},
                    {data: 'nama_divisi', name: 'nama_divisi'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, align: 'center'},
                ]
            });
        });
        $('body').on("click", '.show-data', function (e) {
            $('#myModal').modal("show");
            $.get("/biodata/" + $(this).attr('data-id'), function (data) {
                console.log(data);
                $('#divisi').text(data.nama_divisi);
                $('#nik').text(data.nik);
                $('#nm_tenaga').text(data.nm_tenaga);
                $('#ttl').text(data.tempat_lahir + ', ' + data.tgl_lahir);
                $('#alamat').text(data.alamat);
                $('#email').text(data.email);
                $('#hp').text(data.telp);
                $('#jk').text(data.jenis_kelamin);
                $('#pendidikan').text(data.keterangan + ' ' + data.prog_studi);
                $('#npwp').text(data.npwp);
            });
        });
    </script>
@endpush
