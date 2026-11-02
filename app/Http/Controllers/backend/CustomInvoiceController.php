<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\CustomInvoice;
use App\Models\Service;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CustomInvoiceController extends Controller
{
    public function create(){
        $services = Service::all();
        return view('backend.custom-invoice.add', [
            'services' => $services,
        ]);
    }

    public function store(Request $request){
        $invoice = CustomInvoice::createCustomInvoice($request);

        // Store invoice id in session to use for downloading PDF
        session()->flash('invoice_id', $invoice->id);

        Alert::success('Success', 'Custom Invoice Created successfully');
        return back();
    }

    public function downloadInvoice($id){
        $invoice = CustomInvoice::findOrFail($id);

        $pdf = Pdf::loadView('backend.custom-invoice.custom-invoice', [
            'invoice' => $invoice
        ]);

        return $pdf->download('invoice-'.$invoice->id.'.pdf');
    }

    public function index(){
        $customInvoices = CustomInvoice::orderBy('created_at', 'desc')->get();
        return view('backend.custom-invoice.index', [
            'customInvoices' => $customInvoices
        ]);
    }

    public function view($id){
        $customInvoice = CustomInvoice::findOrFail($id);
        return view('backend.custom-invoice.show', [
            'customInvoice' => $customInvoice
        ]);
    }

    public function edit($id){
        $customInvoice = CustomInvoice::findOrFail($id);
        return view('backend.custom-invoice.edit', [
            'customInvoice' => $customInvoice
        ]);
    }

    public function update(Request $request, $id){
        $customInvoice = CustomInvoice::updateCustomInvoice($id, $request);

        // Store invoice id in session to use for downloading PDF
        session()->flash('invoice_id', $customInvoice->id);

        Alert::success('Success', 'Custom Invoice Updated successfully');
        return redirect()->route('admin.custom-invoices');
    }

    public function destroy($id){
        CustomInvoice::deleteCustomInvoice($id);
        Alert::success('Success', 'Custom Invoice Deleted successfully');
        return back();
    }


}
