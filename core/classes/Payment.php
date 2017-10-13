<?php
class Payment 
{
    public static function getInput($key, $default = false)
    {
        return isset($_GET[$key]) ? $_GET[$key] : $default;
    }


    /**
     * A simple algorithm to generate a random reference to the order
     * @return string
     */
    public static function generateMerchTxnRef()
    {
        $txnRef = rand(9, 999);

        // Saved in the database associated with the order id

        return $txnRef;
    }

    /**
     * Generate secure hash from url params
     * Tested with the example provided in the pdf (page 74)
     * 
     * @param  array $params
     * @return string
     */
    public static function generateSecureHash($secret, array $params)
    {
        $secureHash = "";

        // Sorting params first based on the keys
        ksort($params);
        
        foreach ($params as $key => $value)
        {        
            // Check if key equals to vpc_SecureHash or vpc_SecureHashType to discard it
            if(in_array($key, array('vpc_SecureHash', 'vpc_SecureHashType'))) continue;

            // If key either starts with vpc_ or user_
            if(substr( $key, 0, 4 ) === "vpc_" || substr($key, 0, 5) === "user_") {

                $secureHash .= $key."=".$value."&";
            }
        }

        // Remove the last `&` character from string
        $secureHash = rtrim($secureHash, "&");

        //
        return strtoupper(hash_hmac('sha256', $secureHash, pack('H*', $secret)));
    }







