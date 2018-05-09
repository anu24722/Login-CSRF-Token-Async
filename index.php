
<?php 
    //start a session - users browser
    session_start();

    //setting a cookie
    $sessionID = session_id(); //storing session id

    //generate CSRF token
    if(empty($_SESSION['key']))
    {
        $_SESSION['key']=bin2hex(random_bytes(32));
    }

    $token = hash_hmac('sha256',$sessionID,$_SESSION['key']);
    

    setcookie("session_id_ass2",$sessionID,time()+3600,"/","localhost",false,true); //cookie terminates after 1 hour - HTTP only flag
    setcookie("csrf_token",$token,time()+3600,"/","localhost",false,true); //csrf token cookie


?>


<!DOCTYPE html>
<html>
<head>
<title> Secure Software System Assignment 2 - IT16116702 </title>
<meta charset="utf-8"/>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" id="bootstrap-css" />
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"> </script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Raleway:500' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="config.js"> </script>

<style>


body {
    width:100px;
	height:100px;
  background: -webkit-linear-gradient(90deg,#ebd6ff 10%, #3A6073 90%);   /* Chrome 10+, Saf5.1+ */
 background:    -moz-linear-gradient(90deg, #ebd6ff 10%, #3A6073 90%); /* FF3.6+ */
  background:     -ms-linear-gradient(90deg, #ebd6ff 10%, #3A6073 90%); /* IE10 */
  background:      -o-linear-gradient(90deg, #ebd6ff 10%, #3A6073 90%); /* Opera 11.10+ */
  background:         linear-gradient(90deg, #ebd6ff 10%, #3A6073 90%); /* W3C */
font-family: 'Raleway', sans-serif;
}

.middlePage {
	width: 1000px;
    height: 650px;
    position:center;
    top:0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
}

p {
	color:#4b1b9b;
}

.spacing {
	padding-top:10px;
	padding-bottom:7px; }

.logo {
	color:#4b1b9b;

}

</style>

</head>
<body>

<div class="middlePage">
<div class="page-header">
    <h1 class="logo">Assignment 2 <small> - Cross-Site Request forgery protection - Async</small> </h1>
</div> 

<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title"> <font size="3" color="red"> Log In </font></h3>
    </div>

    <div class ="panel-body">
       

            <div class="col-md-7" style="border-left:1px solid #ccc;height:160px">
                <form class="form-horizontal" method="POST" action="server.html" >
                    <input name="user_name" type="text" placeholder="Enter User Name" class="form-control input-md">
                    <div class="spacing"><input type="checkbox" name="checkboxes" id="checkboxes-0" value="1"><small> Remember me</small></div>
                    <input name="user_pswd" type="password" placeholder="Enter your password" class="form-control input-md">
                    <div class="spacing"><input type="hidden" id="csToken" name="CSR"/></div>
                    <input type="submit" name="sbmt" value="Log In" class="btn btn-info btn-sm pull-right">
                </form>
            </div>
<p><font size="3" color="red"><a href="https://github.com/anu24722/Login-CSRF-Token-Async">GIT HUB PROJECT </a> @Baskaran Anujan </font></p>
        </div>
    </div>

</div>


</div>
<!-- Assign CSRF token to hidden variable -->
<script> document.getElementById("csToken").value = '<?php echo $token; ?>' </script>
</body>
</html>