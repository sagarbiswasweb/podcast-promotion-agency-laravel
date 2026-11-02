<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Invoice #{{ $order->id }}</title>
  <style>
    :root {
      --brand: #2563eb; /* modern blue */
      --line: #e5e7eb;
      --muted: #6b7280;
      --bg: #f9fafb;
    }

    body {
      font-family: "Segoe UI", Arial, sans-serif;
      line-height: 1.5;
      margin: 0;
      padding: 20px;
      background: var(--bg);
      color: #111;
      font-size: 11px; /* smaller text */
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
      font-size: 16px;
      color: var(--brand);
      margin-bottom: 2px;
    }
    .header p {
      margin: 1px 0;
      font-size: 11px;
      color: var(--muted);
    }

    /* Section titles */
    .section-title {
      margin: 18px 0 6px;
      font-size: 12px;
      font-weight: 600;
      color: var(--brand);
      border-bottom: 1px solid var(--line);
      padding-bottom: 3px;
      text-transform: uppercase;
      letter-spacing: .5px;
    }

    /* Tables */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 14px;
      background: #fff;
      border-radius: 6px;
      overflow: hidden;
    }
    th, td {
      border: 1px solid #eee;
      padding: 6px 8px;
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

    /* Totals */
    .totals-table {
      width: 220px;
      margin: 0 0 0 auto;
      border: none;
      background: #fff;
      border-radius: 6px;
      overflow: hidden;
    }
    .totals-table th, .totals-table td {
      border: none;
      padding: 5px 8px;
      font-size: 11px;
    }
    .totals-table td {
      text-align: right;
    }
    .grand-total {
      font-size: 12px;
      font-weight: 700;
      color: var(--brand);
      border-top: 1px solid var(--brand);
      padding-top: 5px;
    }

    /* Watermark */
    .watermark {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%) rotate(-30deg);
      font-size: 32px;
      font-weight: 700;
      color: rgba(0,0,0,0.04);
      pointer-events: none;
      user-select: none;
      white-space: nowrap;
      z-index: 0;
    }

    /* Footer */
    .note {
      margin-top: 16px;
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
      .watermark { font-size: 28px; }
    }
  </style>
</head>
<body>
  <div class="watermark">podcastranker.net</div>

  <div class="header">
    <h1>Podcastranker.net</h1>
    <p>Invoice #{{ $order->id }}</p>
    <p><strong>Order Date:</strong> {{ optional($order->created_at)->format('d M Y') }}</p>
    <p><strong>Status:</strong> {{ ucfirst($order->status ?? '—') }}</p>
  </div>

  <h2 class="section-title">Client Details</h2>
  <table>
    <tr><th>Name</th><td>{{ $order->name }}</td></tr>
    <tr><th>Email</th><td>{{ $order->email }}</td></tr>
    <tr><th>Phone</th><td>{{ $order->phone ?? '—' }}</td></tr>
  </table>

  <h2 class="section-title">Order Details</h2>
  <table>
    <tr><th>Transaction ID</th><td>{{ $order->transactionId }}</td></tr>
    <tr>
      <th>Link</th>
      <td>
        @if(!empty($order->link))
          <a href="{{ $order->link }}" target="_blank" rel="noopener">{{ $order->link }}</a>
        @else
          —
        @endif
      </td>
    </tr>
    <tr><th>Targeted Country</th><td>{{ $order->country ?? '—' }}</td></tr>
  </table>

  <h2 class="section-title">Service Details</h2>
  <table>
    <tr>
      <th>Plan Name</th>
      <td>{{ data_get($order,'plan.service.serviceName','N/A') }} {{ data_get($order,'plan.planName','N/A') }} Plan</td>
    </tr>
    <tr>
      <th>Price</th>
      <td>${{ number_format((float) data_get($order,'plan.planPrice',0), 2) }}</td>
    </tr>
    <tr>
      <th>Duration (days)</th>
      <td>{{ data_get($order,'plan.planDuration') ?? 'N/A' }}</td>
    </tr>
    <tr>
      <th>Features</th>
      <td>
        @php
          $raw = data_get($order,'plan.planFeatures');
          $features = is_array($raw) ? $raw : (json_decode((string)$raw, true) ?? []);
        @endphp
        @if(count($features))
          <ul style="margin:0; padding-left:16px;">
            @foreach($features as $feature)
              <li>{{ $feature }}</li>
            @endforeach
          </ul>
        @else
          —
        @endif
      </td>
    </tr>
  </table>

  <table class="totals-table">
    <tr><th>Amount Paid:</th><td>${{ number_format((float) data_get($order,'plan.planPrice',0), 2) }}</td></tr>
    <tr><th>Payment Due:</th><td>$0</td></tr>
    <tr><th class="grand-total">Total Amount:</th><td class="grand-total">${{ number_format((float) data_get($order,'plan.planPrice',0), 2) }}</td></tr>
  </table>

  <p class="note">This is a system-generated invoice from Podcastranker.net. If you have any questions, please contact support.</p>
</body>
</html>
