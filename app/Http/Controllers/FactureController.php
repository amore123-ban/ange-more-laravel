<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;
use Illuminate\Support\Str;
use Endroid\QrCode\Writer\PngWriter;

class FactureController extends Controller
{
    public function show(Sale $sale)
    {
        // Charger les relations
        $sale->load(['items.product', 'items.details', 'shop']);
        
        $ref_fac = Str::random(8);
        
        return view('facture', compact('sale','ref_fac'));
    }

    public function downloadInvoice($id)
    {
        $sale = Sale::with(['items.product', 'shop'])->findOrFail($id);
        
        $pdf = Pdf::loadView('facture', compact('sale'));
        
        return $pdf->download('facture-' . $sale->id . '.pdf');
    }
}