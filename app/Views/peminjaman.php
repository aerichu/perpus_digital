<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Table</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        /* Sidebar styling */
        .sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            background-color: #343a40;
            color: #fff;
            transition: transform 0.3s ease;
        }

        /* Styling for when the sidebar is hidden */
        .sidebar.hidden {
            transform: translateX(-250px); /* Geser sidebar ke kiri */
        }

        /* Content styling to shift right when sidebar is visible */
        .content {
            margin-left: 250px;
            transition: margin-left 0.3s ease;
        }

        /* Styling when sidebar is hidden */
        .content.shifted {
            margin-left: 0;
        }
        
        .table-responsive {
            margin-top: 30px;
        }

        /* Additional styling for table */
        .table th, .table td {
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="content" id="content">
        <div class="container mt-5">
            <div class="form-container">
                <h3 class="text-center mb-4">Peminjaman</h3>
                <form action="<?=base_url('home/aksi_t_peminjaman')?>" method="POST">
                    <div class="form-group">
                        <label for="id_buku">Pilih Buku</label>
                        <select class="form-control" name="id_buku" id="id_buku" required>
                            <option value="">-- Pilih Buku --</option>
                            <?php foreach ($buku as $book): ?>
                            <option value="<?= $book->id_buku ?>"><?= $book->judul ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="username">Tanggal Peminjaman</label>
                        <input type="date" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Tanggal Pengembalian</label>
                        <input type="date" class="form-control" id="password" name="pass" required>
                    </div>
                    <div class="form-group">
                        <label for="level">Status Peminjaman</label>
                        <select class="form-control" id="level" name="level" required>
                            <option value="dipinjam">Dipinjam</option>
                            <option value="dikembalikan">Dikembalikan</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Pinjam</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>