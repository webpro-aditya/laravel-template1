<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<table>
    <tr>
        <th>Subscription Name</th>
        <th>Amount</th>
    </tr>

    <tr>
        <td>{{ $title }}</td>
        <td>{{ $amount }}</td>
    </tr>
</table>
<p>
    Click on the link below to check Invoice:<br/>
    <a href="{{ $payment_link }}">
        {{ $invoice_url }}
    </a>
</p>
    
</body>
</html>