<?php
require_once '../db.php';
if($_GET['id']){
    $id = $_GET['id'];
    $sqldepartment = "SELECT * from departements where departement_id = $id";
    $resultedit = $conn->query($sqldepartment);
    if($resultedit){
$rowedit = $resultedit->fetch_assoc();
    $name = $rowedit['departement_nom'];
    $location = $rowedit['location'];
    }
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $name = $_POST['departement_nom'];
    $location = $_POST['location'];
    $id = $_GET['id'];
    $sqlUpdatedepartements = "UPDATE departements set departement_nom = '$name' ,location='$location' where departement_id =$id";

    if($conn->query($sqlUpdatedepartements)){
        echo "hh khdam";
    }
    header("Location: ../departements.php");
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
                Ajouter un département
            </h2>

            <form class="grid grid-cols-1 md:grid-cols-2 gap-4" method="post">
                <div>
                    <label class="block text-sm font-medium">Nom de département</label>
                    <input value="<?= $name ?? '' ?>" type="text" name="departement_nom" class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block text-sm font-medium">Location</label>
                    <input value="<?= $location ?? '' ?>" type="text" name="location" class="w-full border rounded p-2">
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