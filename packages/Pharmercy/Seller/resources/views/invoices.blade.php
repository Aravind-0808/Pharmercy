<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header img { max-height: 80px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ccc; }
        th, td { padding: 8px; text-align: left; }
        .total { font-weight: bold; font-size: 16px; }
        .section-title { font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>{{ $order->product->store->name }}</h2>
        <p>{{ $order->product->store->address }},
           {{ $order->product->store->city }},
           {{ $order->product->store->state }} - {{ $order->product->store->zip_code }}
        </p>
    </div>

    <div class="section-title">Store Details</div>
    <p>
        <strong>Store Name:</strong> {{ $order->product->store->name }}<br>
        <strong>Owner:</strong> {{ $order->product->store->user->name ?? 'N/A' }}<br>
        <strong>Contact:</strong> {{ $order->product->store->user->phone ?? 'N/A' }}<br>
        <strong>Email:</strong> {{ $order->product->store->user->email ?? 'N/A' }}<br>
        <strong>Address:</strong> {{ $order->product->store->address }},
           {{ $order->product->store->city }},
           {{ $order->product->store->state }},
           {{ $order->product->store->country ?? 'India' }} - {{ $order->product->store->zip_code }}
    </p>

    <hr>

    <p><strong>Invoice #:</strong> {{ $order->id }}</p>
    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($order->ordered_at)->format('d M Y') }}</p>
    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

    <div class="section-title">Customer Details</div>
    <p>{{ $order->address->first_name }} {{ $order->address->last_name }}<br>
       Phone: {{ $order->address->phone }}<br>
       {{ $order->address->door_no }}, {{ $order->address->street }}<br>
       {{ $order->address->city }}, {{ $order->address->district }}<br>
       {{ $order->address->state }}, {{ $order->address->country }} - {{ $order->address->zip }}
    </p>

    <div class="section-title">Product Details</div>
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Original Price</th>
                <th>Discount (%)</th>
                <th>Quantity</th>
                <th>Selling Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $order->product->id }}</td>
                <td>{{ $order->product->name }}</td>
                <td>{{ $order->product->description }}</td>
                <td>INR {{ number_format($order->product->original_price, 2) }}</td>
                <td>{{ $order->product->discount }}%</td>
                <td>{{ $order->quantity }}</td>
                <td>
                    INR {{ number_format($order->product->selling_price, 2) }}
                </td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">Total Amount</div>
    <p class="total">INR {{ number_format($order->total_amount, 2) }}</p>

</body>
</html>
