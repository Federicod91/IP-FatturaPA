<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 12/12/18
 * Time: 9.58
 */

require_once "XmlBodyClass.php";
require_once "subelements/DettaglioLinee/DettaglioLinee.php";
require_once "subelements/DatiRiepilogo/DatiRiepilogo.php";

class DatiBeniServizi extends XmlBodyClass {

    public $dettaglioLinee;
    public $datiRiepilogo;

    public function __construct(array $dettaglioLinee, DatiRiepilogo $datiRiepilogo) {
        $this->dettaglioLinee = $dettaglioLinee;
        $this->datiRiepilogo = $datiRiepilogo;
    }

    public function addToXml(SimpleXMLElement $xml) {
        $xml->FatturaElettronicaBody->addChild('DatiBeniServizi');
        foreach ($this->dettaglioLinee as $dettaglio_linea)
            $dettaglio_linea->addToXml($xml->FatturaElettronicaBody->DatiBeniServizi->addChild('DettaglioLinee'));
        $this->datiRiepilogo->addToXml($xml->FatturaElettronicaBody->DatiBeniServizi->addChild('DatiRiepilogo'));
    }
}