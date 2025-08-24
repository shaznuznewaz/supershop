<div class="container my-5">
    <h2 class="mb-4 text-center">Report Summary</h2>

    <!-- Date Filter Form -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('reports.page') }}">
                <div class="row g-3 ">
                    <div class="col-md-4">
                        <label for="start_date" class="form-label">Start Date:</label>
                        <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label">End Date:</label>
                        <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                    </div>
                    <div class="col-md-4 d-grid ">
                         <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Report Table -->
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-bordered text-center mb-0">
                <tbody>
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
                </tbody>
            </table>
        </div>
    </div>

    <!-- Download Button -->
    <div class="text-center mt-4">
        <a href="{{ route('reports.download', request()->all()) }}" class="btn btn-success btn-lg">
            <i class="bi bi-download me-2"></i> Download Report (PDF)
        </a>
    </div>
</div>
