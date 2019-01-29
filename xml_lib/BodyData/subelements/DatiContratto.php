<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 10/12/18
 * Time: 12.15
 */

require_once "DatiDocumentiCorrelatiType.php";

class DatiContratto extends XmlBodyClass {

    public $data;

    public function __construct(DatiDocumentiCorrelatiType $data) {
        $this->data = $data;
    }

    public function addToXml(SimpleXMLElement $xml) {
        $this->data->addToXml($xml);
    }
}