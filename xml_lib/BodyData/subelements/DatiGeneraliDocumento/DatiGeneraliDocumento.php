<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 08/12/18
 * Time: 15.19
 */


//require_once "../../XmlBodyClass.php";

require_once 'utils/TipoDocumento.php';
require_once 'utils/DatiRitenuta.php';
require_once 'utils/DatiBollo.php';
require_once 'utils/DatiCassaPrevidenziale.php';
require_once 'utils/ScontoMaggiorazione.php';
require_once 'utils/Art73.php';

class DatiGeneraliDocumento extends XmlBodyClass {

    public $tipoDocumento;
    public $divisa;
    public $data;
    public $numero;
    public $datiRitenuta;       //optional
    public $datiBollo;      //optional
    public $datiCassaPrevidenziale;     //optional
    public $scontoMaggiorazione;        //optional
    public $importoTotaleDocumento;     //optional
    public $arrotondamento;     //optional
    public $causale;        //optional
    public $art73;      //optional

    public function __construct(TipoDocumento $tipoDocumento, $divisa, $data, $numero,
                                DatiRitenuta $datiRitenuta = null, DatiBollo $datiBollo = null,
                                DatiCassaPrevidenziale $datiCassaPrevidenziale = null,
                                ScontoMaggiorazione $scontoMaggiorazione = null, $importoTotaleDocumento = null,
                                $arrotondamento = null, $causale = null, Art73 $art73 = null) {
        $this->tipoDocumento = $tipoDocumento->type;
        $this->divisa = $divisa;
        $this->data = $data;
        $this->numero = $numero;
        $this->datiRitenuta = $datiRitenuta;
        $this->datiBollo = $datiBollo;
        $this->datiCassaPrevidenziale = $datiCassaPrevidenziale;
        $this->scontoMaggiorazione = $scontoMaggiorazione;
        $this->importoTotaleDocumento = $importoTotaleDocumento;
        $this->arrotondamento = $arrotondamento;
        $this->causale = $causale;
        $this->art73 = $art73 == null ? null : $art73->type;
    }


    public function addToXml(SimpleXMLElement $xml) {

        $xml->addChild('TipoDocumento', $this->tipoDocumento->type);
        $xml->addChild('Divisa', $this->divisa);
        $xml->addChild('Data', $this->data);
        $xml->addChild('Numero', $this->numero);
        //$xml->addChild('DatiBollo', $this->datiBollo);
		//$datiBolloXML = $xml->FatturaElettronicaBody->DatiGenerali->DatiGeneraliDocumento;
		//$this->datiBollo->addToXml($datiBolloXML->addChild('DatiBollo'));

		
        if ($this->datiRitenuta != null)
            $this->datiRitenuta->addToXml($xml->addChild('DatiRitenuta'));
        if ($this->datiBollo != null)
            $this->datiBollo->addToXml($xml->addChild('DatiBollo'));
        if ($this->datiCassaPrevidenziale != null)
            $this->datiCassaPrevidenziale->addToXml($xml->addChild('DatiCassaPrevidenziale'));
        if ($this->scontoMaggiorazione != null)
            $this->scontoMaggiorazione->addToXml($xml->addChild('ScontoMaggiorazione'));


        self::addIfNotNull($xml, 'ImportoTotaleDocumento', $this->importoTotaleDocumento);
        self::addIfNotNull($xml, 'Arrotondamento', $this->arrotondamento);
//        self::addIfNotNull($xml, 'Causale', $this->causale);
        self::addIfNotNull($xml, 'Art73', $this->art73);
    }




}