<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    /** États possibles */
    public const STATUS_PENDING   = 'pending';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_CANCELLED = 'cancelled';

    /** Attributs mass-assignables */
    protected $fillable = [
        'user_id',      // <-- patient
        'doctor_id',    // <-- FK vers doctors.id
        'scheduled_at',
        'status',
        'reason',
    ];

    /** Valeurs par défaut */
    protected $attributes = [
        'status' => self::STATUS_PENDING,
    ];

    /** Casts */
    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    /* -------------------- Relations -------------------- */

    // Patient (utilisateur)
    public function patient()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Médecin (modèle Doctor, pas User)
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    /* -------------------- Scopes utiles -------------------- */

    /** RDV pour un médecin donné */
    public function scopeForDoctor(Builder $q, int $doctorId): Builder
    {
        return $q->where('doctor_id', $doctorId);
    }

    /** RDV pour un patient donné */
    public function scopeForPatient(Builder $q, int $userId): Builder
    {
        return $q->where('user_id', $userId);
    }

    /** Filtre par statut */
    public function scopeStatus(Builder $q, ?string $status): Builder
    {
        if ($status) {
            $q->where('status', $status);
        }
        return $q;
    }

    /** Entre deux dates (inclusives) */
    public function scopeBetweenDates(Builder $q, ?string $from, ?string $to): Builder
    {
        if ($from) $q->whereDate('scheduled_at', '>=', $from);
        if ($to)   $q->whereDate('scheduled_at', '<=', $to);
        return $q;
    }

    /** À venir uniquement */
    public function scopeUpcoming(Builder $q): Builder
    {
        return $q->where('scheduled_at', '>=', now());
    }

    /* -------------------- Accessors/Helpers -------------------- */

    public function getFormattedDateAttribute(): string
    {
        return $this->scheduled_at?->format('d/m/Y H:i') ?? '';
    }
}
