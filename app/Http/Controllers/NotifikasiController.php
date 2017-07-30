<?php
namespace App\Http\Controllers;
use DB;
//use Notifikasi;
use App\Notifikasi;
use App\Http\Controllers\DetilKontrakController;
use Illuminate\Http\Request;
//use Notifiable;
use Illuminate\Notifications\Notifiable;
class NotifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function render($val)
    {   
        $notif = $val;
        return view('Notifikasi.index',['notif'=>$notif]);
    }
    public function showwhole()
    {
        
        $post = notifikasi::find(1);
        //dd($post);
        $post->notify(new \App\Notifications\PostPublished());
        $notif = DB::table('Notifikasis')
                    ->join('Detil_kontraks','Detil_kontraks.id_detil','=','Notifikasis.id_detil')
                    ->get();
                    //dd($notif);
        
        return $this->render($notif);   
    }
    public function edit($data)
    {
        $notif = DB::table('Notifikasis')
                    ->join('Detil_kontraks','Detil_kontraks.id_detil','=','Notifikasis.id_detil')
                    ->where('id_notifikasi','=',$data)
                    ->get();
                    //dd($notif);
        return view('Notifikasi.edit',['notif'=>$notif]);
    }
    public function save(Request $request,$data)
    {   
        $keterangan = $request->input('keterangan');
        DB::table('Notifikasis')
            ->where('id_notifikasi','=',$data)
            ->update(['keterangan' => $keterangan,
                    'flag' => '1']);
        return $this->showwhole();
    }
    public function index()
    {
        $datenow = date('Y-m-d');
        $date = date('Y-m-d', strtotime("+90 days"));
        $isi = DB::table('Notifikasis')->select('*')->get();
        //dd($isi);
        $final = array();
        //dd($date);
        if(count($isi) == 0){
            $notif = DB::table('Detil_kontraks')
                ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
                ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
                ->join('Anak_perusahaans','Detil_kontraks.id_perusahaan','=',
                        'Anak_perusahaans.id_perusahaan')
                //->join('Notifikasis','Notifikasis.id_detil','!=','Detil_kontraks.id_detil')
                ->whereBetween('Detil_kontraks.tgl_selesai',[$datenow,$date])
                ->get();
            if(count($notif) > 0){
                foreach ($notif as $tmp) {
                $note = new Notifikasi;
                $note->id_detil = $tmp->id_detil;
                $note->tanggal = date('Y-m-d');
                $note->flag = 0;
                $note->keterangan = 'kosong';
                $note->save();   
                }
                //dd($notif);
            }
        }
        else{
            $cek = DB::select("SELECT tanggal 
                        FROM Notifikasis ORDER BY id_notifikasi DESC LIMIT 1");
            //dd($datenow);
            if($datenow > $cek){
                $notif = DB::table('Detil_kontraks')
                ->join('Account_managers','Detil_kontraks.id_am','=','Account_managers.id_am')
                ->join('Pelanggans','Detil_kontraks.nipnas','=','Pelanggans.nipnas')
                ->join('Anak_perusahaans','Detil_kontraks.id_perusahaan','=',
                        'Anak_perusahaans.id_perusahaan')
                //->join('Notifikasis','Notifikasis.id_detil','!=','Detil_kontraks.id_detil')
                ->whereBetween('Detil_kontraks.tgl_selesai',[$datenow,$date])
                ->get();
                    if(count($notif) > 0){
                    foreach ($notif as $tmp) {
                    $note = new Notifikasi;
                    $note->id_detil = $tmp->id_detil;
                    $note->tanggal = date('Y-m-d');
                    $note->flag = 0;
                    $note->keterangan = 'kosong';
                    $note->save();   
                    }
                }
                //return $this->show();
            }
            else{
                //return $this->show();
            }
        }
        //dd($notif); 
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