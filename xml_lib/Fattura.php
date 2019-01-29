<?php /** @noinspection PhpUndefinedFieldInspection */
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 05/12/18
 * Time: 16.21
 */
require_once "HeaderData/XmlHeaderComponent.php";
require_once "HeaderData/DatiTrasmissione.php";
require_once "HeaderData/CedentePrestatore.php";
require_once "HeaderData/RappresentanteFiscale.php";
require_once "HeaderData/CessionarioCommittente.php";
require_once "HeaderData/TerzoIntermediarioSoggettoEmittente.php";
require_once "HeaderData/SoggettoEmittente.php";
require_once "BodyData/DatiGenerali.php";
require_once "BodyData/DatiBeniServizi.php";
require_once "BodyData/DatiVeicoli.php";
require_once "BodyData/DatiPagamento.php";
require_once "BodyData/Allegati.php";

class Fattura {
    private $fattura;

    public function __construct() {
        $xmlstr = <<<XML
<FatturaElettronica>
</FatturaElettronica>
XML;
        $this->fattura = new SimpleXMLElement($xmlstr);
        $this->fattura->addChild('FatturaElettronicaHeader');
        $this->fattura->addChild('FatturaElettronicaBody');
    }



    public function addHeaderElement(XmlHeaderComponent $element) {
        $element->addToXml($this->fattura);
    }


    public function addBodyElement(XmlBodyClass $element) {
        $element->addToXml($this->fattura);
    }


    function getFatturaAsXML() {
        $xmlFattura = $this->fattura->asXML();
        $dom = new DOMDocument("1.0");
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($this->fattura->asXML());
        $xmlFattura = $dom->saveXML();
        $xmlFattura = str_replace("<FatturaElettronica>", "<v1:FatturaElettronica versione=\"FPR12\" xmlns:v1=\"http://ivaservizi.agenziaentrate.gov.it/docs/xsd/fatture/v1.2\">", $xmlFattura);
        $xmlFattura = str_replace("</FatturaElettronica>", "</v1:FatturaElettronica>", $xmlFattura);
        $xmlFattura = html_entity_decode($xmlFattura);
        $xmlFattura = str_replace('’', '\'', $xmlFattura);
        return $xmlFattura;
    }

    function getFilename() {
        //getting filename
        return $this->fattura->FatturaElettronicaHeader->DatiTrasmissione->IdTrasmittente->IdPaese.
            $this->fattura->FatturaElettronicaHeader->DatiTrasmissione->IdTrasmittente->IdCodice.
            '_'.
            $this->fattura->FatturaElettronicaHeader->DatiTrasmissione->ProgressivoInvio.
            '.xml';

    }

}



