<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Faktur Baru</title>
</head>
<body>
    <h4>Hai, {{ $title }}</h4>
    <p>Pesanan anda sudah kami terima!</p>
    <p>Terima kasih sudah order pada sistem kami : <strong>{{ $name }}</strong></p>
    <p>Lihat faktur anda dibawah ini :</p>
    <a href="{{ route('invoicecustomer.printnonppn', $maildata) }}">Buka Faktur</a><br>
</body>
</html>