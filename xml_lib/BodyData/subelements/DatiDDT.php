<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 10/12/18
 * Time: 16.36
 */

class DatiDDT extends XmlBodyClass {

    public $numeroDDT;
    public $dataDDT;
    public $riferimentoNumeroLinea; //optional

    public function __construct($numeroDDT, $dataDDT, $riferimentoNumeroLinea = null) {
        $this->numeroDDT = $numeroDDT;
        $this->dataDDT = $dataDDT;
        $this->riferimentoNumeroLinea = $riferimentoNumeroLinea;
    }

    public function addToXml(SimpleXMLElement $xml) {
        $xml->addChild('NumeroDDT', $this->numeroDDT);
        $xml->addChild('DataDDT', $this->dataDDT);

        self::addIfNotNull($xml, 'RiferimentoNumeroLinea', $this->riferimentoNumeroLinea);
    }
}