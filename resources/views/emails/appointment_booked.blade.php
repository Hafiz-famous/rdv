@php($a = $appointment)
<h2>Rendez-vous enregistré</h2>
<p>
  Bonjour, votre rendez-vous a été enregistré.
</p>
<ul>
  <li>Médecin : {{ optional($a->doctor)->name }}</li>
  <li>Patient : {{ optional($a->patient)->name }}</li>
  <li>Date : {{ $a->scheduled_at }}</li>
  <li>Durée : {{ $a->duration_minutes }} minutes</li>
  <li>Statut : {{ strtoupper($a->status) }}</li>
</ul>
<p>Merci d'utiliser MediLink.</p>
