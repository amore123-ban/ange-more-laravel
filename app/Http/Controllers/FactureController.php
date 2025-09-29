<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    public function downloadInvoice($id)
    {
        $sale = Sale::with(['items.product', 'shop'])->findOrFail($id);
        
        $pdf = Pdf::loadView('facture', compact('sale'));
        
        return $pdf->download('facture-' . $sale->id . '.pdf');
    }
}