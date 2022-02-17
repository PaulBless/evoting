<?php
  	session_start();
  	if(isset($_SESSION['admin'])){
    	header('location: admin/home.php');
  	}

    if(isset($_SESSION['voter'])){
      header('location: home.php');
    }
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition login-page">
<div class="login-box">
  	<div class="login-logo ">
  		<b> <span class="text-primary">Jecmas Voting System -  </span> <span class="text-dark"> Welcome </span>  </b>
  	</div>
  
  	<div class="login-box-body">
    	<p class="login-box-msg">Sign in to start your voting session</p>

    	<form action="login.php" method="POST" id="loginForm">
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control" name="voter" placeholder="Voter's Phone Number" required>
        		<span class="glyphicon glyphicon-phone form-control-feedback"></span>
      		</div>

          <!-- <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password" >
            <span class="fa fa-key form-control-feedback"></span>
          </div> -->

      		<div class="row">
    			<div class="col-md-12">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="login"> SIGN IN</button>
        		</div>
      		</div>    	
			
			  <p class="text-danger text-center" style="margin-top: 15px;">Note: You can only vote once! </p>

    	</form>
  	</div>
  	<?php
  		if(isset($_SESSION['error'])){
  			echo "
  				<div class='callout callout-danger text-center mt20'>
			  		<p>".$_SESSION['error']."</p> 
			  	</div>
  			";
  			unset($_SESSION['error']);
  		}
  	?>
</div>
	
<?php include 'includes/scripts.php' ?>

<script>
	$(document).ready(function(){
		
		// $('#loginForm').submit(function(e){
		// 	e.preventDefault();
			// alert("login");
		// });

	});
</script>
</body>
</html>