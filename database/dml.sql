-- Sélectionnez toutes les villes d'un continent donné (3), triées par population décroissante.
-- Le continent est lié à un pays avec la table `countries`, sur fk_id_continent
-- Je dois sélectionner tous les pays dont le continent est le même que celui de la ville (id_country)
-- Je dois sélectionner les régions qui sont liées au pays fk_id_country égal à celui du pays

-- Pour sélectionner la ville d'un continent donné je dois récupérer la région de la ville 
SELECT ci.name_city, ci.pop_city FROM countries co
LEFT JOIN regions r ON r.fk_id_country=co.id_country
LEFT JOIN cities ci ON ci.fk_id_region=r.id_region
WHERE fk_id_continent=3
ORDER BY ci.pop_city DESC;

-- Trouvez la population totale et la superficie moyenne des villes par pays.
SELECT 
	co.name_country,
    SUM(ci.pop_city) AS total_population,
    AVG(ci.area_city) AS average_area
FROM countries co
LEFT JOIN regions r ON r.fk_id_country=co.id_country
LEFT JOIN cities ci ON ci.fk_id_region=r.id_region
GROUP BY co.name_country;

-- Listez les 10 villes les plus densément peuplées du monde.
SELECT 
	ci.name_city,
    ci.pop_city,
    ci.area_city,
    (ci.pop_city / ci.area_city) AS density
FROM cities ci
WHERE ci.area_city > 0
ORDER BY density DESC
LIMIT 10;

-- Trouvez les pays qui n'ont pas encore de régions associées.
SELECT co.name_country
FROM countries co
LEFT JOIN regions r ON r.fk_id_country=co.id_country
WHERE r.id_region IS NULL;

-- Mettez à jour la population de toutes les villes d'une région spécifique en augmentant de 10%.
UPDATE cities
SET pop_city = pop_city * 1.1
WHERE fk_id_region=2

-- Supprimez toutes les villes d'un pays donné (pensez aux actions `ON DELETE`).
-- Attention : à cause des contraintes de clé étrangère, il faut supprimer les villes via les régions
-- Sur MySQL, vous ne pouvez PAS utiliser JOIN directement dans une clause DELETE FROM avec un alias SAUF si on précise correctement la syntaxe multitable
DELETE ci FROM cities ci
JOIN regions r ON ci.fk_id_region=r.id_region
JOIN countries co ON r.fk_id_country=co.id_country
WHERE co.id_country=5

-- Trouver toutes les villes d'un pays donné, triées par nom de ville.
SELECT ci.name_city FROM cities ci
JOIN regions r ON ci.fk_id_region=r.id_region
JOIN countries co ON r.fk_id_country=co.id_country
WHERE co.id_country=5
ORDER BY ci.name_city;