<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 12/12/18
 * Time: 11.25
 */

class ModalitaPagamento extends XmlBodyClass {

    public $ModalitaPagamento;
    public $ImportoPagamento;
    public $Beneficiario;
    public $DataRiferimentoTerminiPagamento;
    public $GiorniTerminiPagamento;
    public $CodUfficioPostale;
    public $CognomeQuietanzante;
    public $NomeQuietanzante;
    public $CFQuietanzante;
    public $TitoloQuietanzante;
    public $IstitutoFinanziario;
    public $IBAN;
    public $ABI;
    public $CAB;
    public $BIC;
    public $ScontoPagamentoAnticipato;
    public $DataLimitePagamentoAnticipato;
    public $PenalitaPagamentiRitardati;
    public $DataDecorrenzaPenale;
    public $CodicePagamento;

    /**
     * ModalitaPagamento constructor.
     * @param $ModalitaPagamento
     * @param $ImportoPagamento
     * @param $Beneficiario
     * @param $DataRiferimentoTerminiPagamento
     * @param $GiorniTerminiPagamento
     * @param $CodUfficioPostale
     * @param $CognomeQuietanzante
     * @param $NomeQuietanzante
     * @param $CFQuietanzante
     * @param $TitoloQuietanzante
     * @param $IstitutoFinanziario
     * @param $IBAN
     * @param $ABI
     * @param $CAB
     * @param $BIC
     * @param $ScontoPagamentoAnticipato
     * @param $DataLimitePagamentoAnticipato
     * @param $PenalitaPagamentiRitardati
     * @param $DataDecorrenzaPenale
     * @param $CodicePagamento
     */
    public function __construct(TipoModalitaPagamento $ModalitaPagamento,
                                $ImportoPagamento,
                                $Beneficiario = null,
                                $DataRiferimentoTerminiPagamento = null,
                                $GiorniTerminiPagamento = null,
                                $CodUfficioPostale = null,
                                $CognomeQuietanzante = null,
                                $NomeQuietanzante = null,
                                $CFQuietanzante = null,
                                $TitoloQuietanzante = null,
                                $IstitutoFinanziario = null,
                                $IBAN = null,
                                $ABI = null,
                                $CAB = null,
                                $BIC = null,
                                $ScontoPagamentoAnticipato = null,
                                $DataLimitePagamentoAnticipato = null,
                                $PenalitaPagamentiRitardati = null,
                                $DataDecorrenzaPenale = null,
                                $CodicePagamento = null) {
        $this->ModalitaPagamento = $ModalitaPagamento->type;
        $this->ImportoPagamento = $ImportoPagamento;
        $this->Beneficiario = $Beneficiario;
        $this->DataRiferimentoTerminiPagamento = $DataRiferimentoTerminiPagamento;
        $this->GiorniTerminiPagamento = $GiorniTerminiPagamento;
        $this->CodUfficioPostale = $CodUfficioPostale;
        $this->CognomeQuietanzante = $CognomeQuietanzante;
        $this->NomeQuietanzante = $NomeQuietanzante;
        $this->CFQuietanzante = $CFQuietanzante;
        $this->TitoloQuietanzante = $TitoloQuietanzante;
        $this->IstitutoFinanziario = $IstitutoFinanziario;
        $this->IBAN = $IBAN;
        $this->ABI = $ABI;
        $this->CAB = $CAB;
        $this->BIC = $BIC;
        $this->ScontoPagamentoAnticipato = $ScontoPagamentoAnticipato;
        $this->DataLimitePagamentoAnticipato = $DataLimitePagamentoAnticipato;
        $this->PenalitaPagamentiRitardati = $PenalitaPagamentiRitardati;
        $this->DataDecorrenzaPenale = $DataDecorrenzaPenale;
        $this->CodicePagamento = $CodicePagamento;
    }


    public function addToXml(SimpleXMLElement $xml) {
        $xml->addChild('ModalitaPagamento', $this->ModalitaPagamento);
        $xml->addChild('ImportoPagamento', $this->ImportoPagamento);
        self::addIfNotNull($xml, 'Beneficiario', $this->Beneficiario);
        self::addIfNotNull($xml, 'DataRiferimentoTerminiPagamento', $this->DataRiferimentoTerminiPagamento);
        self::addIfNotNull($xml, 'GiorniTerminiPagamento', $this->GiorniTerminiPagamento);
        self::addIfNotNull($xml, 'CodUfficioPostale', $this->CodUfficioPostale);
        self::addIfNotNull($xml, 'CognomeQuietanzante', $this->CognomeQuietanzante);
        self::addIfNotNull($xml, 'NomeQuietanzante', $this->NomeQuietanzante);
        self::addIfNotNull($xml, 'CFQuietanzante', $this->CFQuietanzante);
        self::addIfNotNull($xml, 'TitoloQuietanzante', $this->TitoloQuietanzante);
        self::addIfNotNull($xml, 'IstitutoFinanziario', $this->IstitutoFinanziario);
        self::addIfNotNull($xml, 'IBAN', $this->IBAN);
        self::addIfNotNull($xml, 'ABI', $this->ABI);
        self::addIfNotNull($xml, 'CAB', $this->CAB);
        self::addIfNotNull($xml, 'BIC', $this->BIC);
        self::addIfNotNull($xml, 'ScontoPagamentoAnticipato', $this->ScontoPagamentoAnticipato);
        self::addIfNotNull($xml, 'DataLimitePagamentoAnticipato', $this->DataLimitePagamentoAnticipato);
        self::addIfNotNull($xml, 'PenalitaPagamentiRitardati', $this->PenalitaPagamentiRitardati);
        self::addIfNotNull($xml, 'DataDecorrenzaPenale', $this->DataDecorrenzaPenale);
        self::addIfNotNull($xml, 'CodicePagamento', $this->CodicePagamento);
    }
}


class TipoModalitaPagamento {
    public $type;

    /**
     * TipoModalitaPagamento constructor.
     * @param $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    const contanti = 'MP01';
    const assegno = 'MP02';
    const assegno_circolare = 'MP03';
    const contanti_presso_Tesoreria = 'MP04';
    const bonifico = 'MP05';
    const vaglia_cambiario = 'MP06';
    const bollettino_bancario = 'MP07';
    const carta_di_pagamento = 'MP08';
    const RID = 'MP09';
    const RID_utenze = 'MP10';
    const RID_veloce = 'MP11';
    const Riba = 'MP12';
    const MAV = 'MP13';
    const quietanza_erario_stato = 'MP14';
    const giroconto_su_conti_di_contabilita_speciale_MP16_domiciliazione_bancaria = 'MP15';
    const domiciliazione_postale = 'MP17';
    const bollettino_di_cc_postale = 'MP18';
    const SEPA_Direct_Debit = 'MP19';
    const SEPA_Direct_Debit_CORE = 'MP20';
    const SEPA_Direct_Debit_B2B = 'MP21';
    const Trattenuta_su_somme_gia_riscosse = 'MP22';

}