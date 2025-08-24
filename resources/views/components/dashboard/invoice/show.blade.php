
<div class="container">
    <h2>Invoice #{{ $invoice->invoice_number }}</h2>
    <p><strong>Customer Name:</strong> {{ $invoice->customer->name ?? 'N/A' }}</p>
    <p><strong>Phone:</strong> {{ $invoice->customer->profile->phone ?? 'N/A' }}</p>
    <p><strong>Address:</strong> {{ $invoice->customer->profile->address ?? 'N/A' }}</p>
    
    <p><strong>Date:</strong> {{ $invoice->invoice_date }}</p>
    <p><strong>Status:</strong> {{ $invoice->status }}</p>

    <h4>Invoice Details</h4>
    <table class="table table-bordered">
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

    <h4>Grand Total: {{ $invoice->total_amount }}</h4>

    <a href="{{ route('invoice.pdf', $invoice->id) }}" class="btn btn-primary">Download PDF</a>
</div>