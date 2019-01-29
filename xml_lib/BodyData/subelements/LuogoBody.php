<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 11/12/18
 * Time: 10.48
 */

class LuogoBody extends XmlBodyClass {

    public $indirizzo;
    public $CAP;
    public $comune;
    public $nazione;
    public $numeroCivico;       //optional
    public $provincia;      //optional

    public function __construct($indirizzo,
                                $CAP,
                                $comune,
                                $nazione,
                                $numeroCivico = null,
                                $provincia = null) {
        $this->indirizzo = $indirizzo;
        $this->CAP = $CAP;
        $this->comune = $comune;
        $this->nazione = $nazione;
        $this->numeroCivico = $numeroCivico;
        $this->provincia = $provincia;
    }


    public function addToXml(SimpleXMLElement $xml) {
        $xml->addChild('Indirizzo', $this->indirizzo);
        $xml->addChild('CAP', $this->CAP);
        $xml->addChild('Comune', $this->comune);
        $xml->addChild('Nazione', $this->nazione);

        self::addIfNotNull($xml, 'NumeroCivico', $this->numeroCivico);
        self::addIfNotNull($xml, 'Provincia', $this->provincia);
    }
}