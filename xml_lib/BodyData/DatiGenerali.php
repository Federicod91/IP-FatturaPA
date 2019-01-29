<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 08/12/18
 * Time: 15.14
 */

require_once "XmlBodyClass.php";
require_once 'subelements/DatiGeneraliDocumento/DatiGeneraliDocumento.php';
require_once "subelements/DatiOrdineAcquisto.php";
require_once "subelements/DatiContratto.php";
require_once "subelements/DatiConvenzione.php";
require_once "subelements/DatiFattureCollegate.php";
require_once "subelements/DatiRicezione.php";
require_once "subelements/RiferimentoFase/DatiSal.php";
require_once "subelements/DatiDDT.php";
require_once "subelements/DatiTrasporto/DatiAnagraficiVettore.php";
require_once "subelements/DatiTrasporto/DatiTrasporto.php";
require_once "subelements/LuogoBody.php";
require_once "subelements/FatturaPrincipale.php";

class DatiGenerali extends XmlBodyClass {

    public $datiGeneraliDocumento;
    public $datiOrdineAcquisto;     //optional
    public $datiContratto;          //optional
    public $datiConvenzione;        //optional
    public $datiRicezione;          //optional
    public $datiFattureCollegate;   //optional
    public $datiSAL;                //optional
    public $datiDDT;                //optional
    public $datiTrasporto;          //optional
    public $fatturaPrincipale;      //optional

    public function __construct(DatiGeneraliDocumento $datiGeneraliDocumento, DatiOrdineAcquisto $datiOrdineAcquisto = null,
                                DatiContratto $datiContratto = null, DatiConvenzione $datiConvenzione = null,
                                DatiRicezione $datiRicezione = null, DatiFattureCollegate $datiFattureCollegate = null,
                                DatiSal $datiSAL = null, DatiDDT $datiDDT = null,
                                DatiTrasporto $datiTrasporto = null, FatturaPrincipale $fatturaPrincipale = null) {
        $this->datiGeneraliDocumento = $datiGeneraliDocumento;
        $this->datiOrdineAcquisto = $datiOrdineAcquisto;
        $this->datiContratto = $datiContratto;
        $this->datiConvenzione = $datiConvenzione;
        $this->datiRicezione = $datiRicezione;
        $this->datiFattureCollegate = $datiFattureCollegate;
        $this->datiSAL = $datiSAL;
        $this->datiDDT = $datiDDT;
        $this->datiTrasporto = $datiTrasporto;
        $this->fatturaPrincipale = $fatturaPrincipale;
    }


    public function addToXml(SimpleXMLElement $xml) {
        if (!isset($xml->FatturaElettronicaBody->DatiGenerali))
            $xml->FatturaElettronicaBody->addChild('DatiGenerali');
        $datiGeneraliDocumentoXML = $xml->FatturaElettronicaBody->DatiGenerali;

        $this->datiGeneraliDocumento->addToXml($datiGeneraliDocumentoXML->addChild('DatiGeneraliDocumento'));

        if ($this->datiOrdineAcquisto != null)
            $this->datiOrdineAcquisto->addToXml($datiGeneraliDocumentoXML->addChild('DatiOrdineAcquisto'));

        if ($this->datiContratto != null)
            $this->datiContratto->addToXml($datiGeneraliDocumentoXML->addChild('DatiContratto'));

        if ($this->datiConvenzione != null)
            $this->datiConvenzione->addToXml($datiGeneraliDocumentoXML->addChild('DatiConvenzione'));

        if ($this->datiRicezione != null)
            $this->datiRicezione->addToXml($datiGeneraliDocumentoXML->addChild('DatiRicezione'));

        if ($this->datiFattureCollegate != null)
            $this->datiFattureCollegate->addToXml($datiGeneraliDocumentoXML->addChild('DatiFattureCollegate'));

        if ($this->datiSAL != null)
            $this->datiSAL->addToXml($datiGeneraliDocumentoXML->addChild('DatiSal'));

        if ($this->datiDDT != null)
            $this->datiDDT->addToXml($datiGeneraliDocumentoXML->addChild('DatiDDT'));

        if ($this->datiTrasporto != null)
            $this->datiTrasporto->addToXml($datiGeneraliDocumentoXML->addChild('DatiTrasporto'));

        if ($this->fatturaPrincipale != null)
            $this->fatturaPrincipale->addToXml($datiGeneraliDocumentoXML->addChild('FatturaPrincipale'));

    }
}