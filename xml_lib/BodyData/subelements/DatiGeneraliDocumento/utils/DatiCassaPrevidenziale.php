<?php
/**
 * Created by PhpStorm.
 * User: pado
 * Date: 08/12/18
 * Time: 17.45
 */

//require_once '../../../XmlBodyClass.php';

class DatiCassaPrevidenziale extends XmlBodyClass {

    public $tipoCassa;
    public $alCassa;
    public $importoContributoCassa;
    public $aliquotaIVA;
    public $imponibileCassa;            //optional
    public $ritenuta;           //optional
    public $natura;         //optional
    public $riferimentoAmministratore;          //optional


    public function __construct(TipoCassa $tipoCassa, $alCassa, $importoContributoCassa,
                                $aliquotaIVA, $imponibileCassa = null, EnumRitenuta $ritenuta = null,
                                EnumNatura $natura = null, $riferimentoAmministratore = null) {
        $this->tipoCassa = $tipoCassa->type;
        $this->alCassa = $alCassa;
        $this->importoContributoCassa = $importoContributoCassa;
        $this->aliquotaIVA = $aliquotaIVA;
        $this->imponibileCassa = $imponibileCassa;
        $this->ritenuta = $ritenuta->type;
        $this->natura = $natura->type;
        $this->riferimentoAmministratore = $riferimentoAmministratore;
    }

    public function addToXml(SimpleXMLElement $xml) {
        $xml->addChild('TipoCassa', $this->tipoCassa);
        $xml->addChild('AlCassa', $this->alCassa);
        $xml->addChild('ImportoContributoCassa', $this->imponibileCassa);
        $xml->addChild('AliquotaIVA', $this->aliquotaIVA);

        self::addIfNotNull($xml, 'ImponibileCassa', $this->imponibileCassa);
        self::addIfNotNull($xml, 'Ritenuta', $this->ritenuta);
        self::addIfNotNull($xml, 'Natura', $this->natura);
        self::addIfNotNull($xml, 'RiferimentoAmministrazione', $this->riferimentoAmministratore);
    }
}


class TipoCassa {

    const Cassa_Nazionale_Previdenza_Avvocati_e_Procuratori_Legali = 'TC01';
    const Cassa_Previdenza_Dottori_Commercialisti = 'TC02';
    const Cassa_Previdenza_e_Assistenza_Geometri = 'TC03';
    const Cassa_Nazionale_Previdenza_e_Assistenza_Ingegneri_e_Architetti_Liberi_Professionisti = 'TC04';
    const Cassa_Nazionale_del_Notariato = 'TC05';
    const Cassa_Nazionale_Previdenza_Ragionieri_e_Periti_Commerciali = 'TC06';
    const Ente_Nazionale_Assistenza_Agenti_Rappresentanti_di_Commercio_ENASARCO = 'TC07';
    const Ente_Nazionale_Previdenza_Consulenti_del_Lavoro_ENPACL = 'TC08';
    const Ente_Nazionale_Previdenza_Assistenza_Medici_ENPAM = 'TC09';
    const Ente_Nazionale_Previdenza_Farmacisti_ENPAF = 'TC10';
    const Ente_Nazionale_Previdenza_Veterinari_ENPAV = 'TC11';
    const Ente_Nazionale_Previdenza_Impiegati_dell_Agricoltura_ENPAIA = 'TC12';
    const Fondo_Previdenza_Impiegati_Spedizione_e_Agenzie_Marittime = 'TC13';
    const Istituto_Nazionale_Previdenza_Giornalisti_Italiani_INPGI = 'TC14';
    const Opera_Nazionale_Assistenza_Orfani_Sanitari_Italiani_ONAOSI = 'TC15';
    const Cassa_Autonoma_Assistenza_Giornalisti_Italiani_CASAGIT = 'TC16';
    const Ente_Previdenza_Periti_Industriali_Laureati_EPPI = 'TC17';
    const Ente_Previdenza_e_Assistenza_Pluricategoriale_EPAP = 'TC18';
    const Ente_Nazionale_Previdenza_e_Assistenza_Biologi_ENPAB = 'TC19';
    const Ente_Nazionale_Previdenza_e_Assistenza_Professione_Infermieristica_ENPAPI = 'TC20';
    const Ente_Nazionale_Previdenza_Psicologi_ENPAP = 'TC21';
    const INPS = 'TC22';


    public $type;
    public function __construct($type) {
        $this->type = $type;
    }
}


class EnumRitenuta {

    const contributo_cassa_soggetto_a_ritenuta = 'SI';

    public $type;
    public function __construct($type) {
        $this->type = $type;
    }
}


class EnumNatura {

    const escluse_ex_art15 = 'N1';
    const non_soggette = 'N2';
    const non_imponibili = 'N3';
    const esenti = 'N4';
    const regime_del_margine_IVA_non_esposta_in_fattura = 'N5';
    const inversione_contabile_per_le_operazioni_in_reverse_charge_ovvero_nei_casi_di_autofatturazione_per_acquisti_extra_UE_di_servizi_ovvero_per_importazioni_di_beni_nei_soli_casi_previsti = 'N6';
    const IVA_assolta_in_altro_stato_UE = 'N7';

    public $type;

    public function __construct($type) {
        $this->type = $type;
    }
}