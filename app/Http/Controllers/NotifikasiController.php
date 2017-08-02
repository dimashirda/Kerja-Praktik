<?php
namespace App\Http\Controllers;
use DB;
use Mail;
//use Notifikasi;
use App\Account_manager;
use App\Anak_perusahaan;
use App\Detil_kontrak;
use App\Pelanggan;
use App\layanan_kontrak;
use App\Layanan;
use App\Notifikasi;
use App\Http\Controllers\DetilKontrakController;
use Illuminate\Http\Request;
class NotifikasiController extends Controller
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
            ->where('notifikasis.flag','=','0')
            ->get();
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

                    //dd($notif);
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
        //dd($detil);

        //$depan .=".pdf";
        //dd($depan);
//            dd($data);
        $keterangan = $request->input('keterangan');
        if (! isset($request['flag'])) $flag=0;
        else $flag = $request->input('flag');
//        dd($flag);
        DB::table('Notifikasis')
            ->where('id_notifikasi','=',$request['id_notif'])
            ->update(['keterangan' => $keterangan,
                'flag' => $flag]);
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
                return Redirect::to('kontrak/edit/'.$request['id'])->withInput()->withErrors($validator);
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
                        Session::flash('success', 'Upload successfully');
                        //return Redirect::to('/kontrak');
                    } else {
                        Session::flash('error', 'uploaded file is not valid');
                        return Redirect::to('/home');
                    }
                } else {
                    // sending back with error message.
                    Session::flash('error', 'uploaded file is not valid');
                    return Redirect::to('/home');
                }
            }
            $detil->save();
        }
        else {
            DB::table('detil_kontraks')
                ->where('id_detil', $request['id'])
                ->update(['judul_kontrak' => $request['nama'],
                    'id_am' => $request['id_am'],
                    'nipnas'=> $request['nipnas'],
                    'id_perusahaan' => $request['id_perusahaan'],
                    'tgl_mulai' => $request['tgl_mulai'],
                    'tgl_selesai' => $request['tgl_selesai'],
                    'slg' => $request['slg']]);
        }

        $lyn = $request->input('name');
        $hapus = $request->input('id');
        $a = count($lyn);

        //dd($lyn);
        $i = 0;
        $delete = DB::table('layanan_kontraks')
            ->where('layanan_kontraks.id_detil','=',$hapus)->delete();
        //dd($delete);
        for($i=0;$i<$a;$i++)
        {
            $lk = new layanan_kontrak;
            $lk->id_detil = $detil->id_detil;
            $lk->id_layanan = $lyn[$i];
            $lk->save();
        }
        //dd($lk);

        $request->session()->flash('alert-edit', 'Data kontrak berhasil diubah');
        return redirect('/notifikasi');
    }
    public function index()
    {
        $datenow = date('Y-m-d');
        $date = date('Y-m-d', strtotime("+90 days"));
        $isi = DB::table('Notifikasis')->select('*')->get();
        $notif = null;//dd($isi);
        $final = array();
        //$tanda;
        //dd($date);
        if (count($isi) == 0) {
            $notif = DB::table('Detil_kontraks')

                ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
                ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
                ->join('Anak_perusahaans','Detil_kontraks.id_perusahaan','=',
                    'Anak_perusahaans.id_perusahaan')
                //->join('Notifikasis','Notifikasis.id_detil','!=','Detil_kontraks.id_detil')
                ->whereBetween('Detil_kontraks.tgl_selesai', [$datenow, $date])
                ->get();


            if(count($notif) > 0){

                foreach ($notif as $tmp) {
                    $note = new Notifikasi;
                    $note->id_detil = $tmp->id_detil;
                    $note->tanggal = date('Y-m-d');
                    $note->flag = 0;
                    $note->keterangan = 'Belum ditindaklanjuti';
                    $note->save();
                }
                //dd($notif);
            }
        } 
      else {
            $cek = DB::select("SELECT tanggal 
                        FROM Notifikasis ORDER BY tanggal DESC LIMIT 1");

            if($datenow > $cek[0]->tanggal) {
                $notif = DB::table('Detil_kontraks')
                    ->join('Account_managers', 'Detil_kontraks.id_am', '=', 'Account_managers.id_am')
                    ->join('Pelanggans', 'Detil_kontraks.nipnas', '=', 'Pelanggans.nipnas')
                    ->join('Anak_perusahaans', 'Detil_kontraks.id_perusahaan', '=', 'Anak_perusahaans.id_perusahaan')
                    ->whereNotIn('Detil_kontraks.id_detil', function($q){
                        $q->select('id_detil')->from('notifikasis');
                        })
                    ->whereBetween('Detil_kontraks.tgl_selesai',[$datenow,$date])
                    ->get();
                    $tanda = 1;
              
                if(count($notif) > 0){
                    foreach ($notif as $tmp) {
                        $note = new Notifikasi;
                        $note->id_detil = $tmp->id_detil;
                        $note->tanggal = date('Y-m-d');
                        $note->flag = 0;
                        $note->keterangan = 'Belum ditindaklanjuti';
                        $note->save();
                    }

                    $datebefore = date('Y-m-d',strtotime("-7 days"));
                    $tgl = DB::table('Notifikasis')
                        ->where('Notifikasis.tanggal','<=',$datebefore)
                        ->where('Notifikasis.flag','=','0')
                        ->get();
                //dd($tgl);
                    $jumlah = array('banyak' => count($tgl), );
                    Mail::send('coba',$jumlah,function($message){
                        $message->from('dimas0308@gmail.com','Nyoba');
                        $message->to('inadewi4@gmail.com')
                        ->subject('Notifikasi Kontrak Terbengkalai');
                        });
                }
               /*       */ 
            }           
        }
//        dd($notif);

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
     * @param  \App\Notifikasi  $notifikasi
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notifikasi  $notifikasi
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notifikasi  $notifikasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notifikasi $notifikasi)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notifikasi  $notifikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notifikasi $notifikasi)
    {
        //
    }
}