<?php

class Pokemon
{
    private $id;

    private $name;

    private $skillPower = 0;

    private $megaEvolutionFactor = 0;

    private $strength = 0;

    private $beingHealed;

    public function __construct($name)
    {
        $this->name = $name;
        // randomly put this pokemon being healed, can not fight now
        $this->beingHealed = mt_rand(1, 100) < 30;
    }

    public function isFunctional()
    {
        return !$this->beingHealed;
    }

    public function sayHello()
    {
        echo 'Hello!';
    }

    public function getName()
    {
        return $this->name;
    }
    
    public function setStrength($number)
    {
        if (!is_numeric($number)) {
            throw new \Exception('Invalid strength passed '.$number);
        }

        $this->strength = $number;
    }

    public function getStrength()
    {
        return $this->strength;
    }

    public function getNameAndSpecs($useShortFormat = false)
    {
        if ($useShortFormat) {
            return sprintf(
                '%s: %s/%s/%s',
                $this->name,
                $this->skillPower,
                $this->megaEvolutionFactor,
                $this->strength
            );
        } else {
            return sprintf(
                '%s: w:%s, j:%s, s:%s',
                $this->name,
                $this->skillPower,
                $this->megaEvolutionFactor,
                $this->strength
            );
        }
    }

    public function doesGivenPokemonHaveMoreStrength($givenPokemon)
    {
        return $givenPokemon->strength > $this->strength;
    }

    /**
     * @return int
     */
    public function getSkillPower()
    {
        return $this->skillPower;
    }

    /**
     * @return int
     */
    public function getMegaEvolutionFactor()
    {
        return $this->megaEvolutionFactor;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param int $skillPower
     */
    public function setSkillPower($skillPower)
    {
        $this->skillPower = $skillPower;
    }

    /**
     * @param int $megaEvolutionFactor
     */
    public function setMegaEvolutionFactor($megaEvolutionFactor)
    {
        $this->megaEvolutionFactor = $megaEvolutionFactor;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}
