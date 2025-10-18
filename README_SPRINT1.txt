Sprint 1 - RDV (Laravel 9)
1) Dézippez à la racine du projet (même dossier que 'artisan').
2) Assurez-vous que .env est en SQLite (DB_CONNECTION=sqlite) et que database/database.sqlite existe.
3) php artisan config:clear
4) php artisan migrate --database=sqlite
5) php artisan db:seed
6) php artisan serve --host=127.0.0.1 --port=8035

API:
GET    /api/doctors
GET    /api/doctors/{id}/availability?date=YYYY-MM-DD
POST   /api/appointments   (doctor_id, patient_email/name/phone, date, start_time, end_time, notes?)
GET    /api/my/appointments
DELETE /api/appointments/{id}
