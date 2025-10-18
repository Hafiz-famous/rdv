<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Specialty;
class SpecialtySeeder extends Seeder {
    public function run(): void {
        foreach (['Généraliste','Pédiatre','Dermatologue','Dentiste','Cardiologue'] as $n) {
            Specialty::firstOrCreate(['name'=>$n]);
        }
    }
}