<?php 




try {
    $BDD = new PDO("mysql:host=sql312.infinityfree.com;dbname=if0_36704777_lorem", "if0_36704777", "LRlCVvxfvZ6Ma6");
    // Set the PDO error mode to exception
    $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}





$usersStatement = $BDD->prepare('SELECT * FROM users');

$usersStatement->execute();

$users= $usersStatement->fetchAll();





?>