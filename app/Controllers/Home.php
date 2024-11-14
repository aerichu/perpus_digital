<?php

namespace App\Controllers;
use App\Models\M_burger;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;
use CodeIgniter\Database\Config;

class Home extends BaseController
{
    public function __construct()
    {
        $this->M_burger = new M_burger();
    }

    public function dashboard()
    {
        if(session()->get('level')>0){ 
            echo view('header');
            echo view('menu');
            echo view('dashboard');
        }else{
            return redirect()->to('http://localhost:8080/home/login');
        }
    }
    public function login()
    {
        echo view('header');
        echo view('login');

    }

    public function aksi_login() {
        $u = $this->request->getPost('username');
        $p = $this->request->getPost('pw');

    // Inisialisasi model
        $model = new M_burger();

    // Mengatur kondisi pencarian
        $where = [
            'username' => $u,
            'pw' => md5($p)
        ];

    // Periksa apakah data user ditemukan
        $cek = $model->getWhereLogin('user', $where);

        if ($cek) {
        // Set session jika login berhasil
            session()->set('id', $cek->id_user);
            session()->set('username', $cek->username);
            session()->set('level', $cek->level);

        // Log aktivitas login
        // $model->logActivity($cek->id_user, 'login', 'User logged in.');

            return redirect()->to('home/dashboard');
        } else {
        // Redirect ke halaman login jika gagal
            return redirect()->to(base_url('home/login'));
        }
    }

