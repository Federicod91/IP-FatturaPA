<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 12/12/18
 * Time: 10.01
 */

require_once (__DIR__.'/../DettaglioLinee/TipoNaturaBody.php');
require_once 'TipoEsigibilitaIVA.php';

class DatiRiepilogo extends XmlBodyClass {

    public $aliquotaIVA;
    public $imponibileImporto;
    public $imposta;
    public $natura;     //optional
    public $speseAccessorie;        //optional
    public $arrotondamento;     //optional
    public $esigibilitaIVA;     //optional
    public $riferimentoNormativo;       //optional

    /**
     * DatiRiepilogo constructor.
     * @param $aliquotaIVA
     * @param $imponibileImporto
     * @param $imposta
     * @param $natura
     * @param $speseAccessorie
     * @param $arrotondamento
     * @param $esigibilitaIVA
     * @param $riferimentoNormativo
     */
    public function __construct($aliquotaIVA, $imponibileImporto, $imposta,
                                TipoNaturaBody $natura = null, $speseAccessorie = null, $arrotondamento = null,
                                TipoEsigibilitaIVA $esigibilitaIVA = null, $riferimentoNormativo = null)
    {
        $this->aliquotaIVA = $aliquotaIVA;
        $this->imponibileImporto = $imponibileImporto;
        $this->imposta = $imposta;
        $this->natura = "N2";
        $this->speseAccessorie = $speseAccessorie;
        $this->arrotondamento = $arrotondamento;
        $this->esigibilitaIVA = $this->esigibilitaIVA != null ? $esigibilitaIVA->type : null;
        $this->riferimentoNormativo = $riferimentoNormativo;
    }

    public function addToXml(SimpleXMLElement $xml) {
        $xml->addChild('AliquotaIVA', $this->aliquotaIVA);
        self::addIfNotNull($xml, 'Natura', $this->natura);
        self::addIfNotNull($xml, 'SpeseAccessorie', $this->speseAccessorie);
        self::addIfNotNull($xml, 'Arrotondamento', $this->arrotondamento);
        $xml->addChild('ImponibileImporto', $this->imponibileImporto);
        $xml->addChild('Imposta', $this->imposta);

        self::addIfNotNull($xml, 'EsigibilitaIVA', $this->esigibilitaIVA);
        self::addIfNotNull($xml, 'RiferimentoNormativo', $this->riferimentoNormativo);
    }
}