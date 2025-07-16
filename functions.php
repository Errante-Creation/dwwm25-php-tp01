<?php

/**
 * Retrieves all countries from the database.
 *
 * @param PDO $pdo The PDO database connection object.
 * @return array An array of countries fetched from the database.
 */
function getCountries($pdo){
   $stmt=$pdo->prepare('SELECT id_country, name_country as country FROM countries');
   $stmt->execute();
   $datas = $stmt->fetchAll();
   return $datas;
}

/**
 * Retrieves a list of city names for a given country ID.
 *
 * @param PDO $pdo The PDO database connection object.
 * @param int $idCountry The ID of the country for which to retrieve cities.
 * @return array An array of city names associated with the specified country.
 */
function getCitiesByCountryId($pdo, $idCountry){
   $stmt=$pdo->prepare('SELECT ci.name_city FROM cities ci
                        JOIN regions r ON ci.fk_id_region=r.id_region
                        JOIN countries co ON r.fk_id_country=co.id_country
                        WHERE co.id_country=:id
                        ORDER BY ci.name_city');
   $stmt->execute(array(
      'id' => $idCountry
   ));
   return $stmt->fetchAll();
}