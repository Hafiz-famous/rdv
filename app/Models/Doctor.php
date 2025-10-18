<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Doctor extends Model {
    use HasFactory;
    protected $fillable = ['name','email','phone','specialty_id'];
    public function specialty(){ return $this->belongsTo(Specialty::class); }
    public function availabilities(){ return $this->hasMany(Availability::class); }
    public function appointments(){ return $this->hasMany(Appointment::class); }
}