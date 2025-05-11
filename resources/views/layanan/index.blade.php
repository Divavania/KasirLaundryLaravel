<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Layanan</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 20px 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #e8f5e9, #f5f5f5);
            font-family: 'Poppins', sans-serif;
            position: relative;
            overflow-y: auto;
        }
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><circle cx="30" cy="30" r="20" fill="rgba(76,175,80,0.1)"/><circle cx="170" cy="50" r="15" fill="rgba(76,175,80,0.15)"/><circle cx="100" cy="150" r="25" fill="rgba(76,175,80,0.1)"/><circle cx="50" cy="100" r="10" fill="rgba(76,175,80,0.2)"/></svg>');
            background-size: 300px;
            opacity: 0.3;
            z-index: -1;
            animation: float 20s infinite linear;
        }
        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0); }
        }
        .service-container {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 800px;
            max-width: 95%;
            position: relative;
            animation: fadeIn 0.8s ease forwards;
            border: 1px solid rgba(76, 175, 80, 0.2);
            margin: 20px auto;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .service-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: #4caf50;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #2e7d32;
            font-weight: 700;
            font-size: 28px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        h2::before {
            content: '\f085';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            display: block;
            font-size: 40px;
            color: #4caf50;
            margin-bottom: 10px;
            opacity: 0.8;
        }
        .btn-success, .btn-primary, .btn-warning, .btn-danger, .btn-secondary {
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .btn-success {
            background: #4caf50;
            border-color: #4caf50;
        }
        .btn-success:hover, .btn-primary:hover {
            background: #2e7d32;
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.3);
            transform: translateY(-2px);
        }
        .btn-warning {
            background: #fb8c00;
            border-color: #fb8c00;
        }
        .btn-warning:hover {
            background: #ef6c00;
            box-shadow: 0 4px 12px rgba(251, 140, 0, 0.3);
        }
        .btn-danger {
            background: #d32f2f;
            border-color: #d32f2f;
        }
        .btn-danger:hover {
            background: #b71c1c;
            box-shadow: 0 4px 12px rgba(211, 47, 47, 0.3);
        }
        .btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        .btn:active::after {
            width: 200px;
            height: 200px;
        }
        .table {
            background: #f8faf8;
            border-radius: 12px;
            overflow: hidden;
        }
        .table-success {
            background: #e8f5e9;
            color: #2e7d32;
        }
        .table-bordered {
            border: 1px solid rgba(76, 175, 80, 0.2);
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid rgba(76, 175, 80, 0.2);
        }
        .alert-success {
            background-color: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
            border-radius: 10px;
            font-weight: 400;
            padding: 12px;
            margin-bottom: 20px;
            text-align: center;
        }
        .modal-content {
            border-radius: 12px;
            border: 1px solid rgba(76, 175, 80, 0.2);
        }
        .modal-header {
            background: #e8f5e9;
            color: #2e7d32;
            border-bottom: 1px solid rgba(76, 175, 80, 0.2);
        }
        .form-control {
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            background-color: #f8faf8;
            font-size: 14px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #2e7d32;
            background-color: #fff;
            box-shadow: 0 0 8px rgba(46, 125, 50, 0.2);
            outline: none;
        }
        .close {
            color: #2e7d32;
            opacity: 0.8;
        }
        .close:hover {
            opacity: 1;
        }
        @media (max-width: 768px) {
            .service-container {
                padding: 30px 20px;
                width: 95%;
            }
            h2 {
                font-size: 24px;
            }
            h2::before {
                font-size: 32px;
            }
            .btn {
                padding: 10px 20px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="service-container">
        <h2>Kelola Layanan</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-3 d-flex flex-wrap">
            <a href="{{ route('dashboard') }}" class="btn btn-success d-flex align-items-center justify-content-center mr-2" style="padding: 8px; width: 40px;">
                <i class="fas fa-arrow-left"></i>
            </a>
            <button class="btn btn-success" data-toggle="modal" data-target="#tambahLayananModal">Tambah Layanan</button>
        </div>

        <table class="table table-bordered">
            <thead class="table-success">
                <tr>
                    <th>Nama Layanan</th>
                    <th>Harga Per Kg</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($layanan as $item)
                    <tr>
                        <td>{{ $item->nama_layanan }}</td>
                        <td>Rp {{ number_format($item->harga_per_kg, 0, ',', '.') }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editLayananModal{{ $item->id }}">Edit</button>
                            <form action="{{ route('layanan.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus layanan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="tambahLayananModal" tabindex="-1" role="dialog" aria-labelledby="tambahLayananModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('layanan.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahLayananModalLabel">Tambah Layanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_layanan" class="form-label">Nama Layanan</label>
                            <input type="text" name="nama_layanan" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga_per_kg" class="form-label">Harga Per Kg</label>
                            <input type="number" name="harga_per_kg" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @foreach ($layanan as $item)
        <div class="modal fade" id="editLayananModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editLayananModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('layanan.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editLayananModalLabel{{ $item->id }}">Edit Layanan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama_layanan" class="form-label">Nama Layanan</label>
                                <input type="text" name="nama_layanan" class="form-control" value="{{ $item->nama_layanan }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="harga_per_kg" class="form-label">Harga Per Kg</label>
                                <input type="number" name="harga_per_kg" class="form-control" value="{{ $item->harga_per_kg }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>