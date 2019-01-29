<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 12/12/18
 * Time: 10.16
 */

class TipoRitenutaBody {
    public $type;

    /**
     * TipoRitenutaBody constructor.
     * @param $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    const LINEA_FATTURA_SOGGETTA_A_RITENUTA = 'SI';


}