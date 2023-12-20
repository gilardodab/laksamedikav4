<?php

namespace App\Observers;
use App\Models\Invoice_customer_detail;

class Invoice_customer_detailObserver
{
    /**
     * Handle the invoice_detail "created" event.
     *
     * @param  \App\Invoice_customer_detail  $invoiceDetail
     * @return void
     */
    private function generateTotal($invoice_customer)
    {
        //MENGAMBIL INVOICE_ID
       
        $invoice_customer_id = $invoice_customer->invoice_customer_id;
        //SELECT DARI TABLE invoice_details BERDASARKAN INVOICE
        $invoice_customer_detail = Invoice_customer_detail::where('invoice_customer_id', $invoice_customer_id)->get();
        //KEMUDIAN DIJUMLAH UNTUK MENDAPATKAN TOTALNYA
        $total = $invoice_customer_detail->sum(function ($i) {
             //DIMANA KETENTUAN YANG DIJUMLAHKAN ADALAH HASIL DARI price* qty kode diskon % ->  (($i->price * $i->qty * $i->diskon) / 100)
            return ($i->price * $i->qty) - $i->diskon;
        });
        //UPDATE TABLE invoice PADA FIELD TOTAL
        $invoice_customer->invoice_customer()->update([
            'total' => $total,
        ]);
    }
    
    public function created(Invoice_customer_detail $invoice_customer)
    {
        //
        $this->generateTotal($invoice_customer);
    }

    /**
     * Handle the invoice_detail "updated" event.
     *
     * @param  \App\Invoice_customer_detail  $invoiceDetail
     * @return void
     */
    public function updated(Invoice_customer_detail $invoice_customer)
    {
        //
        $this->generateTotal($invoice_customer);
    }

    /**
     * Handle the invoice_detail "deleted" event.
     *
     * @param  \App\Invoice_customer_detail  $invoiceDetail
     * @return void
     */
    public function deleted(Invoice_customer_detail $invoice_customer)
    {
        //
        $this->generateTotal($invoice_customer);
    }

    /**
     * Handle the invoice_detail "restored" event.
     *
     * @param  \App\Invoice_customer_detail  $invoiceDetail
     * @return void
     */
    public function restored(Invoice_customer_detail $invoice_customer)
    {
        //
    }

    /**
     * Handle the invoice_detail "force deleted" event.
     *
     * @param  \App\Invoice_customer_detail  $invoiceDetail
     * @return void
     */
    public function forceDeleted(Invoice_customer_detail $invoice_customer)
    {
        //
    }
}
