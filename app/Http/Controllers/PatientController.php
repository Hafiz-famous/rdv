<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class PatientController extends Controller
{
    public function showForm()
    {
        return view('register_patient');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'       => ['nullable','string','max:255'],
            'first_name' => ['nullable','string','max:100'],
            'last_name'  => ['nullable','string','max:100'],
            'email'      => ['required','email', Rule::unique('users','email')],
            'password'   => ['required','string','min:6','confirmed'],
        ], [
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);

        $finalName = $validated['name'] ?? (trim(($validated['first_name'] ?? '') . ' ' . ($validated['last_name'] ?? '')));
        if ($finalName == '') {
            return back()->withErrors(['name' => 'Veuillez renseigner un nom ou bien prénom + nom.'])->withInput();
        }

        $user = User::create([
            'name'     => $finalName,
            'email'    => $validated['email'],
            'password' => $validated['password'], // hash via mutateur
            'role'     => 'patient',
        ]);

        return redirect()->route('login')->with('success','Inscription réussie ! Vous pouvez vous connecter.');
    }
}