    public function activity_log() {   
        if (session()->get('level') > 0) {
            $model = new M_burger();
            $logs = $model->getActivityLogs();
            $data['logs'] = $logs;

            $where = array(
                'id_toko' => 1
            );
            $setting = $model->getWhere('toko', $where);

        $data['setting'] = $setting ? $setting : []; // Jika setting kosong, set sebagai array kosong

        echo view('header');
        echo view('menu', $data);
        return view('activity_log', $data);
    } else {
        return redirect()->to('http://localhost:8080/home/login');
    }
}

public function logout() {
    $user_id = session()->get('id');
    
    if ($user_id) {
        // Log the logout activity
        $model = new M_burger();
        $model->logActivity($user_id, 'logout', 'User logged out.');
    }

    session()->destroy();
    return redirect()->to('http://localhost:8080/home/login');
}


public function user()
{
    if (session()->get('level')> 0) {
        $model = new M_burger();
        $data['jel'] = $model->tampil('user');
        // $data['jel']=$model->query('select * from user where deleted_at IS NOT NULL');
        
        $id = 1; // id_toko yang diinginkan

        // Menyusun kondisi untuk query
        $where = array('id_toko' => $id);

        // Mengambil data dari tabel 'toko' berdasarkan kondisi
        $data['user'] = $model->getWhere('toko', $where);

        // Memuat view
        // $data['setting'] = $model->getWhere('toko', $where);

        $user_id = session()->get('id');
        $model->logActivity($user_id, 'user', 'User in user page');

        echo view('header');
        echo view('menu', $data);
        echo view('user', $data);
    } else {
        return redirect()->to(base_url('home/login'));
    }
}

public function restore()
{
    if (session()->get('level')>0) {
        $model= new M_burger;
        $user_id = session()->get('id');
        $data['jel']=$model->query('select * from user where deleted_at IS NOT NULL');
        $model->logActivity($user_id, 'user', 'User in restore page');
        echo view('header');
        echo view('menu',$data);
        echo view('restore',$data);
    }else{
        return redirect()->to('http://localhost:8080/home/login');
    }
}
public function aksi_restore($id)
{
    $user_id = session()->get('id');
    $model = new M_burger();

    $where= array('id_user'=>$id);
    $isi = array(
        'deleted_at'=>NULL
    );
    $model->edit('user', $isi,$where);
    $model->logActivity($user_id, 'user', 'User restore a data');  

    return redirect()->to('home/restore');
}
public function hapusproduk($id){
    $model = new M_burger();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Menghapus produk'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);

    // Data yang akan diupdate untuk soft delete
    $data = [
        'isdelete' => 1,
        'deleted_by' => $id_user,
        'deleted_at' => date('Y-m-d H:i:s') // Format datetime untuk deleted_at
    ];

    // Update data produk dengan kondisi id_produk sesuai
    $model->logActivity($id_user, 'user', 'User deleted a surat masuk');
    $model->edit('user', $data, ['id_user' => $id]);

  return redirect()->to('home/user');
}

public function t_user()
{
    $model= new M_burger;
    $user_id = session()->get('id');
    
    $data['jel']= $model->tampil('user');
    $model->logActivity($user_id, 'tambah user', 'User in tambah user page');
    echo view('header');
    echo view('menu', $data);
    echo view('t_user',$data);
}

public function aksi_t_user()
{
    // Get the logged-in user's ID from the session
    $user_id = session()->get('id');
    
    // Get the input data from the form
    $username = $this->request->getPost('username');
    $password = md5($this->request->getPost('pass')); // MD5 password encryption
    $email = $this->request->getPost('email');
    $nama_lengkap = $this->request->getPost('nama_lengkap');
    $alamat = $this->request->getPost('alamat');
    $level = $this->request->getPost('level');

    // Prepare the data for insertion into the 'user' table
    $userData = array(
        'username' => $username,
        'pw' => $password,
        'email' => $email,
        'nama_lengkap' => $nama_lengkap,
        'alamat' => $alamat,
        'level' => $level
    );

    // Instantiate the model and insert the new user data
    $model = new M_burger;
    $model->tambah('user', $userData);

    // Log the activity of adding a new user
    $model->logActivity($user_id, 'user', 'User added a new account');  

    // Redirect the user back to the user list page
    return redirect()->to('http://localhost:8080/home/user');
}


public function h_user($id)
{
    $model= new M_burger;
    $user_id = session()->get('id');
    $kil= array('id_user'=>$id);
    $isi= array(
        'deleted_at'=>date('Y-m-d H:i:s'));
    $model->edit('user',$isi,$kil);
    $model->logActivity($user_id, 'user', 'User deleted a user');
    // $model->hapus('makanan',$kil);
    return redirect()-> to('http://localhost:8080/home/user');
}

public function aksi_reset($id)
{
    $model = new M_burger();
    $user_id = session()->get('id');

    $where= array('id_user'=>$id);

    $isi = array(

        'pw' => md5('11111111')      

    );
    $model->editpw('user', $isi,$where);
    $model->logActivity($user_id, 'user', 'User reset a password');  

    return redirect()->to('home/user');
}

public function aksi_edit_user()
{
    // Get the form input data
    $id_user = $this->request->getPost('id_user');
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('pw') ? md5($this->request->getPost('pw')) : null;
    $email = $this->request->getPost('email');
    $nama_lengkap = $this->request->getPost('nama_lengkap');
    $alamat = $this->request->getPost('alamat');
    $level = $this->request->getPost('level');

    // Prepare the data for update
    $userData = array(
        'username' => $username,
        'email' => $email,
        'nama_lengkap' => $nama_lengkap,
        'alamat' => $alamat,
        'level' => $level
    );

    // If the password is provided, include it in the update data
    if ($password) {
        $userData['pw'] = $password;
    }

    // Update the user in the database
    $model = new M_burger;
    $model->edit('user', $userData, ['id_user' => $id_user]);

    // Redirect to the page after the update
    return redirect()->to('http://localhost:8080/home/user');
}


public function register()
{
    $model= new M_burger;
    $data['jel']= $model->tampil('user');
    echo view('header');
    echo view('register',$data);
}
public function aksi_t_register()
{
    // Get the form input data
    $username = $this->request->getPost('username');
    $password = md5($this->request->getPost('pw')); // MD5 encryption for password
    $email = $this->request->getPost('email');
    $nama_lengkap = $this->request->getPost('nama_lengkap');
    $alamat = $this->request->getPost('alamat');
    $level = $this->request->getPost('level'); // Assuming 'level' is either '1' for Admin or '2' for User

    // Prepare the data for insertion into the 'user' table
    $userData = array(
        'username' => $username,
        'pw' => $password,
        'email' => $email,
        'nama_lengkap' => $nama_lengkap,
        'alamat' => $alamat,
        'level' => 2
    );

    // Instantiate the model and insert the new user data
    $model = new M_burger;
    $model->tambah('user', $userData);

    // Redirect to the login page after registration
    return redirect()->to('http://localhost:8080/home/login');
}

public function buku()
{
    $model = new M_burger;
    $user_id = session()->get('id');
    
    // Get all categories from the 'kategori' table
    $data['kategori'] = $model->findAllCategories();  // Assuming this method retrieves all categories

    $data['jel'] = $model->tampil('buku');
    $data['julio'] = $model->tampil('kategori');
    $model->logActivity($user_id, 'buku', 'User in buku page');
    
    echo view('header');
    echo view('menu', $data);
    echo view('buku', $data);
}

public function aksi_t_buku()
{
    $user_id = session()->get('id');
    $b = $this->request->getPost('judul');
    $c = $this->request->getPost('penulis');
    $d = $this->request->getPost('penerbit');
    $e = $this->request->getPost('tahun_terbit');
    $kategori = $this->request->getPost('id_kategori');  // Added category input

    // Prepare data including id_user, category, and default status
    $sis = array(
        'judul' => $b,
        'penulis' => $c,
        'penerbit' => $d,
        'tahun_terbit' => $e,
        'id_kategori' => $kategori,  // Include category in the data
    );

    // Add data to the database
    $model = new M_burger;
    $model->tambah('buku', $sis);

    // Log activity
    $model->logActivity($user_id, 'buku', 'User menambahkan buku');

    return redirect()->to('http://localhost:8080/home/buku');
}


public function aksi_e_buku()
{
    // Retrieve the data from the form
    $id_buku = $this->request->getPost('id_buku');
    $judul = $this->request->getPost('judul');
    $penulis = $this->request->getPost('penulis');
    $penerbit = $this->request->getPost('penerbit');
    $tahun_terbit = $this->request->getPost('tahun_terbit');
    $kategori = $this->request->getPost('id_kategori');  // Added category input

    // Prepare the data to be updated
    $data = [
        'judul' => $judul,
        'penulis' => $penulis,
        'penerbit' => $penerbit,
        'tahun_terbit' => $tahun_terbit,
        'id_kategori' => $kategori,  // Include category in the data
    ];

    // Define the where clause for the record to be updated
    $where = ['id_buku' => $id_buku];

    // Call the model's editgambar method to update the data
    $model = new M_burger(); // Make sure to load the model
    $update = $model->editgambar('buku', $data, $where);

    // Check if the update was successful and redirect accordingly
    if ($update) {
        return redirect()->to(base_url('home/buku'))->with('success', 'Data Buku berhasil diperbarui!');
    } else {
        return redirect()->to(base_url('home/buku'))->with('error', 'Gagal memperbarui data Buku!');
    }
}


public function h_buku($id)
{
    $model = new M_burger();
    $id_user = session()->get('id');
    $kil = array('id_buku' => $id);
    $model->hapus('buku', $kil);
    $model->logActivity($id_user, 'buku', 'User deleted a buku data.');
    return redirect()->to(base_url('home/buku'));
}

public function kategori()
{
    $model= new M_burger;
    $user_id = session()->get('id');
    
    $data['jel']= $model->tampil('kategori');
    $model->logActivity($user_id, 'kategori', 'User in kategori page');
    echo view('header');
    echo view('menu', $data);
    echo view('kategori',$data);
}

public function aksi_t_kategori()
{
    // Retrieve the data from the form
    $nama_kategori = $this->request->getPost('nama_kategori');

    // Prepare the data to be inserted
    $data = [
        'nama_kategori' => $nama_kategori
    ];

    // Call the model's tambah method to insert the data into the kategori table
    $model = new M_burger(); // Load the M_burger model
    $insert = $model->tambah('kategori', $data);

    // Check if the insertion was successful and redirect accordingly
    if ($insert) {
        return redirect()->to(base_url('home/kategori'))->with('success', 'Kategori berhasil ditambahkan!');
    } else {
        return redirect()->to(base_url('home/kategori'))->with('error', 'Gagal menambahkan kategori!');
    }
}

public function h_kategori($id)
{
    $model = new M_burger();
    $id_user = session()->get('id');
    $kil = array('id_kategori' => $id);
    $model->hapus('kategori', $kil);
    $model->logActivity($id_user, 'kategori', 'User deleted a kategori data.');
    return redirect()->to(base_url('home/kategori'));
}

public function aksi_e_kategori()
{
    // Retrieve the data from the form
    $id_kategori = $this->request->getPost('id_kategori');
    $nama_kategori = $this->request->getPost('nama_kategori');

    // Prepare the data to be updated
    $data = [
        'nama_kategori' => $nama_kategori,
    ];

    // Define the where clause for the record to be updated
    $where = ['id_kategori' => $id_kategori];

    // Call the model's method to update the data
    $model = new M_burger(); // Make sure to load the model
    $update = $model->editgambar('kategori', $data, $where);

    // Check if the update was successful and redirect accordingly
    if ($update) {
        return redirect()->to(base_url('home/kategori'))->with('success', 'Kategori berhasil diperbarui!');
    } else {
        return redirect()->to(base_url('home/kategori'))->with('error', 'Gagal memperbarui kategori!');
    }
}


public function peminjaman()
{
    $model = new M_burger;
    $user_id = session()->get('id');
    
    // Ambil data buku
    $data['buku'] = $model->tampil('buku');
    
    // Log activity
    $model->logActivity($user_id, 'peminjaman', 'User in peminjaman page');
    
    // Tampilkan view dengan data
    echo view('header');
    echo view('menu', $data);
    echo view('peminjaman', $data);
}

public function peminjam()
{
    $model = new M_burger;
    $user_id = session()->get('id');
    
    // Fetch the joined data from the model
    $data['jel'] = $model->join3Tabel();
    
    // Log activity
    $model->logActivity($user_id, 'peminjaman', 'User in peminjaman page');
    
    // Tampilkan view
    echo view('header');
    echo view('menu', $data);
    echo view('peminjam', $data);
}


public function h_peminjam($id)
{
    $model = new M_burger();
    $id_user = session()->get('id');
    $kil = array('id_peminjaman' => $id);
    $model->hapus('peminjaman', $kil);
    $model->logActivity($id_user, 'peminjaman', 'User deleted a peminjam data.');
    return redirect()->to(base_url('home/peminjam'));
}



public function aksi_t_peminjaman()
{
    $model = new M_burger;
    
    // Ambil data dari form
    $data = [
        'id_user'            => session()->get('id'),  // Mengambil id_user dari session
        'id_buku'            => $this->request->getPost('id_buku'),  // Ambil id_buku dari form
        'tanggal_peminjaman' => $this->request->getPost('username'),  // Tanggal peminjaman dari form
        'tanggal_pengembalian' => $this->request->getPost('pass'),  // Tanggal pengembalian dari form
        'status_peminjaman'  => $this->request->getPost('level')  // Status peminjaman dari form
    ];
    
    // Insert data ke tabel peminjaman menggunakan metode tambah
    $model->tambah('peminjaman', $data);
    
    // Redirect atau tampilkan pesan sukses
    return redirect()->to(base_url('home/peminjaman'))->with('success', 'Peminjaman berhasil dilakukan!');
}


public function ulasan()
{
    $model = new M_burger;
    $user_id = session()->get('id');
    
    // Fetch review data from 'ulasan' table
    $data['jel'] = $model->tampil('ulasan');  // Fetch reviews
    
    // Fetch list of books for the modal dropdown
    $data['books'] = $model->getBooks();

    // Load views with data
    echo view('header');
    echo view('menu');
    echo view('ulasan', $data);  // Passing both 'jel' (reviews) and 'books' to the view
}




public function h_ulasan($id)
{
    $model = new M_burger();
    $id_user = session()->get('id');
    $kil = array('id_ulasan' => $id);
    $model->hapus('ulasan', $kil);
    $model->logActivity($id_user, 'ulasan', 'User deleted a ulasan data.');
    return redirect()->to(base_url('home/ulasan'));
}

public function tambah_ulasan()
{
    $model = new M_burger;
    $user_id = session()->get('id');

    // Get form data
    $ulasan = $this->request->getPost('ulasan');
    $rating = $this->request->getPost('rating');
    $id_buku = $this->request->getPost('id_buku');

    // Insert the new review into the 'ulasan' table
    $data = [
        'id_user' => $user_id,
        'id_buku' => $id_buku,
        'ulasan' => $ulasan,
        'rating' => $rating
    ];

    $model->insertUlasan($data);

    // Redirect back to the ulasan page
    return redirect()->to(base_url('home/ulasan'));
}



//laporan
public function laporan()
{
    if (session()->get('level')>0) {
        $model = new M_burger();
        $user_id = session()->get('id');
             $model->logActivity($user_id, 'laporan', 'User in laporan');
             echo view('header');
             echo view('menu');
             echo view('laporan');
         } else {
            return redirect()->to('http://localhost:8080/home/login');
        }
    }

