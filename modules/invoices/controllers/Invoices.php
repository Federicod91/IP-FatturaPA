<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 * InvoicePlane
 *
 * @author		InvoicePlane Developers & Contributors
 * @copyright	Copyright (c) 2012 - 2018 InvoicePlane.com
 * @license		https://invoiceplane.com/license.txt
 * @link		https://invoiceplane.com
 */

/**
 * Class Invoices
 */
class Invoices extends Admin_Controller
{

    /**
     * Invoices constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('mdl_invoices');
    }

    public function index()
    {
        // Display all invoices by default
        redirect('invoices/status/all');
    }

    public function downloadXml($invoiceID) {
        require_once ('Fattura.php');

        $this->load->model('clients/mdl_clients');
        $this->load->model('mdl_invoice_amounts');
        $this->load->model('mdl_items');
        $this->load->model('tax_rates/mdl_tax_rates');
        $this->load->model('mdl_invoice_tax_rates');
        $this->load->model('users/mdl_users');


        $invoice = $this->mdl_invoices->where('ip_invoices.invoice_id', $invoiceID)->get()->row();
        $client = $this->mdl_clients->where('client_id', $invoice->client_id)->get()->row();
        $emittente = $this->mdl_users->where('ip_users.user_id', $invoice->user_id)->get()->row();
        $emittentePhone = $emittente->user_phone != null ? $emittente->user_phone : $emittente->user_mobile;
        $emittenteEmail = $emittente->user_pec != null ? $emittente->user_pec : $emittente->user_email;

        /**
         * a few checks
         */
        //dati emittente incompleti
        if ($emittente->user_country == null || $emittente->user_tax_code == null) {
            echo '<script>alert("ERRORE! Non hai specificato i tuoi dati: -Nazione e -Codice Fiscale/Partita iva. Impossibile generare xml per fatturazione elettronica.");</script>';
            echo "Se vuoi modificare i tuoi dati <a href='/index.php/users/form/{$invoice->user_id}'>clicca qui</a><br />";
            echo "<a href='/index.php/invoices/status/all'>indietro</a>";
            return;
        }
        //dati sede incompleti
        if ($emittente->user_address_1 == null || $emittente->user_zip == null || $emittente->user_city == null || $emittente->user_country == null) {
            echo '<script>alert("ERRORE! Il tuo indirizzo è incompleto. Impossibile generare xml per fatturazione elettronica.");</script>';
            echo "Se vuoi modificare i tuoi dati <a href='/index.php/users/form/{$invoice->user_id}'>clicca qui</a><br />";
            echo "<a href='/index.php/invoices/status/all'>indietro</a>";
            return;
        }
        //cliente indirizzo incompleto
        if ($client->client_address_1 == null || $client->client_zip == null || $client->client_city == null || $client->client_country == null) {
            echo '<script>alert("ERRORE! L\'indirizzo del cliente è incompleto. Impossibile generare xml per fatturazione elettronica.");</script>';
            echo "Se vuoi modificare i dati del cliente <a href='/index.php/clients/form/{$invoice->client_id}'>clicca qui</a><br />";
            echo "<a href='/index.php/invoices/status/all'>indietro</a>";
            return;
        }
        // manca codice di interscambio e pec
        if ($client->client_cod_interscambio == null && $client->client_pec == null) {
            echo '<script>alert("ERRORE: Per il cliente selezionato non è stato specificato né il codice di interscambio né un indirizzo Pec. Almeno uno di questi campi è necessario per la fatturazione elettronica");</script>';
            echo "Se vuoi modificare i dati del cliente <a href='/index.php/clients/form/{$invoice->client_id}'>clicca qui</a><br />";
            echo "<a href='/index.php/invoices/status/all'>indietro</a>";
            return;
        }

        //get tax code
        $emittenteTaxCode = $emittente->user_tax_code != null ? $emittente->user_tax_code : $emittente->user_vat_id;
		$emittenteVatId = $emittente->user_vat_id != null ? $emittente->user_vat_id : $emittente->user_vat_id;
		/*$emittenteAnagrafica = $emittente->user_company != null ?
            AnagraficaClass::getAnagraficaNome($emittente->user_name, $emittente->user_company, null, null) :
            AnagraficaClass::getAnagraficaDenominazione($emittente->user_name);*/
		
