<?php 
require_once '../core/init.php';
if(!$session_user->isLoggedIn()){
	Redirect::to(DNADMIN._.'login');
}

$data_exists = false;
if(Input::checkInput('id','get',1)){
	$agent_ID = sanAsID(Input::get('id','get'));
	$agentClass = new Applicants();
	$agentClass->get($agent_ID);
	
	if($agentClass->count()){
		$agent_data = $agentClass->data(); 
		$getsrc = explode(' ',$agent_data->category);
		$app_categ = strtolower($getsrc[0]);
		if($agent_data->checkin =="VIP"){
			$app_categ = strtolower($getsrc[0]).'vip';
		}
		$footerImg = DNADMIN.'/printer/assets/atf/'.$app_categ.'.jpg';
		$data_exists = true;
		$agentClass->update(array('badge'=>'Delivered'),$agent_ID);
	}
}

	if($data_exists){
		switch($app_categ){
			case 'delegate':
				$border_color = 'border-color: #7FFF00';
			break;
			case 'panelist':
				$border_color = 'border-color: #4CEAF9';
			break;
			case 'organizer':
				$border_color = 'border-color: #635059';
			break;
			case 'media':
				$border_color = 'border-color: #34006F';
			break;
			case 'support':
			case 'interpreter':
				$border_color = 'border-color: #FC9D21';
			break;
			case 'organizervip':
			case 'delegatevip':
			case 'panelistvip':
				$border_color = 'border-color: #A50700';
			break;
		}
	}
										
