<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Base de données de villes</title>
</head>
<body>
   <h1>Liste des villes par pays</h1>
   <a href="addcity.php">Ajouter une nouvelle ville</a>
   <ul>
      <?php
      require_once('./config/connect.php');
      require_once('functions.php');

      $countries = getCountries($pdo);

      foreach($countries as $country): ?>

      <li>
         <?= $country['country'] ?>
         <ul>
           <?php
            foreach(getCitiesByCountryId($pdo, $country['id_country']) as $city):
               echo "<li>$city[name_city]</li>";
            endforeach;
           ?>

         </ul>
      </li>
            
      <?php endforeach; ?>
   </ul>
</body>
</html>