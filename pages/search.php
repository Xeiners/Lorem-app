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

<!-- <script> 
    let body = document.body;
    body.style.overflow = "auto";
</script> -->

<section class="main" style="padding-bottom:10vh;">

    <h1 class="title-page" data-aos="fade-down" data-aos-duration="400" data-aos-delay="200">Search</h1>

    <div class="login-page search">

        <form action="" method="GET">      
             <div class="input_container search" data-aos="fade-down" data-aos-duration="500" >
                <input type="search" name="research" placeholder="Enter the name of a user">
                <button type="sumbit"><i class='bx bx-search'></i></button>
            </div>
        </form>     
    </div>




<?php
if (!empty($_GET['research'])) {
    
    $username = char_security($_GET['research']);

    $recupCommentStatement = $BDD->prepare("SELECT * FROM comments WHERE username = :username ORDER BY message_date DESC");
    $recupCommentStatement->execute(['username' => $username]);
    $commentRecup = $recupCommentStatement->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($commentRecup as $comment) {
        $recupPictureStatement = $BDD->prepare("SELECT img_path FROM pictures WHERE user_id = :user_id");
        $recupPictureStatement->execute(['user_id' => $comment['user_id']]);
        $recupPicture = $recupPictureStatement->fetchAll(PDO::FETCH_ASSOC);
        $picture = $recupPicture[0]['img_path'];
        $select_user_id = $comment['user_id'];
    
        include(ROOT . '/pages/component/card_comment.php');
    }
    if(empty($commentRecup)) {
        $errorMessage = "User not found";
        require_once(ROOT . '/pages/component/pop_up_error.php');
    }
}           
?>


 </section>
 <?php require_once(ROOT .'/pages/footer.php');?>