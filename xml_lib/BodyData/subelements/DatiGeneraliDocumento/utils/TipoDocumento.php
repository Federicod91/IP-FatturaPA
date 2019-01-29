<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 08/12/18
 * Time: 17.21
 */

class TipoDocumento {
    const Fattura = 'TD01';
    const Acconto_Anticipo_su_fattura = 'TD02';
    const Acconto_Anticipo_su_parcella = 'TD03';
    const Nota_di_Credito = 'TD04';
    const Nota_di_Debito = 'TD05';
    const Parcella = 'TD06';
    const Autofattura = 'TD20';

    public $type;

    public function __construct($type) {
        $this->type = $type;
    }
}