<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
   public function reportPage(Request $request)
    {
        // Date filter: start & end date
        $startDate = $request->start_date ? Carbon::parse($request->start_date)->startOfDay() : null;
        $endDate   = $request->end_date ? Carbon::parse($request->end_date)->endOfDay() : null;

        // Filtered invoices
        $filteredInvoices = Invoice::query();
        if($startDate && $endDate){
            $filteredInvoices->whereBetween('created_at', [$startDate, $endDate]);
        }
        $filteredInvoices = $filteredInvoices->get();

        // Lifetime total sales
        $totalSales = Invoice::sum('total_amount');

        // Selected period sales
        $selectedPeriodSales = $filteredInvoices->sum('total_amount');

        // Total invoices in period
        $totalInvoices = $filteredInvoices->count();

        // Paid / unpaid invoices
        $paidInvoices = $filteredInvoices->where('status', 'Paid')->count();
        $unpaidInvoices = $filteredInvoices->where('status', 'Pending')->count();

        return view('pages.report.report', compact(
            'totalSales',
            'selectedPeriodSales',
            'totalInvoices',
            'paidInvoices',
            'unpaidInvoices',
            'startDate',
            'endDate'
        ));
    }

    // PDF Download
    public function downloadReport(Request $request)
    {
        $startDate = $request->start_date ? Carbon::parse($request->start_date)->startOfDay() : null;
        $endDate   = $request->end_date ? Carbon::parse($request->end_date)->endOfDay() : null;

        $filteredInvoices = Invoice::query();
        if($startDate && $endDate){
            $filteredInvoices->whereBetween('created_at', [$startDate, $endDate]);
        }
        $filteredInvoices = $filteredInvoices->get();

        $totalSales = Invoice::sum('total_amount'); // Lifetime
        $selectedPeriodSales = $filteredInvoices->sum('total_amount');
        $totalInvoices = $filteredInvoices->count();
        $paidInvoices = $filteredInvoices->where('status', 'Paid')->count();
        $unpaidInvoices = $filteredInvoices->where('status', 'Pending')->count();

        $pdf = Pdf::loadView('pages.report.report-pdf', compact(
            'totalSales','selectedPeriodSales','totalInvoices','paidInvoices','unpaidInvoices','startDate','endDate'
        ));

        return $pdf->download('report-'.date('Y-m-d-H-i-s').'.pdf');
    }
}
