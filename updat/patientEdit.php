<?php
require_once '../db.php';
if($_GET['id']){
    $id = $_GET['id'];
    $sqlpatient = "SELECT * from patients where patient_id = $id";
    $resultedit = $conn->query($sqlpatient);
    if($resultedit){
$rowedit = $resultedit->fetch_assoc();
    $name = $rowedit['patient_nom'];
    $date_naissance = $rowedit['date_naissance'];
    $sexe=$rowedit['sexe'];
    $email=$rowedit['email'];
        $medecin_id=$rowedit['medecin_id'];
    }
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $name = $_POST['patient_nom'];
    $date_naissance= $_POST['date_naissance'];
      $sexe= $_POST['sexe'];
       $email= $_POST['email'];
          $medecin_id= $_POST['medecin_id'];
    $id = $_GET['id'];
    $sqlUpdatepatients = "UPDATE patients set patient_nom = '$name' ,date_naissance='$date_naissance',sexe='$sexe',email='$email',medecin_id='$medecin_id' where patient_id =$id";

    if($conn->query($sqlUpdatepatients)){
        echo "succès";
    }
    header("Location: ../patients.php");
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
                Ajouter un patient
            </h2>

            <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Nom complet</label>
                    <input value="<?= $name ?? '' ?>" type="text" name="patient_nom" class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block text-sm font-medium">Date de naissance</label>
                    <input value="<?= $date_naissance ?? '' ?>" type="date" name="date_naissance" class="w-full border rounded p-2">
                </div>


        <select value="<?= $sexe ?? '' ?>" name="sexe" class="w-full border rounded p-2">
    <option  value="Homme">Homme</option>
    <option value="Femme">Femme</option>
</select>
                    <div>
                    <label class="block text-sm font-medium">Email</label>
                    <input value="<?= $email ?? '' ?>" type="text" name="email" class="w-full border rounded p-2">
                </div>


                  <div>
                    <label class="block text-sm font-medium">Médecin id</label>
                    <input value="<?= $medecin_id ?? '' ?>" type="number" name="medecin_id" class="w-full border rounded p-2">
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