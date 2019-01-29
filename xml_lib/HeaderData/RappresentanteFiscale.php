<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 06/12/18
 * Time: 11.59
 */


require_once "subelements/DatiAnagrafici/DatiAnagraficiSimplified.php";
require_once "XmlHeaderComponent.php";

class RappresentanteFiscale extends XmlHeaderComponent {
    public $DatiAnagrafici;

    public function __construct(DatiAnagraficiSimplified $DatiAnagrafici) {
        $this->DatiAnagrafici = $DatiAnagrafici;
    }

    public function addToXml(SimpleXMLElement $xml) {
        if ($this != null) {
            $datiAnagraficiXML = $xml->FatturaElettronicaHeader->addChild('RappresentanteFiscale')->addChild('DatiAnagrafici');

            $datiAnagrafici = $this->DatiAnagrafici;
            self::addDatiAnagraficiSimplified($datiAnagraficiXML, $datiAnagrafici);
        }
    }
}

