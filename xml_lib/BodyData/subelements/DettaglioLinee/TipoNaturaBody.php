<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 12/12/18
 * Time: 10.18
 */

class TipoNaturaBody {

    public $type;

    /**
     * TipoNaturaBody constructor.
     * @param $type
     */
    public function __construct($type) {
        $this->type = $type;
    }

    const escluseexart15 = 'N1';
    const nonsoggette = 'N2';
    const nonimponibili = 'N3';
    const esenti = 'N4';
    const regimedelmargineIVAnonespostainfattura = 'N5';
    const inversionecontabileperleoperazioniinreversecharge = 'N6';

}