<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 12/12/18
 * Time: 11.21
 */

require_once 'XmlBodyClass.php';
require_once 'subelements/ModalitaPagamento.php';

class DatiPagamento extends XmlBodyClass {

    public $condizioniPagamento;
    public $dettaglioPagamento;     //optional

    /**
     * DatiPagamento constructor.
     * @param $condizioniPagamento
     * @param $dettaglioPagamento
     */
    public function __construct(TipoCondizioniPagamento $condizioniPagamento, ModalitaPagamento $dettaglioPagamento) {
        $this->condizioniPagamento = $condizioniPagamento->type;
        $this->dettaglioPagamento = $dettaglioPagamento;
    }


    public function addToXml(SimpleXMLElement $xml) {
        $element = $xml->FatturaElettronicaBody->addChild('DatiPagamento');
        $element->addChild('CondizioniPagamento', $this->condizioniPagamento);

        $this->dettaglioPagamento->addToXml($element->addChild('DettaglioPagamento'));
    }
}

class TipoCondizioniPagamento {
    public $type;

    /**
     * TipoCondizioniPagamento constructor.
     * @param $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    const PAGAMENTO_A_RATE = 'TP01';
    const PAGAMENTO_COMPLETO = 'TP02';
    const ANTICIPO = 'TP03';
}