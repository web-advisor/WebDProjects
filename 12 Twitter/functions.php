<?php 
    session_start();
    $link=mysqli_connect("shareddb-q.hosting.stackcp.net","twitter-3131372de6","tweeTY@3131","twitter-3131372de6");
        if(mysqli_connect_error()){
           print_r(mysqli_connect_error());
           exit();
        }
    if($_GET['process']=="logout"){
        session_unset();
    }

    function time_since($since) {
        $chunks = array(
            array(60 * 60 * 24 * 365 , 'year'),
            array(60 * 60 * 24 * 30 , 'month'),
            array(60 * 60 * 24 * 7, 'week'),
            array(60 * 60 * 24 , 'day'),
            array(60 * 60 , 'hour'),
            array(60 , 'min'),
            array(1 , 'sec')
        );
    
        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }
    
        $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
        return $print;
    }

    // displaying tweet mechanism
    function displayTweets($type){
        global $link;
        if($type=="public"){
            $whereClause="";
        }else if($type=="isFollowing"){
            $whereClause="";
            $query="SELECT * FROM `isFollowing` WHERE `follower` = ".mysqli_real_escape_string($link,$_SESSION['id']);
            $result=mysqli_query($link,$query);
            if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
                    if($whereClause==""){
                        $whereClause="WHERE";
                    }else{
                        $whereClause.=" OR";
                    }
                    $whereClause.=" userid=".$row['isFollowing'];
                }
            }
        }else if($type=="yourTweets"){
            $whereClause="WHERE userid=".mysqli_real_escape_string($link,$_SESSION['id']);
        }else if($type=="search"){
            echo "<p>Showing Results For <b>'".mysqli_real_escape_string($link,$_GET['query'])."'</b> :</p>";
            $whereClause="WHERE `tweet` LIKE '%".mysqli_real_escape_string($link,$_GET['query'])."%'";
        }else if(is_numeric($type)){
            $userQuery="SELECT * FROM `users` WHERE id=".mysqli_real_escape_string($link,$type)." LIMIT 1";
            $userQueryResult=mysqli_query($link,$userQuery);
            $user=mysqli_fetch_assoc($userQueryResult);
            echo "<h3>".mysqli_real_escape_string($link,$user['email'])."'s Tweets</h3>";
            $whereClause="WHERE userid=".mysqli_real_escape_string($link,$type);
        }
        $query="SELECT * FROM `tweets` ".$whereClause." ORDER BY `datetime` DESC LIMIT 10";
        $result=mysqli_query($link,$query);
        if(mysqli_num_rows($result)==0){
            echo "There are no tweets to display !";
        }else{
            while($row=mysqli_fetch_assoc($result)){
                // User Info 
                $userQuery="SELECT * FROM `users` WHERE id=".mysqli_real_escape_string($link,$row['userid'])." LIMIT 1";
                $userQueryResult=mysqli_query($link,$userQuery);
                $user=mysqli_fetch_assoc($userQueryResult);

                echo "<div class='tweet'><p><a href='?page=publicprofiles&userid=".$user['id']."'>".$user['email']."</a>  <span class='time'>".time_since(time()-strtotime($row['datetime']))." ago</span></p>";
                echo "<p>".$row['tweet']."</p>";
                echo "<p><a class='toggleFollow' data-userId='".$row['userid']."'>";
                $isFollowingQuery="SELECT * FROM `isFollowing` WHERE `follower` = ".mysqli_real_escape_string($link,$_SESSION['id'])." AND `isFollowing`= ".mysqli_real_escape_string($link,$row['userid'])." LIMIT 1";
                $isFollowingQueryResult=mysqli_query($link,$isFollowingQuery);
                if(mysqli_num_rows($isFollowingQueryResult)>0){
                    echo "Unfollow";
                }else{
                    echo "Follow";
                }
                echo "</a></p></div>";
            }
        }
    }

    //Search area
    function displaySearch(){
        echo '<form class="form-inline">
                <div class="form-group my-1">
                    <input type="hidden" name="page" value="search">
                    <input type="text" name="query" class="form-control" id="seaarch" placeholder="Search Tweets">
                </div>
                <div>
                    <button type="submit" class="btn">&#128269;</button>
                </div>
              </form>'; 
    }

    // Posting Tweet Box
    function displayTweetBox(){
        if($_SESSION['id']>0){
            echo '<div class="form">            
                    <div id="tweetSuccess" class="alert alert-success">Your Tweet was Posted Successfully</div>
                    <div id="tweetFail" class="alert alert-danger"></div>
                    <div class="form-group">
                        <textarea class="form-control" id="tweetContent"></textarea>
                    </div>
                    <button class="btn btn-primary" id="postTweetButton">Post Tweet</button>
                  </div>
            ';
        }
    }

    function displayUser(){
        global $link;
        $query="SELECT * FROM `users` LIMIT 10"; 
        $result=mysqli_query($link,$query);
        while($row=mysqli_fetch_assoc($result)){
            echo "<p><a href='?page=publicprofiles&userid=".$row['id']."'>".$row['email']."</a></p>";
        }
    }
?>