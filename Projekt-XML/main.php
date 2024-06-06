<?php

// Učitaj users.xml
$xml = simplexml_load_file('users.xml');

// Inicijalizacija brojača
$counter = 0;

// Izračunaj broj mačaka
foreach ($xml->macke->macka as $macka) { 
    $counter++;
}

?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Main</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div id="logoff" style="width:15%">
        <p>Imate <?php echo $counter; ?> ljubimca.</p>
    </div>
    <div id="macke">
        <?php foreach ($xml->macke->macka as $macka): ?>
        <div class="macka">
            <img src="<?php echo $macka->slika->img['src']; ?>" alt="Slika mačke" style="width:100%; ">
            <h3><?php echo $macka->ime; ?></h3>
            <h4><?php echo $macka->vrsta; ?></h4>
            <p>Boja: <?php echo $macka->boja; ?></p>
            <p>Godine: <?php echo $macka->starost; ?></p>
            <p>Opis: <?php echo $macka->opis; ?></p>
        </div>
        <?php endforeach; ?>
    </div>
    <div id="logoff">
        <a href="login.php">Log off</a>
    </div>
</body>
</html>
