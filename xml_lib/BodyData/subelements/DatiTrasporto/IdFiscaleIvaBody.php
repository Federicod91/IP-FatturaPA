<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 11/12/18
 * Time: 10.34
 */

class IdFiscaleIvaBody extends XmlBodyClass {

    public $idPaese;
    public $idCodice;

    public function __construct($idPaese, $idCodice) {
        $this->idPaese = $idPaese;
        $this->idCodice = $idCodice;
    }

    public function addToXml(SimpleXMLElement $xml) {
        $xml->addChild('IdPaese', $this->idPaese);
        $xml->addChild('IdCodice', $this->idCodice);
    }
}