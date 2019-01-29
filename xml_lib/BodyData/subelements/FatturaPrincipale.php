<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 12/12/18
 * Time: 9.52
 */

class FatturaPrincipale extends XmlBodyClass {

    public $numeroFatturaPrincipale;
    public $dataFatturaPrincipale;

    public function __construct($numeroFatturaPrincipale, $dataFatturaPrincipale) {
        $this->numeroFatturaPrincipale = $numeroFatturaPrincipale;
        $this->dataFatturaPrincipale = $dataFatturaPrincipale;
    }

    public function addToXml(SimpleXMLElement $xml) {
        $xml->addChild('NumeroFatturaPrincipale', $this->numeroFatturaPrincipale);
        $xml->addChild('DataFatturaPrincipale', $this->dataFatturaPrincipale);
    }

}