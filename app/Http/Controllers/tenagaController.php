<?php

namespace App\Http\Controllers;

use App\divisi;
use App\jeniskelamin;
use App\pendidikan;
use App\tenagateknis;
use Illuminate\Http\Request;

class tenagaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $jk = jeniskelamin::all();
        $divisi = divisi::all();
        return view('index', compact('jk','divisi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $divisi = $request->get('divisi');
        $nama = $request->get('nama');
        $tempatlahir = $request->get('tempatlahir');
        $tanggallahir = $request->get('tanggallahir');
        $alamat = $request->get('alamat');
        $nik = $request->get('nik');
        $email = $request->get('email');
        $hp = $request->get('hp');
        $jeniskelamin = $request->get('jeniskelamin');
        $pendidikan = $request->get('pendidikan');
        $jurusan = $request->get('jurusan');
        $npwp = $request->get('npwp');

        $request->validate([
            'tanggallahir' => 'date|required',
            'nik' => 'numeric|digits:16|required',
            'hp' => 'numeric|required',
        ]);

        $tenaga = new tenagateknis();
        $tenaga->nm_tenaga = $nama;
        $tenaga->tempat_lahir = $tempatlahir;
        $tenaga->tgl_lahir = $tanggallahir;
        $tenaga->alamat = $alamat;
        $tenaga->nik = $nik;
        $tenaga->email = $email;
        $tenaga->telp = $hp;
        $tenaga->id_jk = $jeniskelamin;
        $tenaga->id_pendidikan =$pendidikan;
        $tenaga->prog_studi = $jurusan;
        $tenaga->npwp = $npwp;
        $tenaga->id_divisi = $divisi;
        $tenaga->save();

        \Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil Menyimpan. Terimakasih, $nama!"
        ]);
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
