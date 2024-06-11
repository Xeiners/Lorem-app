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

<?php 

if(empty($_GET['id']) || !exist_user($_GET['id'], $BDD)) {
    $errorMessage = "Invalid page";
    require_once(ROOT . '/pages/component/pop_up_error.php');
    header('Location: home.php');
    exit();
}

$user_id = char_security($_GET['id']);

$userQuery = '
    SELECT 
        pictures.img_path, 
        users.username 
    FROM 
        pictures 
    INNER JOIN 
        users 
    ON 
        pictures.user_id = users.id 
    WHERE 
        users.id = :user_id';

$userStatement = $BDD->prepare($userQuery);
$userStatement->execute(['user_id' => $user_id]);
$userRecup = $userStatement->fetch(PDO::FETCH_ASSOC);

$picturePath = '/assets/images/profil-pictures/' . $userRecup['img_path'];
$username = $userRecup['username'];
$picture = $userRecup['img_path'];

?>



<section class="main allCenter userView" style="padding-bottom:10vh;">

    <h1 class="title-page" data-aos="fade-down" data-aos-duration="600">User</h1>

    <div class="user-profile-username" data-aos="fade-in" data-aos-duration="600">
        <h3><?php echo $username;?></h3>
    </div>
    <div class="user-profile-picture" data-aos="zoom-in" data-aos-duration="500">
        <img src="<?php echo $picturePath;?>" alt="Profile Picture">
    </div>
    <div class="text-simple" data-aos="fade-in" data-aos-duration="600">
        <h3>Last <?php echo $username;?> messages</h3>
    </div>
    
    <?php 
 
    $recupCommentStatement = $BDD->prepare("SELECT * FROM comments WHERE user_id = :user_id ORDER BY message_date DESC LIMIT 3");
    $recupCommentStatement->execute(['user_id' => $user_id,]);
    $commentRecup = $recupCommentStatement->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <?php foreach($commentRecup as $comment) : ?>

    <?php include(ROOT .'/pages/component/card_comment.php'); ?>
    
    <?php endforeach; ?> 

 </section>
 <?php require_once(ROOT .'/pages/footer.php');?>