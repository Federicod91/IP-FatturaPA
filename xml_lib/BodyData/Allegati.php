<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 12/12/18
 * Time: 11.43
 */

require_once 'XmlBodyClass.php';

class Allegati extends XmlBodyClass {

    public $nomeAttachment;
    public $attachment;
    public $algoritmoCompressione;      //optional
    public $formatoAttachment;      //optional
    public $descrizioneAttachment;  //optional

    /**
     * Allegati constructor.
     * @param $nomeAttachment
     * @param $Attachment
     * @param $algoritmoCompressione
     * @param $formatoAttachment
     * @param $descrizioneAttachment
     */
    public function __construct($nomeAttachment, $Attachment,
                                $algoritmoCompressione = null, $formatoAttachment = null,
                                $descrizioneAttachment = null) {
        $this->nomeAttachment = $nomeAttachment;
        $this->attachment = $Attachment;
        $this->algoritmoCompressione = $algoritmoCompressione;
        $this->formatoAttachment = $formatoAttachment;
        $this->descrizioneAttachment = $descrizioneAttachment;
    }


    public function addToXml(SimpleXMLElement $xml) {
        $element = $xml->FatturaElettronicaBody->addChild("Allegati");

        $element->addChild('NomeAttachment', $this->nomeAttachment);
        $element->addChild('Attachment', $this->attachment);

        self::addIfNotNull($element, 'AlgoritmoCompressione', $this->algoritmoCompressione);
        self::addIfNotNull($element, 'FormatoAttachment', $this->formatoAttachment);
        self::addIfNotNull($element, 'DescrizioneAttachment', $this->descrizioneAttachment);
    }
}