    public function generate_report()
{
    if (session()->get('level') > 0) {
        $start_date = $this->request->getPost('start_date');
        $end_date = $this->request->getPost('end_date');
        $report_type = $this->request->getPost('report_type');

        switch ($report_type) {
            case 'pdf':
                $this->generate_pdf($start_date, $end_date);
                break;
            case 'excel':
                $this->generate_excel($start_date, $end_date);
                break;
            case 'window':
                $this->generate_window_result($start_date, $end_date);
                break;
            default:
                return redirect()->to('home/error');
        }
    } else {
        return redirect()->to('home/login');
    }
}


    private function generate_pdf($start_date, $end_date)
{
    $model = new M_burger();
    $data['laporan'] = $model->getLaporanByDate($start_date, $end_date);

    $options = new Options();
    $options->set('defaultFont', 'Arial');
    $dompdf = new Dompdf($options);
    $html = view('laporan_pdf', $data);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("laporan.pdf", array("Attachment" => false));
}

private function generate_excel($start_date, $end_date)
{
    $model = new M_burger();
    $data['laporan'] = $model->getLaporanByDateForExcel($start_date, $end_date);

    $spreadsheet = new Spreadsheet();
    $spreadsheet->getProperties()->setCreator("Your Name")->setLastModifiedBy("Your Name")
        ->setTitle("Laporan Loker")->setSubject("Laporan Loker")
        ->setDescription("Laporan Transaksi")->setKeywords("Spreadsheet")
        ->setCategory("Report");

    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'judul')
        ->setCellValue('B1', 'penulis')
        ->setCellValue('C1', 'penerbit')
        ->setCellValue('D1', 'tahun_terbit')
        ->setCellValue('F1', 'email');

    $rowCount = 2;
    foreach ($data['laporan'] as $row) {
        $sheet->setCellValue('A' . $rowCount, $row['judul'])
            ->setCellValue('B' . $rowCount, $row['penulis'])
            ->setCellValue('C' . $rowCount, $row['penerbit'])
            ->setCellValue('D' . $rowCount, $row['tahun_terbit'])
            ->setCellValue('F' . $rowCount, $row['email']);
        $rowCount++;
    }

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="laporan_transaksi.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
}

private function generate_window_result($start_date, $end_date)
{
    $model = new M_burger();
    $data['formulir'] = $model->getLaporanByDate($start_date, $end_date);
    echo view('cetak_hasil', $data);
}










}
