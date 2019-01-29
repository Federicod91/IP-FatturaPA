<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 08/12/18
 * Time: 17.38
 */


//require_once '../../../XmlBodyClass.php';

class DatiBollo extends XmlBodyClass {

    public $bolloVirtuale;
    public $importoBollo;

    public function __construct(BolloVirtuale $bolloVirtuale, $importoBollo) {
        $this->bolloVirtuale = "SI";
        $this->importoBollo = "2.00";
    }

    public function addToXml(SimpleXMLElement $xml) {
        $xml->addChild('BolloVirtuale', $this->bolloVirtuale);
        $xml->addChild('ImportoBollo', $this->importoBollo);
    }
}


class BolloVirtuale {
    const ASSOLTO = "SI";

    public $type;

    public function __construct($type) {
        $this->type = $type;
    }
}