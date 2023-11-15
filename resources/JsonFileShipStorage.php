<?php

class JsonFilePokemonStorage
{
    private $filename;

    public function __construct($jsonFilePath)
    {
        $this->filename = $jsonFilePath;
    }

    public function fetchAllPokemonsData()
    {
        $jsonContents = file_get_contents($this->filename);

        return json_decode($jsonContents, true);
    }

    public function fetchSinglePokemonData($id)
    {
        $pokemons = $this->fetchAllPokemonsData();

        foreach ($pokemons as $pokemon) {
            if ($pokemon['id'] == $id) {
                return $pokemon;
            }
        }

        return null;
    }
}
