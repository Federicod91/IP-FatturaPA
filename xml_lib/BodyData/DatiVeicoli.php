<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 12/12/18
 * Time: 10.46
 */

require_once 'XmlBodyClass.php';

class DatiVeicoli extends XmlBodyClass {

    public $data;
    public $totalePercorso;

    /**
     * DatiVeicoli constructor.
     * @param $data
     * @param $totalePercorso
     */
    public function __construct($data, $totalePercorso)
    {
        $this->data = $data;
        $this->totalePercorso = $totalePercorso;
    }

    public function addToXml(SimpleXMLElement $xml) {
        $element = $xml->FatturaElettronicaBody->addChild('DatiVeicoli');
        $element->addChild('Data', $this->data);
        $element->addChild('TotalePercorso', $this->totalePercorso);
    }
}