<?php
require_once "db.php";
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Unity Care Clinic | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-blue-900 text-white flex flex-col">
        <div class="p-6 text-2xl font-bold border-b border-blue-700">
            Unity Care
        </div>

        <nav class="flex-1 p-4 space-y-2">
            <a href="index.php" class="block px-4 py-2 rounded bg-blue-700">Dashboard</a>
            <a href="patients.php" class="block px-4 py-2 rounded hover:bg-blue-800">Patients</a>
            <a href="medecins.php" class="block px-4 py-2 rounded hover:bg-blue-800">Médecins</a>
            <a href="departements.php" class="block px-4 py-2 rounded hover:bg-blue-800">Départements</a>

        </nav>

        <!-- Language Switch -->
        <div class="p-4 border-t border-blue-700">
            <select class="w-full text-black rounded p-2">
                <option>Français</option>
                <option>English</option>
                <option>Español</option>
            </select>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">

        <!-- Header -->
        <header class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">
                Tableau de bord
            </h1>
            <p class="text-gray-600">
                Vue globale de la clinique
            </p>
        </header>

        <!-- Statistics Cards -->
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-gray-500">Patients</h2>
                <p class="text-3xl font-bold text-blue-600">
                    <?php echo $resultPatients->num_rows;

                    ?>
                </p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-gray-500">Médecins</h2>
                <p class="text-3xl font-bold text-green-600">
                    <?php echo $resultMedecins->num_rows; ?>
                </p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-gray-500">Départements</h2>
                <p class="text-3xl font-bold text-purple-600">
                    <?php echo $resultDepartement->num_rows; ?>
                </p>
            </div>


        </section>

        <!-- Charts Placeholder -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl font-semibold mb-4">
                    Performance par département
                </h2>
                <div class="h-64 flex items-center justify-center text-gray-400 border border-dashed">
                    Chart.js ici
                </div>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl font-semibold mb-4">
                    Activité mensuelle
                </h2>
                <div class="h-64 flex items-center justify-center text-gray-400 border border-dashed">
                    Graphique ici
                </div>
            </div>
        </section>

        
        <!-- Recent Patients Table -->
        <section class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">
                Derniers patients
            </h2>


            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-3 border">Nom</th>
                        <th class="p-3 border">gender</th>
                        <th class="p-3 border">date naissance</th>
                        <th class="p-3 border">email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    while ($rowpatientsResult = $resultPatients->fetch_assoc()) {
                        echo "<tr class=\"hover:bg-gray-50\">";
                        echo "<td class=\"p-3 border\">" . $rowpatientsResult['patient_nom'] . "</td>";
                        echo "<td class=\"p-3 border\">" . $rowpatientsResult['sexe'] . "</td>";
                        echo "<td class=\"p-3 border\">" . $rowpatientsResult['date_naissance'] . "</td>";
                        echo "<td class=\"p-3 border\">" . $rowpatientsResult['email'] . "</td>";
                        echo "<td class=\"p-3 border space-x-2\">";
                        echo "<button class=\"px-3 py-1 bg-blue-600 text-white rounded\">
                                Modifier
                            </button>";
                        echo "<button class=\"px-3 py-1 bg-red-600 text-white rounded\">
                                Supprimer
                            </button>";
                        echo "</td>";
                        echo "</tr>";
                    }


                    ?>
                </tbody>
            </table>
        </section>

    </main>

</body>

</html>