<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account_manager;
use App\Anak_perusahaan;
use App\Detil_kontrak;
use App\Pelanggan;
use DB;

class DetilKontrakController extends Controller
{
    public function index()
    {   
        $dk = DB::table('Detil_kontraks')
                ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
                ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
                ->join('Anak_perusahaans','Detil_kontraks.id_perusahaan','=',
                        'Anak_perusahaans.id_perusahaan')
                ->select('Detil_kontraks.*','Account_managers.*','Pelanggans.*','Anak_perusahaans.*')
                /*->oldest()*/->get();        
    	/*$query = DB::table('Detil_kontraks')
    	->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am');
    	$plg = DB::table('Detil_kontraks')
    	->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas');
    	$ap = DB::table('Detil_kontraks')
    	->join()('Anak_perusahaans','Detil_kontraks.id_perusahaan','=',
    		'Anak_perusahaans.id_perusahaan');
    	*/
        $pluckacc = Account_manager::pluck('id_am','nama_am'); 
    	$pluckplg = Pelanggan::pluck('nipnas','nama_pelanggan');
    	$pluckap = Anak_perusahaan::pluck('id_perusahaan','nama_perusahaan');
    	return view('upload',['acc'=>$pluckacc, 'plg'=>$pluckplg, 'ap'=>$pluckap,
            'dk'=>$dk]);
    }

    public function create()
    {   
        $ap = DB::table('Anak_perusahaans')->select('id_perusahaan','nama_perusahaan')->get();
        $am = DB::table('Account_managers')->select('id_am','nama_am')->get();
        $plg = DB::table('Pelanggans')->select('nipnas','nama_pelanggan')->get();
        $lyn = DB::table('Layanans')->select('id_layanan','nama_layanan')->get();
    	return view('detil_kontrak.create',['ap'=>$ap, 'am'=>$am, 'plg'=>$plg, 'lyn'=>$lyn]);
    }

    public function store(Request $request)
    {   
        //dd($request);
    	$detil = new Detil_kontrak;
        $detil->judul_kontrak = $request->input('nama');
        $detil->id_am = $request->input('id_am');
        $detil->nipnas = $request->input('nipnas');
        $detil->id_perusahaan = $request->input('id_perusahaan');
        $detil->tgl_mulai = $request->input('tgl_mulai');
        $detil->tgl_selesai = $request->input('tgl_selesai');
        $detil->slg = $request->input('slg');
        $detil->nama_dokumen = $request->input('nama_dokumen');
        $detil->save();
        return redirect('/kontrak');

    }
}