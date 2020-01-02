<?php
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=tenaga_teknis_TIK.xlsx");
?>
<h3>Data Tenaga Teknis TIK</h3>

<table border="1" cellpadding="5">
    <tr>
        <th>NIK</th>
        <th>Nama Lengkap</th>
        <th>TTL</th>
        <th>Alamat</th>
        <th>E-Mail</th>
        <th>No. HP</th>
        <th>Jenis Kelamin</th>
        <th>Pendidikan</th>
        <th>NPWP</th>
        <th>Divisi</th>
    </tr>
    <tr>
        @foreach($download as $value)
            <td>{{$value->nik}}</td>
            <td>{{$value->nm_tenaga}}</td>
            <td>{{$value->tempat_lahir}} ,{{$value->tgl_lahir}}</td>
            <td>{{$value->alamat}}</td>
            <td>{{$value->email}}</td>
            <td>(+62) {{$value->telp}}</td>
            <td>{{$value->jenis_kelamin}}</td>
            <td>{{$value->keterangan}}/{{$value->prog_studi}}</td>
            <td>{{$value->npwp}}</td>
            <td>{{$value->nama_divisi}}</td>
        @endforeach
    </tr>
</table>
