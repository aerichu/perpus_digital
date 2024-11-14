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

            <!-- Button to Add New Buku -->
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addBukuModal">Tambah Data Buku</button>
            
            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Penulis</th>
                            <th scope="col">Penerbit</th>
                            <th scope="col">Tahun Terbit</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($jel as $buku) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $buku->judul ?></td>
                            <td><?= $buku->penulis ?></td>
                            <td><?= $buku->penerbit ?></td>
                            <td><?= $buku->tahun_terbit ?></td>
                            <td>
                                <?php 
                                    // Fetch the category name based on the book's id_kategori
                                    $category = null;
                                    foreach ($kategori as $cat) {
                                        if ($cat->id_kategori == $buku->id_kategori) {
                                            $category = $cat->nama_kategori;
                                            break;
                                        }
                                    }
                                    echo $category;
                                ?>
                            </td>

                            <td>
                                <a href="<?= base_url('home/h_buku/' . $buku->id_buku) ?>" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                                <a href="#" data-toggle="modal" data-target="#editBukuModal" class="btn btn-info btn-sm edit-btn" 
                                data-id="<?= $buku->id_buku ?>" 
                                data-judul="<?= $buku->judul ?>" 
                                data-penulis="<?= $buku->penulis ?>" 
                                data-penerbit="<?= $buku->penerbit ?>" 
                                data-tahun_terbit="<?= $buku->tahun_terbit ?>">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for Adding Buku -->
<div class="modal fade" id="addBukuModal" tabindex="-1" role="dialog" aria-labelledby="addBukuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBukuModalLabel">Tambah Data Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('home/aksi_t_buku') ?>" method="post">
                    <!-- Select for Category -->
                    <div class="form-group">
                        <label for="id_kategori">Pilih Kategori</label>
                        <select class="form-control" name="id_kategori" id="id_kategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategori as $cat): ?>
                            <option value="<?= $cat->id_kategori ?>"><?= $cat->nama_kategori ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="form-group">
                        <label for="penulis">Penulis</label>
                        <input type="text" class="form-control" id="penulis" name="penulis" required>
                    </div>
                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <input type="text" class="form-control" id="penerbit" name="penerbit" required>
                    </div>
                    <div class="form-group">
                        <label for="tahun_terbit">Tahun Terbit</label>
                        <input type="date" class="form-control" id="tahun_terbit" name="tahun_terbit" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Editing Buku -->
<div class="modal fade" id="editBukuModal" tabindex="-1" role="dialog" aria-labelledby="editBukuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBukuModalLabel">Edit Data Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('home/aksi_e_buku') ?>" method="post">
                    <input type="hidden" id="edit_id_buku" name="id_buku">
                    <!-- Select for Category -->
                    <div class="form-group">
                        <label for="id_kategori">Pilih Kategori</label>
                        <select class="form-control" name="id_kategori" id="id_kategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategori as $cat): ?>
                            <option value="<?= $cat->id_kategori ?>"><?= $cat->nama_kategori ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_judul">Judul</label>
                        <input type="text" class="form-control" id="edit_judul" name="judul" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_penulis">Penulis</label>
                        <input type="text" class="form-control" id="edit_penulis" name="penulis" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_penerbit">Penerbit</label>
                        <input type="text" class="form-control" id="edit_penerbit" name="penerbit" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_tahun_terbit">Tahun Terbit</label>
                        <input type="date" class="form-control" id="edit_tahun_terbit" name="tahun_terbit" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
            // Populate the Edit modal with book data
            $('.edit-btn').on('click', function() {
                var id_buku = $(this).data('id');
                var judul = $(this).data('judul');
                var penulis = $(this).data('penulis');
                var penerbit = $(this).data('penerbit');
                var tahun_terbit = $(this).data('tahun_terbit');

                $('#edit_id_buku').val(id_buku);
                $('#edit_judul').val(judul);
                $('#edit_penulis').val(penulis);
                $('#edit_penerbit').val(penerbit);
                $('#edit_tahun_terbit').val(tahun_terbit);
            });
        });
    </script>
</body>
</html>
