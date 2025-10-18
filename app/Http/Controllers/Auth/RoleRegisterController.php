<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PatientProfile;
use App\Models\DoctorProfile;
use App\Models\NurseProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RoleRegisterController extends Controller
{
    public function showPatientForm(){ return view('auth.register.patient'); }
    public function showDoctorForm(){ return view('auth.register.doctor'); }
    public function showNurseForm(){ return view('auth.register.nurse'); }
    public function showAdminForm(){ return view('auth.register.admin'); }

    public function registerPatient(Request $r){
        $d = $r->validate([
            'name'=>'required|string|max:255','email'=>'required|email|unique:users,email',
            'password'=>['required','confirmed',Password::min(8)],
            'numero_assure'=>'nullable|string|max:100','assureur'=>'nullable|string|max:100',
            'date_naissance'=>'nullable|date','pays'=>'nullable|string|max:100','ville'=>'nullable|string|max:100',
        ]);
        $u = User::create(['name'=>$d['name'],'email'=>$d['email'],'role'=>'patient','password'=>Hash::make($d['password'])]);
        PatientProfile::create([
            'user_id'=>$u->id,
            'numero_assure'=>$d['numero_assure']??null,
            'assureur'=>$d['assureur']??null,
            'date_naissance'=>$d['date_naissance']??null,
            'pays'=>$d['pays']??null,
            'ville'=>$d['ville']??null
        ]);
        Auth::login($u); return redirect()->route('dashboard.patient')->with('ok','Compte patient créé');
    }

    public function registerDoctor(Request $r){
        $d = $r->validate([
            'name'=>'required|string|max:255','email'=>'required|email|unique:users,email',
            'password'=>['required','confirmed',Password::min(8)],
            'specialite'=>'required|string|max:150','numero_ordre'=>'nullable|string|max:100',
            'cabinet'=>'nullable|string|max:150','pays'=>'nullable|string|max:100','ville'=>'nullable|string|max:100',
        ]);
        $u = User::create(['name'=>$d['name'],'email'=>$d['email'],'role'=>'medecin','password'=>Hash::make($d['password'])]);
        DoctorProfile::create([
            'user_id'=>$u->id,
            'specialite'=>$d['specialite'],
            'numero_ordre'=>$d['numero_ordre']??null,
            'cabinet'=>$d['cabinet']??null,
            'pays'=>$d['pays']??null,
            'ville'=>$d['ville']??null
        ]);
        Auth::login($u); return redirect()->route('dashboard.medecin')->with('ok','Compte médecin créé');
    }

    public function registerNurse(Request $r){
        $d = $r->validate([
            'name'=>'required|string|max:255','email'=>'required|email|unique:users,email',
            'password'=>['required','confirmed',Password::min(8)],
            'grade'=>'nullable|string|max:100','service'=>'nullable|string|max:150',
            'pays'=>'nullable|string|max:100','ville'=>'nullable|string|max:100',
        ]);
        $u = User::create(['name'=>$d['name'],'email'=>$d['email'],'role'=>'infirmier','password'=>Hash::make($d['password'])]);
        NurseProfile::create([
            'user_id'=>$u->id,
            'grade'=>$d['grade']??null,
            'service'=>$d['service']??null,
            'pays'=>$d['pays']??null,
            'ville'=>$d['ville']??null
        ]);
        Auth::login($u); return redirect()->route('dashboard.infirmier')->with('ok','Compte infirmier créé');
    }

    public function registerAdmin(Request $r){
        $d = $r->validate([
            'name'=>'required|string|max:255','email'=>'required|email|unique:users,email',
            'password'=>['required','confirmed',Password::min(10)],
        ]);
        $u = User::create(['name'=>$d['name'],'email'=>$d['email'],'role'=>'admin','password'=>Hash::make($d['password'])]);
        Auth::login($u); return redirect()->route('dashboard.admin')->with('ok','Administrateur créé');
    }
}
