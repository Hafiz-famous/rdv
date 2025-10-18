<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\Specialty;
class DoctorSeeder extends Seeder {
    public function run(): void {
        $map = [
            'Généraliste' => ['Dr. Awa Diop','Dr. Koffi Mensah'],
            'Pédiatre' => ['Dr. Salif Traoré'],
            'Dermatologue' => ['Dr. Nadia Ben Ali'],
        ];
        foreach ($map as $specName => $docs) {
            $spec = Specialty::firstOrCreate(['name'=>$specName]);
            foreach ($docs as $d) {
                Doctor::firstOrCreate(['name'=>$d,'specialty_id'=>$spec->id]);
            }
        }
    }
}