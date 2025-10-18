@php($a = $appointment)
<h2>Mise à jour de votre rendez-vous</h2>
<p>
  Le statut de votre rendez-vous a changé : <strong>{{ strtoupper($a->status) }}</strong>.<br>
</p>
<ul>
  <li>Médecin : {{ optional($a->doctor)->name }}</li>
  <li>Date : {{ $a->scheduled_at }}</li>
  <li>Durée : {{ $a->duration_minutes }} minutes</li>
</ul>
<p>Merci d'utiliser MediLink.</p>
