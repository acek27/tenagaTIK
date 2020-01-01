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
    </script>
@endpush
