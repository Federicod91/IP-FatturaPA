<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 12/12/18
 * Time: 10.11
 */

class TipoCessionePrestazione {
    public $type;

    public function __construct($type) {
        $this->type = $type;
    }

    const Sconto = 'SC';
    const Premio = 'PR';
    const Abbuono = 'AB';
    const SpesaAccessoria = 'AC';

}