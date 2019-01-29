<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 10/12/18
 * Time: 16.32
 */

class RiferimentoFase extends XmlBodyClass {

    public $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function addToXml(SimpleXMLElement $xml) {
        $xml->addChild('RiferimentoFase', $this->data);
    }
}