        $datiTrans = new DatiTrasmissione(
            new IdTrasmittenteClass($emittente->user_country, $emittente->user_vat_id),
            $invoice->invoice_number,
            FormatoTrasmissioneClass::FPR12,
            $client->client_cod_interscambio != null ? $client->client_cod_interscambio : "0000000",
            new ContattiTrasmittenteClass($emittentePhone, $emittenteEmail),
            $client->client_pec
        );

		$emittenteRF = $emittente->user_regime_fiscale_cod != null ? $emittente->user_regime_fiscale_cod : "RF01";
        $cedentePrest = new CedentePrestatore(
            new DatiAnagrafici(
                new IdFiscaleIVAClass($emittente->user_country, $emittenteVatId),
                AnagraficaClass::getAnagraficaDenominazione($emittente->user_company),
                
				//$emittenteTaxCode
				//$emittenteAnagrafica,
                
                /*@todo*/
                
				$emittenteRF
                //RegimeFiscaleClass::Forfettario
            ),
            /**
             * @todo
             */
            new Luogo($emittente->user_address_1.' '.$emittente->user_address_2, $emittente->user_zip, $emittente->user_city,
                $emittente->user_country, null, $emittente->user_state)
//            null, //new Luogo("P.za Cesare Battisti", "31030", "Breda di Piave", "Italia", 11, "TV"),
//            null, //new IscrizioneREAClass("blabla", 322, StatoLiquidazioneClass::NO, 1000, SocioUnicoClass::SI),
//            null, //new ContattiClass(3484655214, "0422904323", "tommaso.pado@gmail.com"),
//            null //"ciao amministrazione"
        );


        /**
         * @todo
         */
        $rapprFisc = new RappresentanteFiscale(new DatiAnagraficiSimplified(
            new IdFiscaleIVAClass($client->client_country, $client),
            AnagraficaClass::getAnagraficaDenominazione("deepmayo", "mr.", "eora"),
            "PDVTMS65489"
        ));


        $clientTaxCode = $client->client_tax_code != null ? $client->client_tax_code : $client->client_vat_id;
		$clientVatId = $client->client_vat_id != null ? $client->client_vat_id : $client->client_vat_id;
        $clientAnagrafica = $client->client_surname != null ?
            AnagraficaClass::getAnagraficaNome($client->client_name, $client->client_surname, null, null) :
            AnagraficaClass::getAnagraficaDenominazione($client->client_name);
		
		
        $cessCommit = new CessionarioCommittente(
            new DatiAnagraficiSimplified(
                new IdFiscaleIVAClass($client->client_country, $clientVatId),
                /** @todo */
                $clientAnagrafica,
                $clientTaxCode
            ),
            new Luogo($client->client_address_1.' '.$client->client_address_2, $client->client_zip, $client->client_city,
                $client->client_country, null, $client->client_state)
        );



        $datiGenScontoMag = null;
        if ($invoice->invoice_discount_percent != 0 || $invoice->invoice_discount_amount != 0)
            $datiGenScontoMag = new ScontoMaggiorazione(new TipoTipo(TipoTipo::SCONTO), $invoice->invoice_discount_percent, $invoice->invoice_discount_amount);
        $datiGen = new DatiGenerali(
            new DatiGeneraliDocumento(
                /** @todo  */
                new TipoDocumento(new TipoDocumento(TipoDocumento::Fattura)),
                "EUR",
                $invoice->invoice_date_created,
                /** @todo  */
                $invoice->invoice_number,
                /** @todo */  null,
                //new DatiRitenuta(new TipoRitenuta(TipoRitenuta::PERSONE_FISICHE), "1200", "20", "perché tvb"),
                /** @todo  */ null,
                //$invoice->invoice_asolvimento_bollo,
				//$invoice->invoice_importo_bollo,
                /** @todo */  null,
//                new DatiCassaPrevidenziale(new TipoCassa(TipoCassa::Cassa_Nazionale_del_Notariato),
//                    "asdas",
//                    "20",
//                    "22",
//                    "asd",
//                    new EnumRitenuta(EnumRitenuta::contributo_cassa_soggetto_a_ritenuta),
//                    new EnumNatura(EnumNatura::non_imponibili),
//                    "asdasdasdas"),
                $datiGenScontoMag,
                $invoice->invoice_total,
                null,
                $invoice->invoice_terms
                //new Art73(Art73::documento_emesso_secondo_modalita_e_termini_stabiliti_con_DM_ai_sensi_del_art_73)
            )
        );



