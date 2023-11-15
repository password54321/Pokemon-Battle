<?php

class BattleManager
{
    /**
     * 
     *
     * @return BattleResult
     */
    public function battle(Pokemon $pokemon1, $pokemon1Quantity, Pokemon $pokemon2, $pokemon2Quantity)
    {
        $pokemon1Health = $pokemon1->getStrength() * $pokemon1Quantity;
        $pokemon2Health = $pokemon2->getStrength() * $pokemon2Quantity;

        $pokemon1UsedMegaEvolutionPowers = false;
        $pokemon2UsedMegaEvolutionPowers = false;
        while ($pokemon1Health > 0 && $pokemon2Health > 0) {
            // first, see if we have a rare Mega Evolution event!
            if ($this->didMegaEvolutionUsed($pokemon1)) {
                $pokemon2Health = 0;
                $pokemon1UsedMegaEvolutionPowers = true;

                break;
            }
            if ($this->didMegaEvolutionUsed($pokemon2)) {
                $pokemon1Health = 0;
                $pokemon2UsedMegaEvolutionPowers = true;

                break;
            }

            // now battle them normally
            $pokemon1Health = $pokemon1Health - ($pokemon2->getSkillPower() * $pokemon2Quantity);
            $pokemon2Health = $pokemon2Health - ($pokemon1->getSkillPower() * $pokemon1Quantity);
        }

        // update the strengths on the pokemons, so we can show this
        $pokemon1->setStrength($pokemon1Health);
        $pokemon2->setStrength($pokemon2Health);

        if ($pokemon1Health <= 0 && $pokemon2Health <= 0) {
            // they defeated each other
            $winningPokemon = null;
            $losingPokemon = null;
            $usedMegaEvolutionPowers = $pokemon1UsedMegaEvolutionPowers || $pokemon2UsedMegaEvolutionPowers;
        } elseif ($pokemon1Health <= 0) {
            $winningPokemon = $pokemon2;
            $losingPokemon = $pokemon1;
            $usedMegaEvolutionPowers = $pokemon2UsedMegaEvolutionPowers;
        } else {
            $winningPokemon = $pokemon1;
            $losingPokemon = $pokemon2;
            $usedMegaEvolutionPowers = $pokemon1UsedMegaEvolutionPowers;
        }

        return new BattleResult($usedMegaEvolutionPowers, $winningPokemon, $losingPokemon);
    }

    private function didMegaEvolutionUsed(Pokemon $pokemon)
    {
        $megaEvolutionProbability = $pokemon->getMegaEvolutionFactor() / 100;

        return mt_rand(1, 100) <= ($megaEvolutionProbability*100);
    }
}
