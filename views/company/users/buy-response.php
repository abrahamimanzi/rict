
<section class="content-header">
	<div class="page_header">
		<div class="row">
			<div class="col-xs-12 col-sm-8">
				<h3 class="content-title">
					<i class="fa fa-users fa-lg pink-col"></i> Users
					<small></small>
				</h3>
			</div>
			<div class="col-xs-12 col-sm-4 hidden-xs">
				<!-- Main search form -->
				<form action="#" method="get" class="mainsearch-form">
					<div class="input-group">
						<input type="text" name="q" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
							<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<section class="content-header navbar_header">
	<div>
        <nav class="navbar navbar-static-top navbar_content" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-branch-menu">
            <ul class="nav navbar-nav">
                
              <li class="">
                <a href="<?=DN?>/company/users/list"> <i class="fa fa-home"></i> Home </a>
              </li>
              <li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-angle-down"></i> Users
                </a>
                <ul class="dropdown-menu dropdown-menu-right" style="height: 83px;">
                  <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                      
                    <?php if($session_user_data->groups == 'Admin' || $session_user_data->groups == 'RG-SUPER-Admin'){?>
                      <li><!-- start notification -->
                        <a href="<?=DN?>/company/users/new">
                          <i class="fa fa-plus text-blue"></i>New user
                        </a>
                      </li><!-- end notification -->
                    <?php }?>
                      <li><!-- start notification -->
                        <a href="<?=DN?>/company/users/list">
                            <i class="fa fa-bars text-blue"></i>User
                        </a>
                      </li><!-- end notification -->
                    </ul>
                  </li>
                </ul>
              </li>
                
            </ul>
          </div>
        </nav>
	</div>
</section>

