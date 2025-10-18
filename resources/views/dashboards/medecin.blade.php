<!doctype html>
<html lang="fr"><head><meta charset="utf-8"><title>Dashboard medecin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="p-5"><div class="container">
  <h1>Bienvenue sur le dashboard medecin</h1>
  <p class="text-muted">Connecté en tant que {{ auth()->user()->name ?? 'Utilisateur' }}.</p>
</div></body></html>
