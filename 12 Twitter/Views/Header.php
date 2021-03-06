<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylessheet" href="http://amarsinharanjan-com.stackstaging.com/content/12%20Twitter/styles.css">
  
  <style type="text/css">
                /* Sticky footer styles
        -------------------------------------------------- */
        html {
            position: relative;
            min-height: 100%;
        }
        body {
            margin-bottom: 60px; /* Margin bottom by footer height */
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px; /* Set the fixed height of the footer here */
            line-height: 60px; /* Vertically center the text there */
            background-color: #f5f5f5;
        } 
        #alertDiv{
            display:none;
        }
        .time{
            color:#A9A9A9;
        }
        .tweet{
            border:2px solid grey;
            border-radius:5px;
            margin:5px;
            padding:5px;
        }
        #tweetSuccess{
            display:none;
        }
        #tweetFail{
            display:none;
        }
        
   </style> 
  <title>Twitter</title>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-fixed-top">
        <a class="navbar-brand" href="http://amarsinharanjan-com.stackstaging.com/content/12%20Twitter/">Twitter</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="?page=timeline">Your Timeline</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=yourTweets">Your Tweets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=publicprofiles">Public Profiles</a>
                </li>                
                <!--<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>-->
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <?php if($_SESSION['id']){ ?>
                    <button type="button" class="btn btn-outline-danger my-2 my-sm-0"><a href="?process=logout" style="text-decoration:none; color:black;">Logout</a></button>
                <?php }else{   ?>
                    <button class="btn btn-outline-success my-2 my-sm-0" data-toggle="modal" data-target="#staticBackdrop" type="button">Login/SignUp</button>
                <?php  }  ?>
            </form>
        </div>
    </nav>

    <!-- Button trigger modal -->
    

    