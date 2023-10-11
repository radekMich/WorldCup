<?php

require '../../vendor/autoload.php';

$factory = new \App\Business\WorldCupBusinessFactory();

$worldCup = $factory->createWorldCup();
$mex = $factory->createTeam('Mexico');
$ger = $factory->createTeam('Germany');
$game1 = $factory->createGame($mex, $ger);

$spa = $factory->createTeam('Spain');
$port = $factory->createTeam('Portugal');
$game2 = $factory->createGame($spa, $port);

$ita = $factory->createTeam('Italy');
$fra = $factory->createTeam('France');
$game3 = $factory->createGame($ita, $fra);
$worldCup->addGame($game1);
$worldCup->addGame($game2);
$worldCup->addGame($game3);
foreach ($worldCup->getTournament() as $key => $game) {
    $worldCup->startGame($key);
}

for ($i = 0; $i < 90; $i++) {
    if (count($worldCup->getTournament()) == 0) {
        break;
    }
    $randKey = array_rand($worldCup->getTournament());
    $random = rand(0, 100);

    if ($random < 10) {
        $worldCup->goalHomeTeam($randKey);
    } elseif ($random < 20) {
        $worldCup->goalAwayTeam($randKey);
    } elseif ($random % 50 == 0) {
        $worldCup->finishGame($randKey);
    }
}

foreach ($worldCup->getTournament() as $key => $game) {
    $worldCup->finishGame($key);
}

foreach ($worldCup->getFinalResult() as $game) {
    echo "<div>" . $game . "</div>";
}