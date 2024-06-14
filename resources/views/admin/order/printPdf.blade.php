<!DOCTYPE html>
<html>
<head>
    <title>Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px; /* Mengecilkan ukuran font */
            margin: 10px 0; /* Mengurangi margin bawah */
        }
        th, td {
            padding: 4px 8px; /* Mengurangi padding */
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        h1 {
            font-size: 24px; /* Mengecilkan ukuran font judul */
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>List of Orders</h1>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Order Number</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Category</th>
                <th>Order Date</th>
                <th>Quantity (Kg)</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->customer ? $order->customer->customer_name : 'N/A' }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->phone_number }}</td>
                    <td>{{ $order->category ? $order->category->type_laundry : 'N/A' }}</td>
                    <td>{{ $order->order_date->format('d-m-Y') }}</td>
                    <td>{{ $order->quantity_kg }}</td>
                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }},00</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
