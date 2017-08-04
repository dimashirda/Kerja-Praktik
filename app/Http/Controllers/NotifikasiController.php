<?php
namespace App\Http\Controllers;
use DB;
use Mail;
use App\Account_manager;
use App\Anak_perusahaan;
use App\Detil_kontrak;
use App\Pelanggan;
use App\layanan_kontrak;
use App\Layanan;
use App\Notifikasi;
use App\Http\Controllers\DetilKontrakController;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Input;

class NotifikasiController extends Controller
{
    protected $allNotif;
    public function __construct() {
        $this->allNotif = DB::table('Notifikasis')
            ->join('Detil_kontraks','Detil_kontraks.id_detil','=','Notifikasis.id_detil')
            ->where('notifikasis.flag','=','0')
            ->get();
    }
    
    public function email()
    {
        $datebefore = date('Y-m-d',strtotime("+30 days"));
        $dk = DB::table('Detil_kontraks')
            ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
            ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
            ->join('Anak_perusahaans','Detil_kontraks.id_perusahaan','=',
                'Anak_perusahaans.id_perusahaan')
            ->where('Detil_kontraks.tgl_selesai','<=',$datebefore)
            ->get();

        $jumlah = array(
            'banyak'=>count($dk),
            'nama' => $nama = array(),
            );
        foreach ($dk as $tmp) {
            array_push($jumlah['nama'],$tmp->judul_kontrak);
        }
        Mail::send('coba',$jumlah,function($message){
            $message->from('dimas0308@gmail.com','Nyoba');
            $message->to('inadewi4@gmail.com')
            ->subject('Notifikasi Kontrak Terbengkalai');
            });
    }
    
    public function render($val)
    {   
        $notif = $val;
        $merah = date('Y-m-d',strtotime("+30 days"));
        $kuning = date('Y-m-d',strtotime("+60 days"));
        $hijau = date('Y-m-d',strtotime("+90 days"));
        return view('Notifikasi.index',['notif'=>$notif, 'merah'=>$merah, 'kuning'=>$kuning, 'hijau'=>$hijau, 'allNotif'=>$this->allNotif]);
    }
    
    public function showwhole()
    {
        $notif = DB::table('Notifikasis')
                    ->join('Detil_kontraks','Detil_kontraks.id_detil','=','Notifikasis.id_detil')
                    ->orderBy('Notifikasis.flag', 'ASC')
                    ->orderBy('Notifikasis.updated_at', 'DESC')
                    ->get();

        return $this->render($notif);
    }
    
    public function edit($data)
    {
        $dt = DB::table('layanan_kontraks')
            ->join('Layanans','Layanans.id_layanan','=','layanan_kontraks.id_layanan')
            ->join('Notifikasis','layanan_kontraks.id_detil','=','Notifikasis.id_detil')
            ->where('Notifikasis.id_notifikasi','=',$data)
            ->get();
        $ap = DB::table('Anak_perusahaans')->select('id_perusahaan','nama_perusahaan')->get();
        $am = DB::table('Account_managers')->select('id_am','nama_am')->get();
        $plg = DB::table('Pelanggans')->select('nipnas','nama_pelanggan')->get();
        $lyn = DB::table('Layanans')->select('id_layanan','nama_layanan')->get();
        $notif = DB::table('Notifikasis')
                    ->join('Detil_kontraks','Detil_kontraks.id_detil','=','Notifikasis.id_detil')
                    ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
                    ->join('Anak_perusahaans', 'Detil_kontraks.id_perusahaan','=','Anak_perusahaans.id_perusahaan')
                    ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
                    ->where('id_notifikasi','=',$data)
                    ->get();
        return view('Notifikasi.edit',['dt'=>$dt, 'allNotif'=>$this->allNotif, 'notif'=>$notif, 'ap'=>$ap, 'am'=>$am, 'plg'=>$plg, 'lyn'=>$lyn]);
    }
    
