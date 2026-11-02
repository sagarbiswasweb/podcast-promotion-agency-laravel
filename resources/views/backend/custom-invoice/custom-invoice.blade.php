<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Invoice #{{ $invoice->id }}</title>
  <style>
    :root {
      --brand: #2563eb;   /* modern blue */
      --line: #e5e7eb;
      --muted: #6b7280;
      --bg: #f9fafb;
    }

    body {
      font-family: "Segoe UI", Arial, sans-serif;
      line-height: 1.5;
      margin: 0;
      padding: 24px;
      background: var(--bg);
      color: #111;
      font-size: 11px; /* smaller clean font */
    }

    h1, h2 {
      margin: 0 0 8px;
      font-weight: 600;
    }

    /* Header */
    .header {
      margin-bottom: 20px;
      border-bottom: 2px solid var(--brand);
      padding-bottom: 10px;
    }
    .header h1 {
      font-size: 18px;
      color: var(--brand);
      margin-bottom: 4px;
    }
    .header p {
      margin: 2px 0;
      font-size: 11px;
      color: var(--muted);
    }

    /* Section titles */
    .section-title {
      margin: 20px 0 8px;
      font-size: 12px;
      font-weight: 600;
      color: var(--brand);
      border-bottom: 1px solid var(--line);
      padding-bottom: 4px;
      text-transform: uppercase;
      letter-spacing: .5px;
    }

    /* Tables */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 16px;
      background: #fff;
      border-radius: 6px;
      overflow: hidden;
      box-shadow: 0 1px 3px rgba(0,0,0,.08);
    }
    th, td {
      border: 1px solid #eee;
      padding: 7px 9px;
      text-align: left;
      vertical-align: top;
    }
    th {
      background: #f3f4f6;
      font-weight: 600;
      color: #374151;
      font-size: 11px;
    }
    td {
      font-size: 11px;
    }
    a { color: var(--brand); text-decoration: none; }

    /* Totals */
    .totals-table {
      width: 240px;
      margin: 0 0 0 auto;
      border: none;
      background: #fff;
      border-radius: 6px;
      box-shadow: 0 1px 3px rgba(0,0,0,.08);
      overflow: hidden;
    }
    .totals-table th, .totals-table td {
      border: none;
      padding: 6px 8px;
      font-size: 11px;
    }
    .totals-table td { text-align: right; }
    .grand-total {
      font-size: 12px;
      font-weight: 700;
      color: var(--brand);
      border-top: 1px solid var(--brand);
      padding-top: 6px;
    }

    /* Watermark */
    .watermark {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%) rotate(-30deg);
      font-size: 28px;
      font-weight: bold;
      color: rgba(0,0,0,0.04);
      pointer-events: none;
      user-select: none;
      white-space: nowrap;
      z-index: 0;
    }

    /* Footer note */
    .note {
      margin-top: 20px;
      text-align: center;
      color: var(--muted);
      font-size: 10px;
      border-top: 1px dashed var(--line);
      padding-top: 6px;
    }

    /* Print */
    @media print {
      body { background: #fff; padding: 0; font-size: 10px; }
      .note { position: fixed; bottom: 10mm; left: 0; right: 0; }
      .watermark { font-size: 24px; }
    }
  </style>
</head>
<body>
  <div class="watermark">podcastranker.net</div>

  <div class="header">
    <h1>PodcastRanker.net</h1>
    <p>Invoice #{{ $invoice->id }}</p>
    <p><strong>Order Date:</strong> {{ $invoice->created_at->format('d M Y') }}</p>
  </div>

  <h2 class="section-title">Client Details</h2>
  <table>
    <tr><th>Name</th><td>{{ $invoice->clientName }}</td></tr>
    <tr><th>Email</th><td>{{ $invoice->clientEmail }}</td></tr>
    <tr><th>Phone</th><td>{{ $invoice->clientPhone }}</td></tr>
  </table>

  <h2 class="section-title">Order Details</h2>
  <table>
    <tr><th>Plan Name</th><td>{{ $invoice->serviceName }}</td></tr>
    <tr><th>Price</th><td>${{ number_format($invoice->price ?? 0, 2) }}</td></tr>
    <tr><th>Duration</th><td>{{ $invoice->duration ?? 'N/A' }}</td></tr>
    <tr><th>Features</th><td>{{ $invoice->features }}</td></tr>
    <tr><th>Link</th><td><a href="{{ $invoice->link }}" target="_blank">{{ $invoice->link }}</a></td></tr>
    <tr><th>Country</th><td>{{ $invoice->country }}</td></tr>
  </table>

  <h2 class="section-title">Payment Details</h2>
  <table>
    <tr><th>Payment Method</th><td>{{ $invoice->paymentMethod }}</td></tr>
    <tr><th>Transaction Id</th><td>{{ $invoice->transactionId }}</td></tr>
  </table>

  <table class="totals-table">
    <tr><th>Amount Paid:</th><td>${{ number_format($invoice->amountPaid, 2) }}</td></tr>
    <tr><th>Tips:</th><td>${{ number_format($invoice->tips, 2) }}</td></tr>
    <tr><th>Payment Due:</th><td>${{ number_format(($invoice->price + $invoice->tips - $invoice->amountPaid), 2) }}</td></tr>
    <tr><th class="grand-total">Total Amount:</th><td class="grand-total">${{ number_format(($invoice->price + $invoice->tips), 2) }}</td></tr>
  </table>

  <p class="note">This is a system-generated invoice from podcastranker.net. Please contact support for questions.</p>
</body>
</html>
