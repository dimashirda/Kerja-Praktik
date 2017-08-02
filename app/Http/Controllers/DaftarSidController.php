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
    protected $allNotif;
    public function __construct() {
    $this->allNotif = DB::table('Notifikasis')
         ->join('Detil_kontraks','Detil_kontraks.id_detil','=','Notifikasis.id_detil')
         ->where('notifikasis.flag','=','0')
         ->get();
    }

    public function vsat()
    {
        $layanan = 'VSAT';
        $search = \Request::get('search');
        $kategori = \Request::get('kategori');
        if($kategori == "sid")
        {
            $sid = Daftar_sid::select('*')
                    ->join('Anak_perusahaans', 'Daftar_sids.id_perusahaan', '=', 'Anak_perusahaans.id_perusahaan')
                    ->join('pelanggans', 'Daftar_sids.nipnas', '=', 'Pelanggans.nipnas')
                    ->join('Layanan_imes', 'Daftar_sids.id_imes', '=', 'Layanan_imes.id_imes')
                    ->where('Layanan_imes.nama_imes', '=', $layanan)
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
                    ->where('Layanan_imes.nama_imes', '=', $layanan)
                    ->where('Anak_perusahaans.nama_perusahaan', 'like', '%'.$search.'%')
                    ->orderBy('sid')
                    ->paginate(25);
        }
        elseif($kategori == "alamat")
        {
            $sid = Daftar_sid::select('*')
                    ->join('Anak_perusahaans', 'Daftar_sids.id_perusahaan', '=', 'Anak_perusahaans.id_perusahaan')
                    ->join('pelanggans', 'Daftar_sids.nipnas', '=', 'Pelanggans.nipnas')
                    ->join('Layanan_imes', 'Daftar_sids.id_imes', '=', 'Layanan_imes.id_imes')
                    ->where('Layanan_imes.nama_imes', '=', $layanan)
                    ->where('Daftar_sids.alamat_sid', 'like', '%'.$search.'%')
                    ->orderBy('sid')
                    ->paginate(25);
        }
        elseif($kategori == "nipnas")
        {
            $sid = Daftar_sid::select('*')
                    ->join('Anak_perusahaans', 'Daftar_sids.id_perusahaan', '=', 'Anak_perusahaans.id_perusahaan')
                    ->join('pelanggans', 'Daftar_sids.nipnas', '=', 'Pelanggans.nipnas')
                    ->join('Layanan_imes', 'Daftar_sids.id_imes', '=', 'Layanan_imes.id_imes')
                    ->where('Layanan_imes.nama_imes', '=', $layanan)
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
                    ->where('Layanan_imes.nama_imes', '=', $layanan)
                    ->where('Pelanggans.nama_pelanggan', 'like', '%'.$search.'%')
                    ->orderBy('sid')
                    ->paginate(25);
        }
        else
        {   
            $sid = Daftar_sid::select('*')
                        ->join('Anak_perusahaans', 'Daftar_sids.id_perusahaan', '=', 'Anak_perusahaans.id_perusahaan')
                        ->join('pelanggans', 'Daftar_sids.nipnas', '=', 'Pelanggans.nipnas')
                        ->join('Layanan_imes', 'Daftar_sids.id_imes', '=', 'Layanan_imes.id_imes')
                        ->where('Layanan_imes.nama_imes', '=', $layanan)
                        ->paginate(25);
            
        }

        return view('daftar_sid.index', ['sid'=>$sid, 'allNotif'=>$this->allNotif]);
    }

    public function radio()
    {
        $layanan = 'Radio';
        $search = \Request::get('search');
        $kategori = \Request::get('kategori');
        if($kategori == "sid")
        {
            $sid = Daftar_sid::select('*')
                    ->join('Anak_perusahaans', 'Daftar_sids.id_perusahaan', '=', 'Anak_perusahaans.id_perusahaan')
                    ->join('pelanggans', 'Daftar_sids.nipnas', '=', 'Pelanggans.nipnas')
                    ->join('Layanan_imes', 'Daftar_sids.id_imes', '=', 'Layanan_imes.id_imes')
                    ->where('Layanan_imes.nama_imes', '=', $layanan)
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
                    ->where('Layanan_imes.nama_imes', '=', $layanan)
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
                    ->where('Layanan_imes.nama_imes', '=', $layanan)
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
                    ->where('Layanan_imes.nama_imes', '=', $layanan)
                    ->where('Pelanggans.nama_pelanggan', 'like', '%'.$search.'%')
                    ->orderBy('sid')
                    ->paginate(25);
        }
        else
        {   
            $sid = Daftar_sid::select('*')
                        ->join('Anak_perusahaans', 'Daftar_sids.id_perusahaan', '=', 'Anak_perusahaans.id_perusahaan')
                        ->join('pelanggans', 'Daftar_sids.nipnas', '=', 'Pelanggans.nipnas')
                        ->join('Layanan_imes', 'Daftar_sids.id_imes', '=', 'Layanan_imes.id_imes')
                        ->where('Layanan_imes.nama_imes', '=', $layanan)
                        ->paginate(25);
            
        }
        
        return view('daftar_sid.index', ['sid'=>$sid, 'allNotif'=>$this->allNotif]);
    }

    public function create()
    {
        $ap = DB::table('Anak_perusahaans')->select('id_perusahaan','nama_perusahaan')->get();
        $lynconn = DB::table('Layanan_imes')->select('id_imes','nama_imes', 'flag')->where('flag','=','Connectivity')->get();
        $lynnon = DB::table('Layanan_imes')->select('id_imes','nama_imes', 'flag')->where('flag','=','Non Connectivity')->get();

        $plg = DB::table('Pelanggans')->select('nipnas','nama_pelanggan')->get();

        return view('daftar_sid.create', ['ap'=>$ap, 'lynconn'=>$lynconn, 'lynnon'=>$lynnon, 'plg'=>$plg, 'allNotif'=>$this->allNotif]);
    }

    public function store(Request $request)
    {
        $cek = DB::table('daftar_sids')->where('sid', '=', $request->input('sid'))->get();

        if(count($cek)){
            $request->session()->flash('alert-danger', 'Daftar SID gagal ditambahkan. SID sudah digunakan.');
            return redirect('/sid/create');
        }
        else{
            $dsid = new Daftar_sid();
            $dsid->sid = $request->input('sid');
            $dsid->id_perusahaan = $request->input('id_perusahaan');
            $dsid->nipnas = $request->input('nipnas');
            $dsid->alamat_sid = $request->input('alamat_sid');
            $dsid->id_imes = $request->input('id_imes');

            if($dsid->save()){
                $request->session()->flash('alert-success', 'Daftar SID telah ditambahkan');
                return redirect('/sid/create');
            }
            else{
                $request->session()->flash('alert-danger', 'Daftar SID gagal ditambahkan');
                return redirect('/sid/create');   
            }
        }
    }

    public function edit(Request $req, $id)
    {
        $s = Daftar_sid::find($id);
        
        $ap = DB::table('Anak_perusahaans')->select('id_perusahaan','nama_perusahaan')->get();
        $lyn = DB::table('Layanan_imes')->select('id_imes','nama_imes', 'flag')->get();
        $plg = DB::table('Pelanggans')->select('nipnas','nama_pelanggan')->get();

        return view('daftar_sid.edit', ['s'=>$s, 'ap'=>$ap, 'lyn'=>$lyn, 'plg'=>$plg, 'allNotif'=>$this->allNotif]);
    }

    public function save(Request $data, $id)
    {
        $edit = Daftar_sid::where('sid',$id)->first();
        $edit->id_perusahaan = $data['id_perusahaan'];
        $edit->nipnas = $data['nipnas'];
        $edit->alamat_sid = $data['alamat_sid'];
        $edit->id_imes = $data['id_imes'];
 
        if($edit->save()){
            $data->session()->flash('alert-success', 'Daftar SID berhasil diperbarui.');    
        }
        else{
            $data->session()->flash('alert-danger', 'Daftar SID gagal diperbarui.');    
        }

        if($data['id_imes'] == 1){
            return redirect('/vsat');
        }
        else if($data['id_imes'] == 2){
            return redirect('/radio');
        }
    }

    public function delete(Request $data, $id)
    {
        $vsat = DB::table('Layanan_imes')->select('id_imes')->where('nama_imes', '=', 'VSAT')->get();
        $radio = DB::table('Layanan_imes')->select('id_imes')->where('nama_imes', '=', 'Radio')->get();
        $del = Daftar_sid::find($id);
        $imes = DB::table('Daftar_sids')->select('id_imes')->where('sid', '=', $id)->get();

        if($del->delete()){
            $data->session()->flash('alert-success', 'Daftar SID berhasil dihapus.'); 
        }
        else{
            $data->session()->flash('alert-danger', 'Daftar SID gagal dihapus.');   
        }
        
        if($imes == $vsat){
            return redirect('/vsat');
        }
        else if($imes == $radio){
            return redirect('/radio');
        }
    }
}