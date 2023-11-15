<?php

class BattleResult
{
    private $usedMegaEvolutionPowers;
    private $winningPokemon;
    private $losingPokemon;

    /**
     * @param Pokemon $winningPokemon
     * @param Pokemon $losingPokemon
     * @param boolean $usedMegaEvolutionPowers
     */
    public function __construct($usedMegaEvolutionPowers, Pokemon $winningPokemon = null, Pokemon $losingPokemon = null)
    {
        $this->usedMegaEvolutionPowers = $usedMegaEvolutionPowers;
        $this->winningPokemon = $winningPokemon;
        $this->losingPokemon = $losingPokemon;
    }

    /**
     * @return boolean
     */
    public function wereMegaEvolutionPowersUsed()
    {
        return $this->usedMegaEvolutionPowers;
    }

    /**
     * @return Pokemon|null
     */
    public function getWinningPokemon()
    {
        return $this->winningPokemon;
    }

    /**
     * @return Pokemon|null
     */
    public function getLosingPokemon()
    {
        return $this->losingPokemon;
    }

    /**
     * Was there a winner? Or not a all?
     *
     * @return bool
     */
    public function isThereAWinner()
    {
        return $this->getWinningPokemon() !== null;
    }
}