    public function save(Request $request)
    {
        $detil = Detil_kontrak::where('id_detil',$request['id'])->first();
        $keterangan = $request->input('keterangan');
        if (! isset($request['flag'])) $flag=0;
        else $flag = $request->input('flag');
        if(DB::table('Notifikasis')
            ->where('id_notifikasi','=',$request['id_notif'])
            ->update(['keterangan' => $keterangan,
                'flag' => $flag]))
        {
            $notif = 1;
        }
        else{
            $request->session()->flash('alert-danger', 'Notifikasi gagal diperbarui.');
            return redirect('/notifikasi');
        }

        if (isset($request['image'])) {
            $detil->id_detil = $request['id'];
            $detil->judul_kontrak = $request['nama'];
            $detil->id_am = $request['id_am'];
            $detil->nipnas = $request['nipnas'];
            $detil->id_perusahaan = $request['id_perusahaan'];
            $detil->tgl_mulai = $request['tgl_mulai'];
            $detil->tgl_selesai = $request['tgl_selesai'];
            $detil->slg = $request['slg'];
            $depan = $request['nama'];
            $file = array('image' => Input::file('image'));

            $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000

            // doing the validation, passing post data, rules and the messages
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                // send back to the page with the input data and errors
                $request->session()->flash('alert-warning', 'File yang diunggah tidak sesuai.');
                // return Redirect::to('/notifikasi');
                return Redirect::to('notifikasi/'.$request['id_notif'])->withInput()->withErrors($validator);
            }
            else {
                // checking file is valid.
                if (Input::file('image')->isValid()) {
                    $destinationPath = 'uploads'; // upload path
                    $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                    if ($extension == "pdf") {
                        $fileName = $depan . '.' . $extension; // renameing image
                        //dd($fileName);
                        Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                        // sending back with message
                        $detil->nama_dokumen = $depan;
                    } else {
                        $request->session()->flash('alert-warning', 'File yang diunggah tidak sesuai.');
                        return Redirect::to('/notifikasi');
                    }
                } else {
                    // sending back with error message.
                    $request->session()->flash('alert-warning', 'File yang diunggah tidak sesuai.');
                    return Redirect::to('/notifikasi');
                }
            }
            if($detil->save()){
                $notif = 1;
            }
            else{
                $request->session()->flash('alert-danger', 'Notifikasi gagal diperbarui B.');
                return redirect('/notifikasi');
            }
        }
        else {
            if($upd = DB::table('detil_kontraks')
                ->where('id_detil', $request['id'])
                ->update(['judul_kontrak' => $request['nama'],
                    'id_am' => $request['id_am'],
                    'nipnas'=> $request['nipnas'],
                    'id_perusahaan' => $request['id_perusahaan'],
                    'tgl_mulai' => $request['tgl_mulai'],
                    'tgl_selesai' => $request['tgl_selesai'],
                    'slg' => $request['slg']]))
            {
                $notif = 1;
            }
        }

        $lyn = $request->input('name');
        $hapus = $request->input('id');
        $a = count($lyn);

        $i = 0;
        $delete = DB::table('layanan_kontraks')
            ->where('layanan_kontraks.id_detil','=',$hapus)->delete();

        for($i=0;$i<$a;$i++)
        {
            $lk = new layanan_kontrak;
            $lk->id_detil = $detil->id_detil;
            $lk->id_layanan = $lyn[$i];
            $s = $lk->save();

            if(!($s)){
                $request->session()->flash('alert-danger', 'Notifikasi gagal diperbarui D.');
                return redirect('/notifikasi');
            }
        }
        if($notif==1){
            $request->session()->flash('alert-success', 'Notifikasi berhasil diperbarui.');          
            return redirect('/notifikasi');
        }
     }

    public function index()
    {
        $datenow = date('Y-m-d');
        $date = date('Y-m-d', strtotime("+90 days"));
        $notif = null;//dd($isi);
        $final = array();
        $table = DB::table('Notifikasis')->select('id_detil')->get();
        //dd($table);
        if(count($table) > 0)
        {   
            $notif = DB::table('Detil_kontraks')
                ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
                ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
                ->join('Anak_perusahaans','Detil_kontraks.id_perusahaan','=',
                    'Anak_perusahaans.id_perusahaan')
                ->whereNotIn('Detil_kontraks.id_detil',function($q){
                    $q->select('id_detil')->from('Notifikasis');
                })
                ->whereBetween('Detil_kontraks.tgl_selesai', [$datenow, $date])
                ->get();
           
        }
        else{
            $notif = DB::table('Detil_kontraks')
                ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
                ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
                ->join('Anak_perusahaans','Detil_kontraks.id_perusahaan','=',
                    'Anak_perusahaans.id_perusahaan')
                #->whereNotIn('Detil_kontraks.id_detil',[$table->id_detil])
                ->whereBetween('Detil_kontraks.tgl_selesai', [$datenow, $date])
                ->get();
        
        }
        //dd($notif);
            if(count($notif) > 0){
                foreach ($notif as $tmp) {
                    $note = new Notifikasi;
                    $note->id_detil = $tmp->id_detil;
                    $note->tanggal = date('Y-m-d');
                    $note->flag = 0;
                    $note->keterangan = 'Belum ditindaklanjuti';
                    $note->save();
                }
            }
    }
}