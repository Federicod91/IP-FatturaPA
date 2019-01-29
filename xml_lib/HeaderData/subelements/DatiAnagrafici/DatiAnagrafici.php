<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 05/12/18
 * Time: 17.49
 */

require_once "utils/AnagraficaClass.php";
require_once "utils/IdFiscaleIVAClass.php";
require_once "utils/RegimeFiscaleClass.php";

class DatiAnagrafici {
    public $IdFiscaleIVA;
    public $Anagrafica;
    public $RegimeFiscale;
    public $CodiceFiscale;          //optional
    public $AlboProfessionale;      //optional
    public $ProvinciaAlbo;          //optional
    public $NumeroIscrizioneAlbo;   //optional
    public $DataIscrizioneAlbo;     //optional


    public function __construct(IdFiscaleIVAClass $IdFiscaleIVA, AnagraficaClass $Anagrafica, $RegimeFiscale,
                                $CodiceFiscale = null, $AlboProfessionale = null,$ProvinciaAlbo = null,
                                $NumeroIscrizioneAlbo = null, $DataIscrizioneAlbo = null) {
        $this->IdFiscaleIVA = $IdFiscaleIVA;
        $this->Anagrafica = $Anagrafica;
        $this->RegimeFiscale = $RegimeFiscale;
        $this->CodiceFiscale = $CodiceFiscale;
        $this->AlboProfessionale = $AlboProfessionale;
        $this->ProvinciaAlbo = $ProvinciaAlbo;
        $this->NumeroIscrizioneAlbo = $NumeroIscrizioneAlbo;
        $this->DataIscrizioneAlbo = $DataIscrizioneAlbo;
    }
}






