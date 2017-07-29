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
  
    protected $allNotif;
    public function __construct() {
        $this->allNotif = DB::table('Notifikasis')
            ->join('Detil_kontraks','Detil_kontraks.id_detil','=','Notifikasis.id_detil')
            ->get();
    }
  
    public function vsat()
    {
        $search = \Request::get('search');
        $kategori = \Request::get('kategori');
        if($kategori == "sid")
        {
            $sid = Daftar_sid::select('*')
                    ->join('Anak_perusahaans', 'Daftar_sids.id_perusahaan', '=', 'Anak_perusahaans.id_perusahaan')
                    ->join('pelanggans', 'Daftar_sids.nipnas', '=', 'Pelanggans.nipnas')
                    ->join('Layanan_imes', 'Daftar_sids.id_imes', '=', 'Layanan_imes.id_imes')
                    ->where('Daftar_sids.sid', 'like', '%'.$search.'%')
                    ->orderBy('sid')
                    ->paginate(25);

        }
        elseif($kategori == "perusahaan")
        {   
            $sid = Daftar_sid::select('*')
                    ->join('Anak_perusahaans', 'Daftar_sids.id_perusahaan', '=', 'Anak_perusahaans.id_perusahaan')
                    ->join('pelanggans', 'Daftar_sids.nipnas', '=', 'Pelanggans.nipnas')
                    ->join('Layanan_imes', 'Daftar_sids.id_imes', '=', 'Layanan_imes.id_imes')
                    ->where('Anak_perusahaans.nama_perusahaan', 'like', '%'.$search.'%')
                    ->orderBy('sid')
                    ->paginate(25);
        }

        elseif($kategori == "nipnas")
        {
            $sid = Daftar_sid::select('*')
                    ->join('Anak_perusahaans', 'Daftar_sids.id_perusahaan', '=', 'Anak_perusahaans.id_perusahaan')
                    ->join('pelanggans', 'Daftar_sids.nipnas', '=', 'Pelanggans.nipnas')
                    ->join('Layanan_imes', 'Daftar_sids.id_imes', '=', 'Layanan_imes.id_imes')
                    ->where('Daftar_sids.nipnas', 'like', '%'.$search.'%')
                    ->orderBy('sid')
                    ->paginate(25);
        }
        elseif($kategori == "pelanggan")
        {
            $sid = Daftar_sid::select('*')
                    ->join('Anak_perusahaans', 'Daftar_sids.id_perusahaan', '=', 'Anak_perusahaans.id_perusahaan')
                    ->join('pelanggans', 'Daftar_sids.nipnas', '=', 'Pelanggans.nipnas')
                    ->join('Layanan_imes', 'Daftar_sids.id_imes', '=', 'Layanan_imes.id_imes')
                    ->where('Pelanggans.nama_pelanggan', 'like', '%'.$search.'%')
                    ->orderBy('sid')
                    ->paginate(25);
        }
        else
        {
            $layanan = 'VSAT';
            
            $sid = Daftar_sid::select('*')
                        ->join('Anak_perusahaans', 'Daftar_sids.id_perusahaan', '=', 'Anak_perusahaans.id_perusahaan')
                        ->join('pelanggans', 'Daftar_sids.nipnas', '=', 'Pelanggans.nipnas')
                        ->join('Layanan_imes', 'Daftar_sids.id_imes', '=', 'Layanan_imes.id_imes')
                        ->where('Layanan_imes.nama_imes', '=', $layanan)
                        ->paginate(25);
            
        }
        
        return view('daftar_sid.index', ['sid'=>$sid, 'allNotif'=>$this->Allnotif]);
    }

    public function radio()
    {
        $search = \Request::get('search');
        $kategori = \Request::get('kategori');
        if($kategori == "sid")
        {
            $sid = Daftar_sid::select('*')
                    ->join('Anak_perusahaans', 'Daftar_sids.id_perusahaan', '=', 'Anak_perusahaans.id_perusahaan')
                    ->join('pelanggans', 'Daftar_sids.nipnas', '=', 'Pelanggans.nipnas')
                    ->join('Layanan_imes', 'Daftar_sids.id_imes', '=', 'Layanan_imes.id_imes')
                    ->where('Daftar_sids.sid', 'like', '%'.$search.'%')
                    ->orderBy('sid')
                    ->paginate(25);

        }
        elseif($kategori == "perusahaan")
        {   
            $sid = Daftar_sid::select('*')
                    ->join('Anak_perusahaans', 'Daftar_sids.id_perusahaan', '=', 'Anak_perusahaans.id_perusahaan')
                    ->join('pelanggans', 'Daftar_sids.nipnas', '=', 'Pelanggans.nipnas')
                    ->join('Layanan_imes', 'Daftar_sids.id_imes', '=', 'Layanan_imes.id_imes')
                    ->where('Anak_perusahaans.nama_perusahaan', 'like', '%'.$search.'%')
                    ->orderBy('sid')
                    ->paginate(25);
        }

        elseif($kategori == "nipnas")
        {
            $sid = Daftar_sid::select('*')
                    ->join('Anak_perusahaans', 'Daftar_sids.id_perusahaan', '=', 'Anak_perusahaans.id_perusahaan')
                    ->join('pelanggans', 'Daftar_sids.nipnas', '=', 'Pelanggans.nipnas')
                    ->join('Layanan_imes', 'Daftar_sids.id_imes', '=', 'Layanan_imes.id_imes')
                    ->where('Daftar_sids.nipnas', 'like', '%'.$search.'%')
                    ->orderBy('sid')
                    ->paginate(25);
        }
        elseif($kategori == "pelanggan")
        {
            $sid = Daftar_sid::select('*')
                    ->join('Anak_perusahaans', 'Daftar_sids.id_perusahaan', '=', 'Anak_perusahaans.id_perusahaan')
                    ->join('pelanggans', 'Daftar_sids.nipnas', '=', 'Pelanggans.nipnas')
                    ->join('Layanan_imes', 'Daftar_sids.id_imes', '=', 'Layanan_imes.id_imes')
                    ->where('Pelanggans.nama_pelanggan', 'like', '%'.$search.'%')
                    ->orderBy('sid')
                    ->paginate(25);
        }
        else
        {
            $layanan = 'Radio';
            
            $sid = Daftar_sid::select('*')
                        ->join('Anak_perusahaans', 'Daftar_sids.id_perusahaan', '=', 'Anak_perusahaans.id_perusahaan')
                        ->join('pelanggans', 'Daftar_sids.nipnas', '=', 'Pelanggans.nipnas')
                        ->join('Layanan_imes', 'Daftar_sids.id_imes', '=', 'Layanan_imes.id_imes')
                        ->where('Layanan_imes.nama_imes', '=', $layanan)
                        ->paginate(25);
            
        }
        
        return view('daftar_sid.index', ['sid'=>$sid, 'allNotif'=>$this->Allnotif]);
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

    public function edit(Request $req, $id)
    {
        $s = Daftar_sid::find($id);
        // $s = DB::table('Daftar_sids')->select('sid', 'id_perusahaan', 'nipnas', 'alamat_sid', 'id_imes')
        //                                 ->where('sid', $id)->get();

        // dd($s);

        $ap = DB::table('Anak_perusahaans')->select('id_perusahaan','nama_perusahaan')->get();
        $lyn = DB::table('Layanan_imes')->select('id_imes','nama_imes', 'flag')->get();
        $plg = DB::table('Pelanggans')->select('nipnas','nama_pelanggan')->get();

        return view('daftar_sid.edit', ['s'=>$s, 'ap'=>$ap, 'lyn'=>$lyn, 'plg'=>$plg]);
    }

    public function save(Request $data, $id)
    {
        $edit = Daftar_sid::where('sid',$id)->first();
//      dd($edit);
        $edit->id_perusahaan = $data['id_perusahaan'];
        $edit->nipnas = $data['nipnas'];
        $edit->alamat_sid = $data['alamat_sid'];
        $edit->id_imes = $data['id_imes'];
 
        $edit->save();
        $data->session()->flash('alert-edit', 'Daftar SID berhasil diubah');

        return redirect('/sid');
    }

    public function delete($id)
    {
        $del = Daftar_sid::find($id);
        $del->delete();
        return redirect ('/sid');
    }

}
