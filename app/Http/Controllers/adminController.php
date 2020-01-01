<?php

namespace App\Http\Controllers;

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
        $chart = tenagateknis::select(DB::raw('count(*) as total'))->groupby('id_divisi')->get();
        $donat = tenagateknis::select(DB::raw('count(*) as total'))->groupby('id_pendidikan')->get();
//        return response()->json($chart);
        return view('dashboard', compact('data', 'chart','donat'));
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function datatenaga(Request $request)
    {
        if ($request->id == 0) {
            return DataTables::of(tenagateknis::all())
                ->make(true);
        } else {
            return DataTables::of(tenagateknis::join('tb_jk', 'tb_tenagateknis.id_jk', '=', 'tb_jk.id_jk')
                ->where('tb_tenagateknis.id_divisi', $request->id))
                ->addColumn('action', function ($data) {
                    $detail = '<a href=""><i class="glyphicon glyphicon-search"> </i></a>';
                    return $detail;
                })->make(true);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
