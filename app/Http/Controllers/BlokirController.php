<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Session;

use App\Models\Blokir;

class BlokirController extends Controller
{
    public function __construct()
    {
            $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blokirs = Blokir::get();
        return view('admin.listblokir',[
            'blokirs' => $blokirs
        ]);
    }

    public function all()
    {
        $blokirs = Blokir::get();
        return view('admin.all-listblokir',[
            'blokirs' => $blokirs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd($category);
        return view('admin.blokir-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'=> 'required',
            'nik'=> 'required',
            'jenis_blokir'=> 'required',
            'foto'=> 'required',
            'keterangan'=> 'required',
            'masa_berlaku' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route("blokir.create")->with('danger', $validator->errors()->first());
        }

        $uploadFolder = "img/foto_blokir/";
        $image = $request->file('foto');
        $imageName = time().'-'.$image->getClientOriginalName();
        $image->move(public_path($uploadFolder), $imageName);
        $image_link = $uploadFolder.$imageName;

        $blokir = Blokir::create([
            'nama'=> $request->nama,
            'nik'=> $request->nik,
            'jenis_blokir'=> $request->jenis_blokir,
            'foto'=> $image_link,
            'keterangan'=> $request->keterangan,
            'masa_berlaku' => $request->masa_berlaku,
        ]);

        if($blokir){
            return redirect()->route("blokir.index")->with('status', "Sukses menambah blokir");
        }else{
            return redirect()->route("blokir.index")->with('danger', "Terjadi Kesalahan saat menambah blokir.");
        }
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
        $blokir = Blokir::findOrFail($id);
        // dd($category);
        return view('admin.blokir-edit',[
            'blokir' => $blokir
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
            'nama'=> 'required',
            'nik'=> 'required',
            'jenis_blokir'=> 'required',
            'keterangan'=> 'required',
            'masa_berlaku' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route("blokir.index")->with('danger', $validator->errors()->first());
        }

        $blokir = Blokir::findOrFail($id);
        $blokir->nama= $request->nama;
        $blokir->nik = $request->nik;
        $blokir->jenis_blokir = $request->jenis_blokir;
        $blokir->keterangan = $request->keterangan;
        $blokir->masa_berlaku =  $request->masa_berlaku;
        if($request->hasfile('foto')){
            $uploadFolder = "img/foto_blokir/";
            $image = $request->file('foto');
            $imageName = time().'-'.$image->getClientOriginalName();
            $image->move(public_path($uploadFolder), $imageName);
            $image_link = $uploadFolder.$imageName;
            $blokir->foto = $image_link;
        }

        if($blokir->save()){
            return redirect()->route("blokir.index")->with('status', "Sukses mengedit blokir");
        }else{
            return redirect()->route("blokir.index")->with('danger', "Terjadi Kesalahan saat mengedit blokir.");
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
        if(Blokir::destroy($id)){
            return redirect()->route("blokir.index")->with('status', "Sukses menghapus blokir");
        }else {
            return redirect()->route("blokir.index")->with('danger', "Terjadi Kesalahan");
        }
    }
}
