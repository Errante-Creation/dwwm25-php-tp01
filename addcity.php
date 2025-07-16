<?php
   $errorMessage = "";
   $isError = false;
   if(!empty($_POST['submit'])){
      if(empty($_POST['region']) || $_POST['region'] == 0){
         $errorMessage = '<span style="color:red; font-weight:bold; font-size:120%;">Vous devez renseigner une région</span>';
         $isError = true;
      }

      if(!$isError && empty($_POST['city'])){
         $errorMessage = '<span style="color:red; font-weight:bold; font-size:120%;">Vous devez renseigner la ville</span>';
         $isError = true;
      }

      if(!$isError && empty($_POST['area']) || $_POST['area'] <= 0){
         $errorMessage = '<span style="color:red; font-weight:bold; font-size:120%;">Vous devez renseigner la superficie de la ville</span>';
         $isError = true;
      }

      if(!$isError && empty($_POST['pop']) || $_POST['pop'] <= 0){
         $errorMessage = '<span style="color:red; font-weight:bold; font-size:120%;">Vous devez renseigner la population de la ville</span>';
         $isError = true;
      }

      // Si on arrive ici, c'est qu'il n'y a PAS d'erreur
      if(!$isError){
         // On peut traiter le formulaire :
            // Faire une requête SELECT pour vérifier que la ville n'est pas déjà présente sur cette région
            // On insère dans la base de données
         $region = $_POST['region'];
         $city = $_POST['city'];
         $area = $_POST['area'];
         $pop = $_POST['pop'];
         
         require_once "config/connect.php";
         require_once "functions.php";
         $isAlreadyExists = checkIfCityExists($pdo, $region, $city);
         // 1 → ce n'est pas bon c'est un doublon, 0 → on peut ajouter
         if($isAlreadyExists){
            $errorMessage = '<span style="color:red; font-weight:bold; font-size:120%;">La ville existe déjà dans cette région</span>';
            $isError = true;
         } else {
            // On aojoute la ville à la BDD
            $request = addCity($pdo, $region, $city, $area, $pop);
            if($request){
               $errorMessage = '<span style="color:green; font-weight:bold; font-size:120%;">La ville a été ajoutée</span>';
            } else {
               $errorMessage = '<span style="color:red; font-weight:bold; font-size:120%;">La ville n\'a pas été ajoutée</span>';
            }
         }
         
         
      }


   }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Ajouter une ville</title>
</head>
<body>
   <h1>Ajouter une ville</h1>
   <a href="index.php">← Retour à la liste</a>
   <p>Ajouter une nouvelle ville à une région existante</p>
   <?= $errorMessage ?>
   <form action="#" method="post">
      <label for="region">Région : </label>
      <select name="region" id="region">
         <option value="0">Veuillez sélectionner une région</option>
         <?php 
            require_once "config/connect.php";
            require_once "functions.php";
            foreach(getRegions($pdo) as $region):
               echo "<option value='$region[id_region]'>$region[name_region]</option>";
            endforeach;
         ?>
      </select> 
      <br />
      <br />
      <label for="city">Ville : </label>
      <input type="text" name="city" required>
      <br />
      <br />
      <label for="area">Superficie : </label>
      <input type="number" name="area" required>
      <br />
      <br />
      <label for="pop">Population : </label>
      <input type="number" name="pop" required>
      <br />
      <br />
      <input type="submit" name="submit" value="Ajouter">
   </form>
   
</body>
</html>