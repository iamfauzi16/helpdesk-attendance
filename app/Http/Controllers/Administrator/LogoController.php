<?php

namespace App\Http\Controllers\Administrator;

use App\Logo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
       $this->middleware('admin');
    }
    public function index()
    {
        $logos = Logo::all();

        return view('administrator.logo.index', [
            'logos' => $logos
        ]);
    } 

    /**
   
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'nullable',
        ]);
    
     
        $image = $request->file('image');
    
      
        $image_file = time()."_".$image->getClientOriginalName();
    
        
        $path = 'logo';
    
  
        $image->move($path, $image_file);
    
       
        Logo::create([
            'image' => $path.'/'.$image_file, 
            'name' => $request->name,
        ]);
    
        
        Alert::success('Sukses', 'Data berhasil ditambahkan!');
    
       
        return redirect()->route('administrator.index.logo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function show(Logo $logo)
    {
        return view('administrator.logo.show', [
            'logo' => $logo
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function edit(Logo $logo)
    {
        return view('administrator.logo.edit', [
            'logo' => $logo
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logo $logo)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'nullable',
        ]);

        $image = $request->file('image');
    
      
        $image_file = time()."_".$image->getClientOriginalName();
    
        
        $path = 'logo';
    
  
        $image->move($path, $image_file);

        $logo->update([
            'name' => $request->name,
            'image' => $path.'/'.$image_file
        ]);

        Alert::success('success', 'Data berhasil diubah!');

        return redirect()->route('administrator.index.logo');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logo $logo)
    {
        $logo->delete();

        return back();
    }
}
