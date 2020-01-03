<?php

namespace App\Http\Controllers;

use App\divisi;
use App\jeniskelamin;
use App\pendidikan;
use App\tenagateknis;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = tenagateknis::all();
        $donat = tenagateknis::select(DB::raw('count(*) as total'))->groupby('id_pendidikan')->get();
        $chart = tenagateknis::select('id_divisi',DB::raw('count(*) as total'))->groupby('id_divisi')->get();

        $re = [0, 0, 0, 0];
        foreach ($chart as $key => $value) {
            $re[$value->id_divisi - 1]= $value->total;
        }
        $data1 = implode(', ', $re);
        return view('dashboard', compact('data', 'data1', 'donat'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $dataid = $id;
        return view('datatenaga', compact('dataid'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $jk = jeniskelamin::all();
        $divisi = divisi::all();
        $pendidikan = pendidikan::all();
        $biodata = tenagateknis::join('tb_jk', 'tb_tenagateknis.id_jk', '=', 'tb_jk.id_jk')
            ->join('tb_pendidikanterakhir', 'tb_tenagateknis.id_pendidikan', '=', 'tb_pendidikanterakhir.id_pendidikan')
            ->join('tb_divisi', 'tb_tenagateknis.id_divisi', '=', 'tb_divisi.id_divisi')
            ->where('id_tenaga', $id)->first();
        return view('edittenaga', compact('biodata', 'jk', 'divisi', 'pendidikan'));
    }

    public function datatenaga(Request $request)
    {
        if ($request->id == 0) {
            return DataTables::of(tenagateknis::join('tb_divisi', 'tb_tenagateknis.id_divisi', '=', 'tb_divisi.id_divisi'))
                ->addColumn('action', function ($data) {
                    $edit = '<a href="' . route('home.edit', $data->id_tenaga) . '" class="edit-data"><i class="glyphicon glyphicon-edit"></i></a>';
                    $detail = '<a href="#" data-id="' . $data->id_tenaga . '" class="show-data"><i class="glyphicon glyphicon-search"></i></a>';
                    return $edit . '&nbsp' . '&nbsp' . $detail;
                })->make(true);
        } else {
            return DataTables::of(tenagateknis::join('tb_jk', 'tb_tenagateknis.id_jk', '=', 'tb_jk.id_jk')
                ->where('tb_tenagateknis.id_divisi', $request->id))
                ->addColumn('action', function ($data) {
                    $detail = '<a href="#" data-id="' . $data->id_tenaga . '" class="show-data"><i class="glyphicon glyphicon-search"></i></a>';
                    return $detail;
                })->make(true);
        }
    }

    public function biodata($id)
    {
        $biodata = tenagateknis::join('tb_jk', 'tb_tenagateknis.id_jk', '=', 'tb_jk.id_jk')
            ->join('tb_pendidikanterakhir', 'tb_tenagateknis.id_pendidikan', '=', 'tb_pendidikanterakhir.id_pendidikan')
            ->join('tb_divisi', 'tb_tenagateknis.id_divisi', '=', 'tb_divisi.id_divisi')
            ->where('id_tenaga', $id)->first();
        return $biodata;
    }

    public function download()
    {
        $download = tenagateknis::join('tb_jk', 'tb_tenagateknis.id_jk', '=', 'tb_jk.id_jk')
            ->join('tb_pendidikanterakhir', 'tb_tenagateknis.id_pendidikan', '=', 'tb_pendidikanterakhir.id_pendidikan')
            ->join('tb_divisi', 'tb_tenagateknis.id_divisi', '=', 'tb_divisi.id_divisi')->get();
        return view('download', compact('download'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggallahir' => 'date|required',
            'nik' => 'numeric|digits:16|required',
            'hp' => 'numeric|required',
            'email' => 'email|required',
        ]);

        $data = tenagateknis::findOrFail($id);
        $data->nm_tenaga = $request->get('nama');
        $data->tempat_lahir = $request->get('tempatlahir');
        $data->tgl_lahir = $request->get('tanggallahir');
        $data->alamat = $request->get('alamat');
        $data->nik = $request->get('nik');
        $data->email = $request->get('email');
        $data->telp = $request->get('hp');
        $data->telp = $request->get('hp');
        $data->id_jk = $request->get('jeniskelamin');
        $data->id_pendidikan = $request->get('pendidikan');
        $data->prog_studi = $request->get('jurusan');
        $data->npwp = $request->get('npwp');
        $data->id_divisi = $request->get('divisi');
        $data->update();

        \Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil Menyimpan. Terimakasih!"
        ]);

        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
