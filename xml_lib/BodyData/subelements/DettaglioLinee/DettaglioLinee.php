<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 12/12/18
 * Time: 10.00
 */

require_once 'AltriDatiGestionali.php';
require_once 'CodiceArticolo.php';
require_once 'TipoCessionePrestazione.php';
require_once 'TipoRitenutaBody.php';
require_once 'TipoNaturaBody.php';
require_once (__DIR__.'/../DatiGeneraliDocumento/utils/ScontoMaggiorazione.php');

class DettaglioLinee extends XmlBodyClass {

    public $numeroLinea;
    public $descrizione;
    public $prezzoUnitario;
    public $prezzoTotale;
    public $aliquotaIVA;
    public $tipoCessionePrestazione;            //optional
    public $codiceArticolo;         //optional
    public $quantita;           //optional
    public $unitaMisura;            //optional
    public $dataInizioPeriodo;          //optional
    public $dataFinePeriodo;            //optional
    public $scontoMaggiorazione;            //optional
    public $ritenuta;           //optional
    public $natura;         //optional
    public $riferimentoAmministrazione;         //optional
    public $altriDatiGestionali;            //optional

    public function __construct($numeroLinea,
                                $descrizione,
                                $prezzoUnitario,
                                $prezzoTotale,
                                $aliquotaIVA,
                                TipoCessionePrestazione $tipoCessionePrestazione = null,
                                CodiceArticolo $codiceArticolo = null,
                                $quantita = null,
                                $unitaMisura = null,
                                $dataInizioPeriodo = null,
                                $dataFinePeriodo = null,
                                ScontoMaggiorazione $scontoMaggiorazione = null,
                                TipoRitenutaBody $ritenuta = null,
                                TipoNaturaBody $natura = null,
                                $riferimentoAmministrazione = null,
                                AltriDatiGestionali $altriDatiGestionali = null) {
        $this->numeroLinea = $numeroLinea;
        $this->descrizione = $descrizione;
        $this->prezzoUnitario = $prezzoUnitario;
        $this->prezzoTotale = $prezzoTotale;
        $this->aliquotaIVA = $aliquotaIVA;
        $this->tipoCessionePrestazione = $this->tipoCessionePrestazione == null ? null : $tipoCessionePrestazione->type;
        $this->codiceArticolo = $codiceArticolo;
        $this->quantita = $quantita;
        $this->unitaMisura = $unitaMisura;
        $this->dataInizioPeriodo = $dataInizioPeriodo;
        $this->dataFinePeriodo = $dataFinePeriodo;
        $this->scontoMaggiorazione = $scontoMaggiorazione;
        $this->ritenuta = $this->ritenuta == null ? null : $ritenuta->type;
        $this->natura = $this->natura == null ? null : $natura->type;
        $this->riferimentoAmministrazione = $riferimentoAmministrazione;
        $this->altriDatiGestionali = $altriDatiGestionali;
    }


    public function addToXml(SimpleXMLElement $xml) {
        $xml->addChild('NumeroLinea', $this->numeroLinea);
        self::addIfNotNull($xml, 'TipoCessionePrestazione', $this->tipoCessionePrestazione);
        if ($this->codiceArticolo != null)
            $this->codiceArticolo->addToXml($xml->addChild('CodiceArticolo'));
        $xml->addChild('Descrizione', $this->descrizione);
        self::addIfNotNull($xml, 'Quantita', $this->quantita);
        self::addIfNotNull($xml, 'UnitaMisura', $this->unitaMisura);
        self::addIfNotNull($xml, 'DataInizioPeriodo', $this->dataInizioPeriodo);
        self::addIfNotNull($xml, 'DataFinePeriodo', $this->dataFinePeriodo);
        $xml->addChild('PrezzoUnitario', $this->prezzoUnitario);
        if ($this->scontoMaggiorazione != null)
            $this->scontoMaggiorazione->addToXml($xml->addChild('ScontoMaggiorazione'));
        $xml->addChild('PrezzoTotale', $this->prezzoTotale);
        $xml->addChild('AliquotaIVA', $this->aliquotaIVA);

        self::addIfNotNull($xml, 'Ritenuta', $this->ritenuta);
        self::addIfNotNull($xml, 'Natura', $this->natura);
        self::addIfNotNull($xml, 'RiferimentoAmministrazione', $this->riferimentoAmministrazione);

        if ($this->altriDatiGestionali != null)
            $this->altriDatiGestionali->addToXml($xml->addChild('AltriDatiGestionali'));

    }
}