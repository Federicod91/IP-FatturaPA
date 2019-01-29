<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 10/12/18
 * Time: 16.55
 */

class DatiTrasporto extends XmlBodyClass {

    public $datiAnagraficiVettore;      //optional
    public $mezzoTrasporto;     //optional
    public $causaleTrasporto;       //optional
    public $numeroColli;        //optional
    public $descrizione;        //optional
    public $unitaMisuraPeso;        //optional
    public $pesoLordo;      //optional
    public $pesoNetto;      //optional
    public $dataOraRitiro;      //optional
    public $dataInizioTrasporto;        //optional
    public $tipoResa;       //optional
    public $indirizzoResa;      //optional
    public $dataOraConsegna;        //optional

    public function __construct(DatiAnagraficiVettore $datiAnagraficiVettore = null, $mezzoTrasporto = null, $causaleTrasporto = null,
                                $numeroColli = null, $descrizione = null, $unitaMisuraPeso = null,
                                $pesoLordo = null, $pesoNetto = null, $dataOraRitiro = null,
                                $dataInizioTrasporto = null, $tipoResa = null,
                                LuogoBody $indirizzoResa = null, $dataOraConsegna = null) {
        $this->datiAnagraficiVettore = $datiAnagraficiVettore;
        $this->mezzoTrasporto = $mezzoTrasporto;
        $this->causaleTrasporto = $causaleTrasporto;
        $this->numeroColli = $numeroColli;
        $this->descrizione = $descrizione;
        $this->unitaMisuraPeso = $unitaMisuraPeso;
        $this->pesoLordo = $pesoLordo;
        $this->pesoNetto = $pesoNetto;
        $this->dataOraRitiro = $dataOraRitiro;
        $this->dataInizioTrasporto = $dataInizioTrasporto;
        $this->tipoResa = $tipoResa;
        $this->indirizzoResa = $indirizzoResa;
        $this->dataOraConsegna = $dataOraConsegna;
    }

    public function addToXml(SimpleXMLElement $xml) {
        if ($this->datiAnagraficiVettore != null)
            $this->datiAnagraficiVettore->addToXml($xml->addChild('DatiAnagraficiVettore'));

        self::addIfNotNull($xml, 'MezzoTrasporto', $this->mezzoTrasporto);
        self::addIfNotNull($xml, 'CausaleTrasporto', $this->causaleTrasporto);
        self::addIfNotNull($xml, 'NumeroColli', $this->numeroColli);
        self::addIfNotNull($xml, 'Descrizione', $this->descrizione);
        self::addIfNotNull($xml, 'UnitaMisuraPeso', $this->unitaMisuraPeso);
        self::addIfNotNull($xml, 'PesoLordo', $this->pesoLordo);
        self::addIfNotNull($xml, 'PesoNetto', $this->pesoNetto);
        self::addIfNotNull($xml, 'DataOraRitiro', $this->dataOraRitiro);
        self::addIfNotNull($xml, 'DataInizioTrasporto', $this->dataInizioTrasporto);
        self::addIfNotNull($xml, 'TipoResa', $this->tipoResa);

        if ($this->indirizzoResa != null)
            $this->indirizzoResa->addToXml($xml->addChild('IndirizzoResa'));

        self::addIfNotNull($xml, 'DataOraConsegna', $this->dataOraConsegna);
    }
}