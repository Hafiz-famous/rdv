<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PatientProfile extends Model
{
    protected $fillable = ['user_id','numero_assure','assureur','date_naissance','pays','ville'];
    public function user(){ return $this->belongsTo(User::class); }
}
