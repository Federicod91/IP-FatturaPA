<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 12/12/18
 * Time: 10.41
 */

class TipoEsigibilitaIVA {
    public $type;

    /**
     * TipoEsigibilitaIVA constructor.
     * @param $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    const IVA_ad_esigibilita_immediata = 'I';
    const IVA_ad_esigibilita_differita = 'D';
    const scissione_dei_pagamenti = 'S';

}