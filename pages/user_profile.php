<?php 
include '../config.php';
include(ROOT .'/pages/post/sql_db.php');
require(ROOT .'/pages/post/fonctions.php');
require_once(ROOT .'/pages/header.php');
require_once(ROOT .'/pages/navbar.php');

if(!login() ){
    header("Location: login.php");
    exit();}
?>

<?php 

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
$userStatement->execute(['user_id' => $_SESSION['LOGGED_USER']['id']]);
$userRecup = $userStatement->fetch(PDO::FETCH_ASSOC);

$picturePath = '/assets/images/profil-pictures/' . $userRecup['img_path'];
$username = $userRecup['username'];

?>


<section class="main">
    <h1 class="title-page" data-aos="fade-down" data-aos-duration="400">Profile</h1>

    <div class="user-page-container">

        <div class="user-profile-picture" data-aos="zoom-in" data-aos-duration="500">
            <img src="<?php echo $picturePath;?>" alt="Profile Picture">
        </div>
        <div class="user-profile-username" data-aos="fade-in" data-aos-duration="600">
            <h3><?php echo $username;?></h3>
        </div>
        <div class="user-profile-button">
            <form id="uploadForm" action="post/upload_picture.php" method="POST" enctype="multipart/form-data">
                <button class="upload" data-aos="fade-right" data-aos-duration="500">
                    EDIT PICTURE
                    <i class='bx bx-upload'></i>
                    <input type="file" name="picture" onchange="submitForm()"></input>
                </button>
            </form>
            <form action="" method="POST">
                <button type="submit" name="logout" class="logout" data-aos="fade-left" data-aos-duration="500">Logout <i class='bx bx-log-out'></i></button>
            </form>
        </div>
    </div>
</section>

<!-- Envoie automatique -->
<script>
function submitForm() {
    document.getElementById('uploadForm').submit();
}
</script>

<?php 
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location:  login.php');
    exit();
}

?>
<?php require_once(ROOT .'/pages/footer.php');?>





