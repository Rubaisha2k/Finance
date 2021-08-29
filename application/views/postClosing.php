<?php
//============================================================+
// File name   : example_003.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 003 for TCPDF class
//               Custom Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Custom Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('C:/xampp/htdocs/finance/application/libraries/tcpdf/tcpdf.php');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'tcpdf_logo.jpg';
        $this->Image($image_file, 10, 10, 20, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 15, 'ABC Company', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Trial Balance');
$pdf->SetSubject('Trial Balance');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', 'BI', 12);

// add a page
$pdf->AddPage();

// set some text to print
$txt = <<<EOD
Trial Balance


EOD;
$debit = 0;
$credit = 0;
// print a block of text using Write()
$pdf->write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
$tbl = '
<table cellspacing="0" cellpadding="1" border="1">
    <tr style="text-align:center; background-color:grey;">
    <th>Account Name</th>
    <th>Debit</th>
    <th>Credit</th>
    </tr>';
    for($i = 0; $i< count($assets); $i++){
        $account = json_decode($assets[$i]);
        $debit += $account->value;
$tbl .= '<tr style="text-align:center">';
$tbl .='<td>'.$account->account;
$tbl .= '</td>
<td>'.$account->value.'</td>
<td></td>
</tr>';
    }
    for($i = 0; $i< count($Sassets); $i++){
        $account = json_decode($Sassets[$i]);
        $tbl .= '<tr style="text-align:center">';
        $tbl .='<td>'.$account->account;
        $tbl .= '</td>
        <td></td>
        <td>'.$account->value.'</td>
        </tr>';
        $credit += $account->value;
    }
    for($i = 0; $i< count($liabilities); $i++){
        $account = json_decode($liabilities[$i]);
        $credit += $account->value;
$tbl .= '<tr style="text-align:center">';
$tbl .='<td>'.$account->account;
$tbl .= '</td>
<td></td>
<td>'.$account->value.'</td>
</tr>';
    }
    $OWamount = $expenseAmount = $revenueAmount = 0;
    for($i = 0; $i< count($OW); $i++){
        $account = json_decode($OW[$i]);
        $OWamount += $account->value;
    }
    for($i = 0; $i< count($expenses); $i++){
        $account = json_decode($expenses[$i]);
        $expenseAmount += $account->value;
    }
    for($i = 0; $i< count($revenues); $i++){
        $account = json_decode($revenues[$i]);
        $revenueAmount += $account->value;
    }
    $OEamount = $expenseAmount - $revenueAmount  + $OWamount;
    for($i = 0; $i< count($OE); $i++){
        $account = json_decode($OE[$i]);
        $OEamount += (-1)*$account->value;
    }
    $credit += (-1)*$OEamount;
    $tbl .= '<tr style="text-align:center">';
    $tbl .='<td>Owner Equity';
    $tbl .= '</td>
    <td></td>
    <td>'.((-1)*$OEamount).'</td>
    </tr>';
    

    $tbl .= '<tr><td colspan = "3"></td></tr><tr style="text-align:center"><td>Total</td>';
    $tbl .= '<td>'.$debit.'</td>';
    $tbl .= '<td>'.$credit.'</td>';
    $tbl .= '</tr>';

$tbl .= '</table>';

$pdf->writeHTML($tbl, true, false, false, false, '');



// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('trialBalance.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+