        $dettaglioLinee = array();
        $linea = 1;
        $invoiceItems = $this->mdl_items->where('ip_invoice_items.invoice_id',$invoiceID)->get()->result();
        /**
         * @todo this will save the last aliquota in the invoice, thus it will work only for "single-aliquoted" invoice
         */
        $aliquotaIVARiepilogo = '';
        foreach ($invoiceItems as $item) {
            array_push(
                $dettaglioLinee,
                new DettaglioLinee(
                    $linea++,
                    $item->item_name,
                    $item->item_price,
                    $item->item_subtotal,
                    $item->item_tax_rate_id != null && $item->item_tax_rate_id != 0 ?
                        $this->mdl_tax_rates->where('ip_tax_rates.tax_rate_id', $item->item_tax_rate_id)->get()->row()->tax_rate_percent :
                        "00.00",
					null, //new TipoCessionePrestazione(TipoCessionePrestazione::Abbuono),
                    null, //new CodiceArticolo("codtipo", "codval"),
                    $item->item_quantity,
                    $item->item_product_unit,
                    null, //"asdasdas",
                    null, //"asdasdas",
                    $item->item_discount_amount != null ? new ScontoMaggiorazione(new TipoTipo(TipoTipo::SCONTO), "0", $item->item_discount_amount) : null,
                    null, //new TipoRitenutaBody(TipoRitenutaBody::LINEA_FATTURA_SOGGETTA_A_RITENUTA),
                    null, //new TipoNaturaBody(TipoNaturaBody::escluseexart15),
                    null, //"asdasdas",
                    null //new AltriDatiGestionali("tipodato", "tipotesto", "rifnum", "rifdata")

                )
            );
            $aliquotaIVARiepilogo = $item->item_tax_rate_id != null && $item->item_tax_rate_id != 0 ?
                $this->mdl_tax_rates->where('ip_tax_rates.tax_rate_id', $item->item_tax_rate_id)->get()->row()->tax_rate_percent :
                "00.00";
        }
        $invoiceTaxRate = $this->mdl_invoice_tax_rates->where('ip_invoice_tax_rates.invoice_id', $invoiceID)->get()->row();
        /**
         * @todo controllare aliquota iva
         */
        $datiBenServ = new DatiBeniServizi(
            $dettaglioLinee,
            new DatiRiepilogo(
                //$invoiceTaxRate != null ? $this->mdl_tax_rates->where('ip_tax_rates.tax_rate_id', $invoiceTaxRate->tax_rate_id)->get()->row()->tax_rate_percent : 0,
                $aliquotaIVARiepilogo,
				//$DatiRiepilogo->natura,
                $invoice->invoice_item_subtotal,
                /** @todo controllare*/
                $invoice->invoice_item_tax_total,
                null, //"spesacc",
                null, //"arrot",
                null, //new TipoEsigibilitaIVA(TipoEsigibilitaIVA::IVA_ad_esigibilita_immediata),
                null //"rifnorm"
            )
        );

        $f=new Fattura();
        $f->addHeaderElement($datiTrans);
        $f->addHeaderElement($cedentePrest);
        $f->addHeaderElement($cessCommit);
        /** @todo */
//        $f->addHeaderElement($rapprFisc);

        $f->addBodyElement($datiGen);
        $f->addBodyElement($datiBenServ);

        $filename = $f->getFilename();

