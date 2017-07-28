<?php

namespace App\Http\Controllers;

use App\Daftar_sid;
use Illuminate\Http\Request;

class DaftarSidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $allNotif;
    public function __construct() {
        $this->allNotif = DB::table('Notifikasis')
            ->join('Detil_kontraks','Detil_kontraks.id_detil','=','Notifikasis.id_detil')
            ->get();
    }
    public function index()
    {
        $sid = Daftar_sid::paginate(25);
        return view('daftar_sid.index',['sid'=>$sid, 'allNotif'=>$this->Allnotif]);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
