<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 08/12/18
 * Time: 18.04
 */
//require_once '../../../XmlBodyClass.php';


class ScontoMaggiorazione extends XmlBodyClass {

    public $tipo;
    public $percentuale;        //optional
    public $importo;        //optional

    public function __construct(TipoTipo $tipo, $percentuale = null, $importo = null) {
        $this->tipo = $tipo->type;
        $this->percentuale = $percentuale;
        $this->importo = $importo;
    }


    public function addToXml(SimpleXMLElement $xml) {
        $xml->addChild('Tipo', $this->tipo);
        self::addIfNotNull($xml, 'Percentuale', $this->percentuale);
        self::addIfNotNull($xml, 'Importo', $this->importo);
    }
}

class TipoTipo {

    const SCONTO = 'SC';
    const MAGGIORAZIONE = 'MG';

    public $type;
    public function __construct($type) {
        $this->type = $type;
    }
}