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
    <div class="container mt-4">

        <!-- Button to Add New Peminjaman -->
        <button class="btn btn-primary mb-3" onclick="window.location.href='<?= base_url('home/peminjaman') ?>'">Tambah Data </button>
        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Peminjam</th>
                        <th scope="col">Buku yang dipinjam</th>
                        <th scope="col">Tanggal Peminjaman</th>
                        <th scope="col">Tanggal Pengembalian</th>
                        <th scope="col">Status Peminjaman</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                        <?php $no = 1; foreach ($jel as $kin) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $kin->nama_lengkap ?></td>
                            <td><?= $kin->judul ?></td>
                            <td><?= $kin->tanggal_peminjaman ?></td>
                            <td><?= $kin->tanggal_pengembalian ?></td>
                            <td><?= $kin->status_peminjaman ?></td>
                            <td>
                                <a href="<?= base_url('home/h_peminjam/' . $kin->id_peminjaman) ?>" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
            </table>
        </div>
    </div>
</div>
