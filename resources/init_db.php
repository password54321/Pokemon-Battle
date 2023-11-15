<?php

/*
 * SETTINGS!
 */
$databaseName = 'oo_battle';
$databaseUser = 'root';
$databasePassword = '';

/*
 * CREATE THE DATABASE
 */
$pdoDatabase = new PDO('mysql:host=localhost', $databaseUser, $databasePassword);
$pdoDatabase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdoDatabase->exec('CREATE DATABASE IF NOT EXISTS oo_battle');

/*
 * CREATE THE TABLE
 */
$pdo = new PDO('mysql:host=localhost;dbname='.$databaseName, $databaseUser, $databasePassword);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// initialize the table
$pdo->exec('DROP TABLE IF EXISTS pokemon;');

$pdo->exec('CREATE TABLE `pokemon` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `skill_power` int(4) NOT NULL,
 `megaEvolution_factor` int(4) NOT NULL,
 `strength` int(4) NOT NULL,
 `team` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');

/*
 * INSERT SOME DATA!
 */
$pdo->exec('INSERT INTO pokemon
    (name, skill_power, megaEvolution_factor, strength, team) VALUES
    ("Charizard", 105, 85, 210, "Ash")'
);
$pdo->exec('INSERT INTO pokemon
    (name, skill_power, megaEvolution_factor, strength, team) VALUES
    ("Venusaur", 102, 62, 170, "Ash")'
);
$pdo->exec('INSERT INTO pokemon
    (name, skill_power, megaEvolution_factor, strength, team) VALUES
    ("Blastoise", 90, 90, 300, "Gary")'
);
$pdo->exec('INSERT INTO pokemon
    (name, skill_power, megaEvolution_factor, strength, team) VALUES
    ("Alakazam", 74, 104, 150, "Gary")'
);

echo "Ready!\n";
