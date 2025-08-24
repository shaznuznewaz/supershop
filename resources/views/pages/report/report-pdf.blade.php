<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin:20px 0; }
        table, th, td { border: 1px solid black; padding: 8px; text-align: center; }
        h2 { text-align:center; }
    </style>
</head>
<body>
    <h2>Report Summary</h2>
    <table>
        <tr>
            <th>Lifetime Sales</th>
            <td>${{ $totalSales }}</td>
        </tr>
        <tr>
            <th>Selected Period Sales</th>
            <td>${{ $selectedPeriodSales }}</td>
        </tr>
        <tr>
            <th>Total Invoices</th>
            <td>{{ $totalInvoices }}</td>
        </tr>
        <tr>
            <th>Paid</th>
            <td>{{ $paidInvoices }}</td>
        </tr>
        <tr>
            <th>Unpaid (Pending)</th>
            <td>{{ $unpaidInvoices }}</td>
        </tr>
    </table>

    <p style="text-align:right;">
        Generated on {{ \Carbon\Carbon::now('Asia/Dhaka')->format('Y-m-d H:i:s') }}
    </p>
</body>
</html>
