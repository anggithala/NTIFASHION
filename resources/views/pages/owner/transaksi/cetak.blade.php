<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Transaksi</title>
    <style>
        table {
            margin: 0 auto;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 4px;
        }

        main h2 {
            text-align: center;
        }
    </style>
</head>

<body>
    {{-- HEADER --}}
    <header style="width: 100%;">
        <img width="300" style="padding: 8px;" src="{{ asset('images/kopsurat.png') }}"
            alt="NTIFashion">
    </header>

    {{-- TABLE --}}
    <main>
        <h2 style="margin: 0;">LAPORAN TRANSAKSI</h2>
        <h5>Tanggal: {{ $start_date->translatedFormat('j F Y') . ' - ' . $end_date->translatedFormat('j F Y') }}</h5>
        <table>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Harga (Rp)</th>
                <th>Status Pembayaran</th>
                <th>Tanggal Transaksi</th>
            </tr>
            @foreach ($transactions as $transaction)
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration . '.' }}</td>
                    <td>{{ $transaction->user->name }}</td>
                    <td style="text-align: right;">{{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                    <td>{{ $transaction->transaction_status }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaction->created_at)->translatedFormat('j F Y H:i') }}</td>
                </tr>
            @endforeach
        </table>
    </main>
</body>

</html>
