<?php
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=tenaga_teknis_TIK.xlsx");
?>
<h3>Data Tenaga Teknis TIK</h3>

<table border="1">
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
    @foreach($download as $value)
        <tr>
            <td>{{$value->nik}}</td>
            <td style="text-transform: capitalize">{{$value->nm_tenaga}}</td>
            <td style="text-transform: capitalize">{{$value->tempat_lahir}} ,{{$value->tgl_lahir}}</td>
            <td style="text-transform: capitalize">{{$value->alamat}}</td>
            <td>{{$value->email}}</td>
            <td>(+62) {{$value->telp}}</td>
            <td style="text-transform: lowercase">{{$value->jenis_kelamin}}</td>
            <td style="text-transform: uppercase">{{$value->keterangan}}/{{$value->prog_studi}}</td>
            <td>{{$value->npwp}}</td>
            <td>{{$value->nama_divisi}}</td>
        </tr>
    @endforeach
</table>
