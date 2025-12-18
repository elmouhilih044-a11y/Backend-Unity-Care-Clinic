
<?php
include "db.php";
// Add
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $patient_nom = $_POST['patient_nom'];
    $date_naissance = $_POST['date_naissance'];
    $sexe = $_POST['sexe'];
    $email = $_POST['email'];
    $medecin_id = $_POST['medecin_id'];
   $result= mysqli_query($conn, "INSERT INTO patients (patient_nom,date_naissance,sexe,email,medecin_id) VALUES ('$patient_nom','$date_naissance','$sexe','$email','$medecin_id')");
   if ($result){
       echo "<script>alert('Patient ajouté avec succès');</script>";
    }
    else{
        echo "<script>alert('Erreur!');</script>";
    }
    header('Refresh:0');    

}   
// delete
if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])){
    $id = $_GET['id'];
    $sqldelete = mysqli_query($conn, "DELETE FROM patients WHERE patient_id= $id");
    if($sqldelete){
        header('Location: patients.php');
        exit;
    }
    
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Patients | Unity Care Clinic</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-blue-900 text-white flex flex-col">
        <div class="p-6 text-2xl font-bold border-b border-blue-700">
            Unity Care
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="index.php" class="block px-4 py-2 rounded hover:bg-blue-800">Dashboard</a>
            <a href="patients.php" class="block px-4 py-2 rounded bg-blue-700">Patients</a>
            <a href="medecins.php" class="block px-4 py-2 rounded hover:bg-blue-800">Médecins</a>
            <a href="departements.php" class="block px-4 py-2 rounded hover:bg-blue-800">Départements</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 space-y-10">

        <!-- Page Title -->
        <header>
            <h1 class="text-3xl font-bold text-gray-800">Gestion des Patients</h1>
        </header>

        <!-- Add Patient Form -->
        <section class="bg-white rounded shadow p-6">
            <h2 class="text-xl font-semibold mb-4 text-green-700">
                Ajouter un patient
            </h2>

            <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Nom complet</label>
                    <input type="text" name="patient_nom" class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block text-sm font-medium">Date de naissance</label>
                    <input type="date" name="date_naissance" class="w-full border rounded p-2">
                </div>


        <select name="sexe" class="w-full border rounded p-2">
    <option value="Homme">Homme</option>
    <option value="Femme">Femme</option>
</select>
                    <div>
                    <label class="block text-sm font-medium">Email</label>
                    <input type="text" name="email" class="w-full border rounded p-2">
                </div>


                  <div>
                    <label class="block text-sm font-medium">Médecin id</label>
                    <input type="number" name="medecin_id" class="w-full border rounded p-2">
                </div>

           
                <div class="md:col-span-2">
                    <button class="bg-green-600 text-white px-6 py-2 rounded">
                        Ajouter
                    </button>
                </div>
            </form>
        </section>

        

        <!-- Patients Table -->
        <section class="bg-white rounded shadow p-6">
            <h2 class="text-xl font-semibold mb-4">
                Liste des patients
            </h2>

            <table class="w-full border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 border">Nom</th>
                        <th class="p-3 border">sexe</th>
                        <th class="p-3 border">date de naissance</th>
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
                         echo '<a href="updat/patientEdit.php?id='.$rowpatientsResult['patient_id'].'" class=\"px-3 py-1 bg-blue-600 text-white rounded\">
                                Modifier
                            </a>';
                        echo '<a href="patients.php?action=delete&id='. $rowpatientsResult['patient_id'] .'" class=\"px-3 py-1 bg-red-600 text-white rounded\">
                                Supprimer
                            </a>';
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
