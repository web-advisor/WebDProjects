<footer class="footer">
  <div class="container">
    &copy; My Website 2020
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
		</script>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="loginModalTitle">Log In</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <div class="container">
        <form>
            <div class="alert alert-danger" type="alert" id="alertDiv"></div>
            <input type="hidden" name="loginActive" id="loginActive" value="1">
            <div class="form-group">
                <label for="email">Email : </label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter email ID here"
                    aria-describedby="helpId">
            </div>
            <div class="form-group">
                <label for="password">Password : </label>
                <input type="password" class="form-control" name="password" id="password"
                    placeholder="Password">
            </div>
            
        </form>
    </div>
        </div>
        <div class="modal-footer">
            <button id="toggleLogin" class="btn btn-success">Sign Up Instead</button>
            <button type="submit" class="btn btn-primary" id="button">Log In</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
</body>

<script type="text/javascript">
   $("#toggleLogin").click(function(){
     if($("#loginActive").val()=="1"){
        $("#loginActive").val("0");
        $("#loginModalTitle").html("Sign Up");
        $('#button').html("Sign Up");
        $("#toggleLogin").html("Log In Instead")
     } else{
        $("#loginActive").val("1");
        $("#loginModalTitle").html("Log In");
        $('#button').html("Log In");
        $("#toggleLogin").html("Sign Up Instead")
     }
   });

   // To action the Sign Up/ Log process
   $("#button").click(function(){
     $.ajax({
      type: "POST",
      url : "http://amarsinharanjan-com.stackstaging.com/content/12%20Twitter/actions.php?process=loginSignup",
      data: "email=" + $("#email").val() + "&password=" + $("#password").val() + "&loginActive=" + $("#loginActive").val(),
      success: function(result){
        // alert(result);
        if(result=="1"){
          window.location.assign("http://amarsinharanjan-com.stackstaging.com/content/12%20Twitter/");
        }else{
          $("#alertDiv").html(result).show();
        }
      }
     })
   });

   $(".toggleFollow").click(function(){
     var id=$(this).attr("data-userId");
     $.ajax({
      type: "POST",
      url : "http://amarsinharanjan-com.stackstaging.com/content/12%20Twitter/actions.php?process=toggleFollow",
      data: "userId=" + id,
      success: function(result){  
         if(result=="1"){
           $("a[data-userId='"+id+"']").html("Follow");
         }else if(result=="2"){
           $("a[data-userId='"+id+"']").html("Unfollow");
         }
      }
     })
   });
   
    $("#postTweetButton").click(function(){
      $.ajax({
      type: "POST",
      url : "http://amarsinharanjan-com.stackstaging.com/content/12%20Twitter/actions.php?process=postTweet",
      data: "tweetContent=" + $("#tweetContent").val(),
      success: function(result){
         if(result=="1"){
           $("#tweetSuccess").show();
           $("#tweetFail").hide();
         }else if(result!=""){
           $("#tweetFail").html(result).show();
           $("tweetSuccess").hide();
         }
      }
     })
    });
   
</script>


</html>
