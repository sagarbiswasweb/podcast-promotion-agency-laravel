<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('backend.orders.index', [
            'orders' => $orders
        ]);
    }

    public function viewOrder($id){
        $order = Order::find($id);

        if (!$order->seen) {
            $order->seen = true;
            $order->save();
        }

        return view('backend.orders.view', [
            'order' => $order
        ]);
    }
    
    public function updateStatus(Request $request, $id){
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        Alert::success('Success', 'Order status updated successfully');
        return back();
    }

    // for generating and download invoice from the backend 
    public function downloadInvoice($id){
        $order = Order::with('user', 'plan')->findOrFail($id);
        $pdf = Pdf::loadView('backend.orders.invoice', compact('order'));
        return $pdf->download('invoice_' . $order->id . '_' . $order->name . '.pdf');
    }


    // for sending email to user with invoice attachment
    // check 'app/mail/invoiceMail.php' for more details
    public function sendInvoice(Request $request, $id){
        $order = Order::with('plan.service', 'user')->findOrFail($id);
        // Generate the invoice PDF
        $pdf = Pdf::loadView('backend.orders.invoice', compact('order'));
        // Send invoice email
        Mail::to($order->email)->send(new InvoiceMail($order, $pdf->output()));
        Alert::success('Success', 'Email send successfully');
        return back();
    }

    // mark as seen 
    public function markSeen($id)
    {
        try {
            $order = \App\Models\Order::findOrFail($id);
            if (!$order->seen) {
                $order->seen = true;
                $order->save();
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Order markSeen failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }


    // real time unseen count 
    public function getUnseenCount(){
        $count = Order::where('seen', false)->count();
        return response()->json(['unseenCount' => $count]);
    }

    // real time unseen dropdown list 
    public function unseenDropdown(){
        $unseenOrders = Order::where('seen', false)->latest()->get();
        return view('backend.common.unseen-orders-dropdown', compact('unseenOrders'))->render();
    }

}
