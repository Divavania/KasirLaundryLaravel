<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    @include('layouts.app')
    
    <div style="text-align: center;">
        <h2>Halo, {{ auth()->user()->username }} ({{ auth()->user()->role }})</h2>
        <p>Selamat datang di sistem kasir laundry!</p>
    </div>
</body>
</html>
