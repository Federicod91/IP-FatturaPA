<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 11/12/18
 * Time: 10.39
 */

class AnagraficaBody extends XmlBodyClass {

    public $denominazione;
    public $nome;
    public $cognome;
    public $titolo;
    public $codEORI;

    private function __construct($denominazione,
                                $nome,
                                $cognome,
                                $titolo = null,
                                $codEORI = null) {
        $this->denominazione = $denominazione;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->titolo = $titolo;
        $this->codEORI = $codEORI;
    }

    public static function getFromDenominazione($denominazione, $titolo = null, $codEORI = null) {
        return new AnagraficaBody($denominazione, null, null, $titolo, $codEORI);
    }

    public static function getFromNomeCognome($nome, $cognome, $titolo = null, $codEORI = null) {
        return new AnagraficaBody(null, $nome, $cognome, $titolo, $codEORI);
    }


    public function addToXml(SimpleXMLElement $xml) {
        if ($this->denominazione != null) {
            $xml->addChild('Denominazione', $this->denominazione);
        } else {
            $xml->addChild('Nome', $this->nome);
            $xml->addChild('Cognome', $this->cognome);
        }

        self::addIfNotNull($xml, 'Titolo', $this->titolo);
        self::addIfNotNull($xml, 'CodEORI', $this->codEORI);
    }
}