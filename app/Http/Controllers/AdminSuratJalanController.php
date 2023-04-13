<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Session;
use Auth;
use App\Models\Guest;
use App\Models\SuratJalan;
use Illuminate\Support\Facades\DB;

class AdminSuratJalanController extends Controller
{
    protected $user;
    public function __construct(Request $request)
    {
            $this->middleware('auth',['tes' => 'egg']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request )
    {
        $bulan = 0;
        $months = array(
            0 => "Pilih Bulan"
        );
        for ($i = 1; $i <= 12; $i++) {
            $timestamp = mktime(0, 0, 0, $i, 1);
            array_push($months,date('F', $timestamp));
        }
        $date = Carbon::today();
        $date_to = Carbon::today();
        $suratjalans = SuratJalan::whereDate('created_at', '=', Carbon::today())->orderBy('id','DESC')->get();

        if($request->has("date")){
            $date = Carbon::createFromFormat('Y-m-d',  $request->date); 
            $suratjalans = SuratJalan::whereDate('created_at', '=', $request->date)->orderBy('id','DESC')->get();
            if($request->has("date_to")){
                $date_to = Carbon::createFromFormat('Y-m-d',  $request->date); 
                $suratjalans = SuratJalan::whereDate('created_at', '>=' ,$request->date)->whereDate('created_at','<=',$request->date_to)->orderBy('id','DESC')->get();
            }
        }

        if($request->has("bulan")){
            try{
                if($request->bulan >= 1 && $request->bulan <= 12){
                    $bulan = $request->bulan;
                    $date = Carbon::createFromFormat('Y-m',  '2023-'.$request->bulan)->startOfMonth(); 
                    $date_to = Carbon::createFromFormat('Y-m',  '2023-'.$request->bulan)->endOfMonth(); 
                    $suratjalans = SuratJalan::whereDate('created_at', '>=' ,$date)->whereDate('created_at','<=',$date_to)->orderBy('id','DESC')->get();
                }

            }catch(\Exception $e){
                // dd($e);
            }
        }
        return view('admin.suratjalan.listsuratjalan',[
            'suratjalans' => $suratjalans,
            'date' => $date->format('Y-m-d'),
            'date_to' => $date_to->format('Y-m-d'),
            'months' => $months,
            'bulan' => $bulan
        ]);
    }

    public function all(Request $request )
    {
        $date = Carbon::today();
        $suratjalans = SuratJalan::orderBy('id','DESC')->get();
        if($request->has("date")){
            $date = Carbon::createFromFormat('Y-m-d',  $request->date); 
            $suratjalans = SuratJalan::orderBy('id','DESC')->get();
        }
        
        return view('admin.suratjalan.all-listsuratjalan',[
            'suratjalans' => $suratjalans,
            'date' => $date->format('Y-m-d')
        ]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suratjalan = SuratJalan::findOrFail($id);
        // dd($category);
        return view('admin.suratjalan.suratjalan-edit',[
            'suratjalan' => $suratjalan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nik' => 'required',
            'nomor_surat' => 'required',
            'departemen' => 'required',
            'dari' => 'required',
            'tujuan' => 'required',
            'no_mb' => 'required',
            'barang' => 'required',
            'pos_izin' => 'required',
            'verifikasi' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route("admin.suratjalan.index")->with('danger', $validator->errors()->first());
        }

        $suratjalan = SuratJalan::findOrFail($id);
        $suratjalan->nama = $request->nama;
        $suratjalan->nik = $request->nik;
        $suratjalan->nomor_surat = $request->nomor_surat;
        $suratjalan->departemen = $request->departemen;
        $suratjalan->dari = $request->dari;
        $suratjalan->tujuan = $request->tujuan;
        $suratjalan->no_mb = $request->no_mb;
        $suratjalan->barang = $request->barang;
        $suratjalan->pos_izin = $request->pos_izin;
        $suratjalan->verifikasi = $request->verifikasi;
        if($request->has('foto_suratjalan')){
            $uploadFolder = "img/foto_suratjalan/";
            $image = $request->file('foto_suratjalan');
            $imageName = time().'-'.$image->getClientOriginalName();
            $image->move(public_path($uploadFolder), $imageName);
            $suratjalan->foto_suratjalan = $uploadFolder.$imageName;
        }
        if($request->has('lainnya')){
            $suratjalan->lainnya = $request->lainnya;
        }
        if($suratjalan->save()){
            return redirect()->route("admin.suratjalan.index")->with('status', "Sukses mengedit suratjalan");
        }else{
            return redirect()->route("admin.suratjalan.index")->with('danger', "Terjadi Kesalahan saat mengedit suratjalan.");
        }
    }

    public function keluar(Request $request, $id)
    {
        // dd('ok');
        $suratjalan = SuratJalan::findOrFail($id);
        $suratjalan->keluar = Carbon::now()->format('h:i');

        if($suratjalan->save()){
            return redirect()->route("admin.suratjalan.index")->with('status', "Sukses logout suratjalan");
        }else{
            return redirect()->route("admin.suratjalan.index")->with('danger', "Terjadi Kesalahan saat logout suratjalan.");
        }
    }

    public function verifikasi(Request $request, $id)
    {
        // dd('ok');
        $suratjalan = SuratJalan::findOrFail($id);
        $suratjalan->verifikasi = "Terverifikasi";

        if($suratjalan->save()){
            return redirect()->route("admin.suratjalan.index")->with('status', "Sukses memverfikasi SuratJalan");
        }else{
            return redirect()->route("admin.suratjalan.index")->with('danger', "Terjadi Kesalahan saat memverfikasi SuratJalan.");
        }
    }
    public function verifikasiall()
    {
       
        DB::beginTransaction();
        try{
            $update = SuratJalan::where('verifikasi','!=','Terverifikasi')->update(["verifikasi"=>"Terverifikasi"]);
            
            DB::commit();
            return redirect()->route("admin.suratjalan.index")->with('status', "Sukses memverfikasi SIM B");
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route("admin.suratjalan.index")->with('danger', "Terjadi Kesalahan saat memverfikasi SIM B.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(SuratJalan::destroy($id)){
            return redirect()->route("admin.suratjalan.index")->with('status', "Sukses menghapus suratjalan");
        }else {
            return redirect()->route("admin.suratjalan.index")->with('danger', "Terjadi Kesalahan");
        }
    }
}
