<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 12/12/18
 * Time: 10.08
 */

class AltriDatiGestionali extends XmlBodyClass {

    public $tipoDato;
    public $riferimentoTesto;
    public $riferimentoNumero;
    public $riferimentoData;

    /**
     * AltriDatiGestionali constructor.
     * @param $tipoDato
     * @param $riferimentoTesto
     * @param $riferimentoNumero
     * @param $riferimentoData
     */
    public function __construct($tipoDato, $riferimentoTesto = null,
                                $riferimentoNumero = null, $riferimentoData = null)
    {
        $this->tipoDato = $tipoDato;
        $this->riferimentoTesto = $riferimentoTesto;
        $this->riferimentoNumero = $riferimentoNumero;
        $this->riferimentoData = $riferimentoData;
    }


    public function addToXml(SimpleXMLElement $xml) {
        $xml->addChild('TipoDato', $this->tipoDato);
        self::addIfNotNull($xml,'RiferimentoTesto', $this->riferimentoTesto);
        self::addIfNotNull($xml,'RiferimentoNumero', $this->riferimentoNumero);
        self::addIfNotNull($xml,'RiferimentoData', $this->riferimentoData);
    }
}