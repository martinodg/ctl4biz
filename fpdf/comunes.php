<?php
class PDF extends FPDF
{
    /** @var string */
    protected $logo;

    /** @var string */
    protected $direccion ;

    /** @var string */
    protected $codigoPostal ;

    /** @var string */
    protected $codigoFiscal ;

    /** @var string */
    protected $leyenda ;

    /** @var string */
    protected $monedaSimbolo ;

    /** @var ChangeLanguage */
    protected $lang;

    public function __construct($orientation = 'P', $unit = 'mm', $size = 'A4',$companyData = null, $traductor = null)
    {
        parent::__construct($orientation, $unit, $size);
        $this->logo = '../img/ctl4bizlogo.jpg';
        $this->direccion = 'Wolnosc Morza Sp.Z.O.O.';
        $this->codigoPostal = '8992887392';
        $this->codigoFiscal = '0000864503cc';
        $this->leyenda = 'Ctl4.biz is a division of Wolnosc Morza Sp.Z.O.O. Registered on the Polish Commertial Court.';
        $this->setCompanyData($companyData);
        $this->lang = $traductor;
    }

    public function setCompanyData($data = null )
    {
        if($data){
            $this->logo = $data['logo'];
            $this->direccion = $data['address'];
            $this->leyenda = $data['leyenda'];
            $this->codigoFiscal = $data['cod_fiscal'];
            $this->monedaSimbolo = $data['simbolo'];
            $this->codigoPostal = $data['zip_code'];
        }
    }


    //Cabecera de pagina
    function Header()
    {
        //Logo
        $this->Image($this->logo, 10, 8, 50, 50);
        $this->Ln(5);
    }

    //Pie de pgina
    function Footer()
    {
        $this->SetFont('Arial', '', 6);
        $this->SetY(-21);
        $this->Cell(0, 10, $this->direccion.' - '.$this->lang->t('cod_fiscal').' '.$this->codigoFiscal, 0, 0, 'C');
        $this->SetY(-18);
        $this->Cell(0, 10, html_entity_decode($this->leyenda), 0, 0, 'C');
        $this->SetY(-15);
        $this->Cell(0, 10, html_entity_decode($this->lang->t('cod_postal').' '.$this->codigoPostal), 0, 0, 'C');
        $this->SetY(-12);
        $this->Cell(0, 10, $this->lang->t('pagina') . $this->PageNo() . '', 0, 0, 'C');
    }

}
?>
