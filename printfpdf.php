<?php
include 'core/init.php';
require('fpdf/fpdf.php');


    // Get user_ID
    $token=(Input::get('id','get'));
    $GetUserID = new \PaymentResponse();
    $GetUserID->selectQuery("SELECT* FROM `payment_receive` WHERE `token`=? ORDER BY `ID` DESC LIMIT 1",array($token));
    
    if(!$GetUserID->count()){
        Redirect::to(DN.'/404'); 
    }
        
    $GetUserID_data = $GetUserID->first();
    
    $user_ID = $GetUserID_data->user_ID;
    $amount_total = $GetUserID_data->amount;
    $currency = $GetUserID_data->currency;
    $card_issue = $GetUserID_data->card_issue;
    $payment_date = $GetUserID_data->payment_date;
    $user_ID = $GetUserID_data->user_ID;
    $receipt_number = $GetUserID_data->receipt_number;
    $transaction_number = $GetUserID_data->transaction_number;
    $payment_rn = $GetUserID_data->payment_rn;
    $registrar = $GetUserID_data->registrar;
    $residence_country = $GetUserID_data->registrar;
    $residence_city = $GetUserID_data->registrar;
    $telephone = $GetUserID_data->registrar;
    $card_number = $GetUserID_data->card_number;

    // echo $user_ID;
    if(Input::checkInput('id','get','1')){
	    $participant_ID = Input::get('id','get');
	    $participantTable = new \User();
	    $participantTable->selectQuery("SELECT * FROM `app_users` WHERE `ID`=? ORDER BY `ID` DESC LIMIT 1",array($user_ID));
	    
	    if(!$participantTable->count()){
	        Redirect::to(DN.'/404'); 
	    }

    	$participant_data = $participantTable->first(); 

		class PDF extends FPDF
		{
		// Page header
			/*
			function Header()
			{
				// Logo
				// $this->Image('logo.png',10,6,30);
				// Arial bold 15
				$this->SetFont('Arial','B',15);
				// Move to the right
				$this->Cell(40);
				// Title
				$this->Cell(30,10,'Title',1,0,'C');
				// Line break
				$this->Ln(20);
			}
			*/

			// Page header
            function Header()
            {
                $this->Image(DN.'/img/tas-logo.png',30,40,150);
                // Arial bold 15
                $this->SetFont('Arial','B',15);
                
                $this->SetFont('Arial','',10);
                $this->Cell(0,15,'Smart Africa Secretariant',0,0,'R');
                $this->Cell(0,40,'Makuza Peace Plaza 9th Floor, Block C',0,0,'R');
                $this->Cell(0,65,'10 KN4 Avenue, Kigali, Rwanda',0,0,'R');
                $this->Cell(0,95,' www.transformafricasummit.org',0,0,'R');
                $this->Cell(0,125,'Tel: (+250) 732-301-014',0,0,'R');
                $this->Cell(0,150,'Email: enquiries@smartafrica.org',0,0,'R');
                // Move to the right
                $this->Cell(80);
                // Line break
                $this->Ln(90);
                $this->SetDrawColor(244,120,34);
                $this->Cell(0,0,'',1,1,'L');
                $this->Ln(30);
            }

            /*
			// Page footer
			function Footer()
			{
				// Position at 1.5 cm from bottom
				$this->SetY(-15);
				// Arial italic 8
				$this->SetFont('Arial','I',8);
				// Page number
				$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
			}
			*/
            // Page footer
            function Footer(){
                // Position at 1.5 cm from bottom
                $this->Image(DN.'/img/holder_email.jpg',0,720,600);
                
                $this->SetY(-40);
                $this->SetFont('Arial','',10);
                // Page number
                $this->Cell(0,10,'Page '.$this->PageNo().' of {nb}',0,0,'C');
            }
		}


        if ($card_issue == 'VC') {
            $card_issue = 'Visa Card';
        }else{
            $card_issue = 'MastrerCard';
        }

        /*
		// Instanciation of inherited class
		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Times','',12);
		for($i=1;$i<=40;$i++)
			$pdf->Cell(0,10,'Printing line number '.$i,0,1);
		$pdf->Output();
		*/

        
        // Instanciation of inherited class
        $pdf = new PDF('P','pt','a4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true,120);


        $pdf->SetY(160); 
        $pdf->SetFont('Arial','B',20);
        $pdf->Cell(0,0,'Receipt',0,0,'L');
        
        $pdf->SetY(185); 
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(0,0,Dates::get('d M Y, h:i:s A',$payment_date),0,2,'L');
        
        $pdf->SetY(215); 
        $pdf->SetFont('Arial','',13);
        $pdf->Cell(0,0,'Your Registration ID',0,0,'L');
        
        
        $pdf->SetY(230);
        $pdf->SetX(30);
        $pdf->SetFillColor('255','255','255');
        $pdf->SetDrawColor('200','200','200');
        $pdf->Cell(155,30,'',1,1,'L',1);
        
        $pdf->SetY(245); 
        $pdf->SetX(35);
        $pdf->SetFont('Arial','B',13);
        $pdf->Cell(0,0,$user_ID,0,0,'L');
        
        $pdf->SetY(225); 
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(0,-30,'Payment method: '.$card_issue,0,0,'R');
        $pdf->Cell(0,0,'Receipt #: '.$receipt_number,0,0,'R');
        $pdf->Cell(0,30,'Transaction #: '.$transaction_number,0,0,'R');
        $pdf->Cell(0,60,'Payment Reference #: '.$payment_rn,0,0,'R');
        
        
        $pdf->SetY(290);
        $pdf->SetX(20);
        $pdf->SetFillColor('240','240','240');
        $pdf->SetDrawColor('200','200','200');
        $pdf->Cell(555,105,'',1,1,'L',1);
        
        $pdf->SetY(310); 
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(0,0,'Bill to:',0,0,'L');
        
        $pdf->SetY(325);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(0,0,$registrar,0,0,'L');
        $pdf->SetY(342);
        // $pdf->Cell(0,0,$participant_data->residence_country.' / '.$participant_data->residence_city,0,0,'L');
        $pdf->Cell(0,0,$residence_country.' / '.$residence_city,0,0,'L');
        $pdf->SetY(358);
        // $pdf->Cell(0,0,$participant_data->telephone,0,0,'L');
        $pdf->Cell(0,0,$telephone,0,0,'L');
        
        $payment_info_name = trim($registrar);
        
        $pdf->SetY(310); 
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(0,0,'Payment Information',0,0,'R');
        $pdf->SetFont('Arial','',10);
        // $pdf->Cell(0,32,$payment_info_name,0,0,'R');
        $pdf->Cell(0,32,'Card number: '.$card_number,0,0,'R');
        $pdf->Cell(0,64,'Paid: '.$currency.' '.number_format($amount_total),0,0,'R');
      
        
        $start_pt = 420;
        $pdf->SetY($start_pt); 
        $pdf->SetFont('Arial','B',10);
        
        $pdf->Cell(0,0,'#',0,0,'L');
        $pdf->SetFont('Arial','B',10);
        
        $pdf->SetY($start_pt); 
        $pdf->Cell(50);
        $pdf->Cell(50,0,'Registration ID',0,0,'C');
        
        $pdf->SetY($start_pt); 
        $pdf->Cell(150);
        $pdf->Cell(50,0,'Item',0,0,'C');
        
        $pdf->SetY($start_pt); 
        $pdf->Cell(245);
        $pdf->Cell(80,0,'Unit Price',0,0,'C');
        
        $pdf->SetY($start_pt); 
        $pdf->Cell(420);
        $pdf->Cell(0,0,'Total',0,0,'R');
         
        
        $pdf->SetY($start_pt+10); 
        $pdf->SetDrawColor('200','200','200');
        $pdf->Cell(0,0,'',1,1,'L');

        $items_array = array();
        foreach($GetUserID->data() as $GetUserID_data){
            $items_array[] = array('item'=>'Reacherge account',
                                    'reg_code'=>$GetUserID_data->user_ID,
                                    'unit_price'=>$currency.' '.number_format($GetUserID_data->amount),
                                    // 'discount'=>$participant_data->discount,
                                    'total'=>$currency.' '.number_format($GetUserID_data->amount));
        }
        
        $item_number = 0;
        
        for($i = 0;$i<count($items_array);$i++){
            $item_number++;
            $this_row_data = (object)$items_array[$i];

            $pdf->SetFont('Arial','',10);
            $pdf->Cell(0,25,$item_number,0,1,'L');

            $pdf->Ln(-25);
            $pdf->SetX(66);
            $pdf->Cell(40,25,$this_row_data->reg_code,0,1,'L');

            $pdf->Ln(-25);
            $pdf->SetX(185);
            $pdf->Cell(40,25,$this_row_data->item,0,1,'C');

            $pdf->Ln(-25);
            $pdf->SetX(270);
            $pdf->Cell(90,25,$this_row_data->unit_price,0,1,'C');

            // $pdf->Ln(-25);
            // $pdf->SetX(370);
            // $pdf->Cell(90,25,$this_row_data->discount.' %',0,1,'C');

            $pdf->Ln(-25);
            $pdf->SetX(480);
            $pdf->Cell(90,25,$this_row_data->total,0,1,'R');
        
        	// End Item
        
	        $pdf->SetFont('Arial','B',10);
	        $pdf->Cell(0,35,'Total: '.$currency.' '.number_format($amount_total),0,0,'R'); 
	        $pdf->SetFont('Arial','',10);
	        // $pdf->Cell(0,67,'VAT (18%) Inclusive',0,0,'R');

            $pdf->Cell(0,0,'',1,1,'L');
        }   



		$pdf->Output();
        
	}
?>

<html>
    <head><title>Invoice</title></head>
    <body>
    </body>
</html>