?>
<!DOCTYPE html>
<html>
	<style>
	</style>
	
	<head>
		<link rel="stylesheet" href="<?=DNADMIN?>/printer/css/style.css" type="text/css" />
		<script language="JavaScript" src="<?=DNADMIN?>/printer/js/swfobject.js"></script>
		<script language="JavaScript" src="<?=DNADMIN?>/printer/scriptcam.js"></script>
		<script language="JavaScript" src="<?=DNADMIN?>/printer/js/main.js"></script>
		<script language="JavaScript"> 
			$(document).ready(function() {
				$("#webcam").scriptcam({
					showMicrophoneErrors:false,
					onError:onError,
					cornerRadius:20,
					cornerColor:'e3e5e2',
					onWebcamReady:onWebcamReady,
					uploadImage:'upload.gif',
					onPictureAsBase64:base64_tofield_and_image
				});
			});
			function base64_tofield() {
				$('#formfield').val($.scriptcam.getFrameAsBase64());
			};
			function base64_toimage() {
				$('#image').attr("src","data:image/png;base64,"+$.scriptcam.getFrameAsBase64());
			};
			function base64_tofield_and_image(b64) {
				$('#formfield').val(b64);
				$('#image').attr("src","data:image/png;base64,"+b64);
			};
			function changeCamera() {
				$.scriptcam.changeCamera($('#cameraNames').val());
			}
			function onError(errorId,errorMsg) {
				$( "#btn1" ).attr( "disabled", true );
				$( "#btn2" ).attr( "disabled", true );
				alert(errorMsg);
			}			
			function onWebcamReady(cameraNames,camera,microphoneNames,microphone,volume) {
				$.each(cameraNames, function(index, text) {
					$('#cameraNames').append( $('<option></option>').val(index).html(text) )
				}); 
				$('#cameraNames').val(camera);
			}
			
			
		</script> 
		<style>
			@media print {
				#profile_name {
					color: #1374B8!important;
					font-family: helvetica !important;
					font-weight: 600 !important;
					font-size: 18px !important;
					-webkit-print-color-adjust: exact; 
					-moz-print-color-adjust: exact; 
				}
				#company_name {
					color: #19274C!important;
					font-family: helvetica !important;
					font-weight: 600 !important;
					font-size: 15px !important;
					-webkit-print-color-adjust: exact; 
					-moz-print-color-adjust: exact; 
				}
			}

			@media print {
				#profile_name {
				}
			}
		</style>
	</head>
	<body>
			<div class=" main">
				<br>
				<div class="row">
					<div class="col-xs-4 colLeft">
						<div style="width:320px;">
							<div id="webcam">
							</div>
							<p>
								<img src="<?=DNADMIN?>/printer/webcamlogo.png" style="vertical-align:text-top"/>
								<select id="cameraNames" class="control form-control" size="1" onChange="changeCamera()">
								</select>
							</p>
							<p><button class=" btn btn-small btn btn-primary btn-md btn-block" id="btn2" onclick="base64_toimage()">
								<span class="glyphicon glyphicon-camera"></span> Capture</button>
							</p>
							<p><textarea id="formfield" style="display: none; width:190px;height:70px;"></textarea></p>
						</div>
					</div>
					<div class="col-xs-4 middleCol">	
						<div class="panel panel-default controlsPannel">
							<div class="panel-heading">
								<h3><center>CONTROLS</center></h3>
							</div>
							<div class="panel-body">
								<form action onsubmit="return false" autocomplete="on">
									<p>
										<label for="fullName">Full Name</label>
										<input class="form-control" onkeyup="writeName('profile')" id="fullName" name="fullName" value="<?php if($data_exists){ echo $agent_data->firstname.' '.$agent_data->lastname;}?>" placeholder="Full Name" maxlength="20" required>
									</p>
									<p>
										<label for="companyName">Company Name</label>
										<input class="form-control" onkeyup="writeName('company')" id="companyName" name="companyName" value="<?php if($data_exists){ echo $agent_data->company;}?>" placeholder="Company Name" maxlength="25" required>
									</p>
									<p>
										<label for="selectCateg">Card Category</label>
										<select id="selectCateg" onchange="changeCateg('categ')" class="form control input-sm" name="card_categ" required>
											<option value="">-- Select Category --</option>
											<option value="delegate" <?php if($data_exists && $app_categ =='delegate'){ echo 'selected';}?>>Delegate</option>
											<option value="organizer" <?php if($data_exists && $app_categ =='organizer'){ echo 'selected';}?>>Organizer</option>
											<option value="panelist" <?php if($data_exists && $app_categ =='panelist'){ echo 'selected';}?>>Panelist</option>
											<option value="media" <?php if($data_exists && $app_categ =='media'){ echo 'selected';}?>>Media</option>
											<option value="interpreter" <?php if($data_exists && $app_categ =='interpreter'){ echo 'selected';}?>>Interpreter</option>
											<option value="support" <?php if($data_exists && $app_categ =='support'){ echo 'selected';}?>>Support Crew</option>
											<option value="delegatevip" <?php if($data_exists && $app_categ =='delegatevip'){ echo 'selected';}?>>Delegate (VIP)</option>
											<option value="organizervip" <?php if($data_exists && $app_categ =='organiservip'){ echo 'selected';}?>>Organizer (VIP)</option>
											<option value="panelistvip" <?php if($data_exists && $app_categ =='panelistvip'){ echo 'selected';}?>>Panelist (VIP)</option>
										</select>
									</p>
									
									<p><button type="submit"  style="display: none" class="btn btn-small" id="btn1" onclick="base64_tofield()">Snapshot to form</button></p>
									
								</form>
								<p>
									<button id="cardPrinterBtn" class="menuBtn btn btn-primary btn-sm btn-block" onclick="PrintElem('#card_div')">
									<span class="glyphicon glyphicon-print"></span> Print</button>
								</p>
								<script>
									setPrinterBtn()
								</script>
							</div>
						</div>
						<div style="width:135px;">
							
						</div>
					</div>
					<div class="col-xs-4 colRight">
						<div style="">
							<div id="card_div" class="delegate">
								<header class="main" style="height: 110px; width: 270px; margin-top: 10px;">
									<img class="img img-responsive" style="width: 100%;" src="<?=DNADMIN?>/printer/assets/img/card_header.jpg">
								</header>
								<main class="body" style="width: 270px; height: 252px; padding-left: 5px">
									<div class="profile_div text-center">
										<img id="image" src="<?php if($data_exists && $agent_data->profile){ echo DNADMIN._.$agent_data->profile;}?>" class="profile" style="width:120px;height:120px; border: 2px solid #10B2E4; <?php if($data_exists){ echo $border_color;}?>;border-radius: 10px; margin-top: 30px;"/>
									</div>
									<div class="content" style="padding: 10px 5px;">
										<div id="profile_name" class="text_field profile_name" style="font-size: 20px; text-align: center; padding: 3px 5px; text-transform: uppercase">
											<?php if($data_exists){ echo $agent_data->firstname.' '.$agent_data->lastname;}else{ echo 'Full Name';}?>
										</div>
										<div id="company_name" class="text_field company_name" style="font-size: 18px; text-align: center; padding: 3px 5px; text-transform: uppercase; font-size: 16px;">
											<?php if($data_exists){ echo $agent_data->company;}else{ echo 'Company Name';}?>
										</div>
									</div>
								</main>
								<footer style="height: 50px; width: 270px; display: block; color: #fff; font-size: 18px;">
									
									<img id="footerImg" src="<?php if($data_exists){ echo $footerImg;}else{?><?=DNADMIN?>/printer/assets/img/badge_1.jpg<?php }?>" style="width: 100%; height: 50px">
									
								</footer>
							</div>
							
							<div class="clearfix"></div>
							<br>
							<br>
						</div>

					</div>
				</div>
			</div>
	</body>
</html>
