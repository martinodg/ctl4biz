<?
class PDF extends FPDF
{
//Cabecera de pgina
function Header()
{

    //Logo
    $this->Image('../img/ctl4bizlogo.jpg',10,8,50,50); 
    $this->Ln(5);	
}

//Pie de pgina
function Footer()
{
  
    $this->SetFont('Arial','',6);
	$this->SetY(-21);
	$this->Cell(0,10,'Wolnosc Morza Sp.Z.O.O. - NIP 8992887392',0,0,'C');
	$this->SetY(-18);
	$this->Cell(0,10,html_entity_decode('Ctl4.biz is a division of Wolnosc Morza Sp.Z.O.O. Registered on the Polish Commertial Court.'),0,0,'C');
	$this->SetY(-15);
	$this->Cell(0,10,html_entity_decode('KRS Number 0000864503'),0,0,'C');
	$this->SetY(-12);
    $this->Cell(0,10,'Pagina '.$this->PageNo().'',0,0,'C');	
}

}
?>
