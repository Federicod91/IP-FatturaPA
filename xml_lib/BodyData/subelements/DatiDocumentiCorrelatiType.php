<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 10/12/18
 * Time: 12.04
 */

//require_once "../XmlBodyClass.php";

class DatiDocumentiCorrelatiType extends XmlBodyClass {

    public $idDocumento;
    public $riferimentoNumeroLinea;
    public $data;
    public $numItem;
    public $codiceCommessaConvenzione;
    public $codiceCUP;
    public $codiceCIG;

    public function __construct($idDocumento, $riferimentoNumeroLinea = null, $data = null,
                                $numItem = null, $codiceCommessaConvenzione = null,
                                $codiceCUP = null, $codiceCIG = null) {
        $this->idDocumento = $idDocumento;
        $this->riferimentoNumeroLinea = $riferimentoNumeroLinea;
        $this->data = $data;
        $this->numItem = $numItem;
        $this->codiceCommessaConvenzione = $codiceCommessaConvenzione;
        $this->codiceCUP = $codiceCUP;
        $this->codiceCIG = $codiceCIG;
    }


    public function addToXml(SimpleXMLElement $xml) {
        $xml->addChild('IdDocumento', $this->idDocumento);
        self::addIfNotNull($xml,'RiferimentoNumeroLinea', $this->riferimentoNumeroLinea);
        self::addIfNotNull($xml,'Data', $this->data);
        self::addIfNotNull($xml,'NumItem', $this->numItem);
        self::addIfNotNull($xml,'CodiceCommessaConvenzione', $this->codiceCommessaConvenzione);
        self::addIfNotNull($xml,'CodiceCUP', $this->codiceCUP);
        self::addIfNotNull($xml,'CodiceCIG', $this->codiceCIG);
    }
}