	public static function pay($pda){
        
        $returnResult = array('state'=>false,
                                  'message'=>'Unknown error');
        
        $seconds = \Config::get('time/seconds');
        $_PDT['vpc_CardExp'] = $pda['cardExp'];
//            $_PDT['vpc_ReturnURL']=DN."/vpcapi"; // VPC URL
        $_PDT['vpc_Version']="1"; // VPC Version
        $_PDT['vpc_Command']="pay"; // Command Type
        $_PDT['vpc_AccessCode']="69E28154"; // Merchant AccessCode from jerome:
        // $_PDT['vpc_AccessCode']="CF9FAB30"; // Merchant AccessCode:
           // $_PDT['vpc_AccessCode']="090752E2"; // Merchant AccessCode Active
        $_PDT['vpc_MerchTxnRef']=$pda['paymentRn']; // Merchant Transaction Reference
        $_PDT['vpc_Merchant']="TESTBOK000003"; // MerchantID from jerome
        // $_PDT['vpc_Merchant']="TESTBK0000003"; // MerchantID
           // $_PDT['vpc_Merchant']="BK0000003"; // MerchantID Active
        $_PDT['vpc_OrderInfo']= $pda['order'];// Order Info
        $_PDT['vpc_Locale']= "en";// Local
        
        $secHashSec="62E8CC6E522EEDEF625561CDAAAE74E8"; // Hash added  from jerome
        // $secHashSec="BE35CB8ED75A6C5BF23B121E3A9AEE74"; // Hash added 

        if($pda['currency']=="RWF"){
            $_PDT['vpc_Currency']=646;
            $mult = 1;
        }elseif($pda['currency']=="USD"){
            $_PDT['vpc_Currency']=840;
            $mult = 100;
        }
        // $mult = 100;

        $_PDT['vpc_Amount']=$pda['amount']*$mult;
        
        $_PDT['vpc_CardNum'] = $pda['cardNum']; // MerchantID
        $_PDT['vpc_CardSecurityCode'] = $pda['csc'];

        $vpcURL = "https://migs.mastercard.com.au/vpcdps";

        ksort($_PDT);
        
        // create a variable to hold the POST data information and capture it
        $postData = "";
        $ampersand = "";
        foreach($_PDT as $key => $value) {
            // create the POST data input leaving out any fields that have no value
            if(strlen($value) > 0) {
                $postData .= $ampersand . urlencode($key) . '=' . urlencode($value);
                $ampersand = "&";
            }
        }

        $_PDT['vpc_SecureHash'] = strtoupper(hash_hmac('SHA256', $postData, pack('H*',$secHashSec)));
        $_PDT['vpc_SecureHashType']='SHA256';
        
        $postData .='&'.urlencode('vpc_SecureHash').'='.urlencode($_PDT['vpc_SecureHash']).'&'.urlencode('vpc_SecureHashType').'='.urlencode($_PDT['vpc_SecureHashType']);

        // Get a HTTPS connection to VPC Gateway and do transaction turn on output buffering to stop response going to browser
        ob_start();
        // initialise Client URL object
        $ch = curl_init();
        // set the URL of the VPC
        curl_setopt ($ch, CURLOPT_URL, $vpcURL);
        curl_setopt ($ch, CURLOPT_POST, 1);
        curl_setopt ($ch, CURLOPT_POSTFIELDS, $postData);
        // connect
        curl_exec ($ch);
        // get response
        $response = ob_get_contents();
        // turn output buffering off.
        ob_end_clean();
        // set up message paramter for error outputs
        $message = "";
        // serach if $response contains html error code
        if(strchr($response,"<html>") || strchr($response,"<html>")) {;
            $message = $response;
        } else {
            // check for errors from curl
            if (curl_error($ch))
                  $message = "%s: s". curl_errno($ch) . "<br/>" . curl_error($ch);
        }
        // close client URL
        curl_close ($ch);
        // Extract the available receipt fields from the VPC Response
        // If not present then let the value be equal to 'No Value Returned'
        $map = array();
        // process response if no errors
        if (strlen($message) == 0) {
            $pairArray = explode("&", $response);
            foreach ($pairArray as $pair) {
                $param = explode("=", $pair);
                $map[urldecode($param[0])] = urldecode($param[1]);
            }
            $message         = null2unknown($map, "vpc_Message");
        }

        // Standard Receipt Data
        # merchTxnRef not always returned in response if no receipt so get input
        //TK//$merchTxnRef     = $vpc_MerchTxnRef;
        $merchTxnRef     = $_PDT["vpc_MerchTxnRef"];

        $amount          = null2unknown($map, "vpc_Amount");    //Purchase Amount:
        $vpc_Currency    = null2unknown($map, "vpc_Currency");    //Purchase Amount:
        $locale          = null2unknown($map, "vpc_Locale");
        $batchNo         = null2unknown($map, "vpc_BatchNo");
        $command         = null2unknown($map, "vpc_Command"); // Command
        $version         = null2unknown($map, "vpc_Version"); // version
        $cardType        = null2unknown($map, "vpc_Card");
        $orderInfo       = null2unknown($map, "vpc_OrderInfo"); //Order Information
        $receiptNo       = null2unknown($map, "vpc_ReceiptNo");
        $merchantID      = null2unknown($map, "vpc_Merchant"); //Merchant ID:
        $authorizeID     = null2unknown($map, "vpc_AuthorizeId");
        $transactionNo   = null2unknown($map, "vpc_TransactionNo");
        $acqResponseCode = null2unknown($map, "vpc_AcqResponseCode");
        $txnResponseCode = null2unknown($map, "vpc_TxnResponseCode"); //  //VPC Transaction Response Code
        $txnResponseCode = getResponseDescription($txnResponseCode); //  //Transaction Response Code Description
        $message; // Message


        $_PDT['vpc_SecureHash'] = strtoupper(hash_hmac('SHA256', $postData, pack('H*',$secHashSec)));
        $_PDT['vpc_SecureHashType']='SHA256';

        $first_data = urlencode('vpc_Amount').'='.urlencode(@$_PDT['vpc_Amount']);
        $first_data .= '&'.urlencode('vpc_Command').'='.urlencode(@$_PDT['vpc_Command']);
        $first_data .= '&'.urlencode('vpc_Currency').'='.urlencode(@$pda['currency']);
        $first_data .= '&'.urlencode('vpc_Locale').'='.urlencode(@$_PDT['vpc_Locale']);
        $first_data .= '&'.urlencode('vpc_MerchTxnRef').'='.urlencode(@$_PDT['vpc_MerchTxnRef']);
        $first_data .= '&'.urlencode('vpc_Merchant').'='.urlencode(@$_PDT['vpc_Merchant']);
        $first_data .= '&'.urlencode('vpc_OrderInfo').'='.urlencode(@$_PDT['vpc_OrderInfo']);
        $first_data .= '&'.urlencode('vpc_Version').'='.urlencode(@$_PDT['vpc_Version']);

        $second_data = urlencode('vpc_Amount').'='.urlencode(@$map['vpc_Amount']);
        $second_data .= '&'.urlencode('vpc_Command').'='.urlencode(@$map['vpc_Command']);
        $second_data .= '&'.urlencode('vpc_Currency').'='.urlencode(@$map['vpc_Currency']);
        $second_data .= '&'.urlencode('vpc_Locale').'='.urlencode(@$map['vpc_Locale']);
        $second_data .= '&'.urlencode('vpc_MerchTxnRef').'='.urlencode(@$map['vpc_MerchTxnRef']);
        $second_data .= '&'.urlencode('vpc_Merchant').'='.urlencode(@$map['vpc_Merchant']);
        $second_data .= '&'.urlencode('vpc_OrderInfo').'='.urlencode(@$map['vpc_OrderInfo']);
        $second_data .= '&'.urlencode('vpc_Version').'='.urlencode(@$map['vpc_Version']);

        $posted_hash = strtoupper(hash_hmac('SHA256', $first_data, pack('H*',$secHashSec)));
        $received_hash = strtoupper(hash_hmac('SHA256', $second_data, pack('H*',$secHashSec)));

        if(@$map['vpc_Message'] == "Approved" && $posted_hash==$received_hash){

            $seconds = \Config::get('time/seconds');

            $amount = $amount/$mult;

            $receipt_string = "ReceiptNo: {$receiptNo} | TransactionNo: {$transactionNo} | Acquirer Response Code: {$acqResponseCode} | Bank Authorization ID: {$authorizeID} | Batch Number: {$batchNo} | Card Type: {$cardType} | Amount: {$amount} | Message: {$message}";

            $payment_data = (object)array('txnResponseCode'=>$txnResponseCode,
                                          'command'=>$map['vpc_Command'],
                                          'receipt_string'=>$receipt_string,
                                          'receiptNo'=>$receiptNo,
                                          'transactionNo'=>$transactionNo,
                                          'currency'=>$vpc_Currency,
                                          'orderInfo'=>$orderInfo);
            
            $returnResult = array('state'=>true,
                                  'payment_data'=>$payment_data,
                                  'message'=>'Approved');
            
        }else{
            $returnResult = array('state'=>false,
                                  'message'=>$message);
        }

        return $returnResult;
        
	}
    
    
    public static function paymentConfirmedEmail($user_ID){
        
            $userTable = new \User();
            $userTable->selectQuery("SELECT * FROM `app_users` WHERE `ID`=? AND `payment_state`='Confirmed' ORDER BY `ID` DESC",array($user_ID));
            $user_data = $userTable->first();
            
            $subject= 'Receipt: RICTA Payment';
        
            $currency = $user_data->currency;

            $messageText_0= 'Dear <b>'.$user_data->firstname.'</b>,';

            $messageText_1= 'Your payment has been successfully processed.';
            

            $messageText_2= 'Your Payment details are:';

            $messageText_3= 'Kindly email us on noc@rict.org.rw, if you have not received your receipt.';



            $message_body = '
                <body>
                    <div style="padding: 10px; margin-left: 10px margin-right: 10px">

                        <section>
                            <p style="margin-bottom: 25px; font-size: 13px;">
                                '.$messageText_0.'
                            </p>
                            <p style="font-size: 13px;">
                                '.$messageText_1.'
                            </p>
                            <p style="font-size: 13px;">
                                 '.$messageText_2.'
                            </p>

                            <p style="font-size: 13px;">
                                User ID: '.$user_data->ID.'<br>
                                Names: '.$user_data->firstname.'<br>
                                Price: '.$currency.' '.$user_data->amount.'<br>
                                Payment Receipt: <a href="'.DN.'/receipt-single/'.$user_data->token.'"> [Click here to view your Receipt]</a>
                            </p>
                            <p style="font-size: 13px;">
                                 '.$messageText_3.'
                            </p>
                            <p style="font-size: 13px;">
                                <b>Stay connected</b> <br>
                                <b>Twitter / Facebook:</b> RICTA <br>
                                <b>Connect with our official tag:</b> #rw<br>
                                <b>Youtube:</b> ricta<br>
                            </p>
                            <br>
                        </section>
                        <div style="font-size: 13px; padding: 0px; color: #222; position: relative">
                            <div style="background: #fff;text-align: left; color: #222; border-top: 1px solid #ddd; padding: 10px 5px">
                                Regards,<br><br>

                                RICTA Team<br>
                                E:  noc@ricta.org.rw<br>
                                T:  + 250 788 424 148<br>
                                <a href="'.DN.'/tcs">Terms & Conditions</a> | 
                                <a href="'.DN.'/privacy">Privacy Policy</a>
                            </div>
                        </div>
                    </div>
                </body>
            ';

            $message_alt = $messageText_0.' '.$messageText_1.' '.$messageText_2;

            $contactDetails['from_email'] = 'noc@ricta.org.rw';
            $contactDetails['from_names'] = 'RICTA';
            $contactDetails['to_email'] = $user_data->email;

            $contactDetails['attach'] = false;

            $email_status = Functions::smartMailer($contactDetails,$subject,$message_body,$message_alt);

        return true;
    }

