<?php
namespace App\Mail;

use App\Models\Sale;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

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
    $url = URL::route('facture.show', ['sale' => $this->sale->id]);

    $qrCode = new QrCode($url);
    $writer = new PngWriter();
    $qrImage = $writer->write($qrCode);

    $qrCodeBase64 = 'data:image/png;base64,' . base64_encode($qrImage->getString());

    $pdf = Pdf::loadView('facture', [
        'sale' => $this->sale,
        'qrCodeBase64' => $qrCodeBase64,
        'invoiceUrl' => $url,
    ]);

    return $this->subject('Votre facture #' . $this->sale->id)
                ->view('facture')
                ->attachData($pdf->output(), 'facture_'.$this->sale->id.'.pdf', [
                    'mime' => 'application/pdf',
                ]);
}

}
