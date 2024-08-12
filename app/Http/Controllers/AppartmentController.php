<?php

namespace App\Http\Controllers;

use App\Models\Appartment;
use App\Models\Building;
use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


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
        $floors = Floor::where('building_id', $buildingId)->get();
        return response()->json($floors);
    }


    public function store(Request $request)
    {
        // Log the request data
        Log::info('Request Data:', $request->all());

        // Retrieve the validated input data
        $buildingId = $request->input('building_id');
        $floorIds = $request->input('floor_id', []);
        $appartmentNames = $request->input('appartment_name', []);

        // Log the retrieved data
        Log::info('Building ID:', [$buildingId]);
        Log::info('Floor IDs:', $floorIds);
        Log::info('Appartment Names:', $appartmentNames);

        // Ensure that the arrays are not empty and have matching lengths
        if (count($floorIds) !== count($appartmentNames)) {
            return redirect()->back()->withErrors(['msg' => 'Mismatch between floor IDs and appartment names.'])->withInput();
        }

        // Iterate through the arrays and save the data
        foreach ($floorIds as $index => $floorId) {
            $appartment = new Appartment();
            $appartment->building_id = $buildingId;
            $appartment->floor_id = $floorId;
            $appartment->appartment_name = $appartmentNames[$index];
            $appartment->created_date = date('Y-m-d');
            $appartment->created_by = Auth::guard('admin')->user()->id;

            // Log the appartment data before saving
            Log::info('Appartment Data:', $appartment->toArray());

            try {
                $appartment->save();
            } catch (\Exception $e) {
                Log::error('Error saving appartment:', ['error' => $e->getMessage()]);
                return redirect()->back()->withErrors(['msg' => 'Failed to save appartment. Please try again.'])->withInput();
            }
        }

        return redirect()->route('appartment.index')->with('alert',['messageType'=>'success','message'=>'Appartments added successfully.!']);
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
        $data['appartment_name'] = $request->appartment_name;
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
