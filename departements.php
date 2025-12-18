<?php
include"db.php";

if($_SERVER['REQUEST_METHOD']=='POST'){
    $departement_nom = $_POST['departement_nom'];
      $location = $_POST['location'];
   $result=mysqli_query($conn, "INSERT INTO departements (departement_nom,location) VALUES ('$departement_nom','$location')");

   if($result){
    echo"<script>alert('Département ajouté avec succès');</script>";
   }
 else{
     echo "<script>alert('Erreur!');</script>";
 }

 header('REFRESH:0');
}
// delete
try{
    if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])){
    $id = $_GET['id'];
    $sqldelete = mysqli_query($conn, "DELETE FROM departements WHERE departement_id= $id");
    if($sqldelete){
        header('Location: departements.php');
        exit;
    }
    
}
}catch(Exception $e){
    if($conn->errno == 1451){
        echo "<script>alert('Erreur!');</script>";
    }
    header('Location: departements.php');
    exit;
}



// if (isset($_POST['delete'])) {
//     $id = $_POST['id'];
//     mysqli_query($conn, "DELETE FROM departements WHERE id = $id");
// }
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Départements | Unity Care Clinic</title>
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
        <h1 class="text-3xl font-bold mb-6">Gestion des Départements</h1>

    
         <section class="bg-white rounded shadow p-6">
            <h2 class="text-xl font-semibold mb-4 text-green-700">
                Ajouter un département
            </h2>

            <form class="grid grid-cols-1 md:grid-cols-2 gap-4" method="post">
                <div>
                    <label class="block text-sm font-medium">Nom de département</label>
                    <input type="text" name="departement_nom" class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block text-sm font-medium">Location</label>
                    <input type="text" name="location" class="w-full border rounded p-2">
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
                        <th class="p-3 border">Nom du département</th>
                        <th class="p-3 border">location</th>
                    </tr>
                </thead>
                <tbody>
                   <?php

                    while ($rowdepartementsResult = $resultDepartement->fetch_assoc()) {
                        echo "<tr class=\"hover:bg-gray-50\">";
                        echo "<td class=\"p-3 border\">" . $rowdepartementsResult['departement_nom'] . "</td>";
                        echo "<td class=\"p-3 border\">" . $rowdepartementsResult['location'] . "</td>";
                        echo "<td class=\"p-3 border space-x-2\">";
                       echo '<a href="updat/departmentEdit.php?id='. $rowdepartementsResult['departement_id'].'" class=\"px-3 py-1 bg-blue-600 text-white rounded\">
                                Modifier
                            </a>';
                       
                           echo '<a href="departements.php?action=delete&id='. $rowdepartementsResult['departement_id'] .'" class=\"px-3 py-1 bg-red-600 text-white rounded\">
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
