<?php
require_once '../db.php';
if($_GET['id']){
    $id = $_GET['id'];
    $sqlmedecin = "SELECT * from medecins where medecin_id = $id";
    $resultedit = $conn->query($sqlmedecin);
    if($resultedit){
$rowedit = $resultedit->fetch_assoc();
    $name = $rowedit['medecin_nom'];
    $specialite = $rowedit['specialite'];
    $departement_id=$rowedit['departement_id'];
    }
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $name = $_POST['medecin_nom'];
    $specialite= $_POST['specialite'];
      $departement_id= $_POST['departement_id'];
    $id = $_GET['id'];
    $sqlUpdatemedecins = "UPDATE medecins set medecin_nom = '$name' ,specialite='$specialite',   departement_id='$departement_id' where medecin_id =$id";

    if($conn->query($sqlUpdatemedecins)){
        echo "succès";
    }
    header("Location: ../medecins.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
     <section class="bg-white rounded shadow p-6">
            <h2 class="text-xl font-semibold mb-4 text-green-700">
                Ajouter un medecin
            </h2>

            <form class="grid grid-cols-1 md:grid-cols-2 gap-4" method="post">
                <div>
                    <label class="block text-sm font-medium">Nom complet</label>
                    <input value="<?= $name ?? '' ?>" type="text" name="medecin_nom" class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block text-sm font-medium">Specialite</label>
                    <input value="<?= $specialite ?? '' ?>" type="text" name="specialite" class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block text-sm font-medium">Departement id</label>
                    <input value="<?= $departement_id ?? '' ?>" type="number" name="departement_id" class="w-full border rounded p-2">
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


</body>
</html>