//$datiTrans = new DatiTrasmissione(
//    new IdTrasmittenteClass("IT", "420"),
//    1,
//    FormatoTrasmissioneClass::FPR12,
//    "coddest",
//    new ContattiTrasmittenteClass("3484655214", "tommaso.pado@gmail.com"),
//    "shamalaya"
//);
//
//$cedentePrest = new CedentePrestatore(
//    new DatiAnagrafici(
//        new IdFiscaleIVAClass('IT', '666'),
//        AnagraficaClass::getAnagraficaDenominazione("giggino", "mr."),
//        RegimeFiscaleClass::Commercio_dei_fiammiferi
//    ),
//    new Luogo("P.za Cesare Battisti", "31030", "Breda di Piave", "Italia", 11, "TV"),
//    new Luogo("P.za Cesare Battisti", "31030", "Breda di Piave", "Italia", 11, "TV"),
//    new IscrizioneREAClass("blabla", 322, StatoLiquidazioneClass::NO, 1000, SocioUnicoClass::SI),
//    new ContattiClass(3484655214, "0422904323", "tommaso.pado@gmail.com"),
//    "ciao amministrazione"
//);
//
//$rapprFisc = new RappresentanteFiscale(new DatiAnagraficiSimplified(
//    new IdFiscaleIVAClass("IT", "777"),
//    AnagraficaClass::getAnagraficaDenominazione("deepmayo", "mr.", "eora"),
//    "PDVTMS65489"
//));
//
//
//$cessCommit = new CessionarioCommittente(
//    new DatiAnagraficiSimplified(
//        new IdFiscaleIVAClass("it", "gnegnegne"),
//        AnagraficaClass::getAnagraficaNome("Tommaso", "Padovan", "mr", "7666"),
//        "pdvtmsqualcosaqualcosa"
//    ),
//    new Luogo(
//        'via lemani d\'alculo',
//        '31030',
//        'comune finto',
//        'pakistan',
//        '11',
//        'MT'
//    ),
//    new Luogo(
//        'via lemani d\'alculo',
//        '31030',
//        'comune finto',
//        'pakistan',
//        '11',
//        'MT'
//    ),
//    RappresentanteFiscaleOnlyCessionarioCommittente::getRappresentanteFiscaleOnlyCessionarioCommittenteDenominazione(
//        new IdFiscaleIVAClass('swe', 'kasjdbksaj'),
//        'giggino spa'
//    )
//);
//
//$terzo = new TerzoIntermediarioSoggettoEmittente(new DatiAnagraficiSimplified(
//    new IdFiscaleIVAClass('de', 'arbmacfri'),
//    AnagraficaClass::getAnagraficaDenominazione('deepfriedmayo'),
//    'GGGGNDMAY420'
//));
//
//$soggEmit = new SoggettoEmittente(SoggettoEmittente::CESSIONARIO_COMMITTENTE);
//
//
//
//$sampleDocCorrellati = new DatiDocumentiCorrelatiType(
//    "io",
//    "45",
//    "oggi",
//    "5",
//    "456",
//    "535",
//    "666"
//);
//
//$datiGen = new DatiGenerali(
//    new DatiGeneraliDocumento(
//        new TipoDocumento(new TipoDocumento(TipoDocumento::Fattura)),
//        "euro",
//        "2018-05-07",
//        "420",
//        new DatiRitenuta(new TipoRitenuta(TipoRitenuta::PERSONE_FISICHE), "1200", "20", "perché tvb"),
//        new DatiBollo(new BolloVirtuale(BolloVirtuale::ASSOLTO), "500"),
//        new DatiCassaPrevidenziale(new TipoCassa(TipoCassa::Cassa_Nazionale_del_Notariato),
//            "asdas",
//            "20",
//            "22",
//            "asd",
//            new EnumRitenuta(EnumRitenuta::contributo_cassa_soggetto_a_ritenuta),
//            new EnumNatura(EnumNatura::non_imponibili),
//            "asdasdasdas"),
//        new ScontoMaggiorazione(new TipoTipo(TipoTipo::SCONTO), "20", "100"),
//        "2000",
//        "20",
//        "ciao",
//        new Art73(Art73::documento_emesso_secondo_modalita_e_termini_stabiliti_con_DM_ai_sensi_del_art_73)
//    ),
//    new DatiOrdineAcquisto($sampleDocCorrellati),
//    new DatiContratto($sampleDocCorrellati),
//    new DatiConvenzione($sampleDocCorrellati),
//    new DatiRicezione($sampleDocCorrellati),
//    new DatiFattureCollegate($sampleDocCorrellati),
//    new DatiSal(new RiferimentoFase("1")),
//    new DatiDDT("1", "ieri", "56"),
//    new DatiTrasporto(
//        new DatiAnagraficiVettore(
//            new IdFiscaleIvaBody("it", "666"),
//            AnagraficaBody::getFromDenominazione("ginocamionciono", "spa", "eora"),
//            "GNCMDL06KJASBKAS",
//            "420"
//        ),
//        "furgon",
//        "parché xe strada",
//        "10",
//        "pacchi amazon",
//        "kg",
//        "500",
//        "450",
//        "sta sera",
//        "adesso",
//        "mai",
//        new LuogoBody("via Dalculo Lemani", "31100", "treviso", "italy", "1092", "TV"),
//        "doman matina"
//    ),
//    new FatturaPrincipale("5", "oggi")
//);
//
//
//$datiBenServ = new DatiBeniServizi(
//    new DettaglioLinee(
//        "1",
//        "asodash",
//        "40",
//        "400",
//        "22",
//        new TipoCessionePrestazione(TipoCessionePrestazione::Abbuono),
//        new CodiceArticolo("codtipo", "codval"),
//        "10",
//        "kg",
//        "asdasdas",
//        "asdasdas",
//        new ScontoMaggiorazione(new TipoTipo(TipoTipo::SCONTO), "50", "200"),
//        new TipoRitenutaBody(TipoRitenutaBody::LINEA_FATTURA_SOGGETTA_A_RITENUTA),
//        new TipoNaturaBody(TipoNaturaBody::escluseexart15),
//        "asdasdas",
//        new AltriDatiGestionali("tipodato", "tipotesto", "rifnum", "rifdata")
//    ),
//    new DatiRiepilogo(
//        "aliqiva",
//        "imponimp",
//        "imposta",
//        new TipoNaturaBody(TipoNaturaBody::esenti),
//        "spesacc",
//        "arrot",
//        new TipoEsigibilitaIVA(TipoEsigibilitaIVA::IVA_ad_esigibilita_immediata),
//        "rifnorm"
//    )
//);
//
//$datiVeicol = new DatiVeicoli("data", "totpercors");
//
//
//$datiPag = new DatiPagamento(
//    new TipoCondizioniPagamento(TipoCondizioniPagamento::PAGAMENTO_COMPLETO),
//    new ModalitaPagamento(
//        new TipoModalitaPagamento(TipoModalitaPagamento::assegno),
//        "importopaga",
//        "benefic",
//        "datariftermpag",
//        "giorniterminipagamento",
//        "cod fuccio postale",
//        "cognome quitanz",
//        "nomequietanz",
//        "CFQquietanze",
//        "titolo quietanze",
//        "istitut finanz",
//        "iban",
//        "abi",
//        "cab",
//        "bic",
//        "sconto pag anticip",
//        "data limite pag anticip",
//        "penalit pag ritard",
//        "data ricor penal",
//        "cod pegament"
//    )
//);
//
//
//$alleg = new Allegati(
//    "nome attach",
//    "binariolunghissimo0101000001011010101111000100011111011101010101010",
//    "algo compr",
//    "form attach",
//    "descr attach"
//);
//
//$f = new Fattura();
//$f->addHeaderElement($datiTrans);
//$f->addHeaderElement($cedentePrest);
//$f->addHeaderElement($rapprFisc);
//$f->addHeaderElement($cessCommit);
//$f->addHeaderElement($terzo);
//$f->addHeaderElement($soggEmit);
//
//$f->addBodyElement($datiGen);
//$f->addBodyElement($datiBenServ);
//$f->addBodyElement($datiVeicol);
//$f->addBodyElement($datiPag);
//$f->addBodyElement($alleg);
//
////echo $f->getFatturaAsXML();