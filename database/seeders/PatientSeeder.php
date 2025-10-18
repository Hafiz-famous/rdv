<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Patient;
class PatientSeeder extends Seeder {
    public function run(): void {
        Patient::firstOrCreate(['email'=>'patient@test.local'],['name'=>'Patient Test','phone'=>'+22800000000']);
    }
}