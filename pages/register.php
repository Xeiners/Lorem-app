<?php 
include '../config.php';
include(ROOT .'/pages/post/sql_db.php');//SQL OPEN DB
require(ROOT .'/pages/post/fonctions.php');
require_once(ROOT .'/pages/header.php');
?>

<script> 
    let body = document.body;
    body.style.overflow = "hidden";
</script>

<div class="login-page">
    <h1 class="title-page">Register</h1>

    <form action="" method="POST">      
        <div class="input_container">
            <label>Username</label>
           <input type="text" name="username" placeholder="Enter your Username">
       </div>  
        <div class="input_container">
            <label>E-mail</label>
           <input type="email" name="mail" placeholder="Enter your e-mail address">
       </div>  
        <div class="input_container"> 
            <label>Password</label>
            <input type="password" name="mdp" placeholder="Enter your password">
        </div>
        <div class="input_container"> 
            <label>Confirm password</label>
            <input type="password" name="mdp_conf" placeholder="Confirm your password">
        </div>
        <button type="submit">Sign Up</button>
    </form>     
    <a href="login.php" class="forget">
        <p>Already have an <b>account </b>?</p>
    </a>
</div>



<?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
<?php 

    if(char_empty($_POST['mail']) ||
     char_empty($_POST['mdp']) ||
     char_empty($_POST['mdp_conf']) ||
     char_empty($_POST['username']) )  
    {
        $errorMessage = "Empty field";
        require_once(ROOT . '/pages/component/pop_up_error.php');
        exit();
    } 
    elseif(!same($_POST['mdp'], $_POST['mdp_conf']))
    {
        $errorMessage = "Password doesn't match";
        require_once(ROOT . '/pages/component/pop_up_error.php');
        exit();
    } 
    else
    {
        $email = char_security($_POST['mail']);
        $password = password_hash($_POST['mdp'], PASSWORD_DEFAULT, ['cost' => 12]);
        $username = char_security($_POST['username']);
        $statut = 'normal';


        $checkUserStatement = $BDD->prepare("SELECT * FROM users WHERE email = :email");
        $checkUserStatement->execute([
            'email' => $email,
        ]);
        $checkUserExist = $checkUserStatement->fetchAll(PDO::FETCH_ASSOC);
                
        if(!empty($checkUserExist)) 
        {
            $errorMessage = "Email already used";
            require_once(ROOT . '/pages/component/pop_up_error.php');
        exit();
        } 
        else 
        {
        $registerQuery = "INSERT INTO users (username, email, mdp, statut) 
        VALUE (:username, :email, :mdp, :statut)";
        $registerStatement = $BDD->prepare($registerQuery);
        $registerStatement->execute([
            'username' => $username,
            'email' => $email,
            'mdp' => $password,
            'statut' => $statut,
        ]);

        $recupUserIdStatement = $BDD->prepare("SELECT id FROM users WHERE email = :email");
        $recupUserIdStatement->execute(['email' => $email]);
        $recupUserId = $recupUserIdStatement->fetchAll(PDO::FETCH_ASSOC);

        $uploadQuery = "INSERT INTO pictures (user_id, img_path) 
        VALUE (:user_id, :img_path)";
        $uploadStatement = $BDD->prepare($uploadQuery);
        $uploadStatement->execute([
            'user_id' => $recupUserId[0]['id'],
            'img_path' => 'default-profile.webp',
        ]);

        header('Location: /pages/login.php');
        exit();
        }
    }

    
    
    
?>
<?php endif; ?>
<?php require_once(ROOT .'/pages/footer.php');?>

    


