<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuildingController extends Controller
{
    public function index()
    {
        $data = Building::orderBy('id', 'desc')->get();
        return view('admin.buildings.index', compact('data'));
    }

    public function create()
    {
        return view('admin.buildings.create');
    }

    public function store(Request $request)
    {
        $data['building_name'] = $request->building_name;
        $data['building_location'] = $request->building_location;
        $data['building_floor'] = $request->building_floor;
        $data['created_date'] = date('Y-m-d');
        $data['created_by'] = Auth::guard('admin')->user()->id;
        $building = Building::create($data);

        if ($building) {
            $building_id = Building::latest()->value('id');
            $floor = $request->building_floor;
            for ($i = 0; $i < $floor; $i++) {
                $data['building_id'] = $building_id;
                $data['building_floor'] = $i + 1;
                Floor::create($data);
            }
        }
        return redirect()->route('building.index')->with('alert', ['messageType' => 'success', 'message' => 'Building Added Successfully!']);
    }

    public function edit($id)
    {
        $data = Building::where('id', $id)->first();
        return view('admin.buildings.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $data = Building::where('id', $request->id)->first();
        $data['building_name'] = $request->building_name;
        $data['status'] = $request->status;
        $data->save();

        return redirect()->route('building.index')->with('alert', ['messageType' => 'warning', 'message' => 'Building Updated Successfully!']);
    }

    public function destroy($id)
    {
        $data = Building::findOrFail($id);
        $data->delete();
        return redirect()->route('building.index')->with('alert', ['messageType' => 'danger', 'message' => 'Building Deleted Successfully!']);
    }
}
