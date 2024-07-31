<?php

namespace App\Http\Controllers;

use App\Models\Appartment;
use App\Models\Building;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index()
    {
        $data = Member::orderBy('id', 'desc')->get();
        return view('admin.member.index', compact('data'));
    }

    public function show($id)
    {
        $data = Member::where('id', $id)->first();
        return view('admin.member.show', compact('data'));
    }

    public function create() 
    {
        $appartments = Appartment::orderBy('id', 'desc')->get();
        return view('admin.member.create', compact('appartments'));
    }

    // public function store(Request $request)
    // {
    //     $data['building_name'] = $request->building_name;
    //     $data['created_date'] = date('Y-m-d');
    //     $data['created_by'] = Auth::guard('admin')->user()->id;
    //     Building::create($data);
    //     return redirect()->route('building.index')->with('alert',['messageType'=>'success','message'=>'Building Added Successfully!']);
    // }

    public function store(Request $request)
        {
            $appartment = Appartment::where('id', $request->appartment_id)->first();
            $building = Building::where('id', $appartment->building_id)->first();

            // Validate input
            $validatedData = $request->validate([
                'member_name' => 'required|string|max:255',
                'guardian_name' => 'required|string|max:255',
                'mother_name' => 'required|string',
                'permanent_address' => 'required|string|max:255',
                'nationality' => 'required|string',
                'religion' => 'required|string|max:255',
                'date_of_birth' => 'required|date',
                'appartment_id' => 'required|exists:appartments,id',
                'intercome_no' => 'nullable|string|max:255',
                'land_phone' => 'string|max:20',
                'mobile_phone' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'nid_no' => 'required|string|max:255',
                'nid' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
                'image' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
                'flat_reg_document' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
                'car_no' => 'required|string|max:50',
                'garage_no' => 'required|string|max:50',
                'occupation' => 'nullable|string|max:255',
                'designation' => 'string|max:255',
                'institute_name' => 'string|max:255',
                'institute_address' => 'string|max:255',
            ]);
    
            // Handle file uploads
            $data = [];
            $data['appartment_id'] = $request->appartment_id;
            $data['building_id'] = $building->id;
            $data['member_name'] = $request->member_name;
            $data['guardian_name'] = $request->guardian_name;
            $data['mother_name'] = $request->mother_name;
            $data['permanent_address'] = $request->permanent_address;
            $data['nationality'] = $request->nationality;
            $data['religion'] = $request->religion;
            $data['date_of_birth'] = $request->date_of_birth;
            $data['intercome_no'] = $request->intercome_no;
            $data['land_phone'] = $request->land_phone;
            $data['mobile_phone'] = $request->mobile_phone;
            $data['email'] = $request->email;
            $data['nid_no'] = $request->nid_no;
            $data['car_no'] = $request->car_no;
            $data['garage_no'] = $request->garage_no;
            $data['occupation'] = $request->occupation;
            $data['designation'] = $request->designation;
            $data['institute_name'] = $request->institute_name;
            $data['institute_address'] = $request->institute_address;
            $data['created_date'] = date('Y-m-d');
            $data['created_by'] = Auth::guard('admin')->user()->id;
           
    
            if ($request->hasFile('nid')) {
                $nidFileName = time() . '.' . $request->file('nid')->getClientOriginalExtension();
                $request->file('nid')->storeAs('public/uploads', $nidFileName);
                $data['nid'] = $nidFileName;
            }
    
            if ($request->hasFile('image')) {
                $imageFileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->storeAs('public/uploads', $imageFileName);
                $data['image'] = $imageFileName;
            }
    
            if ($request->hasFile('flat_reg_document')) {
                $flatRegFileName = time() . '.' . $request->file('flat_reg_document')->getClientOriginalExtension();
                $request->file('flat_reg_document')->storeAs('public/uploads', $flatRegFileName);
                $data['flat_reg_document'] = $flatRegFileName;
            }
    
            // Combine validated data and file upload data
            // $memberData = array_merge($validatedData, $data);
    
            // // Store member data
            // Member::create($memberData);
            dd($data);
            Member::create($data);
    
            // Redirect back with success message or any custom response
            return redirect()->back()->with('success', 'Member created successfully!');
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

        return redirect()->route('building.index')->with('alert',['messageType'=>'warning','message'=>'Building Updated Successfully!']);
    }

    public function destroy($id)
    {
        $data = Building::findOrFail($id);
        $data->delete();
        return redirect()->route('building.index')->with('alert',['messageType'=>'danger','message'=>'Building Deleted Successfully!']);
    }
}
