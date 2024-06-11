<?php 
include '../config.php';
include(ROOT .'/pages/post/sql_db.php');//SQL OPEN DB
require(ROOT .'/pages/post/fonctions.php');
require_once(ROOT .'/pages/header.php');

if(!login() ){
    header("Location: login.php");
    exit();
}

if(empty($_GET['id']) || !exist_comment($_GET['id'], $BDD)) {
    $errorMessage = "Invalid page";
    require_once(ROOT . '/pages/component/pop_up_error.php');
    header('Location: ../home.php');
    exit();
}

$commentId = $_GET['id'];

$recupCommentStatement = $BDD->prepare("SELECT comment FROM comments WHERE id = :id");
$recupCommentStatement->execute(['id' => $commentId]);
$commentRecup = $recupCommentStatement->fetchAll(PDO::FETCH_ASSOC);

$comment = $commentRecup[0];
?>

<button class="back" onclick="goBack()"><i class='bx bx-left-arrow-circle'></i></button>

<div class="login-page comment">
    <h1 class="title-page comment-add" data-aos="fade-down" data-aos-duration="400">Edit your comment</h1>

    <form action="post/post_comment_edit.php" method="POST">       
        <div class="input_container" data-aos="fade-up" data-aos-duration="500">
            <textarea name="message" placeholder="Express yourself on the subject you wish."  maxlength="380" required="required" ><?php echo trim($comment['comment']); ?></textarea>
        </div>
        <input type="hidden" name="commentId" value="<?php echo $commentId; ?>">
        <button type="submit">Sumbit</button>
    </form>     
</div>


 
<script>
    function goBack() {
        window.history.back();
    }
</script>

<?php require_once(ROOT .'/pages/footer.php');?>
