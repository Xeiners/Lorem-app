<?php 
include '../../config.php';
include_once(ROOT .'/pages/header.php');
include(ROOT .'/pages/post/sql_db.php');//SQL OPEN DB
require_once(ROOT .'/pages/post/fonctions.php');

if(!login() ){
    header("Location: login.php");
    exit();
}

if(char_empty($_POST['message'])){
    header("Location: ../home.php");
    exit();
}

$id = $_SESSION['LOGGED_USER']['id'];

$message = char_security($_POST['message']);

$recupUsernameStatement = $BDD->prepare("SELECT username FROM users WHERE id = :id");
$recupUsernameStatement->execute([
    'id' => $id,
]);
$recupUsername = $recupUsernameStatement->fetchAll(PDO::FETCH_ASSOC);

$username = $recupUsername[0]['username'];

$addCommentQuery = "INSERT INTO comments (user_id, username, comment) 
VALUE (:user_id, :username, :comment)";

$addCommentStatement = $BDD->prepare($addCommentQuery);
$addCommentStatement->execute([
    'user_id' => $id,
    'username' => $username,
    'comment' => $message,
]);

$recupCommentStatement = $BDD->prepare("SELECT * FROM comments WHERE user_id = :user_id");
$recupCommentStatement->execute([
    'user_id' => $id,
]);
$recupComment = $recupCommentStatement->fetchAll(PDO::FETCH_ASSOC);

print_r ($recupComment);

header('Location: /pages/home.php');
exit();

?>