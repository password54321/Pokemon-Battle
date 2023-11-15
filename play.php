<?php

require_once __DIR__.'/lib/Pokemon.php';

/**
 * @param Pokemon $somePokemon
 */
function printPokemonSummary($somePokemon)
{
    echo 'Pokemon Name: '.$somePokemon->getName();
    echo '<hr/>';
    $somePokemon->sayHello();
    echo '<hr/>';
    echo $somePokemon->getNameAndSpecs(false);
    echo '<hr/>';
    echo $somePokemon->getNameAndSpecs(true);
}


$myPokemon = new Pokemon();
$myPokemon->name = 'Squirtle';
$myPokemon->skillPower = 10;

printPokemonSummary($myPokemon);

$otherPokemon = new Pokemon();
$otherPokemon->name = 'Pikachu';
$otherPokemon->skillPower = 45;
$otherPokemon->strength = 50;

echo '<hr/>';
printPokemonSummary($otherPokemon);
echo '<hr/>';

if ($myPokemon->doesGivenPokemonHaveMoreStrength($otherPokemon)) {
    echo $otherPokemon->name.' has more strength';
} else {
    echo $myPokemon->name.' has more strength';
}
