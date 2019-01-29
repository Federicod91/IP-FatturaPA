<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 08/12/18
 * Time: 12.11
 */

require_once "utils/IdFiscaleIVAClass.php";
require_once "utils/AnagraficaClass.php";

class DatiAnagraficiSimplified {
    public $idFiscaleIVA;
    public $codiceFiscale;      //optional
    public $Anagrafica;

    public function __construct(IdFiscaleIVAClass $idFiscaleIVA, AnagraficaClass $Anagrafica, $codiceFiscale = null) {
        $this->idFiscaleIVA = $idFiscaleIVA;
        $this->Anagrafica = $Anagrafica;
        $this->codiceFiscale = $codiceFiscale;
    }
}