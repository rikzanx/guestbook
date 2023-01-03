<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Session;

use App\Models\Guest;


class AdminController extends Controller
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
        $guests = Guest::get();
        return view('admin.listguest',[
            'guests' => $guests
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
        $guest = Guest::findOrFail($id);
        // dd($category);
        return view('admin.guest-edit',[
            'guest' => $guest
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
            'name' => 'required',
            'email' => 'required',
            'telp' => 'required',
            'keterangan' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->route("guest.index")->with('danger', $validator->errors()->first());
        }

        $guest = Guest::findOrFail($id);
        $guest->name = $request->name;
        $guest->email = $request->email;
        $guest->telp = $request->telp;
        $guest->keterangan = $request->keterangan;

        if($guest->save()){
            return redirect()->route("guest.index")->with('status', "Sukses mengedit guest");
        }else{
            return redirect()->route("guest.index")->with('danger', "Terjadi Kesalahan saat mengedit guest.");
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
        if(Guest::destroy($id)){
            return redirect()->route("guest.index")->with('status', "Sukses menghapus guest");
        }else {
            return redirect()->route("guest.index")->with('danger', "Terjadi Kesalahan");
        }
    }
}
