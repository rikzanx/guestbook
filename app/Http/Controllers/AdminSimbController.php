<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Session;
use Auth;
use App\Models\Guest;
use App\Models\Simb;

class AdminSimbController extends Controller
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
        $date = Carbon::today();
        $simbs = Simb::whereDate('created_at', '=', Carbon::today())->orderBy('id','DESC')->get();
        if($request->has("date")){
            $date = Carbon::createFromFormat('Y-m-d',  $request->date); 
            $simbs = Simb::whereDate('created_at', '=', $request->date)->orderBy('id','DESC')->get();
        }
        
        return view('admin.listsimb',[
            'simbs' => $simbs,
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
        $simb = Simb::findOrFail($id);
        // dd($category);
        return view('admin.simb-edit',[
            'simb' => $simb
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
            'nama_perusahaan' => 'required',
            'tujuan' => 'required',
            'pos_asal' => 'required',
            'verifikasi' => 'required',
            'no_hp' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route("admin.simb.index")->with('danger', $validator->errors()->first());
        }

        $simb = Simb::findOrFail($id);
        $simb->nama = $request->nama;
        $simb->nik = $request->nik;
        $simb->nama_perusahaan = $request->nama_perusahaan;
        $simb->tujuan = $request->tujuan;
        $simb->nomor_kartu = $request->nomor_kartu;
        $simb->pos_asal = $request->pos_asal;
        $simb->verifikasi = $request->verifikasi;
        $simb->no_hp = $request->no_hp;
        if($request->has('foto_ktp')){
            $uploadFolder = "img/foto_ktp/";
            $image = $request->file('foto_ktp');
            $imageName = time().'-'.$image->getClientOriginalName();
            $image->move(public_path($uploadFolder), $imageName);
            $simb->foto_ktp = $uploadFolder.$imageName;
        }
        if($request->has('keluar')){
            $simb->keluar = $request->keluar;
        }
        if($simb->save()){
            return redirect()->route("admin.simb.index")->with('status', "Sukses mengedit simb");
        }else{
            return redirect()->route("admin.simb.index")->with('danger', "Terjadi Kesalahan saat mengedit simb.");
        }
    }

    public function keluar(Request $request, $id)
    {
        // dd('ok');
        $simb = Simb::findOrFail($id);
        $simb->keluar = Carbon::now()->format('h:i');

        if($simb->save()){
            return redirect()->route("admin.simb.index")->with('status', "Sukses logout simb");
        }else{
            return redirect()->route("admin.simb.index")->with('danger', "Terjadi Kesalahan saat logout simb.");
        }
    }

    public function verifikasi(Request $request, $id)
    {
        // dd('ok');
        $simb = Simb::findOrFail($id);
        $simb->verifikasi = "Terverifikasi";

        if($simb->save()){
            return redirect()->route("admin.simb.index")->with('status', "Sukses memverfikasi Simb");
        }else{
            return redirect()->route("admin.simb.index")->with('danger', "Terjadi Kesalahan saat memverfikasi Simb.");
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
        if(Simb::destroy($id)){
            return redirect()->route("admin.simb.index")->with('status', "Sukses menghapus simb");
        }else {
            return redirect()->route("admin.simb.index")->with('danger', "Terjadi Kesalahan");
        }
    }
}
