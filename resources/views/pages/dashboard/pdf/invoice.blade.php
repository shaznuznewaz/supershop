<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $invoice->invoice_number }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; padding: 8px; }
    </style>
</head>
<body>
      <!-- Customer Name -->
    <p><strong>Customer Name:</strong> {{ $invoice->customer->name ?? 'N/A' }}</p>
    <p><strong>Phone:</strong> {{ $invoice->customer->profile->phone ?? 'N/A' }}</p>
    <p><strong>Address:</strong> {{ $invoice->customer->profile->address ?? 'N/A' }}</p>
    <h2>Invoice #{{ $invoice->invoice_number }}</h2>
    <p><strong>Date:</strong> {{ $invoice->invoice_date }}</p>
    <p><strong>Status:</strong> {{ $invoice->status }}</p>

    <h4>Details</h4>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->details as $detail)
                <tr>
                    <td>{{ $detail->product->name }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ $detail->amount }}</td>
                    <td>{{ $detail->total_amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total: {{ $invoice->total_amount }}</h3>
</body>
</html>
