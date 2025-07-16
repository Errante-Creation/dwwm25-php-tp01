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