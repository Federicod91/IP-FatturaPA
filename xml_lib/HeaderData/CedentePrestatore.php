<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 05/12/18
 * Time: 18.33
 */
require_once "subelements/ContattiClass.php";
require_once "subelements/DatiAnagrafici/DatiAnagrafici.php";
require_once "subelements/IscrizioneREA.php";
require_once "subelements/Luogo.php";
require_once "XmlHeaderComponent.php";

class CedentePrestatore extends XmlHeaderComponent {
    public $datiAnagrafici;
    public $sede;
    public $stabileOrganizzazione;
    public $iscrizioneREA;
    public $contatti;
    public $riferimentoAmministrazione;

    public function __construct(DatiAnagrafici $datiAnagrafici, Luogo $sede, Luogo $stabileOrganizzazione = null,
                                IscrizioneREAClass $iscrizioneREA = null, ContattiClass $contatti = null,
                                $riferimentoAmministrazione = null) {
        $this->datiAnagrafici = $datiAnagrafici;
        $this->sede = $sede;
        $this->stabileOrganizzazione = $stabileOrganizzazione;
        $this->iscrizioneREA = $iscrizioneREA;
        $this->contatti = $contatti;
        $this->riferimentoAmministrazione = $riferimentoAmministrazione;
    }

    public function addToXml(SimpleXMLElement $xml) {
        if (!isset($xml->FatturaElettronicaHeader->CedentePrestatore))
            $xml->FatturaElettronicaHeader->addChild('CedentePrestatore');
        $cedentePrestatoreXML = $xml->FatturaElettronicaHeader->CedentePrestatore;

        $datiAnagraficiXML = $cedentePrestatoreXML->addChild("DatiAnagrafici");
        self::addDatiAnagrafici($datiAnagraficiXML, $this->datiAnagrafici);

        $sedeXML = $cedentePrestatoreXML->addChild("Sede");
        self::addLuogo($sedeXML, $this->sede);

        if ($this->stabileOrganizzazione != null) {
            $stabileOrganizzazioneXML = $cedentePrestatoreXML->addChild("StabileOrganizzazione");
            self::addLuogo($stabileOrganizzazioneXML, $this->stabileOrganizzazione);
        }

        if ($this->iscrizioneREA != null) {
            $iscrizioneREAXML = $cedentePrestatoreXML->addChild("IscrizioneREA");
            self::addIscrizioneREA($iscrizioneREAXML, $this->iscrizioneREA);
        }

        if ($this->contatti != null) {
            $contattiXML = $cedentePrestatoreXML -> addChild("Contatti");
            self::addContatti($contattiXML, $this->contatti);
        }

        self::addIfNotNull($cedentePrestatoreXML, 'RiferimentoAmministrazione', $this->riferimentoAmministrazione);
    }
}