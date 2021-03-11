<?php
    include("functions.php");
    $error="";
    if($_GET["process"]=="loginSignup"){

        if(!$_POST["email"]){
            $error="An Email is required. ";
        }else if(!$_POST["password"]){
            $error="A Password is required. ";
        }else if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)===false){
            $error= "Please enter a Valid email address";
        }
        if($error!=""){
            echo $error;
            exit();
        }

        if($_POST["loginActive"]=="0"){
            // Checking if the Signing Up input email is already taken
            $query="SELECT * FROM `users` WHERE `email` = '".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1";
            $result=mysqli_query($link,$query);
            if(mysqli_num_rows($result)>0){
                $error="This Email id is already taken !";
            }else{
                // Siging up if no errors found
                $query="INSERT INTO `users` (`email`,`password`) VALUES ('".mysqli_real_escape_string($link,$_POST['email'])."','".mysqli_real_escape_string($link,$_POST['password'])."')";
                if(mysqli_query($link,$query)){
                    $_SESSION['id']=mysqli_insert_id($link);
                    // Password Hashing
                    $query="UPDATE `users` SET `password` = '".md5(md5($_SESSION['id']).$_POST['password'])."' WHERE `id`=".$_SESSION['id']." LIMIT 1";
                    mysqli_query($link,$query);
                    echo 1;
                }else{
                    $error="Couldn't Create User - Please try again later ";
                }
            }
        }else{
            // Signing in the user after checking
            $query="SELECT * FROM `users` WHERE `email` = '".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1";
            $result=mysqli_query($link,$query);
            $row=mysqli_fetch_assoc($result);
            if($row['password']==md5(md5($row['id']).$_POST['password'])){
                echo 1;
                $_SESSION['id']=$row['id'];
            }else{
                $error="Could not find that Username-Password Combination ! Please try Again !";
            }
        }

        if($error!=""){
            echo $error;
            exit();
        }
    }

    if($_GET["process"]=="toggleFollow"){
        $query="SELECT * FROM `isFollowing` WHERE `follower` = ".mysqli_real_escape_string($link,$_SESSION['id'])." AND `isFollowing`= ".mysqli_real_escape_string($link,$_POST['userId'])." LIMIT 1";
        $result=mysqli_query($link,$query);
        if(mysqli_num_rows($result)>0){
            // already following case 
            $row=mysqli_fetch_assoc($result);
            $deletion="DELETE FROM `isFollowing` WHERE `id` = ".mysqli_real_escape_string($link,$row['id'])." LIMIT 1";
            mysqli_query($link,$deletion);
            echo "1";
        }else{
            // Want to Follow Case
            $insertion="INSERT INTO `isFollowing` (`follower`,`isFollowing`) VALUES (".mysqli_real_escape_string($link,$_SESSION['id']).",".mysqli_real_escape_string($link,$_POST['userId']).")";
            mysqli_query($link,$insertion);
            echo "2";
        }    
    }

    if($_GET["process"]=="postTweet"){
        if(!$_POST['tweetContent']){
            echo "Your Tweet is Empty !";
        }else if(strlen($_POST['tw  eetContent'])>140){
            echo "Your Tweet is too long !";
        }else{
                $insertion="INSERT INTO `tweets` (`tweet`,`userid`,`datetime`) VALUES ('".mysqli_real_escape_string($link,$_POST['tweetContent'])."',".mysqli_real_escape_string($link,$_SESSION['id']).",NOW())";
            mysqli_query($link,$insertion);
            echo '1';
        }
    }

?>
