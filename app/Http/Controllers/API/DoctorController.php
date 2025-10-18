<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Availability;
use Illuminate\Http\Request;
class DoctorController extends Controller {
    public function index(Request $request){
        $q = $request->query('q');
        $query = Doctor::with('specialty');
        if ($q) $query->where('name','like',"%$q%");
        return $query->orderBy('name')->paginate(10);
    }
    public function availability($id, Request $request){
        $date = $request->query('date');
        $query = Availability::where('doctor_id',$id)->where('is_booked',false)->orderBy('date')->orderBy('start_time');
        if ($date) $query->where('date',$date);
        return $query->get();
    }
}