<?php
//============================================================+
// File name   : example_028.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 028 for TCPDF class
//               Changing page formats
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
 * @abstract TCPDF - Example: changing page formats
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('C:/xampp/htdocs/finance/application/libraries/tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Financial Statements');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(10, PDF_MARGIN_TOP, 10);

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

$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');

// set font
$pdf->SetFont('times', 'B', 16);



//PAGE 1
$pdf->AddPage('P', 'A4');
$pdf->Cell(0, 0, 'ABC Company', 0, 1, 'C');
$statementName = "Income Statement\n For Month Ending ".date("M Y")."\n\n";

$pdf->write(0, $statementName, '', 0, 'C', true, 0, false, false, 0);

$pdf->SetFont('times', '', 16);
$revenueTbl = '<table cellspacing="1" cellpadding="3" border="0">';
$revenueTbl .= "<tr><th><b>Revenues</b></th><th>$</th></tr>";
$revenuesCount = 0;
if(!empty($revenues)){
for($i = 0; $i< count($revenues); $i++){
    $account = json_decode($revenues[$i]);
    $revenuesCount += $account->value;
$revenueTbl .= '<tr style="text-align:center">';
$revenueTbl .='<td>'.$account->account;
$revenueTbl .= '</td>
<td>'.$account->value.'</td>
</tr>';
}
}
$revenueTbl .= '<hr><tr style="text-align:center"><td>Total Revenues</td><td>'.$revenuesCount.'</td></tr>';
$revenueTbl .= "</table>";

$pdf->writeHTML($revenueTbl, true, false, false, false, '');

$expenseTbl = '<table cellspacing="1" cellpadding="3" border="0">';
$expenseTbl .= "<tr><th><b>Expenses</b></th><th>$</th></tr>";
$expenseCount = 0;
if(!empty($expenses)){
for($i = 0; $i< count($expenses); $i++){
    $account = json_decode($expenses[$i]);
    $expenseCount += $account->value;
$expenseTbl .= '<tr style="text-align:center">';
$expenseTbl .='<td>'.$account->account;
$expenseTbl .= '</td>
<td>'.$account->value.'</td>
</tr>';
}
}
$expenseTbl .= '<hr><tr style="text-align:center"><td>Total Expenses</td><td>'.$expenseCount.'</td></tr>';
$expenseTbl .= "</table>";

$pdf->writeHTML($expenseTbl, true, false, false, false, '');

$net = '<table cellspacing="1" cellpadding="3" border="0">';
$net .= "<tr><th><b>Net Income</b></th>";
$netIncome = $revenuesCount - $expenseCount;
if($netIncome > 0)
$net .= '<td>$ </td><td>'.$netIncome.'</td></tr>';
else{
    $net .= '<td>$ </td><td>('.(-1*$netIncome).')</td></tr>';
}
$net .= "</table>";

$pdf->writeHTML($net, true, false, false, false, '');

//PAGE 2

$pdf->SetFont('times', 'B', 15);

$pdf->AddPage('P', 'A4');
$pdf->Cell(0, 0, 'ABC Company', 0, 1, 'C');

$statementName = "Owner Equity Statement\n For Month Ending ".date("M Y")."\n\n\n";

$pdf->write(0, $statementName, '', 0, 'C', true, 0, false, false, 0);

$pdf->SetFont('times', '', 15);

$equity = '<table cellspacing="1" cellpadding="3" border="0">';
$equity .= '<tr><th>Opening balance of Owner</th>';
$openingBal = 0;
$endingBal = 0;
if(!empty($OE)){
$opening = json_decode($OE[0]);
$openingBal += $opening->value;
}
$equity .= "<th>$ ".$openingBal."</th>";
$equity .= "</tr>";
$equity .= "<tr><th> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (1 ".date("M Y").")</th><th></th></tr>";
$equity .= "<tr><th>";
if($netIncome > 0)
$equity .= "Add";
else 
$equity .= "Less";
if($netIncome > 0 ){
    $equity .= ": Net Income</th><th>$ ".$netIncome."</th></tr>";
}
else
$equity .= ": Net Income</th><th>$ ".(-1*$netIncome)."</th></tr>";

$equity .= '<tr><th>Less:  Owner Withdrawl</th>';
if(!empty($OW)){
$withdrawl = json_decode($OW[0]);
$equity .= "<th>$ (".$withdrawl->value.")</th>";
$endingBal = $openingBal - $withdrawl->value;
}
else{
    $equity .= "<th>$ 0</th>";
    $endingBal = $openingBal;
}
$equity .= "</tr>";
$endingBal = $endingBal + $netIncome;
$equity .= '<hr><tr><td>Ending Balance of Owner</td><td>$ '.$endingBal.'</td></tr>';
$equity .= "<tr>
<th> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (".date("t M Y").")</th>
<th></th></tr>";
$equity .= "</table>";

$pdf->writeHTML($equity, true, false, false, false, '');

//PAGE 3
$pdf->SetFont('times', 'B', 15);

$pdf->AddPage('P', 'A4');
$pdf->Cell(0, 0, 'ABC Company', 0, 1, 'C');

$statementName = "Balance Sheet\n ".date("t M Y")."\n\n\n";

$pdf->write(0, $statementName, '', 0, 'C', true, 0, false, false, 0);

$pdf->SetFont('times', '', 15);

$assetCount = 0;
$liabilityCount = 0;
$asset = '<table cellspacing="1" cellpadding="3" border="0" class="assetsTable">';
$asset .= "<tr><th><b>Assets</b></th><th>$ </th><th><b>Liabilities</b></th><td>$</td></tr>";
for($i = 0; $i< count($assets); $i++){
    $l = array();
    $a = json_decode($assets[$i]);
    if(isset($liabilities[$i]))
    $l = json_decode($liabilities[$i]);
    $asset .= '<tr><td>'.$a->account.'</td><td>'.$a->value.'</td>';
    $assetCount += $a->value;
    if(!empty($l)){
    $asset .= '<td>'.$l->account.'</td><td>'.$l->value.'</td>';
    $liabilityCount += $l->value;
}
    $asset .= '</tr>';

}
for($i = 0; $i< count($Sassets); $i++){
    $a = json_decode($Sassets[$i]);
    $asset .= '<tr><td>'.$a->account.'</td><td>('.$a->value.')</td> </tr>';
    $assetCount -= $a->value;
}
$asset .= '<hr><tr><th>Total Assets</th><td>'.$assetCount.'</td>
<th>Total Liabilities</th><td>'.$liabilityCount.'</td></tr>';
$asset .='<tr><td></td></tr><tr><td></td></tr>';
$asset .= '<hr><tr><th><b>Total Assets</b></th><td>'.$assetCount.'
</td><th><b>Total Liabilities and Total Owner Equity</b></th><td>'.($liabilityCount+$endingBal).'</td></tr>';
$asset .= "</table>";

$pdf->writeHTML($asset, true, false, false, false, '');

// --- test backward editing ---


$pdf->setPage(1, true);
$pdf->SetY(50);

$pdf->setPage(2, true);
$pdf->SetY(50);

$pdf->setPage(3, true);
$pdf->SetY(50);

$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('FinancialStatements.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+