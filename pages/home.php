<?php 
include '../config.php';
require(ROOT .'/pages/post/fonctions.php');
include(ROOT .'/pages/post/sql_db.php');//SQL OPEN DB
require_once(ROOT .'/pages/header.php');
require_once(ROOT .'/pages/navbar.php');

if(!login()){
    header("Location: login.php");
    exit();}
?>

<script> 
    let body = document.body;
    body.style.overflow = "auto";
</script>

<section class="main" style="padding-bottom:10vh;">

    <h1 class="title-page" data-aos="fade-down" data-aos-duration="600">Welcome</h1>
    <?php 
 
    $recupCommentStatement = $BDD->prepare("SELECT * FROM comments ORDER BY message_date DESC");
    $recupCommentStatement->execute();
    $commentRecup = $recupCommentStatement->fetchAll(PDO::FETCH_ASSOC);
    
    ?>

    <?php foreach($commentRecup as $comment) : ?>
    <?php 
    $recupPictureStatement = $BDD->prepare("SELECT img_path FROM pictures WHERE user_id = :user_id");
    $recupPictureStatement->execute(['user_id' => $comment['user_id']]);
    $recupPicture = $recupPictureStatement->fetchAll(PDO::FETCH_ASSOC);
    $picture = $recupPicture[0]['img_path'];
    $select_user_id = $comment['user_id'];
    ?>  

    <?php include(ROOT .'/pages/component/card_comment.php'); ?>
    
    <?php endforeach; ?> 

 </section>
 <?php require_once(ROOT .'/pages/footer.php');?>