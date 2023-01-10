<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Session;

use App\Models\Visitor;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::now()->isoFormat('D MMMM Y');
        return view('visitor-register',[
            "today" => $today
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'nama' => 'required',
            'nik' => 'required',
            'nama_perusahaan' => 'required',
            'tujuan' => 'required',
            'foto_ktp' => 'required',
            'pos_asal' => 'required',
        ]);
        if ($validator->fails()) {
            // dd($validator->errors());
            return redirect()->route("visitor.index")->with('danger', $validator->errors()->first());
        }
        // dd($request->all());
        $uploadFolder = "img/foto_ktp/";
        $image = $request->file('foto_ktp');
        $imageName = time().'-'.$image->getClientOriginalName();
        $image->move(public_path($uploadFolder), $imageName);
        $image_link = $uploadFolder.$imageName;

        $visitor = Visitor::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'nama_perusahaan' => $request->nama_perusahaan,
            'tujuan' => $request->tujuan,
            'foto_ktp' => $image_link,
            'nomor_kartu' => $request->nomor_kartu,
            'pos_asal' => $request->pos_asal,
        ]);

        if($visitor){
            return redirect()->route("visitor.index")->with('status', "Sukses menambahkan kategori");
        }else{
            return redirect()->route("visitor.index")->with('danger', "Terjadi Kesalahan saat menambahkan kategori.");
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
