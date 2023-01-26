<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Session;

use App\Models\Blokir;
use App\Models\ImagesBlokir;
use Illuminate\Support\Facades\DB;

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
        $jumlah = 0;
        DB::beginTransaction();
        try {
            $blokirs = Blokir::get();
            foreach($blokirs as $item){
                $image = ImagesBlokir::where('blokir_id',$item->id)->get();
                if(count($image) <= 0){
                    $imagesblokir = new ImagesBlokir();
                    $imagesblokir->blokir_id = $item->id;
                    $imagesblokir->foto_blokir = $item->foto;
                    $imagesblokir->save();
                    $jumlah++;
                }
            }
            DB::commit();
            return "oke: ".$jumlah;
        }catch (\Exception $e) {
            DB::rollback();
            $ea = "Terjadi Kesalahan saat menambah foto blokir".$e->message;
            return redirect()->route("blokir.index")->with('danger', $ea);
        }

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
            'keterangan'=> 'required',
            'masa_berlaku' => 'required',
            'filenames' => 'required',
            'filenames.*' => 'image'
        ]);
        if ($validator->fails()) {
            return redirect()->route("blokir.create")->with('danger', $validator->errors()->first());
        }

        DB::beginTransaction();
        try {

            $blokir  = new Blokir();
            $blokir->nama = $request->nama;
            $blokir->nik = $request->nik;
            $blokir->jenis_blokir = $request->jenis_blokir;
            $blokir->foto = "foto table lain";
            $blokir->keterangan = $request->keterangan;
            $blokir->masa_berlaku = $request->masa_berlaku;
            $blokir->save();
            if($request->hasfile('filenames')){
                foreach($request->file('filenames') as $file){
                    $uploadFolder = "img/foto_blokir/";
                    $image = $file;
                    $imageName = time().'-'.$image->getClientOriginalName();
                    $image->move(public_path($uploadFolder), $imageName);
                    $image_link = $uploadFolder.$imageName;
                    
                    $imagesblokir = new ImagesBlokir();
                    $imagesblokir->blokir_id = $blokir->id;
                    $imagesblokir->foto_blokir = $image_link;
                    $imagesblokir->save();
                }
            }
            DB::commit();
            return redirect()->route("blokir.index")->with('status', "Sukses menambah blokir");
        }catch (\Exception $e) {
            DB::rollback();
            $ea = "Terjadi Kesalahan saat menambah blokir".$e->message;
            return redirect()->route("blokir.index")->with('danger', $ea);
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

        DB::beginTransaction();
        try {
            $blokir = Blokir::findOrFail($id);
            $blokir->nama= $request->nama;
            $blokir->nik = $request->nik;
            $blokir->jenis_blokir = $request->jenis_blokir;
            $blokir->keterangan = $request->keterangan;
            $blokir->masa_berlaku =  $request->masa_berlaku;
            $blokir->save();
            if($request->hasfile('filenames')){
                foreach($request->file('filenames') as $file){
                    $uploadFolder = "img/foto_blokir/";
                    $image = $file;
                    $imageName = time().'-'.$image->getClientOriginalName();
                    $image->move(public_path($uploadFolder), $imageName);
                    $image_link = $uploadFolder.$imageName;
                    
                    $imagesblokir = new ImagesBlokir();
                    $imagesblokir->blokir_id = $blokir->id;
                    $imagesblokir->foto_blokir = $image_link;
                    $imagesblokir->save();
                }
            }
            DB::commit();
            return redirect()->route("blokir.index")->with('status', "Sukses mengedit blokir");
        }catch (\Exception $e) {
            DB::rollback();
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
