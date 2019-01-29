<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 08/12/18
 * Time: 12.14
 */

require_once "subelements/DatiAnagrafici/DatiAnagraficiSimplified.php";
require_once "subelements/Luogo.php";
require_once "XmlHeaderComponent.php";


class CessionarioCommittente extends XmlHeaderComponent {
    public $datiAnagrafici;
    public $sede;
    public $stabileOrganizzazione;
    public $rappresentanteFiscale;

    public function __construct(DatiAnagraficiSimplified $datiAnagrafici, Luogo $sede, Luogo $stabileOrganizzazione = null,
                                RappresentanteFiscaleOnlyCessionarioCommittente $rappresentanteFiscale = null) {
        $this->datiAnagrafici = $datiAnagrafici;
        $this->sede = $sede;
        $this->stabileOrganizzazione = $stabileOrganizzazione;
        $this->rappresentanteFiscale = $rappresentanteFiscale;
    }

    public function addToXml(SimpleXMLElement $xml) {
        if (!isset($xml->FatturaElettronicaHeader->CessionarioCommittente))
            $xml->FatturaElettronicaHeader->addChild('CessionarioCommittente');
        $cessionarioCommittenteXML = $xml->FatturaElettronicaHeader->CessionarioCommittente;

        self::addDatiAnagraficiSimplified(
            $cessionarioCommittenteXML->addChild('DatiAnagrafici'),
            $this->datiAnagrafici
        );

        self::addLuogo(
            $cessionarioCommittenteXML->addChild('Sede'),
            $this->sede
        );

        if ($this->stabileOrganizzazione != null)
            self::addLuogo(
                $cessionarioCommittenteXML->addChild('StabileOrganizzazione'),
                $this->stabileOrganizzazione
            );

        if ($this->rappresentanteFiscale != null) {
            $rappresentanteFiscaleXML = $cessionarioCommittenteXML->addChild('RappresentanteFiscale');
            $rappresentanteFiscaleXML->addChild("IdFiscaleIVA");
            $rappresentanteFiscaleXML->IdFiscaleIVA->addChild('IdPaese', $this->rappresentanteFiscale->idFiscaleIVA->IdPaese);
            $rappresentanteFiscaleXML->IdFiscaleIVA->addChild('IdCodice', $this->rappresentanteFiscale->idFiscaleIVA->IdCodice);
            if ($this->rappresentanteFiscale->denominazione != null) {
                $rappresentanteFiscaleXML->addChild('Denominazione', $this->rappresentanteFiscale->denominazione);
            } else {
                $rappresentanteFiscaleXML->addChild('Nome', $this->rappresentanteFiscale->nome);
                $rappresentanteFiscaleXML->addChild('Cognome', $this->rappresentanteFiscale->cognome);
            }
        }
    }
}


class RappresentanteFiscaleOnlyCessionarioCommittente {
    public $idFiscaleIVA;
    public $denominazione;
    public $nome;
    public $cognome;

    private function __construct(IdFiscaleIVAClass $idFiscaleIVA, $denominazione, $nome, $cognome) {
        $this->idFiscaleIVA = $idFiscaleIVA;
        $this->denominazione = $denominazione;
        $this->nome = $nome;
        $this->cognome = $cognome;
    }

    public static function getRappresentanteFiscaleOnlyCessionarioCommittenteDenominazione(IdFiscaleIVAClass $idFiscaleIVA, $denominazione) {
        return new RappresentanteFiscaleOnlyCessionarioCommittente($idFiscaleIVA, $denominazione, null, null);
    }

    public static function getRappresentanteFiscaleOnlyCessionarioCommittenteNomeCognome(IdFiscaleIVAClass $idFiscaleIVA, $nome, $cognome) {
        return new RappresentanteFiscaleOnlyCessionarioCommittente($idFiscaleIVA, null, $nome, $cognome);
    }
}