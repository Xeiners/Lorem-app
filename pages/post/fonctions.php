<?php 
session_start();


function create_session(array $db_table)
{ 
    $user_id = $db_table['id'];
    $email = $db_table['email'];
    $user_state = $db_table['status'];

    $_SESSION['LOGGED_USER'] = [
        'id' => $user_id,
        'email' => $email,
        'state' => $user_state,
        'time_login' => time(),
    ];
}

function time_out() : bool 
{
    if(!empty($_SESSION['LOGGED_USER']['time_login'])) 
    {
    
        if((time() - $_SESSION['LOGGED_USER']['time_login']) > 172800) {
            session_destroy();
            return true;
        }
    } 

    return false;
}


function login() :bool
{
    time_out();
    if(isset($_SESSION['LOGGED_USER']) && is_array($_SESSION['LOGGED_USER']) && !empty($_SESSION['LOGGED_USER']['email'])) {
        return true;
    }
    return false;
}


function char_empty($word) : bool
{
    if(!isset($word)) {
        return true;
    }

    $word = trim($word);
    
    if(empty($word)){  
        return true;
    }
    return false;
}

function char_security(string $word) : string
{
    $word = htmlspecialchars($word);
    $word = strip_tags($word);

    return $word;
}


function same(string $word1, string $word2) : bool 
{
    $word1 = trim($word1);
    $word2 = trim($word2);
    

    return $word1 === $word2; //true sinon false
}


function valid_picture(array $files) : bool 
{
    $files_size = $files['picture']['size'];

    //recuperation de l'extension
    $filesInfo = pathinfo($files['picture']['name']);
    $extension = $filesInfo['extension'];

    $allowed_extension = ['jpg' , 'jpeg', 'gif', 'png', 'webp'];


    if ($files['picture']['error'] === 0 && $files_size <  10000000 && in_array($extension, $allowed_extension))
    {
        
        return true;
    }  
    
    return false;
}


function exist_user(int $id, $BDD) :bool 
{
    $userExistQuery = 'SELECT * FROM users WHERE id = :id';
    $existUserStatement = $BDD->prepare($userExistQuery);
    $existUserStatement->execute(['id' => $id]);
    $existUser = $existUserStatement->fetch(PDO::FETCH_ASSOC);
    
    if(empty($existUser)) {
        return false;
    } 

    return true;
}

function exist_comment(int $id, $BDD) :bool 
{
    $commentExistQuery = 'SELECT * FROM comments WHERE id = :id';
    $existCommentStatement = $BDD->prepare($commentExistQuery);
    $existCommentStatement->execute(['id' => $id]);
    $existComment = $existCommentStatement->fetch(PDO::FETCH_ASSOC);
    
    if(empty($existComment)) {
        return false;
    } 

    return true;
}

function goBack() {

    if (isset($_SERVER['HTTP_REFERER'])) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        header("Location: home.php"); // Page par défaut si HTTP_REFERER n'est pas défini
    }
    exit();
}

function isEmail(string $string) : bool
{
    if(filter_var($string, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}




?>
