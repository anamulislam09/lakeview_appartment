<?php

namespace App\Http\Controllers;

use App\Models\Appartment;
use App\Models\Building;
use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AppartmentController extends Controller
{
    public function index()
    {
        $data = Appartment::join('buildings', 'appartments.building_id', '=', 'buildings.id')
            ->select('appartments.*', 'buildings.building_name') // Select columns from both tables
            ->orderBy('appartments.id', 'desc')
            ->get();

        // Pass the data to the view
        return view('admin.appartment.index', compact('data'));
    }

    public function create()
    {
        $buildings = Building::get();
        return view('admin.appartment.create', compact('buildings'));
    }

    public function getFloor($buildingId)
    {
        // dd("hello");
        $floors = Floor::where('building_id', $buildingId)->get();
        // dd($floors);
        return response()->json($floors);
    }

    // public function store(Request $request)
    // {
    //     $data['building_id'] = $request->building_id;
    //     $data['appartment_name'] = $request->appartment_name;
    //     $data['location'] = $request->location;
    //     $data['created_date'] = date('Y-m-d');
    //     $data['created_by'] = Auth::guard('admin')->user()->id;
    //     Appartment::create($data);
    //     return redirect()->route('appartment.index')->with('alert', ['messageType' => 'success', 'message' => 'Appartment Added Successfully!']);
    // }


  // store all data 
  
 
      public function store(Request $request)
      {
          // Validate the request
        //   $request->validate([
        //       'building_id' => 'required|exists:buildings,id',
        //       'floor_id' => 'required|exists:floors,id',
        //       'building_name.*' => 'required|string',
        //       'floor_name.*' => 'required|string',
        //       'appartment_name.*' => 'required|string',
        //       'location.*' => 'required|string',
        //   ]);
  
          // Retrieve the validated data
          $buildingId = $request->input('building_id');
          $floorId = $request->input('floor_id');
        //   $buildingNames = $request->input('building_name');
        //   $floorNames = $request->input('floor_name');
          $appartmentNames = $request->input('appartment_name');
          $locations = $request->input('location');
  
          // Loop through the apartment data and store it
          foreach ($buildingNames as $index => $buildingName) {
              $appartment = new Appartment();
              $appartment->building_id = $buildingId;
              $appartment->floor_id = $floorId;
              $appartment->building_name = $buildingName;
              $appartment->floor_name = $floorNames[$index];
              $appartment->appartment_name = $appartmentNames[$index];
              $appartment->location = $locations[$index];
              $appartment->save();
          }
  
          // Redirect back with a success message
          return redirect()->route('appartment.index')->with('success', 'Appartments added successfully!');
      }
  
  



    public function edit($id)
    {
        $data = Appartment::where('id', $id)->first();
        $buildings = Building::get();
        return view('admin.appartment.edit', compact('data', 'buildings'));
    }

    public function update(Request $request)
    {
        $data = Appartment::where('id', $request->id)->first();
        $data['building_id'] = $request->building_id;
        $data['appartment_name'] = $request->appartment_name;
        $data['location'] = $request->location;
        $data['status'] = $request->status;
        $data->save();

        return redirect()->route('appartment.index')->with('alert', ['messageType' => 'warning', 'message' => 'Appartment Updated Successfully!']);
    }

    public function destroy($id)
    {
        $data = Appartment::findOrFail($id);
        $data->delete();
        return redirect()->route('appartment.index')->with('alert', ['messageType' => 'danger', 'message' => 'Appartment Deleted Successfully!']);
    }
}
