<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Your Invoice</title>
    </head>
    <body>
        <p>Hi {{ $order->name }},</p>

        <p>Thank you for your order. Please find your invoice attached.</p>

        <p>Order ID: {{ $order->id }}</p>
        <p>Date: {{ $order->created_at->format('d M Y') }}</p>

        <p>If you have any questions, feel free to contact us.</p>

        <p>Best regards,<br>
        Podcastranker.net Team</p>
    </body>
</html>