        header("Content-type: text/xml");
        header("Content-Disposition: attachment; filename=$filename");
        echo $f->getFatturaAsXML();


    }

    /**
     * @param string $status
     * @param int $page
     */
    public function status($status = 'all', $page = 0)
    {
        // Determine which group of invoices to load
        switch ($status) {
            case 'draft':
                $this->mdl_invoices->is_draft();
                break;
            case 'sent':
                $this->mdl_invoices->is_sent();
                break;
            case 'viewed':
                $this->mdl_invoices->is_viewed();
                break;
            case 'paid':
                $this->mdl_invoices->is_paid();
                break;
            case 'overdue':
                $this->mdl_invoices->is_overdue();
                break;
        }

        $this->mdl_invoices->paginate(site_url('invoices/status/' . $status), $page);
        $invoices = $this->mdl_invoices->result();

        $this->layout->set(
            [
                'invoices' => $invoices,
                'status' => $status,
                'filter_display' => true,
                'filter_placeholder' => trans('filter_invoices'),
                'filter_method' => 'filter_invoices',
                'invoice_statuses' => $this->mdl_invoices->statuses(),
            ]
        );

        $this->layout->buffer('content', 'invoices/index');
        $this->layout->render();
    }

    public function archive()
    {
        $invoice_array = [];

        if (isset($_POST['invoice_number'])) {
            $invoiceNumber = $_POST['invoice_number'];
            $invoice_array = glob(UPLOADS_ARCHIVE_FOLDER . '*' . '_' . $invoiceNumber . '.pdf');
            $this->layout->set(
                [
                    'invoices_archive' => $invoice_array,
                ]);
            $this->layout->buffer('content', 'invoices/archive');
            $this->layout->render();

        } else {
            foreach (glob(UPLOADS_ARCHIVE_FOLDER . '*.pdf') as $file) {
                array_push($invoice_array, $file);
            }

            rsort($invoice_array);
            $this->layout->set(
                [
                    'invoices_archive' => $invoice_array,
                ]);
            $this->layout->buffer('content', 'invoices/archive');
            $this->layout->render();
        }
    }

    /**
     * @param $invoice
     */
    public function download($invoice)
    {
        header('Content-type: application/pdf');
        header('Content-Disposition: attachment; filename="' . urldecode($invoice) . '"');
        readfile(UPLOADS_ARCHIVE_FOLDER . urldecode($invoice));
    }

    /**
     * @param $invoice_id
     */
    public function view($invoice_id)
    {
        $this->load->model(
            [
                'mdl_items',
                'tax_rates/mdl_tax_rates',
                'payment_methods/mdl_payment_methods',
                'mdl_invoice_tax_rates',
                'custom_fields/mdl_custom_fields',
            ]
        );

        $this->load->helper("custom_values");
        $this->load->helper("client");
        $this->load->model('units/mdl_units');
        $this->load->module('payments');

        $this->load->model('custom_values/mdl_custom_values');
        $this->load->model('custom_fields/mdl_invoice_custom');

        $this->db->reset_query();

        /*$invoice_custom = $this->mdl_invoice_custom->where('invoice_id', $invoice_id)->get();

        if ($invoice_custom->num_rows()) {
            $invoice_custom = $invoice_custom->row();

            unset($invoice_custom->invoice_id, $invoice_custom->invoice_custom_id);

            foreach ($invoice_custom as $key => $val) {
                $this->mdl_invoices->set_form_value('custom[' . $key . ']', $val);
            }
        }*/

        $fields = $this->mdl_invoice_custom->by_id($invoice_id)->get()->result();
        $invoice = $this->mdl_invoices->get_by_id($invoice_id);

        if (!$invoice) {
            show_404();
        }

        $custom_fields = $this->mdl_custom_fields->by_table('ip_invoice_custom')->get()->result();
        $custom_values = [];
        foreach ($custom_fields as $custom_field) {
            if (in_array($custom_field->custom_field_type, $this->mdl_custom_values->custom_value_fields())) {
                $values = $this->mdl_custom_values->get_by_fid($custom_field->custom_field_id)->result();
                $custom_values[$custom_field->custom_field_id] = $values;
            }
        }

        foreach ($custom_fields as $cfield) {
            foreach ($fields as $fvalue) {
                if ($fvalue->invoice_custom_fieldid == $cfield->custom_field_id) {
                    // TODO: Hackish, may need a better optimization
                    $this->mdl_invoices->set_form_value(
                        'custom[' . $cfield->custom_field_id . ']',
                        $fvalue->invoice_custom_fieldvalue
                    );
                    break;
                }
            }
        }

        $this->layout->set(
            [
                'invoice' => $invoice,
                'items' => $this->mdl_items->where('invoice_id', $invoice_id)->get()->result(),
                'invoice_id' => $invoice_id,
                'tax_rates' => $this->mdl_tax_rates->get()->result(),
                'invoice_tax_rates' => $this->mdl_invoice_tax_rates->where('invoice_id', $invoice_id)->get()->result(),
                'units' => $this->mdl_units->get()->result(),
                'payment_methods' => $this->mdl_payment_methods->get()->result(),
                'custom_fields' => $custom_fields,
                'custom_values' => $custom_values,
                'custom_js_vars' => [
                    'currency_symbol' => get_setting('currency_symbol'),
                    'currency_symbol_placement' => get_setting('currency_symbol_placement'),
                    'decimal_point' => get_setting('decimal_point'),
                ],
                'invoice_statuses' => $this->mdl_invoices->statuses(),
            ]
        );

        if ($invoice->sumex_id != null) {
            $this->layout->buffer(
                [
                    ['modal_delete_invoice', 'invoices/modal_delete_invoice'],
                    ['modal_add_invoice_tax', 'invoices/modal_add_invoice_tax'],
                    ['modal_add_payment', 'payments/modal_add_payment'],
                    ['content', 'invoices/view_sumex'],
                ]
            );
        } else {
            $this->layout->buffer(
                [
                    ['modal_delete_invoice', 'invoices/modal_delete_invoice'],
                    ['modal_add_invoice_tax', 'invoices/modal_add_invoice_tax'],
                    ['modal_add_payment', 'payments/modal_add_payment'],
                    ['content', 'invoices/view'],
                ]
            );
        }

        $this->layout->render();
    }

    /**
     * @param $invoice_id
     */
    public function delete($invoice_id)
    {
        // Get the status of the invoice
        $invoice = $this->mdl_invoices->get_by_id($invoice_id);
        $invoice_status = $invoice->invoice_status_id;

        if ($invoice_status == 1 || $this->config->item('enable_invoice_deletion') === true) {
            // If invoice refers to tasks, mark those tasks back to 'Complete'
            $this->load->model('tasks/mdl_tasks');
            $tasks = $this->mdl_tasks->update_on_invoice_delete($invoice_id);

            // Delete the invoice
            $this->mdl_invoices->delete($invoice_id);
        } else {
            // Add alert that invoices can't be deleted
            $this->session->set_flashdata('alert_error', trans('invoice_deletion_forbidden'));
        }

        // Redirect to invoice index
        redirect('invoices/index');
    }

    /**
     * @param $invoice_id
     * @param bool $stream
     * @param null $invoice_template
     */
    public function generate_pdf($invoice_id, $stream = true, $invoice_template = null)
    {
        $this->load->helper('pdf');

        if (get_setting('mark_invoices_sent_pdf') == 1) {
            $this->mdl_invoices->mark_sent($invoice_id);
        }

        generate_invoice_pdf($invoice_id, $stream, $invoice_template, null);
    }

    /**
     * @param $invoice_id
     */
    public function generate_zugferd_xml($invoice_id)
    {
        $this->load->model('invoices/mdl_items');
        $this->load->library('ZugferdXml', [
            'invoice' => $this->mdl_invoices->get_by_id($invoice_id),
            'items' => $this->mdl_items->where('invoice_id', $invoice_id)->get()->result(),
        ]);

        $this->output->set_content_type('text/xml');
        $this->output->set_output($this->zugferdxml->xml());
    }

    public function generate_sumex_pdf($invoice_id)
    {
        $this->load->helper('pdf');

        generate_invoice_sumex($invoice_id);
    }

    public function generate_sumex_copy($invoice_id)
    {


        $this->load->model('invoices/mdl_items');
        $this->load->library('Sumex', [
            'invoice' => $this->mdl_invoices->get_by_id($invoice_id),
            'items' => $this->mdl_items->where('invoice_id', $invoice_id)->get()->result(),
            'options' => [
                'copy' => "1",
                'storno' => "0",
            ],
        ]);

        $this->output->set_content_type('application/pdf');
        $this->output->set_output($this->sumex->pdf());
    }

    /**
     * @param $invoice_id
     * @param $invoice_tax_rate_id
     */
    public function delete_invoice_tax($invoice_id, $invoice_tax_rate_id)
    {
        $this->load->model('mdl_invoice_tax_rates');
        $this->mdl_invoice_tax_rates->delete($invoice_tax_rate_id);

        $this->load->model('mdl_invoice_amounts');
        $this->mdl_invoice_amounts->calculate($invoice_id);

        redirect('invoices/view/' . $invoice_id);
    }

    public function recalculate_all_invoices()
    {
        $this->db->select('invoice_id');
        $invoice_ids = $this->db->get('ip_invoices')->result();

        $this->load->model('mdl_invoice_amounts');

        foreach ($invoice_ids as $invoice_id) {
            $this->mdl_invoice_amounts->calculate($invoice_id->invoice_id);
        }
    }

}
