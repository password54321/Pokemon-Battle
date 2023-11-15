<?php
require __DIR__.'/bootstrap.php';

$container = new Container($configuration);

$pokemonLoader = $container->getPokemonLoader();
$pokemons = $pokemonLoader->getPokemons();

$errorMessage = '';
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'missing_data':
            $errorMessage = 'Don\'t forget to select some pokemons to battle!';
            break;
        case 'bad_pokemons':
            $errorMessage = 'You\'re trying to fight with a pokemon that\'s unknown to the Manga?';
            break;
        case 'bad_quantities':
            $errorMessage = 'You pick strange numbers of pokemons to battle - try again.';
            break;
        default:
            $errorMessage = 'There was a disturbance in the game. Try again.';
    }
}
?>

<html>
    <head>
        <meta charset="utf-8">
           <meta http-equiv="X-UA-Compatible" content="IE=edge">
           <meta name="viewport" content="width=device-width, initial-scale=1">
           <title>OO Battlepokemons</title>

           <!-- Bootstrap -->
           <link href="css/bootstrap.min.css" rel="stylesheet">
           <link href="css/style.css" rel="stylesheet">
           <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

           <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
           <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
           <!--[if lt IE 9]>
             <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
             <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
           <![endif]-->
    </head>

    <?php if ($errorMessage): ?>
        <div>
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>

    <body>
        <div class="container">
            <div class="page-header">
                <h1>OO Battlepokemons</h1>
            </div>
            <table class="table table-hover">
                <caption><i class="fa fa-rocket"></i> These pokemons are ready</caption>
                <thead>
                    <tr>
                        <th>Pokemon</th>
                        <th>Skill Power</th>
                        <th>MegaEvolution Factor</th>
                        <th>Strength</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pokemons as $pokemon): ?>
                        <tr>
                            <td><?php echo $pokemon->getName(); ?></td>
                            <td><?php echo $pokemon->getSkillPower(); ?></td>
                            <td><?php echo $pokemon->getMegaEvolutionFactor(); ?></td>
                            <td><?php echo $pokemon->getStrength(); ?></td>
                            <td>
                                <?php if ($pokemon->isFunctional()): ?>
                                    <i class="fa fa-sun-o"></i>
                                <?php else: ?>
                                    <i class="fa fa-cloud"></i>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div class="battle-box center-block border">
                <div>
                    <form method="POST" action="/battle.php">
                        <h2 class="text-center">The Mission</h2>
                        <input class="center-block form-control text-field" type="text" name="pokemon1_quantity" placeholder="Enter Number of Pokemons" />
                        <select class="center-block form-control btn drp-dwn-width btn-default dropdown-toggle" name="pokemon1_id">
                            <option value="">Choose a Pokemon</option>
                            <?php foreach ($pokemons as $pokemon): ?>
                                <?php if ($pokemon->isFunctional()): ?>
                                    <option value="<?php echo $pokemon->getId(); ?>"><?php echo $pokemon->getNameAndSpecs(); ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <br>
                        <p class="text-center">AGAINST</p>
                        <br>
                        <input class="center-block form-control text-field" type="text" name="pokemon2_quantity" placeholder="Enter Number of Pokemons" />
                        <select class="center-block form-control btn drp-dwn-width btn-default dropdown-toggle" name="pokemon2_id">
                            <option value="">Choose a Pokemon</option>
                            <?php foreach ($pokemons as $pokemon): ?>
                                <?php if ($pokemon->isFunctional()): ?>
                                    <option value="<?php echo $pokemon->getId(); ?>"><?php echo $pokemon->getNameAndSpecs(); ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <br>
                        <button class="btn btn-md btn-danger center-block" type="submit">Engage</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
