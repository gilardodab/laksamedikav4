<?php

namespace App\Observers;

use App\Models\Invoice_detailppn;

class Invoice_detailppnObserver
{
    /**
     * Handle the invoice_detail "created" event.
     *
     * @param  \App\Invoice_detailppn  $invoiceDetail
     * @return void
     */
    private function generateTotal($invoiceDetailppn)
    {
        //MENGAMBIL INVOICE_ID
        $invoiceppn_id = $invoiceDetailppn->invoiceppn_id;
        //SELECT DARI TABLE invoice_details BERDASARKAN INVOICE
        $invoice_detailppn = Invoice_detailppn::where('invoiceppn_id', $invoiceppn_id)->get();
        //KEMUDIAN DIJUMLAH UNTUK MENDAPATKAN TOTALNYA
        $total = $invoice_detailppn->sum(function ($i) {
             //DIMANA KETENTUAN YANG DIJUMLAHKAN ADALAH HASIL DARI price* qty kode diskon % ->  (($i->price * $i->qty * $i->diskon) / 100)
            return ($i->price * $i->qty) - $i->diskon;
        });
        //UPDATE TABLE invoice PADA FIELD TOTAL
        $invoiceDetailppn->invoiceppn()->update([
            'total' => $total
        ]);
    }

    public function created(Invoice_detailppn $invoiceDetailppn)
    {
        //
        $this->generateTotal($invoiceDetailppn);
    }

    /**
     * Handle the invoice_detail "updated" event.
     *
     * @param  \App\Invoice_detailppn  $invoiceDetail
     * @return void
     */
    public function updated(Invoice_detailppn $invoiceDetailppn)
    {
        //
        $this->generateTotal($invoiceDetailppn);
    }

    /**
     * Handle the invoice_detail "deleted" event.
     *
     * @param  \App\Invoice_detailppn  $invoiceDetail
     * @return void
     */
    public function deleted(Invoice_detailppn $invoiceDetailppn)
    {
        //
        $this->generateTotal($invoiceDetailppn);
    }

    /**
     * Handle the invoice_detail "restored" event.
     *
     * @param  \App\Invoice_detailppn  $invoiceDetail
     * @return void
     */
    public function restored(Invoice_detailppn $invoiceDetailppn)
    {
        //
    }

    /**
     * Handle the invoice_detail "force deleted" event.
     *
     * @param  \App\Invoice_detailppn  $invoiceDetail
     * @return void
     */
    public function forceDeleted(Invoice_detailppn $invoiceDetailppn)
    {
        //
    }
}
