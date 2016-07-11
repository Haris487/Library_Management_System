<?php $this -> load -> helper('cookie') ?>
<html>
	<!DOCTYPE html>
<html lang="en">
<head>
  <title>Library Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <style>
        .jumbotron {
            background-color: #2b2428;
            color: #ffffff;
            padding: 100px 25px;
        }
        .btn{
            background-color: #97828f;
            border-color: #53464e;

        }
        footer.jumbotron {
            padding: 0px 0px;
        }
    </style>

    	

    </head>
    
    <body>

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img src="/lms/images/lms-logo2.png" class="img-rounded" alt="Cinque Terre" width="100" height="80"></a>

            </div>

            <div class="collapse navbar-collapse" id="myNavbar">

                <ul class="nav navbar-nav navbar-right">
                    <li><h4><?php if(get_cookie('type') != NULL && get_cookie('name') != NULL){ ?><small>Welcome </small><?php echo get_cookie('name'); } ?></h4></li>



                    <?php $li = array(
                        'Home',
                        'Books',
                        'Staff'


                    );

                    if(get_cookie('type') === 'admin' || get_cookie('type')=== 'librarian' || get_cookie('type') === 'student'){
                        array_push($li , 'Student');
                    }

                    if(get_cookie('type') === 'admin' || get_cookie('type')=== 'librarian'){
                        array_push($li , 'Book_Issue');
                        array_push($li, 'Book_Return');
                    }
                    for($i  = 0 ; $i < count($li) ; $i++){
                    ?>
                    <li <?php if($title === $li[$i]) echo "class = 'active'";?>><a href="/lms/index.php/<?php echo $li[$i] ?>"><?php echo $li[$i] ?></a></li>

                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

        <div class="jumbotron text-center">
        	<h1>
            L<small>IBRARY</small>
            M<small>ANAGEMENT</small>
            S<small>YSTEM</small>
            </h1>
            <p>We Serve Students</p>

<?php if(get_cookie('type') === NULL){ ?>

    <form class = "form" method = "post" action = "/lms/index.php/Login" >
                <input type = "input" name = "username" class="form-control" size = "50"  placeholder = "User Name" >
                <input type = "password" name = "password" class="form-control" size = "50" placeholder = "Password" >
                <input type = "submit" class="btn btn-info" value = "LOGIN" >
            </form >
  <?php } else{ ?>

            <form class = "form" method = "post" action = "/lms/index.php/Login/sign_out">
                <input type = 'submit' class="btn btn-danger" value = "SIGN OUT">
            </form>
      <?php } ?>

        
        </div>
        <div class = 'container'>

        
        
       