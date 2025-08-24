<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;
use App\Models\Invoice;
use App\Models\InvoiceDetails;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{
    public function index(){

    }

    public function store(Request $request){

     /*   try{

            $grossTotal=0;
            $invoiceData=[
                'customer_id'=>$request->customer_id,
                'user_id'=>$request->user_id,
                'invoice_date'=>$request->invoice_date,
                'invoice_number'=>('INV').date('Ymd').uniqid(),
                'total_amount'=>0,
                'notes'=>$request->notes,
                'status'=>'pending', // Default status
            ];

            $invoice=Invoice::create($invoiceData);
            
            $products=$request->product;
            $quantities=$request->quantity;
            $amounts=$request->amount;

            $total_amount=0;
            $invoiceDetails=[];
            foreach($products as $key=>$value){ 
                $product_id=$products[$key];
                $quantity=$quantities[$key];
                $amount=$amounts[$key];

                $total_amount=$amount*$quantity;
                $grossTotal+=$total_amount;

                $invoiceDetailsData=[

                    'invoice_id'=>$invoice->id,
                    'product_id'=>$product_id,
                    'quantity'=>$quantity,
                    'amount'=>$amount,
                    'total_amount'=>$total_amount
                ];

               $invoiceDetails[]= InvoiceDetails::create($invoiceDetailsData);     
                
            }

            $invoice->total_amount=$grossTotal;
            $invoice->save();
            return response()->json([
                    'status'=>'200',
                    'message'=>'Invoice created successfully',
                    'data'=>$invoiceDetails

                ]);
            
        }catch(\Exception $e){
            Log::critical($e->getMessage().' '.$e->getLine().' '.$e->getFile());
            return response()->json([
                'status'=>'201',
                'message'=>'Unable to create invoice'
            ]);
        }   */


        $order_id = $request->order_id;
       
        $customer_id = $request->customer_id;
        $user = Auth::user();
        $invoice_date = date('Y-m-d H:i:s');
        $notes = '';

        $random = mt_rand(100000, 999999);
        $invoice_number = 'INV-'.date('Ymd').'-'.$random;

        $gross_total_amount = 0;

        $invoice = Invoice::create([
            'order_id'=> $order_id,
            'customer_id'=> $customer_id,
            'user_id'=> 2,
            'invoice_number'=> $invoice_number,
            'invoice_date'=> $invoice_date,
            'total_amount'=> 0,
            'status'=> "Paid",
        ]);




        $orderDetails = OrderDetails::where('order_id', $order_id)->get();

        $total_amount = 0;
        foreach($orderDetails as $order)
        {
            $product_id = $order->product_id;
            $quantity  = $order->quantity;
            $amount  = $order->price;

            $total_amount = $quantity * $amount;
            $gross_total_amount+= $total_amount;

            $invoiveDetails = [
                'invoice_id' =>  $invoice->id,
                'product_id' =>  $product_id,
                'quantity' =>  $quantity,
                'amount' =>  $amount,
                'total_amount' =>  $total_amount,
            ];

            InvoiceDetails::create($invoiveDetails);

            // update product table:
            $product = Product::find($product_id);
            $product->quantity = $product->quantity - $quantity;
            $product->save();
        }

        $invoice->total_amount = $gross_total_amount;
        $invoice->save();

        $order = Order::find($order->id);
        $order->status = 'confirmed';
        $order->save();

        return response()->json([
            'status' => 'success',
            'data' => $invoice,
            'message' => 'Invoice Created successfully.'
        ]);
    }

    

    public function show($id){

        $invoice = Invoice::with(['customer','user', 'details.product'])->findOrFail($id);
        return view('pages.dashboard.invoice.show', compact('invoice'));
    }
    


    public function print(Invoice $invoice)
    {
        $invoice->load(['customer','user', 'details.product']);

        // Load Blade view into PDF
        $pdf = Pdf::loadView('pages.dashboard.pdf.invoice', compact('invoice'));

        // Download
        return $pdf->download('invoice_'.$invoice->id.'.pdf');
    }

    public function customerdashboardInvoices(){
        $user=Auth::user();
       // $invoices=Invoice::where('user_id',$user->id)->orderBy('created_at','desc')->get();
        $invoices=Invoice::with('customer')->where('customer_id', $user->id)->orderBy('created_at','desc')->get();
        return view('pages.dashboard.invoice.invoice-page',compact('invoices'));
    }
    public function admindashboardInvoices(){
        
       
        $invoices=Invoice::with('customer')->orderBy('created_at','desc')->get();
        return view('pages.dashboard.admin.invoice.invoice',compact('invoices'));
    }


}
