<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterPelatihan;
use App\Http\Requests\StoreMasterPelatihanRequest;
use App\Http\Requests\UpdateMasterPelatihanRequest;

class MasterPelatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $judul = 'Master Pelatihan Selectize';
        $masterPelatihan =  MasterPelatihan::get();
        // dd($masterPelatihan);

        return view('master-pelatihan', [
            'judul' => $judul,
            'masterPelatihan' => $masterPelatihan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->all();
        dd($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMasterPelatihanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMasterPelatihanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterPelatihan  $masterPelatihan
     * @return \Illuminate\Http\Response
     */
    public function show(MasterPelatihan $masterPelatihan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterPelatihan  $masterPelatihan
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterPelatihan $masterPelatihan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMasterPelatihanRequest  $request
     * @param  \App\Models\MasterPelatihan  $masterPelatihan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMasterPelatihanRequest $request, MasterPelatihan $masterPelatihan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterPelatihan  $masterPelatihan
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterPelatihan $masterPelatihan)
    {
        //
    }
}
