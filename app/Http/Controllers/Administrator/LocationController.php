<?php

namespace App\Http\Controllers\Administrator;

use App\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('administrator.location.index', compact('locations'));
    }
    
    public function store(Request $request)
    {
        $location = $request->validate([
            'address' => 'required',
            'longitude' => 'required',
            'latitude' => 'required'
        ]);

        Location::create($location);

        Alert::success('success', 'Data lokasi berhasil ditambah!');
        return redirect()->route('administrator.index.location');
    }

    public function destroy($id)
    {
        $location = Location::find($id);

        $location->delete();

        Alert::info('info', 'Data berhasil dihapus');
        return back();
    }
}