    public static function paymentCancelledEmail($memberIDs){
        
        foreach($memberIDs as $member_reg_ID){
        
            $userTable = new \User();
            $userTable->selectQuery("SELECT * FROM `app_users` WHERE `ID`=? AND `payment_state`='Confirmed' ORDER BY `ID` DESC",array($user_ID));
            $user_data = $userTable->first();
            
            $subject= 'Payment: Decline';
        
            $currency = $user_data->currency;
            // $currency = 'RWF';
            print_r($currency);

            $messageText_0= 'Dear <b>'.$user_data->firstname.'</b>,';

            $messageText_1= 'It appears that your have cancelled your card transaction mid-way through the process.';
            
            $messageText_2= 'Your Payment details are:';

            $messageText_3= 'Kindly email us on noc@rict.org.rw, if you have a problem';



            $message_body = '
                <body>
                    <div style="padding: 10px; margin-left: 10px margin-right: 10px">

                        <section>
                            <p style="margin-bottom: 25px; font-size: 13px;">
                                '.$messageText_0.'
                            </p>
                            <p style="font-size: 13px;">
                                '.$messageText_1.'
                            </p>
                            <p style="font-size: 13px;">
                                 '.$messageText_2.'
                            </p>

                            <p style="font-size: 13px;">
                                Registration ID: '.$user_data->code.'<br>
                                Names: '.$user_data->firstname.'<br>
                                Price: '.$currency.' '.$user_data->amount.'<br>
                            </p>
                            <p style="font-size: 13px;">
                                 '.$messageText_3.'
                            </p>
                            <p style="font-size: 13px;">
                                <b>Stay connected</b> <br>
                                <b>Twitter / Facebook:</b> RICTA <br>
                                <b>Connect with our official tag:</b> #rw<br>
                                <b>Youtube:</b> ricta<br>
                            </p>
                            <br>
                        </section>
                        <div style="font-size: 13px; padding: 0px; color: #222; position: relative">
                            <div style="background: #fff;text-align: left; color: #222; border-top: 1px solid #ddd; padding: 10px 5px">
                                Regards,<br><br>

                                RICTA Team<br>
                                E:  noc@ricta.org.rw<br>
                                T:  + 250 788 424 148<br>
                                <a href="'.DN.'/tcs">Terms & Conditions</a> | 
                                <a href="'.DN.'/privacy">Privacy Policy</a>
                            </div>
                        </div>
                    </div>
                </body>
            ';

            $message_alt = $messageText_0.' '.$messageText_1.' '.$messageText_2;

            $contactDetails['from_email'] = 'noc@ricta.org.rw';
            $contactDetails['from_names'] = 'RICTA';
            $contactDetails['to_email'] = $user_data->email;

            $contactDetails['attach'] = false;

            $email_status = Functions::smartMailer($contactDetails,$subject,$message_body,$message_alt);

        }
        return true;
    }



