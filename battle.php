<?php
require __DIR__.'/bootstrap.php';

$container = new Container($configuration);

$pokemonLoader = $container->getPokemonLoader();
$pokemons = $pokemonLoader->getPokemons();

$pokemon1Id = isset($_POST['pokemon1_id']) ? $_POST['pokemon1_id'] : null;
$pokemon1Quantity = isset($_POST['pokemon1_quantity']) ? $_POST['pokemon1_quantity'] : 1;
$pokemon2Id = isset($_POST['pokemon2_id']) ? $_POST['pokemon2_id'] : null;
$pokemon2Quantity = isset($_POST['pokemon2_quantity']) ? $_POST['pokemon2_quantity'] : 1;

if (!$pokemon1Id || !$pokemon2Id) {
    header('Location: /index.php?error=missing_data');
    die;
}

$pokemon1 = $pokemonLoader->findOneById($pokemon1Id);
$pokemon2 = $pokemonLoader->findOneById($pokemon2Id);

if (!$pokemon1 || !$pokemon2) {
    header('Location: /index.php?error=bad_pokemons');
    die;
}

$battleManager = $container->getBattleManager();

if ($pokemon1Quantity <= 0 || $pokemon2Quantity <= 0) {
    header('Location: /index.php?error=bad_quantities');
    die;
}

$battleResult = $battleManager->battle($pokemon1, $pokemon1Quantity, $pokemon2, $pokemon2Quantity);
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
           <link href='http://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet' type='text/css'>
           
           <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
           <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
           <!--[if lt IE 9]>
             <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
             <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
           <![endif]-->
    </head>
    <body>
        <div class="container">
            <div class="page-header">
                <h1>OO Battlepokemons</h1>
            </div>
            <div>
                <h2 class="text-center">The Matchup:</h2>
                <p class="text-center">
                    <br>
                    <?php echo $pokemon1Quantity; ?> <?php echo $pokemon1->getName(); ?><?php echo $pokemon1Quantity > 1 ? 's': ''; ?>
                    VS.
                    <?php echo $pokemon2Quantity; ?> <?php echo $pokemon2->getName(); ?><?php echo $pokemon2Quantity > 1 ? 's': ''; ?>
                </p>
            </div>
            <div class="result-box center-block">
                <h3 class="text-center audiowide">
                    Winner:
                    <?php if ($battleResult->isThereAWinner()): ?>
                        <?php echo $battleResult->getWinningPokemon()->getName(); ?>
                    <?php else: ?>
                        Nobody
                    <?php endif; ?>
                </h3>
                <p class="text-center">
                    <?php if (!$battleResult->isThereAWinner()): ?>
                        Both pokemons defeated each other in an epic battle to the end.
                    <?php else: ?>
                        The <?php echo $battleResult->getWinningPokemon()->getName(); ?>
                        <?php if ($battleResult->wereMegaEvolutionPowersUsed()): ?>
                            used its MegaEvolution Powers for a stunning victory!
                        <?php else: ?>
                            overpowered and defeated the <?php echo $battleResult->getLosingPokemon()->getName() ?>s
                        <?php endif; ?>
                    <?php endif; ?>
                </p>
                <h3>Remaining Strength</h3>
                <dl class="dl-horizontal">
                    <dt><?php echo $pokemon1->getName(); ?></dt>
                    <dd><?php echo $pokemon1->getStrength(); ?></dd>
                    <dt><?php echo $pokemon2->getName(); ?></dt>
                    <dd><?php echo $pokemon2->getStrength(); ?></dd>
                </dl>
            </div>
            <a href="/index.php"><p class="text-center"><i class="fa fa-undo"></i> Battle again</p></a>
        
            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="js/bootstrap.min.js"></script>
        </div>
    </body>
</html>
