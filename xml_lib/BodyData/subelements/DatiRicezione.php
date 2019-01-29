<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 10/12/18
 * Time: 12.28
 */

require_once "DatiDocumentiCorrelatiType.php";

class DatiRicezione extends XmlBodyClass {
    public $data;

    public function __construct(DatiDocumentiCorrelatiType $data) {
        $this->data = $data;
    }

    public function addToXml(SimpleXMLElement $xml) {
        $this->data->addToXml($xml);
    }

}