    public static function bkPayment($value='')
    {
        $diagnoArray[0] = 'NO_ERRORS';
        $validate = new \Validate();
        $prfx = 'pay-';
        foreach($_POST as $index=>$val){
            $ar = explode($prfx,$index);
            if(count($ar)){
                $_SIGNUP[end($ar)] = $val;
            }
        }

        $str = new \Str();

        // $validate_array = array();
        // $validate_array_0 = array();

        $validation = $validate->check($_SIGNUP, array(
            'currency' => array(
                'name' => 'Currency',
                'string' => true,
                'required' => true,
                'min' => 2
            ),
            'amount' => array(
                'name' => 'Your Names',
                'required' => true
            )
        ));

        // $validate_array = array_merge($validate_array_0);

        // $validation = $validate->check($_SUBMIT, $validate_array);

        if($validation->passed()){

            $amount= (@$_POST['pay-amount']);
            $currency= (@$_POST['pay-currency']);
            $admin_ID = $str->data_in(@$_SUBMIT['admin_ID']);

            echo $amount;
            echo $currency;
            // $amount = 1;
            // $currency = 'USD';
            $orderInfo = 'ORDER34525';


            // active
            // $accountData = array(
            //     'merchant_id' => 'BOK000017',
            //     'access_code' => '6E1D4213',
            //     'secret'      => '64D39353B699D231D047AF7585A56E64'
            // );

            //test
            $accountData = array(
                'merchant_id' => 'TESTBOK000017',
                'access_code' => '9E7C9D4E',
                'secret'      => '1C57A53FDDDE4B812AAA452A10FC8545'
            );

            // multi currency

            if($currency=="RWF"){
                // $_PDT['vpc_Currency']=646;
                $mult = 1;
            }elseif($currency=="USD"){
                // $_PDT['vpc_Currency']=840;
                $mult = 100;
            }
            /**
             * Query data..
             */
            $queryData = array(
                'vpc_AccessCode' => $accountData['access_code'],
                'vpc_Merchant' => $accountData['merchant_id'],

                'vpc_Amount' => ($amount * $mult), // Multiplying by 100 to convert to the smallest unit
                'vpc_OrderInfo' => $orderInfo,

                'vpc_MerchTxnRef' => Payment::generateMerchTxnRef(), // See functions.php file

                'vpc_Command' => 'pay',
                'vpc_Currency' => $currency,
                'vpc_Locale' => 'en',
                'vpc_Version' => 1,
                'vpc_ReturnURL' => (DN.'/ricta/company/users/response'),

                'vpc_SecureHashType' => 'SHA256'
            );

            // Add secure secret after hashing
            $queryData['vpc_SecureHash'] = Payment::generateSecureHash($accountData['secret'], $queryData); // See functions.php file

            // 
            $migsUrl = 'https://migs.mastercard.com.au/vpcpay?'.http_build_query($queryData);

            // Redirect to the bank website to continue the 
            header("Location: " . $migsUrl);
        }
        
    }


    
}
?>