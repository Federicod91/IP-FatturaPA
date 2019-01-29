<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 08/12/18
 * Time: 17.29
 */

//require_once "../../../XmlBodyClass.php";

class DatiRitenuta extends XmlBodyClass {



    public $tipoRitenuta;
    public $importoRitenuta;
    public $aliquotaRitenuta;
    public $causalePagamento;

    public function __construct(TipoRitenuta $tipoRitenuta, $importoRitenuta,
                                $aliquotaRitenuta, $causalePagamento) {
        $this->tipoRitenuta = $tipoRitenuta->type;
        $this->importoRitenuta = $importoRitenuta;
        $this->aliquotaRitenuta = $aliquotaRitenuta;
        $this->causalePagamento = $causalePagamento;
    }


    public function addToXml(SimpleXMLElement $xml) {
        $xml->addChild('TipoRitenuta', $this->tipoRitenuta);
        $xml->addChild('ImportoRitenuta', $this->importoRitenuta);
        $xml->addChild('AliquotaRitenuta', $this->aliquotaRitenuta);
        $xml->addChild('CausalePagamento', $this->causalePagamento);
    }
}


class TipoRitenuta {
    const PERSONE_FISICHE = 'RT01';
    const PERSONE_GIURIDICHE = 'RT02';

    public $type;

    public function __construct($type) {
        $this->type = $type;
    }
}