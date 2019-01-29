<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 08/12/18
 * Time: 14.36
 */

abstract class XmlHeaderComponent {

    protected static function addIfNotNull(SimpleXMLElement $element, $name, $value) {
        if ($value != null)
            return $element->addChild($name, $value);
        else
            return null;
    }

    protected static function addDatiAnagrafici(SimpleXMLElement $datiAnagraficiXML, DatiAnagrafici $datiAnagrafici) {
        $datiAnagraficiXML->addChild("IdFiscaleIVA");
        $datiAnagraficiXML->IdFiscaleIVA->addChild('IdPaese', $datiAnagrafici->IdFiscaleIVA->IdPaese);
        $datiAnagraficiXML->IdFiscaleIVA->addChild('IdCodice', $datiAnagrafici->IdFiscaleIVA->IdCodice);

        //moved CF here
        self::addIfNotNull($datiAnagraficiXML, 'CodiceFiscale', $datiAnagrafici->CodiceFiscale);

        $anagraficaXML = $datiAnagraficiXML->addChild("Anagrafica");
        $anagrafica = $datiAnagrafici->Anagrafica;
        if ($anagrafica->Denominazione != null) {
            $anagraficaXML->addChild('Denominazione', $anagrafica->Denominazione);
        } else {
            $anagraficaXML->addChild('Nome', $anagrafica->Nome);
            $anagraficaXML->addChild('Cognome', $anagrafica->Cognome);
        }
        self::addIfNotNull($anagraficaXML, "Titolo", $anagrafica->Titolo);
        self::addIfNotNull($anagraficaXML, "CodEORI", $anagrafica->CodEORI);

        self::addIfNotNull($datiAnagraficiXML, 'AlboProfessionale', $datiAnagrafici->AlboProfessionale);
        self::addIfNotNull($datiAnagraficiXML, 'ProvinciaAlbo', $datiAnagrafici->ProvinciaAlbo);
        self::addIfNotNull($datiAnagraficiXML, 'NumeroIscrizioneAlbo', $datiAnagrafici->NumeroIscrizioneAlbo);
        self::addIfNotNull($datiAnagraficiXML, 'DataIscrizioneAlbo', $datiAnagrafici->DataIscrizioneAlbo);
        self::addIfNotNull($datiAnagraficiXML, 'RegimeFiscale', $datiAnagrafici->RegimeFiscale);
    }

    protected static function addDatiAnagraficiSimplified(SimpleXMLElement $datiAnagraficiXML, DatiAnagraficiSimplified $datiAnagrafici) {
        $datiAnagraficiXML->addChild("IdFiscaleIVA");
        $datiAnagraficiXML->IdFiscaleIVA->addChild('IdPaese', $datiAnagrafici->idFiscaleIVA->IdPaese);
        $datiAnagraficiXML->IdFiscaleIVA->addChild('IdCodice', $datiAnagrafici->idFiscaleIVA->IdCodice);

        self::addIfNotNull($datiAnagraficiXML, 'CodiceFiscale', $datiAnagrafici->codiceFiscale);

        $anagraficaXML = $datiAnagraficiXML->addChild("Anagrafica");
        $anagrafica = $datiAnagrafici->Anagrafica;
        if ($anagrafica->Denominazione != null) {
            $anagraficaXML->addChild('Denominazione', $anagrafica->Denominazione);
        } else {
            $anagraficaXML->addChild('Nome', $anagrafica->Nome);
            $anagraficaXML->addChild('Cognome', $anagrafica->Cognome);
        }
        self::addIfNotNull($anagraficaXML, "Titolo", $anagrafica->Titolo);
        self::addIfNotNull($anagraficaXML, "CodEORI", $anagrafica->CodEORI);

    }

    protected static function addLuogo(SimpleXMLElement $luogoXML, Luogo $luogo) {
        $luogoXML->addChild('Indirizzo', $luogo->Indirizzo);
        self::addIfNotNull($luogoXML, 'NumeroCivico', $luogo->NumeroCivico);
        $luogoXML->addChild('CAP', $luogo->CAP);
        $luogoXML->addChild('Comune', $luogo->Comune);
        self::addIfNotNull($luogoXML, 'Provincia', $luogo->Provincia);
        $luogoXML->addChild('Nazione', $luogo->Nazione);
    }

    protected static function addIscrizioneREA(SimpleXMLElement $iscrizioneREAXML, IscrizioneREAClass $iscrizioneREA) {
        $iscrizioneREAXML->addChild('Ufficio', $iscrizioneREA->Ufficio);
        $iscrizioneREAXML->addChild('NumeroREA', $iscrizioneREA->NumeroREA);
        $iscrizioneREAXML->addChild('StatoLiquidazione', $iscrizioneREA->StatoLiquidazione);
        self::addIfNotNull($iscrizioneREAXML, 'CapitaleSociale', $iscrizioneREA->CapitaleSociale);
        self::addIfNotNull($iscrizioneREAXML, 'SocioUnico', $iscrizioneREA->SocioUnico);
    }

    protected static function addContatti(SimpleXMLElement $contattiXML, ContattiClass $contatti) {
        self::addIfNotNull($contattiXML, 'Telefono', $contatti->Telefono);
        self::addIfNotNull($contattiXML, 'Fax', $contatti->Fax);
        self::addIfNotNull($contattiXML, 'Email', $contatti->Email);
    }


    public abstract function addToXml(SimpleXMLElement $xml);

}