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
        <th>Subscription Amount</th>
    </tr>

    <tr>
        <td>{{ $subscription_name }}</td>
        <td>{{ $amount }}</td>
    </tr>
</table>
<p>
    Click on the link below to pay:<br/>
    <a href="{{ $payment_link }}">
        {{ $payment_link }}
    </a>
</p>
    
</body>
</html>