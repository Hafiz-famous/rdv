<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class NurseProfile extends Model
{
    protected $fillable = ['user_id','grade','service','pays','ville'];
    public function user(){ return $this->belongsTo(User::class); }
}
