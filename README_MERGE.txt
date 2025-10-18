# Sprint 2 — Médecins, Spécialités & RDV (MVP)

## Contenu
Ce zip contient tous les fichiers à copier dans votre projet Laravel.

### À copier/coller (en conservant les dossiers)
- app/Models/
- app/Http/Controllers/
- app/Policies/
- database/migrations/
- database/seeders/
- resources/views/medecins/
- resources/views/rdv/
- routes/web_sprint2.php (routes à fusionner dans routes/web.php)

### Ajouts à faire à la main
1) **User.php** (modèle) — ajouter les relations :
```
public function doctorProfile(){ return $this->hasOne(\App\Models\DoctorProfile::class); }
public function specialties(){ return $this->belongsToMany(\App\Models\Specialty::class, 'specialty_user'); }
public function appointmentsAsPatient(){ return $this->hasMany(\App\Models\Appointment::class,'patient_id'); }
public function appointmentsAsDoctor(){ return $this->hasMany(\App\Models\Appointment::class,'doctor_id'); }
```

2) **AuthServiceProvider.php** — enregistrer la policy :
```
protected $policies = [
    \App\Models\Appointment::class => \App\Policies\AppointmentPolicy::class,
];
```

3) **routes/web.php** — ouvrir `routes/web_sprint2.php` et **copier les routes**.

4) **Seeders** — ouvrir `database/seeders/DatabaseSeeder.php` et ajouter :
```
$this->call([
    SpecialtySeeder::class,
    DoctorSeeder::class,
    AdminUserSeeder::class,
]);
```

## Commandes
- Migrations : `php artisan migrate`
- Seed : `php artisan db:seed` (ou `php artisan db:seed --class=DatabaseSeeder`)
