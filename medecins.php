<?php
include"db.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $medecin_nom = $_POST['medecin_nom'];
    $specialite = $_POST['specialite'];
     $departement_id = $_POST['departement_id'];
    $result=mysqli_query($conn, "INSERT INTO medecins (medecin_nom,specialite,departement_id) VALUES ('$medecin_nom','$specialite',$departement_id)");

    if ($result){
       echo "<script>alert('Medecin ajouté avec succès');</script>";
    }
    else{
     echo "<script>alert('Erreur!');</script>";
    }

    header('refresh:0');
}
// delete

if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])){
    $id = $_GET['id'];
    $sqldelete = mysqli_query($conn, "DELETE FROM medecins WHERE medecin_id= $id");
    if($sqldelete){
        header('Location: medecins.php');
        exit;
    }
    
}

?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Médecins | Unity Care Clinic</title>
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

    <!-- Content -->
    <main class="flex-1 p-6">
        <h1 class="text-3xl font-bold mb-6">Gestion des Médecins</h1>

        </div>
         <section class="bg-white rounded shadow p-6">
            <h2 class="text-xl font-semibold mb-4 text-green-700">
                Ajouter un medecin
            </h2>

            <form class="grid grid-cols-1 md:grid-cols-2 gap-4" method="post">
                <div>
                    <label class="block text-sm font-medium">Nom complet</label>
                    <input type="text" name="medecin_nom" class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block text-sm font-medium">Specialite</label>
                    <input type="text" name="specialite" class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block text-sm font-medium">Departement id</label>
                    <input type="number" name="departement_id" class="w-full border rounded p-2">
                </div>

                <div>
                
                    </select>
                </div>

               
                <div class="md:col-span-2">
                    <button class="bg-green-600 text-white px-6 py-2 rounded">
                        Ajouter
                    </button>
                </div>
            </form>
        </section>

        <div class="bg-white rounded shadow p-4">
            <table class="w-full border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 border">Nom</th>
                        <th class="p-3 border">Spécialité</th>
                        <th class="p-3 border">Département</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php

                    while ($rowmedecinsResult = $resultMedecins->fetch_assoc()) {
                        echo "<tr class=\"hover:bg-gray-50\">";
                        echo "<td class=\"p-3 border\">" . $rowmedecinsResult['medecin_nom'] . "</td>";
                        echo "<td class=\"p-3 border\">" . $rowmedecinsResult['specialite'] . "</td>";
                        echo "<td class=\"p-3 border\">" . $rowmedecinsResult['departement_id'] . "</td>";
                        echo "<td class=\"p-3 border space-x-2\">";
                        echo '<a href="updat/medeciEdit.php?id='.$rowmedecinsResult['medecin_id'].'" class=\"px-3 py-1 bg-blue-600 text-white rounded\">
                                Modifier
                            </a>';
                        echo '<a href="updat/medecins.php?action=delete&id='. $rowmedecinsResult['medecin_id'] .'" class=\"px-3 py-1 bg-red-600 text-white rounded\">
                                Supprimer
                            </a>';

                              
                        
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>


                </tbody>
            </table>
        </div>
    </main>

</body>
</html>
