@extends('layouts.app')

@section('title', 'Rendez-vous — Tableau de bord')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">

    {{-- En-tête --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold">Tableau de bord des rendez-vous</h1>
            <p class="text-sm text-gray-500">Suivi des consultations, filtres rapides et actions.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('rendezvous.create') }}"
               class="inline-flex items-center rounded-md px-3 py-2 text-sm font-medium border border-transparent bg-indigo-600 text-white hover:bg-indigo-700">
                + Nouveau rendez-vous
            </a>
        </div>
    </div>

    {{-- Cards de synthèse --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="rounded-lg border p-4 bg-white">
            <div class="text-sm text-gray-500">Aujourd’hui</div>
            <div class="mt-1 text-2xl font-semibold">{{ $stats['today'] ?? 0 }}</div>
        </div>
        <div class="rounded-lg border p-4 bg-white">
            <div class="text-sm text-gray-500">À venir</div>
            <div class="mt-1 text-2xl font-semibold">{{ $stats['upcoming'] ?? 0 }}</div>
        </div>
        <div class="rounded-lg border p-4 bg-white">
            <div class="text-sm text-gray-500">En attente</div>
            <div class="mt-1 text-2xl font-semibold">{{ $stats['pending'] ?? 0 }}</div>
        </div>
        <div class="rounded-lg border p-4 bg-white">
            <div class="text-sm text-gray-500">Annulés</div>
            <div class="mt-1 text-2xl font-semibold">{{ $stats['canceled'] ?? 0 }}</div>
        </div>
    </div>

    {{-- Filtres --}}
    <form method="GET" action="{{ route('medecin.rendezvous') }}" class="rounded-lg border bg-white p-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                <input type="date" name="date" value="{{ request('date') }}"
                       class="w-full rounded-md border-gray-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                <select name="status" class="w-full rounded-md border-gray-300">
                    <option value="">— Tous —</option>
                    @foreach (['pending'=>'En attente','confirmed'=>'Confirmé','done'=>'Terminé','canceled'=>'Annulé'] as $key => $label)
                        <option value="{{ $key }}" @selected(request('status')===$key)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Recherche (patient, motif, téléphone)</label>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Ex: Kossi, fièvre..."
                       class="w-full rounded-md border-gray-300">
            </div>
        </div>
        <div class="mt-4 flex items-center gap-2">
            <button class="rounded-md px-3 py-2 text-sm font-medium bg-gray-800 text-white hover:bg-gray-900">Filtrer</button>
            <a href="{{ route('medecin.rendezvous') }}" class="text-sm text-gray-600 hover:underline">Réinitialiser</a>
        </div>
    </form>

    {{-- Tableau --}}
    <div class="rounded-lg border bg-white overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & heure</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Motif</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($rendezvous as $rdv)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm">
                                {{ \Carbon\Carbon::parse($rdv->scheduled_at)->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <div class="font-medium">{{ $rdv->patient_name }}</div>
                                <div class="text-gray-500 text-xs">{{ $rdv->patient_phone }}</div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ Str::limit($rdv->reason, 60) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                @php
                                    $badge = [
                                        'pending'  => 'bg-yellow-100 text-yellow-800',
                                        'confirmed'=> 'bg-blue-100 text-blue-800',
                                        'done'     => 'bg-green-100 text-green-800',
                                        'canceled' => 'bg-red-100 text-red-800',
                                    ][$rdv->status] ?? 'bg-gray-100 text-gray-800';
                                    $label = [
                                        'pending'  => 'En attente',
                                        'confirmed'=> 'Confirmé',
                                        'done'     => 'Terminé',
                                        'canceled' => 'Annulé',
                                    ][$rdv->status] ?? ucfirst($rdv->status);
                                @endphp
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $badge }}">
                                    {{ $label }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('rendezvous.show', $rdv) }}"
                                       class="text-indigo-600 hover:underline">Voir</a>
                                    <a href="{{ route('rendezvous.edit', $rdv) }}"
                                       class="text-gray-700 hover:underline">Éditer</a>
                                    <form method="POST" action="{{ route('rendezvous.destroy', $rdv) }}"
                                          onsubmit="return confirm('Supprimer ce rendez-vous ?');">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600 hover:underline">Supprimer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-gray-500">
                                Aucun rendez-vous ne correspond aux filtres.
                                <a href="{{ route('medecin.rendezvous') }}" class="text-indigo-600 hover:underline">
                                    Réinitialiser les filtres
                                </a>
                                ou
                                <a href="{{ route('rendezvous.create') }}" class="text-indigo-600 hover:underline">
                                    créer un nouveau rendez-vous
                                </a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if(method_exists($rendezvous, 'links'))
            <div class="px-4 py-3 border-t bg-gray-50">
                {{ $rendezvous->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
