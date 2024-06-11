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

    <h1 class="title-page">Sign In</h1>



    <form action="" method="POST">      

         <div class="input_container">

             <label>E-mail</label>

            <input type="text" name="mail" placeholder="Enter your Username or e-mail address">

        </div>  

        <div class="input_container"> 

            <label>Password</label>

            <input type="password" name="mdp" placeholder="Enter your password">

        </div>

        <button type="submit">Login</button>

    </form>     

    <a href="register.php" class="forget">

        <p>Create <b>account</b></p>

    </a>

</div>



<?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>

<?php 



    if(char_empty($_POST['mail']) || char_empty($_POST['mdp']))

    {

        $errorMessage = "Empty field";

        require_once(ROOT . '/pages/component/pop_up_error.php');

    } 

    

    $email = char_security($_POST['mail']);

    



    if(isEmail($email)) 

    {   

        $recupUserStatement = $BDD->prepare("SELECT * FROM users WHERE email = :email");

        $recupUserStatement->execute([

            'email' => $email,

        ]);

        $recupUser = $recupUserStatement->fetchAll(PDO::FETCH_ASSOC);



    } else {

        $recupUserStatement = $BDD->prepare("SELECT * FROM users WHERE username = :username");

        $recupUserStatement->execute([

            'username' => $email,

        ]);

        $recupUser = $recupUserStatement->fetchAll(PDO::FETCH_ASSOC);

    }





    if(empty($recupUser))

    {

        $errorMessage = "No user found";

        require_once(ROOT . '/pages/component/pop_up_error.php');

    } 

    elseif(!password_verify($_POST['mdp'], $recupUser[0]['mdp'])) 

    {

        $errorMessage = "Wrong password";

        require_once(ROOT . '/pages/component/pop_up_error.php');



    } elseif(!empty($recupUser) && password_verify($_POST['mdp'], $recupUser[0]['mdp'])) {



        create_session($recupUser[0]);

    }

    

    

    



    if(login()) {

        echo "Connected";

        header("Location: /pages/home.php");

        exit();

    } else {

        echo "Disconnected";

    }



    // print_r($_SESSION['LOGGED_USER']['email']);



?>

<?php endif; ?>

<?php require_once(ROOT .'/pages/footer.php');?>



    





