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


<section class="main" style="padding-bottom:10vh;">

<h1 class="title-page edit" data-aos="fade-down" data-aos-duration="400">Your comments</h1>

<?php 

$recupCommentStatement = $BDD->prepare("SELECT * FROM comments WHERE user_id = :user_id ORDER BY message_date DESC");
$recupCommentStatement->execute(['user_id' => $_SESSION['LOGGED_USER']['id'] ]);
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


 </section>
 <?php require_once(ROOT .'/pages/footer.php');?>