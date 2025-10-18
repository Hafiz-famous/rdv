@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Patients -->
        <div class="bg-white p-4 rounded shadow flex items-center justify-between">
            <div>
                <p class="text-gray-500">Patients</p>
                <p class="text-2xl font-bold">{{ $patientsCount }}</p>
            </div>
            <i class="fa-solid fa-user text-3xl text-blue-500"></i>
        </div>
        <!-- Médecins -->
        <div class="bg-white p-4 rounded shadow flex items-center justify-between">
            <div>
                <p class="text-gray-500">Médecins</p>
                <p class="text-2xl font-bold">{{ $medecinsCount }}</p>
            </div>
            <i class="fa-solid fa-user-doctor text-3xl text-green-500"></i>
        </div>
        <!-- Rendez-vous -->
        <div class="bg-white p-4 rounded shadow flex items-center justify-between">
            <div>
                <p class="text-gray-500">Rendez-vous</p>
                <p class="text-2xl font-bold">{{ $appointmentsCount }}</p>
            </div>
            <i class="fa-solid fa-calendar-check text-3xl text-yellow-500"></i>
        </div>
        <!-- Rapports -->
        <div class="bg-white p-4 rounded shadow flex items-center justify-between">
            <div>
                <p class="text-gray-500">Rapports</p>
                <p class="text-2xl font-bold">{{ $reportsCount }}</p>
            </div>
            <i class="fa-solid fa-file-medical text-3xl text-red-500"></i>
        </div>
    </div>

    <!-- Graphique rendez-vous -->
    <div class="bg-white p-6 rounded shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">Activité des rendez-vous</h2>
        <canvas id="appointmentsChart"></canvas>
    </div>

    <!-- Derniers utilisateurs -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Derniers utilisateurs inscrits</h2>
        <table class="min-w-full border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2">Nom</th>
                    <th class="p-2">Rôle</th>
                    <th class="p-2">Date d'inscription</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentUsers as $user)
                <tr class="border-t">
                    <td class="p-2">{{ $user->name }}</td>
                    <td class="p-2">{{ $user->role }}</td>
                    <td class="p-2">{{ $user->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('appointmentsChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            
            datasets: [{
                label: 'Rendez-vous',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2
            }]
        },
        options: { responsive: true }
    });
</script>
@endsection
