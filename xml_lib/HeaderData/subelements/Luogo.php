<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 05/12/18
 * Time: 18.16
 */

/**
 * Class Luogo
 * va bene sia per Sede che per StabileOrganizzazione
 */
class Luogo {
    public $Indirizzo;
    public $CAP;
    public $Comune;
    public $Nazione;
    public $NumeroCivico;   //optional
    public $Provincia;      //optional

    public function __construct($Indirizzo, $CAP, $Comune, $Nazione, $NumeroCivico = null, $Provincia = null) {
        $this->Indirizzo = $Indirizzo;
        $this->CAP = $CAP;
        $this->Comune = $Comune;
        $this->Nazione = $Nazione;
        $this->NumeroCivico = $NumeroCivico;
        $this->Provincia = $Provincia;
    }
}