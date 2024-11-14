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
    </style>
</head>
<body>

    <div class="content" id="content">
        <div class="container mt-4">

            <!-- Button to Add New User -->
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addUserModal">Tambah Data User</button>
            
            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Username</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">Email</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Password</th>
                            <th scope="col">Level</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($jel as $kin) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $kin->username ?></td>
                            <td><?= $kin->nama_lengkap ?></td>
                            <td><?= $kin->email ?></td>
                            <td><?= $kin->alamat ?></td>
                            <td><?= $kin->pw ?></td>
                            <td>
                                <?php 
                                    if ($kin->level == '1') {
                                        echo 'Admin';
                                    } else {
                                        echo 'User';
                                    }
                                ?>
                            </td>

                            <td>
                                <a href="<?= base_url('home/h_user/' . $kin->id_user) ?>" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                                <a href="<?= base_url('home/aksi_reset/' . $kin->id_user) ?>" class="btn btn-warning btn-sm">
                                    <i class="fa fa-redo"></i>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#editUserModal" class="btn btn-info btn-sm edit-btn" data-id="<?= $kin->id_user ?>" data-username="<?= $kin->username ?>" data-email="<?= $kin->email ?>" data-nama_lengkap="<?= $kin->nama_lengkap ?>" data-alamat="<?= $kin->alamat ?>" data-level="<?= $kin->level ?>">
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

    <!-- Modal for Adding User -->
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Tambah Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('home/aksi_t_user') ?>" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="pw">Password</label>
                            <input type="password" class="form-control" id="pw" name="pw" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select class="form-control" id="level" name="level" required>
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Editing User -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('home/aksi_edit_user') ?>" method="post">
                        <input type="hidden" id="edit_id_user" name="id_user">
                        <div class="form-group">
                            <label for="edit_username">Username</label>
                            <input type="text" class="form-control" id="edit_username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_pw">Password</label>
                            <input type="password" class="form-control" id="edit_pw" name="pw">
                        </div>
                        <div class="form-group">
                            <label for="edit_email">Email</label>
                            <input type="email" class="form-control" id="edit_email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_nama_lengkap">Nama Lengkap</label>
                            <input type="text" class="form-control" id="edit_nama_lengkap" name="nama_lengkap" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_alamat">Alamat</label>
                            <input type="text" class="form-control" id="edit_alamat" name="alamat" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_level">Level</label>
                            <select class="form-control" id="edit_level" name="level" required>
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                            </select>
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
            $('.edit-btn').on('click', function() {
            // Get data attributes from the clicked button
            var id_user = $(this).data('id');
            var username = $(this).data('username');
            var email = $(this).data('email');
            var nama_lengkap = $(this).data('nama_lengkap');
            var alamat = $(this).data('alamat');
            var level = $(this).data('level');
            
            // Populate the modal fields with the user data
            $('#edit_id_user').val(id_user);
            $('#edit_username').val(username);
            $('#edit_email').val(email);
            $('#edit_nama_lengkap').val(nama_lengkap);
            $('#edit_alamat').val(alamat);
            $('#edit_level').val(level);
        });
        });
    </script>


</body>
</html>
