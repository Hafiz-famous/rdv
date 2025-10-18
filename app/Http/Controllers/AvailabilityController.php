<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Availability;
use Illuminate\Support\Facades\Auth;

class AvailabilityController extends Controller
{
    public function index()
    {
        $avail = Availability::where('doctor_id', Auth::id())->orderBy('weekday')->get();
        return view('medecin.availabilities', compact('avail'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'weekday'    => ['required','integer','between:0,6'],
            'start_time' => ['required','date_format:H:i'],
            'end_time'   => ['required','date_format:H:i','after:start_time'],
            'is_active'  => ['nullable','boolean'],
        ]);
        $data['doctor_id'] = Auth::id();
        $data['is_active'] = $request->boolean('is_active');
        Availability::create($data);
        return back()->with('success','Plage ajoutée.');
    }
}
