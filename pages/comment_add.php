<?php 
include '../config.php';
include(ROOT .'/pages/post/sql_db.php');//SQL OPEN DB
require(ROOT .'/pages/post/fonctions.php');
require_once(ROOT .'/pages/header.php');

if(!login() ){
    header("Location: login.php");
    exit();}
?>

<button class="back" onclick="goBack()"><i class='bx bx-left-arrow-circle'></i></button>

<div class="login-page comment">
    <h1 class="title-page comment-add" data-aos="fade-down" data-aos-duration="400">Add your comment</h1>

    <form action="post/post_comment.php" method="POST">       
        <div class="input_container" data-aos="fade-up" data-aos-duration="500">
           <textarea name="message" placeholder="Express yourself on the subject you wish." maxlength="380" required="required"></textarea>
       </div>  
        <button type="submit">Sumbit</button>
    </form>     
</div>
 
<script>
    function goBack() {
        window.location.href = '/pages/home.php';
    }
</script>

<?php require_once(ROOT .'/pages/footer.php');?>
