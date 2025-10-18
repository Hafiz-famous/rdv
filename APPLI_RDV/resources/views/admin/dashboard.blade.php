<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Médilink</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/countup.js@2.0.7/dist/countUp.min.js"></script>
</head>
<body class="bg-gray-100 font-sans">

<div class="min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-blue-600 text-white p-4 shadow-md">
        <h1 class="text-2xl font-bold">Tableau de bord Administrateur</h1>
    </header>

    <!-- Main -->
    <main class="flex-1 p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Carte Utilisateurs -->
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-gray-500 font-semibold">Total Utilisateurs</h2>
                        <p id="totalUsers" class="text-3xl font-bold mt-2">0</p>
                    </div>
                    <div class="text-blue-500 text-4xl">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>

            <!-- Carte Patients -->
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-gray-500 font-semibold">Patients</h2>
                        <p id="totalPatients" class="text-3xl font-bold mt-2">0</p>
                    </div>
                    <div class="text-green-500 text-4xl">
                        <i class="fas fa-procedures"></i>
                    </div>
                </div>
            </div>

            <!-- Carte Médecins -->
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-gray-500 font-semibold">Médecins</h2>
                        <p id="totalMedecins" class="text-3xl font-bold mt-2">0</p>
                    </div>
                    <div class="text-yellow-500 text-4xl">
                        <i class="fas fa-user-md"></i>
                    </div>
                </div>
            </div>

            <!-- Carte Administrateurs -->
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-gray-500 font-semibold">Admins</h2>
                        <p id="totalAdmins" class="text-3xl font-bold mt-2">0</p>
                    </div>
                    <div class="text-red-500 text-4xl">
                        <i class="fas fa-user-shield"></i>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>

<!-- FontAwesome pour les icônes -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<!-- Animation des chiffres -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const options = { duration: 2, useEasing: true, separator: ',' };

        
        users.start();
        patients.start();
        medecins.start();
        admins.start();
    });
</script>

</body>
</html>
