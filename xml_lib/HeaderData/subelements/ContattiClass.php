<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 05/12/18
 * Time: 18.29
 */

class ContattiClass {
    public $Telefono;
    public $Fax;
    public $Email;

    public function __construct($Telefono = null, $Fax = null, $Email = null) {
        $this->Telefono = $Telefono;
        $this->Fax = $Fax;
        $this->Email = $Email;
    }
}