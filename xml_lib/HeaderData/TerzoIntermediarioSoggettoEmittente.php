<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 08/12/18
 * Time: 12.57
 */

require_once "subelements/DatiAnagrafici/DatiAnagraficiSimplified.php";
require_once "XmlHeaderComponent.php";

class TerzoIntermediarioSoggettoEmittente extends XmlHeaderComponent {
    public $datiAnagrafici;

    public function __construct(DatiAnagraficiSimplified $datiAnagraficiSimplified) {
        $this->datiAnagrafici = $datiAnagraficiSimplified;
    }

    public function addToXml(SimpleXMLElement $xml) {
        if ($this != null) {
            $terzoIntermediarioSoggettoEmittenteXML = $xml->FatturaElettronicaHeader->addChild('TerzoIntermediarioSoggettoEmittente');

            self::addDatiAnagraficiSimplified(
                $terzoIntermediarioSoggettoEmittenteXML->addChild('DatiAnagrafici'),
                $this->datiAnagrafici
            );
        }
    }
}