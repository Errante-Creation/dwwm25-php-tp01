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

/**
 * Retrieves all regions from the database.
 *
 * @param PDO $pdo The PDO database connection object.
 * @return array An array of regions, each containing 'id_region' and 'name_region'.
 */
function getRegions($pdo){
   $stmt=$pdo->prepare('SELECT id_region, name_region FROM regions');
   $stmt->execute();
   return $stmt->fetchAll();
}

/**
 * Checks if a city exists in the database for a given region.
 *
 * @param PDO    $pdo    The PDO database connection object.
 * @param string $region The region identifier or name to search for.
 * @param string $city   The name of the city to check.
 *
 * @return bool Returns true if the city exists in the specified region, false otherwise.
 */
function checkIfCityExists($pdo, $region, $city){
   $stmt=$pdo->prepare('SELECT COUNT(id_city) as nb FROM cities WHERE name_city=:city AND fk_id_region=:region');
   $stmt->execute(array(
      'city' => $city,
      'region' => $region
   ));
   $datas = $stmt->fetch();
   return ($datas['nb'] >= 1) ? true : false;
}

/**
 * Adds a new city to the database.
 *
 * @param PDO    $pdo    The PDO database connection object.
 * @param int    $region The ID of the region to associate with the city.
 * @param string $city   The name of the city to add.
 * @param float  $area   The area of the city.
 * @param int    $pop    The population of the city.
 *
 * @return int The number of rows affected by the insert operation.
 */
function addCity($pdo, $region, $city, $area, $pop){
   $stmt=$pdo->prepare('INSERT INTO cities(name_city, area_city, pop_city, fk_id_region) VALUES(:city, :area, :pop, :region)');
   $stmt->execute(array(
      'city' => $city,
      'area' => $area,
      'pop' => $pop,
      'region' => $region
   ));
   return $stmt->rowCount();
}