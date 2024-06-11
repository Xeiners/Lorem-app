<?php 
include '../../config.php';
include_once(ROOT .'/pages/header.php');
include(ROOT .'/pages/post/sql_db.php');//SQL OPEN DB
require_once(ROOT .'/pages/post/fonctions.php');


if(empty($_FILES['picture']['name']) || !valid_picture($_FILES)) {
    require_once(ROOT . '/pages/component/pop_up_error_picture.php');
    exit();
}

$upload_dir = ROOT . '/assets/images/profil-pictures';

$deletFileQuery = "SELECT img_path FROM pictures WHERE user_id = :user_id";
$deletFileStatement = $BDD->prepare($deletFileQuery);
$deletFileStatement->execute([
    'user_id' => $_SESSION['LOGGED_USER']['id'],
]);
$deletFileName = $deletFileStatement->fetchAll(PDO::FETCH_ASSOC);

$check_file = $upload_dir. '/' . $deletFileName[0]['img_path'];
$defaultPicture = 'default-profile.webp';

if(file_exists($check_file) )
{
    if($deletFileName[0]['img_path'] !== $defaultPicture) {
        unlink($check_file);
    }
}


$name = $_FILES['picture']['name'];
$extension = pathinfo($name, PATHINFO_EXTENSION);

$tmp_name = $_FILES['picture']['tmp_name'];

$picture_name = rand(1000,10000). "-profile." . $extension;

echo $picture_name;


move_uploaded_file($tmp_name, $upload_dir. '/' . $picture_name);


$uploadQuery = "UPDATE pictures SET img_path = :img_path WHERE user_id = :user_id";
$uploadStatement = $BDD->prepare($uploadQuery);
$uploadStatement->execute([
    'user_id' => $_SESSION['LOGGED_USER']['id'],
    'img_path' => $picture_name,
]);


goBack();
exit();
?>