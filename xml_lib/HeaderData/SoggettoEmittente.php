<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 08/12/18
 * Time: 13.06
 */

require_once "XmlHeaderComponent.php";

class SoggettoEmittente extends XmlHeaderComponent {
    public $soggettoEmittente;

    public function __construct($soggettoEmittente) {
        $this->soggettoEmittente = $soggettoEmittente;
    }

    const CESSIONARIO_COMMITTENTE = 'CC';
    const SOGGETTO_TERZO = 'TZ';

    public function addToXml(SimpleXMLElement $xml) {
        if ($this != null) {
            $xml->FatturaElettronicaHeader->addChild('SoggettoEmittente', $this->soggettoEmittente);
        }
    }
}