<!-- Main content -->
<section class="content">
		
 <!-- Small boxes (Stat box) -->
	  <div class="row">
          <div class="col-sm-8">


            <?php

                $transaction['status'] = Payment::getInput('vpc_TxnResponseCode');
                $transaction['key']    = Payment::getInput('vpc_TransactionNo');
                $transaction['message'] = Payment::getInput('vpc_Message');

                // $reference = getInput('vpc_MerchTxnRef');
                // Get order from the database by the `$reference` generated random number in the request process

                //&vpc_Version=1
                $vpc_3DSXID = Payment::getInput('vpc_3DSXID');
                $vpc_3DSenrolled = Payment::getInput('vpc_3DSenrolled');
                $vpc_AVSResultCode = Payment::getInput('vpc_AVSResultCode');
                $vpc_AcqAVSRespCode = Payment::getInput('vpc_AcqAVSRespCode');
                $vpc_AcqCSCRespCode = Payment::getInput('vpc_AcqCSCRespCode');
                $vpc_AcqResponseCode = Payment::getInput('vpc_AcqResponseCode');
                $vpc_Amount = Payment::getInput('vpc_Amount');
                $vpc_AuthorizeId = Payment::getInput('vpc_AuthorizeId');
                $vpc_BatchNo = Payment::getInput('vpc_BatchNo');
                $vpc_CSCResultCode = Payment::getInput('vpc_CSCResultCode');
                $vpc_Card = Payment::getInput('vpc_Card');
                $vpc_Command = Payment::getInput('vpc_Command');
                $vpc_Currency = Payment::getInput('vpc_Currency');
                $vpc_MerchTxnRef = Payment::getInput('vpc_MerchTxnRef');
                $vpc_Merchant = Payment::getInput('vpc_Merchant');
                $vpc_Message = Payment::getInput('vpc_Message');
                $vpc_OrderInfo = Payment::getInput('vpc_OrderInfo');
                $vpc_ReceiptNo = Payment::getInput('vpc_ReceiptNo');
                $vpc_RiskOverallResult = Payment::getInput('vpc_RiskOverallResult');
                $vpc_SecureHash = Payment::getInput('vpc_SecureHash');
                $vpc_SecureHashType = Payment::getInput('vpc_SecureHashType');
                $vpc_TransactionNo = Payment::getInput('vpc_TransactionNo');
                $vpc_TxnResponseCode = Payment::getInput('vpc_TxnResponseCode');
                $vpc_VerSecurityLevel = Payment::getInput('vpc_VerSecurityLevel');
                $vpc_VerStatus = Payment::getInput('vpc_VerStatus');
                $vpc_VerType = Payment::getInput('vpc_VerType');
                $vpc_Version = Payment::getInput('vpc_Version');
                $vpc_CardNum = Payment::getInput('vpc_CardNum');

                // echo $vpc_3DSXID.'<br>';
                // echo $vpc_3DSXID.'<br>';
                // echo $vpc_3DSenrolled;
                // echo $vpc_AVSResultCode;
                // echo $vpc_AcqAVSRespCode;
                // echo $vpc_AcqCSCRespCode;
                // echo $vpc_AcqResponseCode;
                // echo $vpc_Amount;
                // echo $vpc_AuthorizeId;
                // echo $vpc_BatchNo;
                // echo $vpc_CSCResultCode;
                // echo $vpc_Card;
                // echo $vpc_Command;
                // echo $vpc_Currency;
                // echo $vpc_MerchTxnRef;
                // echo $vpc_Merchant;
                // echo $vpc_Message;
                // echo $vpc_OrderInfo;
                // echo $vpc_ReceiptNo;
                // echo $vpc_RiskOverallResult;
                // echo $vpc_SecureHash;
                // echo $vpc_SecureHashType;
                // echo $vpc_TransactionNo;
                // echo $vpc_TxnResponseCode;
                // echo $vpc_VerSecurityLevel;
                // echo $vpc_VerStatus;
                // echo $vpc_VerType;
                // echo $vpc_Version;

                $user_ID = $session_user_ID;

                    if($transaction['status'] == "0" && $transaction['message'] == "Approved") {

                        $participant_code = Input::get('id','get');
                        $discount = 0;
                        $participantTable = new \User();
                        $participantTable->selectQuery("SELECT * FROM `app_users` WHERE `code`=? ORDER BY `ID` DESC LIMIT 1",array($user_ID));

                        if(!$participantTable->count()){
                            Redirect::to(DN.'/404');
                        }else{
                            $participant_data = $participantTable->first(); 
                        }
                        
                        $payment_host_data = $participant_data;

                        // Save transaction information in the database
                        // Display transaction details
                            //https://migs.mastercard.com.au/ssl?paymentId=9080421090351159358&currentTimeStamp=1487579404418
                                $member_reg_data = $participant_data;
                                $member_other_data = $memberOtherDatas;
                                // $member_payment_data = $paymentResult['payment_data'];
                                $member_payment_data = Input::get('vpc_AcqResponseCode',
                                    'vpc_Amount','vpc_AuthorizeId','vpc_BatchNo','vpc_Currency',
                                    'vpc_Locale','vpc_MerchTxnRef','vpc_Merchant','vpc_Message',
                                    'vpc_ReceiptNo','vpc_SecureHash','vpc_SecureHashType',
                                    'vpc_TransactionNo','vpc_TxnResponseCode','vpc_3DSXID',
                                    'vpc_Command','vpc_OrderInfo');
                                $seconds = \Config::get('time/seconds');  
                                
                                // $participantTable = new \Participant();
                                // $participantTable->update(array(
                                //     'payment_state'=>'Confirmed',
                                //     'payment_date'=>$seconds,
                                //     'payment_rn'=>$payment_host_data->ID,
                                //     'receipt_number'=>$vpc_ReceiptNo,
                                //     'card_issue'=>$vpc_Card,
                                //     'card_number'=>$vpc_CardNum,
                                //     'transaction_number'=>$vpc_TransactionNo
                                // ),$participant_data->ID);

                                //&vpc_AcqAVSRespCode=Unsupported&vpc_AcqCSCRespCode=Unsupported&vpc_AcqResponseCode=00&vpc_Amount=635000&vpc_AuthorizeId=515010&vpc_BatchNo=20170220&vpc_CSCResultCode=Unsupported&vpc_Card=VC&vpc_Command=pay&vpc_Currency=RWF&vpc_Locale=en&vpc_MerchTxnRef=5899070691348419&vpc_Merchant=TESTBOK000003&vpc_Message=Approved&vpc_OrderInfo=TAS-PLA-000018&vpc_ReceiptNo=705120515010&vpc_RiskOverallResult=ACC&vpc_SecureHash=9004458FA1A92DD73EF225836C687BE9BC32A00BD59687C3A863C17DA5A7DCAC&vpc_SecureHashType=SHA256&vpc_TransactionNo=1100000034&vpc_TxnResponseCode=0&vpc_VerSecurityLevel=06&vpc_VerStatus=E&vpc_VerType=3DS&vpc_Version=1

                                $payment_log_token = md5($payment_host_data->ID.$seconds);
                                
                                $participantItemTable = new PaymentResponse();
                                $participantItemTable->insert(array( 
                                    'user_ID'=>$payment_host_data->ID, 
                                    'registrar'=>$payment_host_data->username, 
                                    'command'=>$vpc_Command,
                                    'amount'=>$vpc_Amount,
                                    'currency'=>$vpc_Currency,
                                    // 'order_info'=>$member_payment_data->vpc_OrderInfo,
                                    // 'receipt_string'=>$member_payment_data->receipt_string,
                                    'receipt_number'=>$vpc_ReceiptNo,
                                    'transaction_number'=>$vpc_TransactionNo,
                                    'payment_rn'=>$payment_host_data->code,
                                    'payment_date'=>$seconds,
                                    'payment_state'=>$vpc_Message,
                                    'type'=>'Single',
                                    'card_issue'=>$vpc_Card,
                                    'card_number'=>$vpc_CardNum,
                                    'token'=>$payment_log_token
                                ));

                        // $email_status = Payment::paymentConfirmedEmail(array($participant_data->ID));

                        // include 'views/register/success.php';
                        ?>
                        <div class="box box-info">
                            <div class="box-header with-border">
                              <h3 class="box-title">Payment successful</h3>

                              <div class="box-tools pull-right">
                                
                              </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" style="padding: 30px; ">
                                 
                                  <div class="form-group">
                                      <label>The transaction was completed successfully. Your payment confirmation and receipt will be sent to 
                                        <span><?=$payment_host_data->email?></span>
                                        momentarily. Please contact info@ricta.org.rw if you do not receive your  email within 12 hours.<br>
                                        Check your spam folder too.
                                      </label>
                                  
                                  </div>

                                  
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix">
                                <a href="<?=DN?>/receipt/<?=$payment_log_token?>" class="btn btn-sm btn-default btn-flat pull-left">Print receipt</a>
                                <a href="<?=DN?>/company/users/buy" class="btn btn-sm btn-info btn-flat pull-right">Done</a>
                            </div>
                            <!-- /.box-footer -->
                          </div>
                        <?php

                    } else {

                        // Display error
                        // echo $transaction['status'] = getInput('vpc_TxnResponseCode') .'<br>';
                        // echo $transaction['key']    = getInput('vpc_TransactionNo') .'<br>';
                        // echo $transaction['message'] = getInput('vpc_Message');

                        $participant_code = Input::get('id','get');
                        $discount = 0;
                        $participantTable = new \User();
                        $participantTable->selectQuery("SELECT * FROM `app_users` WHERE `code`=? ORDER BY `ID` DESC LIMIT 1",array($user_ID));

                        if(!$participantTable->count()){
                            Redirect::to(DN.'/404');
                        }else{
                            $participant_data = $participantTable->first(); 
                        }
                        
                        $payment_host_data = $participant_data;

                        $member_reg_data = $participant_data;
                        // $member_other_data = $memberOtherDatas;
                        // $member_payment_data = $paymentResult['payment_data'];
                        $member_payment_data = Input::get('vpc_AcqResponseCode',
                            'vpc_Amount','vpc_AuthorizeId','vpc_BatchNo','vpc_Currency',
                            'vpc_Locale','vpc_MerchTxnRef','vpc_Merchant','vpc_Message',
                            'vpc_ReceiptNo','vpc_SecureHash','vpc_SecureHashType',
                            'vpc_TransactionNo','vpc_TxnResponseCode','vpc_3DSXID',
                            'vpc_Command','vpc_OrderInfo');
                        $seconds = \Config::get('time/seconds');  
                        
                        // $participantTable = new \Participant();
                        // $participantTable->update(array(
                        //     'payment_state'=>'Cancelled',
                        //     'payment_date'=>$seconds,
                        //     'payment_rn'=>$payment_host_data->ID,
                        //     'receipt_number'=>$vpc_ReceiptNo,
                        //     'transaction_number'=>$vpc_TransactionNo
                        // ),$participant_data->ID);

                        $payment_log_token = md5($payment_host_data->ID.$seconds);
                        
                        $participantItemTable = new PaymentResponse();
                        $participantItemTable->insert(array( 
                            'user_ID'=>$payment_host_data->ID, 
                            'registrar'=>$payment_host_data->username, 
                            'command'=>$vpc_Command,
                            'amount'=>$vpc_Amount,
                            'currency'=>$vpc_Currency,
                            // 'order_info'=>$member_payment_data->vpc_OrderInfo,
                            // 'receipt_string'=>$member_payment_data->receipt_string,
                            'receipt_number'=>$vpc_ReceiptNo,
                            'transaction_number'=>$vpc_TransactionNo,
                            'payment_rn'=>$payment_host_data->ID,
                            'payment_date'=>$seconds,
                            'payment_state'=>'Cancelled',
                            'type'=>'Single',
                            'token'=>$payment_log_token
                        ));

                        // $email_status = Payment::paymentCancelledEmail(array($participant_data->ID));

                        // include 'views/register/decline.php';

                        if($transaction['message'] == 'Cancelled'){ 

                          ?>
                          <div class="box box-info">
                              <div class="box-header with-border">
                                <h3 class="box-title">Payment cancelled</h3>

                                <div class="box-tools pull-right">
                                  
                                </div>
                              </div>
                              <!-- /.box-header -->
                              <div class="box-body" style="padding: 30px; ">
                                   
                                    <div class="form-group">
                                        <label>You seem to have cancelled your payment. </label>
                                    
                                    </div>

                                    
                              </div>
                              <!-- /.box-body -->
                              <div class="box-footer clearfix">
                                  <a href="<?=DN?>/company/users/buy" class="btn btn-sm btn-default btn-flat pull-left">Cancel</a>
                                <a href="<?=DN?>/company/users/buy" class="btn btn-sm btn-info btn-flat pull-right">Done</a>
                              </div>
                              <!-- /.box-footer -->
                            </div>
                          <?php
                        }elseif($transaction['message'] != 'Approved'){
                          ?>
                          <div class="box box-info">
                              <div class="box-header with-border">
                                <h3 class="box-title">Payment decline</h3>

                                <div class="box-tools pull-right">
                                  
                                </div>
                              </div>
                              <!-- /.box-header -->
                              <div class="box-body" style="padding: 30px; ">
                                   
                                    <div class="form-group">
                                        <label>You seem to entered an incorrect card details, please try again.</label>
                                    
                                    </div>

                                    
                              </div>
                              <!-- /.box-body -->
                              <div class="box-footer clearfix">
                                  <a href="<?=DN?>/company/users/buy" class="btn btn-sm btn-default btn-flat pull-left">Cancel</a>
                                <a href="<?=DN?>/company/users/buy" class="btn btn-sm btn-info btn-flat pull-right">Done</a>
                              </div>
                              <!-- /.box-footer -->
                            </div>
                          <?php
                        }else{
                          ?>
                          <div class="box box-info">
                              <div class="box-header with-border">
                                <h3 class="box-title">Payment decline</h3>

                                <div class="box-tools pull-right">
                                  
                                </div>
                              </div>
                              <!-- /.box-header -->
                              <div class="box-body" style="padding: 30px; ">
                                   
                                    <div class="form-group">
                                        <label>You seem to have cancelled your payment.</label>
                                    
                                    </div>

                                    
                              </div>
                              <!-- /.box-body -->
                              <div class="box-footer clearfix">
                                  <a href="<?=DN?>/company/users/list" class="btn btn-sm btn-default btn-flat pull-left">Cancel</a>
                                  <button type="submit" class="btn btn-sm btn-info btn-flat pull-right">Submit</button>
                              </div>
                              <!-- /.box-footer -->
                            </div>
                          <?php

                        }

                    }
            ?>
              
          </div>
	  </div><!-- /.row -->
    
	  <div class="row">
		<div class="col-md-8 col-xs-12">
           
		</div><!-- ./col -->
		<div class="col-md-4 col-xs-12">
           
		</div><!-- ./col -->
	  </div><!-- /.row -->
    
</section>


