<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Session;
use Auth;
use App\Models\Guest;
use App\Models\Visitor;

class PosVisitorController extends Controller
{
    protected $user;
    public function __construct(Request $request)
    {
        $this->middleware('authpos',['ddd'=>'dddj']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request )
    {
        $date = Carbon::today();
        $visitors = Visitor::whereDate('created_at', '=', Carbon::today())->orderBy('id','DESC')->get();
        if($request->has("date")){
            $date = Carbon::createFromFormat('Y-m-d',  $request->date); 
            $visitors = Visitor::whereDate('created_at', '=', $request->date)->orderBy('id','DESC')->get();
        }
        
        return view('pos.listvisitor',[
            'visitors' => $visitors,
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
        $visitor = Visitor::findOrFail($id);
        // dd($category);
        return view('pos.visitor-edit',[
            'visitor' => $visitor
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
        ]);
        if ($validator->fails()) {
            return redirect()->route("pos.visitor.index")->with('danger', $validator->errors()->first());
        }

        $visitor = Visitor::findOrFail($id);
        $visitor->nama = $request->nama;
        $visitor->nik = $request->nik;
        $visitor->nama_perusahaan = $request->nama_perusahaan;
        $visitor->tujuan = $request->tujuan;
        $visitor->nomor_kartu = $request->nomor_kartu;
        $visitor->pos_asal = $request->pos_asal;
        $visitor->verifikasi = $request->verifikasi;
        if($request->has('foto_ktp')){
            $uploadFolder = "img/foto_ktp/";
            $image = $request->file('foto_ktp');
            $imageName = time().'-'.$image->getClientOriginalName();
            $image->move(public_path($uploadFolder), $imageName);
            $visitor->foto_ktp = $uploadFolder.$imageName;
        }
        if($request->has('keluar')){
            $visitor->keluar = $request->keluar;
        }
        if($visitor->save()){
            return redirect()->route("pos.visitor.index")->with('status', "Sukses mengedit visitor");
        }else{
            return redirect()->route("pos.visitor.index")->with('danger', "Terjadi Kesalahan saat mengedit visitor.");
        }
    }

    public function keluar(Request $request, $id)
    {
        // dd('ok');
        $visitor = Visitor::findOrFail($id);
        $visitor->keluar = Carbon::now()->format('h:i');

        if($visitor->save()){
            return redirect()->route("pos.visitor.index")->with('status', "Sukses logout visitor");
        }else{
            return redirect()->route("pos.visitor.index")->with('danger', "Terjadi Kesalahan saat logout visitor.");
        }
    }

    public function verifikasi(Request $request, $id)
    {
        // dd('ok');
        $visitor = Visitor::findOrFail($id);
        $visitor->verifikasi = "Terverifikasi";

        if($visitor->save()){
            return redirect()->route("pos.visitor.index")->with('status', "Sukses memverfikasi Visitor");
        }else{
            return redirect()->route("pos.visitor.index")->with('danger', "Terjadi Kesalahan saat memverfikasi Visitor.");
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
        if(Visitor::destroy($id)){
            return redirect()->route("pos.visitor.index")->with('status', "Sukses menghapus visitor");
        }else {
            return redirect()->route("pos.visitor.index")->with('danger', "Terjadi Kesalahan");
        }
    }
}
