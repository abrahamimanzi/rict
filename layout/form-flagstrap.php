<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Timbaktu</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	
	<script src="<?=DN?>/js/jquery.min.js"></script>
	<script src="<?=DN?>/js/bootstrap.min.js"></script>
	
	<script src="<?=DN?>/assets/flagstrap/js/jquery.flagstrap.min.js"></script>
	<script src="<?=DN?>/js/jquery.easing.min.js"></script>
	<script src="<?=DN?>/js/tim_signup.js"></script>
	<link href="<?=DN?>/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?=DN?>/css/tim_signup.css" rel="stylesheet">
	<link href="<?=DN?>/assets/flagstrap/css/flags.css" rel="stylesheet">
	<!--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>-->
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="col-xs-4">
				</div>
				<div class="col-xs-4">
					<!-- multistep form -->
					<form method="post" id="msform">
					  <!-- progressbar -->
					  <ul id="progressbar">
						<li class="active">Personal Details</li>
						<li>Account Setup</li>
						<li>Privacy</li>
					  </ul>
					  <!-- fieldsets -->
					  <fieldset>
						<h2 class="fs-title">Welcome aboard!</h2>
						<h3 class="fs-subtitle">What should we call you?</h3>
						<input type="text" name="fname" placeholder="First Name" required/>
						<input type="text" name="lname" placeholder="Last Name" required/>
						<select name="country" id="country" class="js-example-templating js-states form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
							<?php 
								$countryArray = require 'country.php';
								foreach($countryArray as $country_ID=>$country_data){
									$country_data = (object)$country_data;?>
									<option value="<?php echo $country_ID+1; ?>"  id="<?php echo $country_data->icon; ?>"><span></span><?php echo $country_data->name; ?></option>>
									<?php
								}
							?>
						</select>
						<div class="form-group">
							<label>Select Country</label><br>
							<div id="flagstrap3"
								 data-input-name="country2"
								 data-selected-country="RW"
								 data-button-size="btn-md"
								 data-button-type="btn-default"
								 data-scrollable-height="150px"
								 data-scrollable="true">
							</div>
						</div>
						<script>
  //  $('.flagstrap').flagStrap();
</script>
						<script>
							$('#flagstrap3').flagStrap({
								// countries: {
									// "AU": "Australia",
									// "GB": "United Kingdom",
									// "US": "United States"
								// },
								inputName: 'country',
								buttonSize: "btn-lg",
								buttonType: "btn-primary",
								labelMargin: "20px",
								scrollable: false,
								scrollableHeight: "350px",
								onSelect: function(value, element) {
									//
								},
								placeholder: {
									value: "",
									text: "Please select a country"
								}
							});
						</script>
						<input type="button" name="next" class="next action-button" value="Next" />
					  </fieldset>
					  <fieldset>
						<h2 class="fs-title">Account setup</h2>
						<h3 class="fs-subtitle">You're only few moments a way from having your own App, </h3>
						<input type="email" name="email" placeholder="Your address Email" />
						<input type="button" name="previous" class="previous action-button" value="Previous" />
						<input type="button" name="next" class="next action-button" value="Next" />
					  </fieldset>
					  <fieldset>
						<h2 class="fs-title">Secure your Account</h2>
						<h3 class="fs-subtitle">What should your password be?</h3>
						<input type="password" name="pass" placeholder="Password" />
						<input type="password" name="cpass" placeholder="Confirm Password" />
						<input type="button" name="previous" class="previous action-button" value="Previous" />
						<input type="submit" name="submit" class="submit action-button" value="Submit" />
					  </fieldset>
					</form>
				</div>
				<div class="col-xs-4">
				</div>
			</div>
		</div>
	</div>
</body>
</html>