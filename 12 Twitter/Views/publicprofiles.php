<div class="container" style="padding:20px;">
    <div class="row">
        <div class="col-md-8">
            <?php if($_GET['userid']){ 
                displayTweets($_GET['userid']); 
                ?>
            <?php }else{ ?>
            <h2>Active Users</h2>
            <?php displayUser(); 
                  }
            ?>

        </div>
        <div class="col-md-4">
            <?php displaySearch(); ?>
            <hr>
            <?php displayTweetBox(); ?>
        </div>    
    </div>
</div>

