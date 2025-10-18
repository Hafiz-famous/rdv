@php($title = 'Créer un compte Administrateur')
<!doctype html>
<html lang="fr">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $title }}</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light"><div class="container py-5">
<h1 class="mb-4">{{ $title }}</h1>
<form class="card p-4 shadow-sm bg-white" method="POST" action={{ route('register.admin') }}>@csrf
<div class="row g-3">
<div class="col-md-6"><label class="form-label">Nom</label><input name="name" class="form-control" required></div>
<div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required></div>
<div class="col-md-6"><label class="form-label">Mot de passe</label><input type="password" name="password" class="form-control" required></div>
<div class="col-md-6"><label class="form-label">Confirmer</label><input type="password" name="password_confirmation" class="form-control" required></div>

</div>
<button class="btn btn-primary mt-3">Créer le compte</button>
</form>
</div></body></html>
