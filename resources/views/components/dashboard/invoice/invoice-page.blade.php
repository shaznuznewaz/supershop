<div class="container">
    <h4>Invoices</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Customer</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->id }}</td>
                    <td>{{ $invoice->customer->name ?? 'N/A' }}</td>
                    <td>${{ $invoice->total_amount }}</td>
                    <td>{{ ucfirst($invoice->status) }}</td>
                    <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('invoice.pdf', $invoice->id) }}" class="btn btn-sm btn-info">PDF</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
