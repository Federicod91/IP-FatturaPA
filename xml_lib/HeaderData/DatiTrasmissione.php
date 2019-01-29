<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 05/12/18
 * Time: 16.43
 */

require_once "XmlHeaderComponent.php";

class DatiTrasmissione extends XmlHeaderComponent{
    public $IdTrasmittente = null;
    public $ProgressivoInvio = null;
    public $FormatoTrasmissione = null;
    public $CodiceDestinatario = null;
    public $ContattiTrasmittente = null;
    public $PECDestinatario = null;

    public function __construct(IdTrasmittenteClass $IdTrasmittente, $ProgressivoInvio, $FormatoTrasmissione,
                                $CodiceDestinatario, ContattiTrasmittenteClass $ContattiTrasmittente = null,
                                $PECDestinatario = null) {
        $this->IdTrasmittente = $IdTrasmittente;
        $this->ProgressivoInvio = $ProgressivoInvio;
        $this->FormatoTrasmissione = $FormatoTrasmissione;
        $this->CodiceDestinatario = $CodiceDestinatario;
        $this->ContattiTrasmittente = $ContattiTrasmittente;
        $this->PECDestinatario = $PECDestinatario;
    }


    public function addToXml(SimpleXMLElement $xml) {
        if (!isset($xml->FatturaElettronicaHeader->DatiTrasmissione))
            $xml->FatturaElettronicaHeader->addChild('DatiTrasmissione');
        $datiTrasmissioneXML = $xml->FatturaElettronicaHeader->DatiTrasmissione;

        $datiTrasmissioneXML->addChild('IdTrasmittente');
        $datiTrasmissioneXML->IdTrasmittente->addChild('IdPaese', $this->IdTrasmittente->IdPaese);
        $datiTrasmissioneXML->IdTrasmittente->addChild('IdCodice', $this->IdTrasmittente->IdCodice);

        $datiTrasmissioneXML->addChild('ProgressivoInvio', $this->ProgressivoInvio);

        $datiTrasmissioneXML->addChild('FormatoTrasmissione', $this->FormatoTrasmissione);

        $datiTrasmissioneXML->addChild('CodiceDestinatario', $this->CodiceDestinatario);
	
        $datiTrasmissioneXML->addChild('PECDestinatario', $this->PECDestinatario);

        /*if ($this->ContattiTrasmittente != null) {
            $datiTrasmissioneXML->addChild('ContattiTrasmittente');
            $datiTrasmissioneXML->ContattiTrasmittente->addChild('Telefono', $this->ContattiTrasmittente->Telefono);
            $datiTrasmissioneXML->ContattiTrasmittente->addChild('Email', $this->ContattiTrasmittente->Email);
        }*/

        
    }
}

class IdTrasmittenteClass {
    public function __construct($IdPaese, $IdCodice) {
        $this->IdPaese = $IdPaese;
        $this->IdCodice = $IdCodice;
    }

    public $IdPaese;
    public $IdCodice;
}

class ContattiTrasmittenteClass {
    public $Telefono;
    public $Email;

    public function __construct($Telefono = null, $Email = null) {
        $this->Telefono = $Telefono;
        $this->Email = $Email;
    }
}

class FormatoTrasmissioneClass {
    const FPR12 = "FPR12";
}


//esempio costruttore
//$d = new DatiTrasmissione(
//    new IdTrasmittenteClass("IT", "culotette"),
//    1,
//    FormatoTrasmissioneClass::FPR12,
//    "diocanecane",
//    new ContattiTrasmittenteClass("3484655214", "dio.boia@mosconi.org"),
//    "shamalaya"
//);
//
//var_dump($d);