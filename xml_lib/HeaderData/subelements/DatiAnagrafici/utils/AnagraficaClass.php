<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 06/12/18
 * Time: 11.54
 */

/**
 * Class Anagrafica
 * ATTENZIONE -> $Denominazione e [$Nome - $Cognome] sono alternativi
 */
class AnagraficaClass {
    public $Denominazione;
    public $Nome;
    public $Cognome;
    public $Titolo;     //optional
    public $CodEORI;    //optional

    private function __construct($Denominazione, $Nome, $Cognome, $Titolo, $CodEORI) {
        $this->Denominazione = $Denominazione;
        $this->Nome = $Nome;
        $this->Cognome = $Cognome;
        $this->Titolo = $Titolo;
        $this->CodEORI = $CodEORI;
    }

    public static function getAnagraficaDenominazione($Denominazione, $Titolo = null, $CodEORI = null) {
        return new AnagraficaClass($Denominazione, null, null, $Titolo, $CodEORI);
    }

    public static function getAnagraficaNome($Nome, $Cognome, $Titolo, $CodEORI) {
        return new AnagraficaClass(null, $Nome, $Cognome, $Titolo, $CodEORI);
    }
}