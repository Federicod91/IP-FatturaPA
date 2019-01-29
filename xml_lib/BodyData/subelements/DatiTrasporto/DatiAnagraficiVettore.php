<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 10/12/18
 * Time: 17.00
 */

require_once "IdFiscaleIvaBody.php";
require_once "AnagraficaBody.php";

class DatiAnagraficiVettore extends XmlBodyClass {

    public $idFiscaleIVA;
    public $anagrafica;
    public $codiceFiscale;
    public $numeroLicenzaGuida;


    public function __construct(IdFiscaleIvaBody $idFiscaleIVA,
                                AnagraficaBody $anagrafica,
                                $CodiceFiscale = null,
                                $numeroLicenzaGuida = null) {
        $this->idFiscaleIVA = $idFiscaleIVA;
        $this->anagrafica = $anagrafica;
        $this->codiceFiscale = $CodiceFiscale;
        $this->numeroLicenzaGuida = $numeroLicenzaGuida;
    }

    public function addToXml(SimpleXMLElement $xml) {
        $this->idFiscaleIVA->addToXml($xml->addChild('IdFiscaleIVA'));
        $this->anagrafica->addToXml($xml->addChild('Anagrafica'));
        self::addIfNotNull($xml, 'CodiceFiscale', $this->codiceFiscale);
        self::addIfNotNull($xml, 'NumeroLicenzaGuida', $this->numeroLicenzaGuida);
    }
}