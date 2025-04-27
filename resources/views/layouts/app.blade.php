<!DOCTYPE html>
<html>
<head>
    <title>Kasir Laundry</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

</head>
<body>
    @include('layouts.navbar') <!-- Jika kamu punya navbar, kalau tidak bisa hapus -->
    <div class="py-4">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- Inisialisasi Select2 -->
    <script>
        $(document).ready(function() {
            // Pastikan Select2 diinisialisasi setelah modal ditampilkan
            $('#tambahPesananModal').on('shown.bs.modal', function() {
                $('.select2').select2({
                    placeholder: "Cari Pelanggan...",
                    allowClear: true,
                    dropdownParent: $('#tambahPesananModal')
                });
             });
        });
    </script>

</body>
</html>
