<?php

namespace App\Http\Controllers;

use App\Layanan_imes;
use DB;
use Illuminate\Http\Request;

class LayananImesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = \Request::get('search');
        $category = \Request::get('kategori');
        if($category == "nama")
        {
            $layanan = DB::table('layanan_imes')
            ->where('nama_imes','like','%'.$search.'%')
            ->orderBy('nama_imes')
            ->paginate(25);
        }
        elseif($category == "ID")
        {
            $layanan = DB::table('layanan_imes')
            ->where('id_imes','like','%'.$search.'%')
            ->orderBy('id_imes')
            ->paginate(25);
        }
        elseif($category == "jenis")
        {
            $layanan = DB::table('layanan_imes')
            ->where('flag', 'like', '%'.$search.'%')
            ->orderBy('flag')
            ->paginate(25);
        }
        else
        {
            $layanan = DB::table('layanan_imes')->paginate(25);
        }
        return view('layanan_imes.index',['layanan'=>$layanan]);
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
        
        $imes = new Layanan_imes;
        $imes->id_imes = $request->input('id');
        $imes->nama_imes = $request->input('nama');
        $imes->flag = $request->input('flag');

        //$layanan->deskripsi = $request->input('desk');

        $imes->save();
        $request->session()->flash('alert-success', 'Layanan IMES telah ditambahkan');
        return redirect('/imes');
    }

    public function save(Request $data, $id)
    {   
//      dd($data);
        $edit = layanan_imes::where('id_imes',$id)->first();
//      dd($edit);
        $edit->nama_imes = $data['nama'];
        $edid->flag = $data['flag'];
        //$edit->deskripsi = $data['desk'];
        //$edit->email_pelanggan = $data['email'];
        $edit->save();
        $data->session()->flash('alert-edit', 'Layanan IMES berhasil diubah');

        return redirect('/imes');
    }

    public function delete($id)
    {
        $del = layanan_imes::find($id);
        $del->delete();
        return redirect ('/imes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Layanan_imes  $layanan_imes
     * @return \Illuminate\Http\Response
     */
    public function show(Layanan_imes $layanan_imes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Layanan_imes  $layanan_imes
     * @return \Illuminate\Http\Response
     */
    public function edit(Layanan_imes $layanan_imes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Layanan_imes  $layanan_imes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Layanan_imes $layanan_imes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Layanan_imes  $layanan_imes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Layanan_imes $layanan_imes)
    {
        //
    }
}
