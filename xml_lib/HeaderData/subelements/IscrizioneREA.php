<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 05/12/18
 * Time: 18.21
 */

class IscrizioneREAClass {
    public $Ufficio;
    public $NumeroREA;
    public $StatoLiquidazione;
    public $CapitaleSociale;    //optional
    public $SocioUnico;         //optional

    public function __construct($Ufficio, $NumeroREA, $StatoLiquidazione,
                                $CapitaleSociale = null, $SocioUnico = null) {
        $this->Ufficio = $Ufficio;
        $this->NumeroREA = $NumeroREA;
        $this->StatoLiquidazione = $StatoLiquidazione;
        $this->CapitaleSociale = $CapitaleSociale;
        $this->SocioUnico = $SocioUnico;
    }
}


class StatoLiquidazioneClass {
    const SI = "LS";
    const NO = "LN";
}

class SocioUnicoClass {
    const SI = "SU";
    const NO = "SM";
}