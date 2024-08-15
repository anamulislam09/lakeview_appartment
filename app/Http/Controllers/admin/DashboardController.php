<?php

namespace App\Http\Controllers\admin;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Appartment;
use App\Models\Building;
use App\Models\Member;
use Auth;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['building'] = Building::count();
        $data['appartment'] = Appartment::count();
        $data['bookedAppartment'] = Appartment::where('booking_status', 1)->count();
        $data['availableAppartment'] = Appartment::where('booking_status', 0)->count();
        $data['member'] = Member::count();
        $data['activeMember'] = Member::where('status', 1)->count();
        $data['deactiveMember'] = Member::where('status', 0)->count();
        // dd($data['deactiveMember']);
        return view('admin.index', $data);
    }
}

