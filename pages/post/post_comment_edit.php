<?php 
include '../../config.php';
include_once(ROOT .'/pages/header.php');
include(ROOT .'/pages/post/sql_db.php');//SQL OPEN DB
require_once(ROOT .'/pages/post/fonctions.php');


if(empty($_POST['commentId']) || !exist_comment($_POST['commentId'], $BDD) || char_empty($_POST['message'])) {
    $errorMessage = "Invalid page";
    require_once(ROOT . '/pages/component/pop_up_error.php');
    header('Location: ../home.php');
    exit();
}

$commentId = $_POST['commentId'];
$newComment = char_security($_POST['message']);
$newComment = trim($newComment);


$updateCommentQuery =  'UPDATE comments SET comment = :comment WHERE id = :id';
$updateCommentStatement = $BDD->prepare($updateCommentQuery);
$updateCommentStatement ->execute([
    'comment' => $newComment,
    'id' => $commentId,
]);

?>
<script>
    window.history.go(-2); 
</script>
<?php exit(); ?>