<?php 
include '../../config.php';
include_once(ROOT .'/pages/header.php');
include(ROOT .'/pages/post/sql_db.php');//SQL OPEN DB
require_once(ROOT .'/pages/post/fonctions.php');


if(empty($_GET['id']) || !exist_comment($_GET['id'], $BDD)) {
    $errorMessage = "Invalid page";
    require_once(ROOT . '/pages/component/pop_up_error.php');
    header('Location: ../home.php');
    exit();
}

$commentId = $_GET['id'];

$deleteCommentQuery =  'DELETE FROM comments WHERE id = :id';
$deleteCommentStatement = $BDD->prepare($deleteCommentQuery);
$deleteCommentStatement ->execute([
    'id' => $commentId,
]);

goBack();
exit();
?>