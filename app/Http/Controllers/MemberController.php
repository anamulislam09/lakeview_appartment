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
        $buildings = Building::orderBy('id', 'desc')->get();
        return view('admin.member.create', compact('buildings'));
    }

    public function getAppartment($buildingId)
    {
        $appartments = Appartment::where('building_id', $buildingId)->get();
        return response()->json($appartments);
    }

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
            $nidFile = $request->file('nid');
            $nidFileName = time() . '_nid.' . $nidFile->getClientOriginalExtension();
            $nidFile->move(public_path('member_document/nid'), $nidFileName);
            $data['nid'] = 'member_document/nid/' . $nidFileName;
        }

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imgFileName = time() . '_image.' . $imageFile->getClientOriginalExtension();
            $imageFile->move(public_path('member_document/image'), $imgFileName);
            $data['image'] = 'member_document/image/' . $imgFileName;
        }

        if ($request->hasFile('flat_reg_document')) {
            $regFile = $request->file('flat_reg_document');
            $regFileName = time() . '_flat_reg_document.' . $regFile->getClientOriginalExtension();
            $regFile->move(public_path('member_document/flat_reg_document'), $regFileName);
            $data['flat_reg_document'] = 'member_document/flat_reg_document/' . $regFileName;
        }

        // Combine validated data and file upload data
        // $memberData = array_merge($validatedData, $data);

        $data['family_member_name'] = $request->family_member_name;
        $data['family_member_occupation'] = $request->family_member_occupation;
        $data['family_member_age'] = $request->family_member_age;
        $data['family_member_relation'] = $request->family_member_relation;

        if ($request->hasFile('family_member_image')) {
            $familyMemberFile = $request->file('family_member_image');
            $familyMemberFileFileName = time() . '_family_member_image.' . $familyMemberFile->getClientOriginalExtension();
            $familyMemberFile->move(public_path('family_member_document/family_member_image'), $familyMemberFileFileName);
            $data['family_member_image'] = 'member_document/family_member_image/' . $familyMemberFileFileName;
        }
        Member::create($data);

        // Redirect back with success message or any custom response
        return redirect()->back()->with('success', 'Member created successfully!');
    }

    public function edit($id)
    {
        $data = Member::where('id', $id)->first();
        $building = Building::where('id', $data->building_id)->value('building_name');
        $appartment = Appartment::where('id', $data->appartment_id)->value('appartment_name');
        return view('admin.member.edit', compact('data', 'building', 'appartment'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data = Appartment::findOrFail($id);
    
        // $document->tenant_id = $request->tenant_id;
        // $document->client_id = Auth::guard('admin')->user()->id;
        // $document->auth_id = Auth::guard('admin')->user()->id;
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
            $nidFile = $request->file('nid');
            $nidFileName = time() . '_nid.' . $nidFile->getClientOriginalExtension();
            $nidFile->move(public_path('member_document/nid'), $nidFileName);
            $data['nid'] = 'member_document/nid/' . $nidFileName;
        }

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imgFileName = time() . '_image.' . $imageFile->getClientOriginalExtension();
            $imageFile->move(public_path('member_document/image'), $imgFileName);
            $data['image'] = 'member_document/image/' . $imgFileName;
        }

        if ($request->hasFile('flat_reg_document')) {
            $regFile = $request->file('flat_reg_document');
            $regFileName = time() . '_flat_reg_document.' . $regFile->getClientOriginalExtension();
            $regFile->move(public_path('member_document/flat_reg_document'), $regFileName);
            $data['flat_reg_document'] = 'member_document/flat_reg_document/' . $regFileName;
        }

        // Combine validated data and file upload data
        // $memberData = array_merge($validatedData, $data);

        $data['family_member_name'] = $request->family_member_name;
        $data['family_member_occupation'] = $request->family_member_occupation;
        $data['family_member_age'] = $request->family_member_age;
        $data['family_member_relation'] = $request->family_member_relation;

        if ($request->hasFile('family_member_image')) {
            $familyMemberFile = $request->file('family_member_image');
            $familyMemberFileFileName = time() . '_family_member_image.' . $familyMemberFile->getClientOriginalExtension();
            $familyMemberFile->move(public_path('family_member_document/family_member_image'), $familyMemberFileFileName);
            $data['family_member_image'] = 'member_document/family_member_image/' . $familyMemberFileFileName;
        }
        Member::create($data);

        // Redirect back with success message or any custom response
        return redirect()->back()->with('success', 'Member created successfully!');
    }



    public function destroy($id)
    {
        $data = Building::findOrFail($id);
        $data->delete();
        return redirect()->route('building.index')->with('alert', ['messageType' => 'danger', 'message' => 'Building Deleted Successfully!']);
    }
}
