<?php

namespace App\Http\Controllers;

use DB; 
use App\Daftar_sid;
use App\Anak_perusahaan;
use App\Layanan_imes;
use App\Pelanggan;
use Illuminate\Http\Request;

class DaftarSidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sid = Daftar_sid::paginate(25);
        return view('daftar_sid.index',['sid'=>$sid]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ap = DB::table('Anak_perusahaans')->select('id_perusahaan','nama_perusahaan')->get();
        $lyn = DB::table('Layanan_imes')->select('id_imes','nama_imes', 'flag')->get();
        $plg = DB::table('Pelanggans')->select('nipnas','nama_pelanggan')->get();

        return view('daftar_sid.create', ['ap'=>$ap, 'lyn'=>$lyn, 'plg'=>$plg]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dsid = new Daftar_sid();

        $dsid->sid = $request->input('sid');
        $dsid->id_perusahaan = $request->input('id_perusahaan');
        $dsid->nipnas = $request->input('nipnas');
        $dsid->alamat_sid = $request->input('alamat_sid');
        $dsid->id_imes = $request->input('id_imes');

        $dsid->save();
        $request->session()->flash('alert-success', 'Daftar SID telah ditambahkan');
        return redirect('/sid');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Datar_sid  $datar_sid
     * @return \Illuminate\Http\Response
     */
    public function show(Datar_sid $datar_sid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Datar_sid  $datar_sid
     * @return \Illuminate\Http\Response
     */
    public function edit(Datar_sid $datar_sid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Datar_sid  $datar_sid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Datar_sid $datar_sid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Datar_sid  $datar_sid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Datar_sid $datar_sid)
    {
        //
    }
}
