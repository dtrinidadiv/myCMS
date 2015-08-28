<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<!--PHP function htmlspecialchars() encodes any special HTML characters, 
    	such as <, >, and &, into their HTML entity equivalents (&lt;, &gt;, and &amp;) -->
   	<title><?php echo htmlspecialchars( $results['pageTitle'] )?></title>

     <link href="css/style.css" rel="stylesheet">
     <link href="css/signin.css" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

 
    
  </head>

  <body>
  <div id="wrap">
     <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color:#222222">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a style="color: #0099CC" class="navbar-brand" href="."><i style="color: #0099CC" class="glyphicon glyphicon-alert"></i> </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1">
              
                <ul class="nav navbar-nav navbar-right"  >
                <li style="padding-top:10px;padding-bottom:10px;padding-right:5px">
                    <img heigh="30px" width="30px" src="http://www.gravatar.com/avatar/">

                </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">user's name<span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                          <li><a href="#">Profile</a></li>
                          <li><a href="#">Sign Out</a></li>
                  </ul>
              </li>
                </ul>

             <!--   <form class="navbar-form navbar-right" role="search">
                    <div class="form-group">
                        <input style="height:30px" type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input style="height:30px" type="text" class="form-control" name="password" placeholder="Password">
                    </div>
                    <button  type="submit" class="btn btn-default">Sign In</button>
                </form>-->

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">


   