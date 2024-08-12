<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Appartment;
use App\Models\Building;
use App\Models\FamilyMember;
use App\Models\Floor;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Mailer\Transport\Dsn;
use Termwind\Components\Dd;

class MemberController extends Controller
{
    public function index()
    {
        $data = Member::orderBy('id', 'desc')->get();
        $buildings = Building::orderBy('id', 'desc')->get();
        return view('admin.member.index', compact('data', 'buildings'));
    }

    public function filterMembers(Request $request)
    {
        \Log::info('Filter Parameters:', $request->all()); // Log the request data

        $buildingId = $request->get('building_id');
        $floorId = $request->get('floor_id');
        $appartmentId = $request->get('appartment_id');
        $search = $request->get('search');

        $query = Member::query()
            ->leftJoin('appartments', 'members.appartment_id', '=', 'appartments.id')
            ->leftJoin('floors', 'members.floor_id', '=', 'floors.id') // Assuming floors is the table name
            ->leftJoin('buildings', 'members.building_id', '=', 'buildings.id')
            ->leftJoin('admins', 'members.created_by', '=', 'admins.id')
            ->select('members.*', 'appartments.appartment_name', 'floors.building_floor', 'admins.name as auth_name'); // Include floor name

        // Filter by Building
        if ($buildingId && $buildingId != 0) {
            $query->where('members.building_id', $buildingId);
        }

        // Filter by Floor
        if ($floorId && $floorId != 0) {
            $query->where('members.floor_id', $floorId);
        }

        // Filter by Apartment
        if ($appartmentId && $appartmentId != 0) {
            $query->where('members.appartment_id', $appartmentId);
        }

        // Apply Search Filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('members.member_name', 'like', '%' . $search . '%')
                    ->orWhere('members.mobile_phone', 'like', '%' . $search . '%')
                    ->orWhere('members.email', 'like', '%' . $search . '%')
                    ->orWhere('appartments.appartment_name', 'like', '%' . $search . '%')
                    ->orWhere('buildings.building_name', 'like', '%' . $search . '%')
                    ->orWhere('admins.name', 'like', '%' . $search . '%')
                    ->orWhere('floors.building_floor', 'like', '%' . $search . '%'); // Include floor search
            });
        }

        // Retrieve the filtered members
        $members = $query->get();
        // dd($members);

        \Log::info('Filtered Members:', $members->toArray()); // Log the query result
        return response()->json(['members' => $members]);
    }


    public function show($id)
    {
        $data = Member::where('id', $id)->first();
        $fmembers = FamilyMember::where('member_id', $data->id)->get();
        return view('admin.member.show', compact('data', 'fmembers'));
    }

    public function create()
    {
        $buildings = Building::orderBy('id', 'desc')->get();
        return view('admin.member.create', compact('buildings'));
    }

    public function getAppartment($floorId)
    {
        $appartments = Appartment::where('floor_id', $floorId)->where('booking_status', 1)->where('status', 1)->get();
        return response()->json($appartments);
    }

    //  filter members using jquery
    public function getAppartments($buildingId)
    {
        // dd($buildingId);
        $appartments = Appartment::where('building_id', $buildingId)->where('booking_status', 0)->where('status', 1)->get();
        // dd($appartments);
        return response()->json(['appartments' => $appartments]);
    }

    public function store(Request $request)
    {
        // dd($request->all(), $request->file("family_member_image"));
        if ($request->family_member_name) {
            $appartment = Appartment::find($request->appartment_id);

            $floor = Floor::find($appartment->floor_id);

            $building = Building::find($appartment->building_id);

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
                'land_phone' => 'nullable|string|max:20',
                'mobile_phone' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'nid_no' => 'required|string|max:255',
                'nid' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
                'image' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
                'flat_reg_document' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
                'car_no' => 'nullable|string|max:50',
                'garage_no' => 'nullable|string|max:50',
                'occupation' => 'nullable|string|max:255',
                'designation' => 'nullable|string|max:255',
                'institute_name' => 'nullable|string|max:255',
                'institute_address' => 'nullable|string|max:255',
            ]);

            // Handle file uploads
            $data = $validatedData;
            $data['building_id'] = $building->id;
            $data['floor_id'] = $floor->id;
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

            $member = Member::create($data);
            // Store family members
            if ($member) {
                $memberId = Member::latest()->first();
                foreach ($request->family_member_name as $index => $familyMemberName) {
                    // dd($memberId->id);
                    $familyData = [
                        'member_id' => $memberId->id,
                        'family_member_name' => $familyMemberName,
                        'family_member_occupation' => $request->family_member_occupation[$index] ?? null,
                        'family_member_age' => $request->family_member_age[$index] ?? null,
                        'family_member_relation' => $request->family_member_relation[$index] ?? null,
                    ];

                    if ($request->hasFile("family_member_image.$index")) {
                        $familyMemberFile = $request->file("family_member_image.$index");
                        $familyMemberFileName = time() . "_family_member_image_{$index}." . $familyMemberFile->getClientOriginalExtension();
                        $familyMemberFile->move(public_path('family_member_document/family_member_image'), $familyMemberFileName);
                        $familyData['family_member_image'] = 'family_member_document/family_member_image/' . $familyMemberFileName;
                    }

                    // if ($request->hasFile("family_member_image.$index")) {
                    //     $familyMemberFile = $request->file("family_member_image.$index");
                    //     $familyMemberFileName = time() . "_family_member_image_{$index}." . $familyMemberFile->getClientOriginalExtension();
                    //     $familyMemberFile->move(public_path('family_member_document/family_member_image'), $familyMemberFileName);
                    //     $familyData['family_member_image'] = 'family_member_document/family_member_image/' . $familyMemberFileName;
                    // }
                    
                    // dd($familyData);
                    FamilyMember::create($familyData);
                }
            }

            // Update apartment booking status
            if ($appartment) {
                $appartment->booking_status = 1;
                $appartment->save();
            }
            return redirect()->route('member.index')->with('alert', ['messageType' => 'success', 'message' => 'Member created successfully!']);
        } else {
            return redirect()->route('member.create')->with('alert', ['messageType' => 'warning', 'message' => 'Please Add family member!']);
        }
    }


    public function edit($id)
    {
        $data = Member::where('id', $id)->first();
        $fmembers = FamilyMember::where('member_id', $data->id)->get();
        $building = Building::where('id', $data->building_id)->value('building_name');
        $appartment = Appartment::where('id', $data->appartment_id)->value('appartment_name');
        return view('admin.member.edit', compact('data', 'fmembers', 'building', 'appartment'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data = Member::findOrFail($id);

        // Validate input
        // $validatedData = $request->validate([
        //     'member_name' => 'required|string|max:255',
        //     'guardian_name' => 'required|string|max:255',
        //     'mother_name' => 'required|string',
        //     'permanent_address' => 'required|string|max:255',
        //     'nationality' => 'required|string',
        //     'religion' => 'required|string|max:255',
        //     'date_of_birth' => 'required|date',
        //     'appartment_id' => 'required|exists:appartments,id',
        //     'intercome_no' => 'nullable|string|max:255',
        //     'land_phone' => 'string|max:20',
        //     'mobile_phone' => 'required|string|max:20',
        //     'email' => 'required|email|max:255',
        //     'nid_no' => 'required|string|max:255',
        //     'nid' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
        //     'image' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        //     'flat_reg_document' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        //     'car_no' => 'required|string|max:50',
        //     'garage_no' => 'required|string|max:50',
        //     'occupation' => 'nullable|string|max:255',
        //     'designation' => 'string|max:255',
        //     'institute_name' => 'string|max:255',
        //     'institute_address' => 'string|max:255',
        // ]);

        // Update data
        $data->member_name = $request->member_name;
        $data->guardian_name = $request->guardian_name;
        $data->mother_name = $request->mother_name;
        $data->permanent_address = $request->permanent_address;
        $data->nationality = $request->nationality;
        $data->religion = $request->religion;
        $data->date_of_birth = $request->date_of_birth;
        $data->intercome_no = $request->intercome_no;
        $data->land_phone = $request->land_phone;
        $data->mobile_phone = $request->mobile_phone;
        $data->email = $request->email;
        $data->nid_no = $request->nid_no;
        $data->car_no = $request->car_no;
        $data->garage_no = $request->garage_no;
        $data->occupation = $request->occupation;
        $data->designation = $request->designation;
        $data->institute_name = $request->institute_name;
        $data->institute_address = $request->institute_address;
        $data->status = $request->status;
        // dd($data);

        // Handle file uploads
        if ($request->hasFile('nid')) {
            if ($data->nid && file_exists(public_path($data->nid))) {
                unlink(public_path($data->nid));
            }
            $nidFile = $request->file('nid');
            $nidFileName = time() . '_nid.' . $nidFile->getClientOriginalExtension();
            $nidFile->move(public_path('member_document/nid'), $nidFileName);
            $data->nid = 'member_document/nid/' . $nidFileName;
        }

        if ($request->hasFile('image')) {
            if ($data->image && file_exists(public_path($data->image))) {
                unlink(public_path($data->image));
            }
            $imageFile = $request->file('image');
            $imageFileName = time() . '_image.' . $imageFile->getClientOriginalExtension();
            $imageFile->move(public_path('member_document/image'), $imageFileName);
            $data->image = 'member_document/image/' . $imageFileName;
        }

        if ($request->hasFile('flat_reg_document')) {
            if ($data->flat_reg_document && file_exists(public_path($data->flat_reg_document))) {
                unlink(public_path($data->flat_reg_document));
            }
            $flatRegDocFile = $request->file('flat_reg_document');
            $flatRegDocFileName = time() . '_flat_reg_document.' . $flatRegDocFile->getClientOriginalExtension();
            $flatRegDocFile->move(public_path('member_document/flat_reg_document'), $flatRegDocFileName);
            $data->flat_reg_document = 'member_document/flat_reg_document/' . $flatRegDocFileName;
        }

        $data->save();


        // family member document 
        $data['family_member_name'] = $request->family_member_name;
        $data['family_member_occupation'] = $request->family_member_occupation;
        $data['family_member_age'] = $request->family_member_age;
        $data['family_member_relation'] = $request->family_member_relation;


        if ($request->hasFile('family_member_image')) {
            if ($data->family_member_image && file_exists(public_path($data->family_member_image))) {
                unlink(public_path($data->family_member_image));
            }
            $family_member_image = $request->file('family_member_image');
            $family_member_imageName = time() . '_family_member_image.' . $family_member_image->getClientOriginalExtension();
            $family_member_image->move(public_path('family_member_document/family_member_image'), $family_member_imageName);
            $data->family_member_image = 'family_member_document/family_member_image/' . $family_member_imageName;
        }



        // Redirect back with success message
        return redirect()->back()->with('success', 'Member updated successfully!');
    }


    public function destroy($id)
    {
        $data = Member::findOrFail($id);
        $data->delete();
        return redirect()->route('member.index')->with('alert', ['messageType' => 'danger', 'message' => 'Building Deleted Successfully!']);
    }
}
