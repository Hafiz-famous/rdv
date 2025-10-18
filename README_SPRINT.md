# Sprint Auth Roles (Laravel)

## Contenu
- Contrôleur: `app/Http/Controllers/Auth/RoleRegisterController.php`
- Middleware: `app/Http/Middleware/RoleMiddleware.php`
- Vue formulaire unique: `resources/views/auth/register/role.blade.php`
- Dashboards: `resources/views/dash/*.blade.php`
- Routes additionnelles: `routes/register_roles.php` (à inclure depuis `routes/web.php`)

## Installation rapide
1. Dézipper à la racine de votre projet Laravel (là où se trouve `artisan`).
2. Enregistrer le middleware dans `app/Http/Kernel.php` :
   ```php
   protected $routeMiddleware = [
       // ...
       'role' => \App\Http\Middleware\RoleMiddleware::class,
   ];
   ```
3. Inclure les routes dans `routes/web.php` (ajouter en bas du fichier) :
   ```php
   require __DIR__.'/register_roles.php';
   ```
4. (Optionnel) Ajouter les colonnes spécifiques si vous voulez persister les champs par rôle :
   ```bash
   php artisan make:migration add_role_fields_to_users_table --table=users
   # puis complétez la migration et lancez : php artisan migrate
   ```
5. Vider les caches et démarrer :
   ```bash
   php artisan route:clear && php artisan view:clear && php artisan config:clear
   php artisan serve --host=127.0.0.1 --port=8000
   ```

## Accès
- Formulaires : `/register/patient`, `/register/medecin`, `/register/infirmier`, `/register/admin`
- Dashboards : `/patient`, `/medecin`, `/infirmier`, `/admin` (protégés par rôle)

## Notes
- Le mot de passe est **hashé** avec `Hash::make`.
- Décommentez `auth()->login($user);` pour connecter automatiquement après l'inscription.
