<?php
require_once "db.php";
require_once "auth.php";

requireLogin();

$sqlPatientsParSexe = "SELECT sexe, COUNT(*) AS count FROM patients GROUP BY sexe";
$resultPatientsParSexe = $conn->query($sqlPatientsParSexe);

$dataSexe = ['Homme' => 0, 'Femme' => 0];
while ($row = $resultPatientsParSexe->fetch_assoc()) {
    $dataSexe[$row['sexe']] = $row['count'];
}

$sqlMedecinsParDept = "
    SELECT d.departement_nom, COUNT(m.medecin_id) AS count
    FROM departements d
    LEFT JOIN medecins m ON d.departement_id = m.departement_id
    GROUP BY d.departement_nom
";
$resultMedecinsParDept = $conn->query($sqlMedecinsParDept);

$departements = [];
$medecinsCounts = [];
while ($row = $resultMedecinsParDept->fetch_assoc()) {
    $departements[] = $row['departement_nom'];
    $medecinsCounts[] = $row['count'];
}

$sqlPatientsParMois = "
    SELECT MONTH(date_naissance) AS mois, COUNT(*) AS count
    FROM patients
    WHERE YEAR(date_naissance) = YEAR(CURDATE())
    GROUP BY mois
";
$resultPatientsParMois = $conn->query($sqlPatientsParMois);

$moisData = array_fill(1, 12, 0);
while ($row = $resultPatientsParMois->fetch_assoc()) {
    $moisData[$row['mois']] = $row['count'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Unity Care | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100 min-h-screen flex">

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
    
    <div class="p-4 border-t border-blue-700">
        <p class="text-sm mb-2">Connecté: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
        <a href="logout.php" class="block px-4 py-2 rounded bg-red-600 hover:bg-red-700 text-center">
            Déconnexion
        </a>
    </div>
</aside>

<main class="flex-1 p-6">

<header class="mb-6">
    <h1 class="text-3xl font-bold">Tableau de bord</h1>
    <p class="text-gray-600">Vue générale</p>
</header>

<section class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold mb-3">Médecins par département</h2>
        <canvas id="chartDepartements"></canvas>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold mb-3">Patients par sexe</h2>
        <canvas id="chartSexe"></canvas>
    </div>

</section>

<section class="bg-white p-6 rounded shadow">
    <h2 class="text-lg font-semibold mb-3">Patients par mois</h2>
    <canvas id="chartMois"></canvas>
</section>

</main>

<script>
new Chart(document.getElementById('chartDepartements'), {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($departements); ?>,
        datasets: [{
            label: 'Médecins',
            data: <?php echo json_encode($medecinsCounts); ?>
        }]
    }
});


new Chart(document.getElementById('chartSexe'), {
    type: 'pie',
    data: {
        labels: ['Homme', 'Femme'],
        datasets: [{
            data: [
                <?php echo $dataSexe['Homme']; ?>,
                <?php echo $dataSexe['Femme']; ?>
            ]
        }]
    }
});

new Chart(document.getElementById('chartMois'), {
    type: 'line',
    data: {
        labels: ['Jan','Fév','Mar','Avr','Mai','Juin','Juil','Août','Sep','Oct','Nov','Déc'],
        datasets: [{
            label: 'Patients',
            data: <?php echo json_encode(array_values($moisData)); ?>
        }]
    }
});
</script>

</body>
</html>