<?php
namespace App\Mail;

use App\Models\Sale;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sale;

    public function __construct(Sale $sale)
    {
        $this->sale = $sale;
    }

    public function build()
    {
        
        $pdf = Pdf::loadView('facture', ['sale' => $this->sale]);

        return $this->subject('Votre facture #' . $this->sale->id)
                    ->view('facture')
                    ->attachData($pdf->output(), 'facture_'.$this->sale->id.'.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
