<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 12/12/18
 * Time: 10.07
 */

class CodiceArticolo extends XmlBodyClass {

    public $codiceTipo;
    public $codiceValore;

    /**
     * CodiceArticolo constructor.
     * @param $codiceTipo
     * @param $codiceValore
     */
    public function __construct($codiceTipo, $codiceValore) {
        $this->codiceTipo = $codiceTipo;
        $this->codiceValore = $codiceValore;
    }


    public function addToXml(SimpleXMLElement $xml) {
        $xml->addChild('CodiceTipo', $this->codiceTipo);
        $xml->addChild('CodiceValore', $this->codiceValore);
    }
}