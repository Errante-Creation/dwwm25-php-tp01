## Projet 1: Gestion de la Superficie des Villes (TP01 - Avancé)

**Objectif:** Concevoir et implémenter une base de données pour stocker des informations sur les villes et leur superficie, avec un accent sur les données géographiques et démographiques.

**Description:** Vous devez créer une base de données capable de gérer les villes, leur pays, leur région, et des données démographiques (population, densité). Pensez aux relations entre les entités et aux types de données appropriés, ainsi qu'à la performance des requêtes sur de grandes quantités de données.

**Tâches:**

1. **Conception:** Modélisez les entités `Continent`, `Pays`, `Region`, et `Ville`. Un continent a plusieurs pays, un pays a plusieurs régions, une région a plusieurs villes. Incluez des attributs pour la population et la densité pour les villes.
2. **DDL:** Créez la base de données `villes_monde_db` et les tables avec les colonnes et contraintes suivantes:
    - `continents`: `id_continent` (PK, AI), `nom_continent` (UNIQUE, NOT NULL).
    - `pays`: `id_pays` (PK, AI), `nom_pays` (UNIQUE, NOT NULL), `code_iso` (CHAR(2) UNIQUE, NOT NULL), `fk_id_continent` (FK).
    - `regions`: `id_region` (PK, AI), `nom_region` (NOT NULL), `fk_id_pays` (FK).
    - `villes`: `id_ville` (PK, AI), `nom_ville` (NOT NULL), `superficie_km2` (FLOAT, NOT NULL, CHECK > 0), `population` (BIGINT, NOT NULL, CHECK >= 0), `fk_id_region` (FK).
    - Ajoutez des index pertinents pour les recherches fréquentes (ex: sur `nom_ville`, `nom_pays`, `code_iso`).
3. **DML (Insertion Volumineuse):** Insérez des données pour au moins 5 continents, 20 pays, 50 régions, et 50 villes. Générez des données de population et de superficie de manière réaliste.
4. **DML (Requêtes Complexes):**
    - Sélectionnez toutes les villes d'un continent donné, triées par population décroissante.
    - Trouvez la population totale et la superficie moyenne des villes par pays.
    - Listez les 10 villes les plus densément peuplées du monde.
    - Trouvez les pays qui n'ont pas encore de régions associées.
    - Mettez à jour la population de toutes les villes d'une région spécifique en augmentant de 10%.
    - Supprimez toutes les villes d'un pays donné (pensez aux actions `ON DELETE`).
5. **Intégration PHP PDO:** Créez un script PHP qui permet d'afficher une liste de villes par pays, et un formulaire pour ajouter une nouvelle ville à une région existante.

## Pistes de Solution et Conseils

Les projets intégrés sont conçus pour être des défis complets, nécessitant l'application de toutes les compétences acquises. Les solutions ne sont pas fournies directement pour encourager une approche de résolution de problèmes autonome. Voici quelques pistes et conseils pour vous guider:

- **Modélisation (Étape Cruciale):** Avant d'écrire une seule ligne de SQL, prenez le temps de bien modéliser votre base de données. Dessinez le schéma, identifiez les entités, leurs attributs, les clés primaires et étrangères, et les relations (1-N, N-N). Pensez à la normalisation pour éviter la redondance et assurer l'intégrité des données. Des outils comme MySQL Workbench peuvent être très utiles.
- **Décomposition du Projet:** Ne tentez pas de tout faire en une seule fois. Décomposez chaque projet en étapes plus petites:
    1. **Conception:** Schéma de la base de données.
    2. **DDL:** Création des bases de données et des tables, avec toutes les contraintes.
    3. **Insertion de Données:** Peuplement des tables avec un volume significatif de données de test. Pour les grands volumes, pensez à des scripts ou des boucles pour générer les données.
    4. **Requêtes DML:** Écriture et test des requêtes `SELECT`, `INSERT`, `UPDATE`, `DELETE` pour répondre aux besoins du projet.
    5. **Intégration PHP PDO:** Développement de l'interface applicative.
- **Tests Incrémentaux:** Testez chaque partie de votre code SQL au fur et à mesure. Créez une table, insérez quelques données, puis testez vos requêtes `SELECT` sur ces données. Cela vous permettra de détecter les erreurs tôt et de les corriger plus facilement.
- **Gestion des Erreurs:** Soyez attentif aux messages d'erreur de MySQL. Ils sont souvent très précis et vous guideront vers la source du problème.
- **Optimisation:** Pour les projets avec de grands volumes de données, pensez à l'ajout d'index sur les colonnes fréquemment utilisées dans les clauses `WHERE`, `JOIN` ou `ORDER BY` pour améliorer les performances des requêtes.
- **PHP PDO:** Pour la partie PHP, assurez-vous de bien gérer la connexion à la base de données, la préparation des requêtes (pour éviter les injections SQL), et la gestion des erreurs.

Ces projets sont une excellente opportunité de consolider vos connaissances. La persévérance et une approche méthodique sont les clés du succès. Chaque défi surmonté renforcera vos compétences et votre confiance en vous.