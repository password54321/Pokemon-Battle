<?php

class PokemonLoader
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return Pokemon[]
     */
    public function getPokemons()
    {
        $pokemons = array();

        $pokemonsData = $this->queryForPokemons();

        foreach ($pokemonsData as $pokemonData) {
            $pokemons[] = $this->createPokemonFromData($pokemonData);
        }

        return $pokemons;
    }

    /**
     * @param $id
     * @return Pokemon
     */
    public function findOneById($id)
    {
        $statement = $this->getPDO()->prepare('SELECT * FROM pokemon WHERE id = :id');
        $statement->execute(array('id' => $id));
        $pokemonArray = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$pokemonArray) {
            return null;
        }

        return $this->createPokemonFromData($pokemonArray);
    }

    private function createPokemonFromData(array $pokemonData)
    {
        $pokemon = new Pokemon($pokemonData['name']);
        $pokemon->setId($pokemonData['id']);
        $pokemon->setSkillPower($pokemonData['skill_power']);
        $pokemon->setMegaEvolutionFactor($pokemonData['megaEvolution_factor']);
        $pokemon->setStrength($pokemonData['strength']);

        return $pokemon;
    }

    /**
     * @return PDO
     */
    private function getPDO()
    {
        return $this->pdo;
    }

    private function queryForPokemons()
    {
        $statement = $this->getPDO()->prepare('SELECT * FROM pokemon');
        $statement->execute();
        $pokemonsArray = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $pokemonsArray;
    }
}

