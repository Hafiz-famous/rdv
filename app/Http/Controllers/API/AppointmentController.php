<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Availability;
use App\Models\Patient;
use Illuminate\Http\Request;
class AppointmentController extends Controller {
    public function store(Request $request){
        $data = $request->validate([
            'doctor_id'=>'required|integer|exists:doctors,id',
            'patient_id'=>'nullable|integer|exists:patients,id',
            'patient_name'=>'nullable|string|max:255',
            'patient_email'=>'nullable|email',
            'patient_phone'=>'nullable|string|max:50',
            'date'=>'required|date',
            'start_time'=>'required|date_format:H:i',
            'end_time'=>'required|date_format:H:i|after:start_time',
            'notes'=>'nullable|string|max:1000',
        ]);
        if (empty($data['patient_id'])){
            $patient = Patient::firstOrCreate(
                ['email'=>$data['patient_email']??null],
                ['name'=>$data['patient_name'] or 'Patient','phone'=>$data['patient_phone']??null]
            );
            $data['patient_id'] = $patient->id;
        }
        $conflict = Appointment::where('doctor_id',$data['doctor_id'])
            ->whereDate('date',$data['date'])
            ->where(function($q) use ($data){
                $q->whereBetween('start_time', [$data['start_time'],$data['end_time']])
                  ->orWhereBetween('end_time', [$data['start_time'],$data['end_time']])
                  ->orWhere(function($qq) use ($data){
                      $qq->where('start_time','<=',$data['start_time'])->where('end_time','>=',$data['end_time']);
                  });
            })->exists();
        if ($conflict) return response()->json(['message'=>'Le créneau est déjà réservé.'],422);
        $appt = Appointment::create([
            'doctor_id'=>$data['doctor_id'],
            'patient_id'=>$data['patient_id'],
            'date'=>$data['date'],
            'start_time'=>$data['start_time'],
            'end_time'=>$data['end_time'],
            'status'=>'pending',
            'notes'=>$data['notes']??null,
        ]);
        Availability::where([
            'doctor_id'=>$data['doctor_id'],
            'date'=>$data['date'],
            'start_time'=>$data['start_time'],
            'end_time'=>$data['end_time'],
        ])->update(['is_booked'=>true]);
        return response()->json(['appointment'=>$appt],201);
    }
    public function mine(Request $request){
        return Appointment::with(['doctor.specialty','patient'])->orderBy('date','desc')->limit(50)->get();
    }
    public function destroy($id){
        $appt = Appointment::findOrFail($id);
        $appt->delete();
        return response()->json(['deleted'=>true]);
    }
}