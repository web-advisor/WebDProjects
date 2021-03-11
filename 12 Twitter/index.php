<?php
    include("functions.php");
    include("Views/Header.php");
    if($_GET['page']=="timeline"){
        include("Views/timeline.php");
    }else if($_GET['page']=="yourTweets"){
        include("Views/yourTweets.php");
    }else if($_GET['page']=="search"){
        include("Views/search.php");
    }else if($_GET['page']=="publicprofiles"){
        include("Views/publicprofiles.php");
    }else{
        include("Views/Home.php");
    }
    include("Views/Footer.php");


?>