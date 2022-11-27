<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>User Signup</title>

<!-- CSS only -->
<link href="./view/css/form.css" rel="stylesheet" type="text/css" />
<style>
body {
	font-family: Arial;
	color: #333;
	font-size: 0.95em;
	background-image: url("./view/images/bg.jpeg");
	background-repeat: no-repeat;
	background-size: 200%;
}
</style>
</head>
<body>
	<div>
		<form action="signup-action.php" method="post" id="frmSignup"
			onSubmit="return validate();">
			<div class="login-form-container">

				<div class="form-head">Sign Up</div>
                <?php
                if (isset($_SESSION["errorMessage"])) {
                    ?>
                <div class="error-message"><?php  echo $_SESSION["errorMessage"]; ?></div>
                <?php
                    unset($_SESSION["errorMessage"]);
                }
                ?>
                <div class="field-column">
					<div>
						<label for="firstname">First Name</label><span id="user_info"
							class="error-info"></span>
					</div>
					<div>
						<input name="first_name" id="first_name" type="text"
							class="demo-input-box" placeholder="Enter First Name">
					</div>
				</div>
                <div class="field-column">
					<div>
						<label for="lastname">Last Name</label><span id="user_info"
							class="error-info"></span>
					</div>
					<div>
						<input name="last_name" id="last_name" type="text"
							class="demo-input-box" placeholder="Enter Last Name">
					</div>
				</div>
                <div class="field-column">
					<div>
						<label for="username">Email</label><span id="user_info"
							class="error-info"></span>
					</div>
					<div>
						<input name="user_name" id="user_name" type="text"
							class="demo-input-box" placeholder="Enter Username or Email">
					</div>
				</div>
				<div class="field-column">
					<div>
						<label for="password">Password</label><span id="password_info"
							class="error-info"></span>
					</div>
					<div>
						<input name="password" id="password" type="password"
							class="demo-input-box" placeholder="Enter Password">
					</div>
					<br>
					<div class>
						<input name="manager" id="manager" type="checkbox">
						<label for="manager">Manager</label>
					</div>
				</div>
                <div class="field-column">
					<div>
						<label for="phone">Phone Number</label><span id="user_info"
							class="error-info"></span>
					</div>
					<div>
						<input name="phone_number" id="phone_number" type="tel"
							class="demo-input-box" placeholder="Enter Phone Number">
					</div>
				</div>
                <div class="field-column">
					<div>
						<label for="phone">Cell Number</label><span id="user_info"
							class="error-info"></span>
					</div>
					<div>
						<input name="cell_number" id="cell_number" type="phone"
							class="demo-input-box" placeholder="Enter Cell Number">
					</div>
				</div>
                <div class="field-column">
					<div>
						<label for="ethaddress">Ethereum Address</label><span id="user_info"
							class="error-info"></span>
					</div>
					<div>
						<input name="eth_address" id="eth_address" type="text"
							class="demo-input-box" placeholder="Enter Ethereum Address">
					</div>
				</div>
                <div class="field-column">
					<div>
						<label for="street_address">Street Address</label><span id="user_info"
							class="error-info"></span>
					</div>
					<div>
						<input name="street_address" id="street_address" type="text"
							class="demo-input-box" placeholder="Enter Street Address">
					</div>
				</div>
                <div class="field-column">
					<div>
						<label for="city">City</label><span id="user_info"
							class="error-info"></span>
					</div>
					<div>
						<input name="city_address" id="city_address" type="text"
							class="demo-input-box" placeholder="Enter City">
					</div>
				</div>
                <div class="field-column">
					<div>
						<label for="state">State</label><span id="user_info"
							class="error-info"></span>
					</div>
					<div>
						<input name="state_address" id="state_address" type="text"
							class="demo-input-box" placeholder="Enter State">
					</div>
				</div>
                <div class="field-column">
					<div>
						<label for="city">Zip Code</label><span id="user_info"
							class="error-info"></span>
					</div>
					<div>
						<input name="zip_code" id="zip_code" type="text"
							class="demo-input-box" placeholder="Enter Zip Code">
					</div>
				</div>
				<div class=field-column>
					<div>
						<input type="submit" name="signup" value="Sign Up" class="btnLogin"></span>
					</div>
				</div>
				<!-- <div class="form-nav-row">
					<a href="#" class="form-link">Forgot password?</a>
				</div> -->
				<div class="login-row form-nav-row">
					<p>Already an existing user?</p>
					<a href="index.php" class="btn form-link">Login Now</a>
				</div>
			</div>
		</form>
	</div>
	<script>
    function validate() {
        var $valid = true;
        document.getElementById("user_info").innerHTML = "";
        document.getElementById("password_info").innerHTML = "";
        
        var userName = document.getElementById("user_name").value;
        var password = document.getElementById("password").value;
        if(userName == "") 
        {
            document.getElementById("user_info").innerHTML = "required";
        	$valid = false;
        }
        if(password == "") 
        {
        	document.getElementById("password_info").innerHTML = "required";
            $valid = false;
        }
        return $valid;
    }
    </script>
</body>
</html>