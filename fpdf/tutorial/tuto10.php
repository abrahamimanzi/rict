<?php
require('../fpdf.php');

class PDF extends FPDF{
    // Page header
    function Header(){
        // Logo
        $this->Image('holder_mail.jpg',55,0,100,23);
        // Line break
        $this->Ln(20);
    }

    // Page footer
    function Footer(){
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','B',20);   
        // Profile
        $this->SetFillColor(200,220,255);
        $this->SetTextColor(4,0,4,1);
        $this->Cell(0,10,"",0,0,'C');
    }
    
    function ChapterTitle($num, $label){
        // Arial 12
        $this->SetFont('Arial','',12);
        // Background color
        $this->SetFillColor(200,220,255);
        $this->SetTextColor(128,44);
        // Title
        $this->Cell(0,6,"Chapter $num : $label",0,1,'L',true);
        // Line break
        $this->Ln(4);
    }
    function ProfileName($label,$num){
        // Arial 12
        $this->SetFont('Arial','B',17);
        // Background color
        $this->SetFillColor(200,220,255);
        $this->SetTextColor(244,120,34,1);
        // Title
        $this->Cell(0,10,$label,0,0,'C');
        $this->Ln(11);
        $this->SetFont('Arial','B',10);
        $this->SetTextColor(82,84,86);
        $this->Cell(0,10,$num,0,0,'C');
    }
    
    function SetBottom($text){
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        
        // Colors of frame, background and text
        $this->SetDrawColor(244,120,34,1);
        $this->SetTextColor(230,20,20,20);
        // Thickness of frame (1 mm)
        $this->SetLineWidth(0.3);
      
        $this->Cell(100);
        $this->Ln(13);
	    $this->Cell(45);
        $this->SetFillColor(237,237,237);
        $this->SetTextColor(30,81,164);
        // Title
        $this->Cell(100,15,$text,0,0,'C',true);
        // Line break
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();


$pdf->Cell(45);
$pdf->SetFillColor(255,255,255);
$pdf->Cell(100,5,'',0,0,'C',true);

// Profile
$pdf->Image('profile.jpg',85,30,40);

$pdf->Ln(45);
$pdf->SetFont('Arial','B',15);
$pdf->SetFillColor(230,230,0,10);

$pdf->ProfileName('Serge Karim','TAS-GOL-8932');
$pdf->SetBottom('Delegate');



$pdf->Output();
?>
