<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 10/12/18
 * Time: 16.31
 */


require_once "RiferimentoFase.php";

class DatiSal extends XmlBodyClass {

    public $riferimentoFase;

    public function __construct(RiferimentoFase $riferimentoFase) {
        $this->riferimentoFase = $riferimentoFase;
    }

    public function addToXml(SimpleXMLElement $xml) {
        $this->riferimentoFase->addToXml($xml);
    }


}