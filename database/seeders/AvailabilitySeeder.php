<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\Availability;
use Carbon\Carbon;
class AvailabilitySeeder extends Seeder {
    public function run(): void {
        $doctors = Doctor::all();
        $today = now()->startOfDay();
        foreach ($doctors as $doc) {
            for ($d=0;$d<5;$d++){
                $date = $today->copy()->addDays($d)->toDateString();
                $start = Carbon::parse($date.' 09:00');
                for ($i=0;$i<6;$i++){
                    $slotStart = $start->copy()->addMinutes($i*30);
                    $slotEnd = $slotStart->copy()->addMinutes(30);
                    Availability::firstOrCreate([
                        'doctor_id'=>$doc->id,
                        'date'=>$date,
                        'start_time'=>$slotStart->format('H:i'),
                        'end_time'=>$slotEnd->format('H:i'),
                    ],['is_booked'=>false]);
                }
            }
        }
    }
}