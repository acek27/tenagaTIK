@extends('layouts.master')
@section('title')
    <title>DATA TENAGA TEKNIS TIK</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('header')
    <section class="content-header">
        <h1>
            Data Tenaga Teknis TIK
            <small>
                @if($dataid == 1)
                    Divisi Programming
                @elseif($dataid == 2)
                    Divisi Networking
                @elseif($dataid == 3)
                    Divisi Multimedia
                @elseif($dataid == 4)
                    Divisi Keamanan Informasi
                @endif
            </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Tabel Tenaga Teknis TIK</li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
                    @if($dataid == 1)
                        Tabel Tenaga Programmer
                    @elseif($dataid == 2)
                        Tabel Tenaga JARKOMDAT
                    @elseif($dataid == 3)
                        Tabel Tenaga Multimedia
                    @elseif($dataid == 4)
                        Tabel Tenaga Keamanan Informasi
                    @endif
                </h3>
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
                        <th>E-Mail</th>
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
    <script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            var dt = $('#data_tenaga').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('tenaga.data')}}?id={{$dataid}}',
                columns: [
                    {data: 'nik', name: 'nik'},
                    {data: 'nm_tenaga', name: 'nm_tenaga'},
                    {data: 'tgl_lahir', name: 'tgl_lahir'},
                    {data: 'telp', name: 'telp'},
                    {data: 'email', name: 'email'},
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
                $('#ttl').text(data.tempat_lahir +', '+ data.tgl_lahir);
                $('#alamat').text(data.alamat);
                $('#email').text(data.email);
                $('#hp').text(data.telp);
                $('#jk').text(data.jenis_kelamin);
                $('#pendidikan').text(data.keterangan +' '+ data.prog_studi);
                $('#npwp').text(data.npwp);
            });
        });
    </script>
@endpush
