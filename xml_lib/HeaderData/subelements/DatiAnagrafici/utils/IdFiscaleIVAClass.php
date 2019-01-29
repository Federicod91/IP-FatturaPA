<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 06/12/18
 * Time: 11.53
 */

class IdFiscaleIVAClass {
    public $IdPaese;
    public $IdCodice;

    public function __construct($IdPaese, $IdCodice) {
        $this->IdPaese = $IdPaese;
        $this->IdCodice = $IdCodice;
    }
}