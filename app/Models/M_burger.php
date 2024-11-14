<?php

namespace App\Models;
use CodeIgniter\Model;

class M_burger extends Model
{

protected $table = 'paket'; // Or whatever table you're querying
protected $primaryKey = 'id_paket'; // Ensure this matches your table's primary key

public function tambah1($table, $data)
{
    $builder = $this->db->table($table);
    $insert = $builder->insert($data);

    if ($insert) {
        log_message('debug', 'Data inserted successfully: ' . json_encode($data));
    } else {
        log_message('error', 'Failed to insert data: ' . json_encode($data));
    }

    return $insert;
}

public function getLatestBooking($user_id)
{
    return $this->db->table('booking')
        ->where('user_id', $user_id)
        ->orderBy('id_booking', 'DESC')
        ->limit(1)
        ->get()
        ->getRow();
}

public function jointampilwhere($table, $user_id)
{
    return $this->db->table($table)
        ->join('paket', 'booking.id_paket = paket.id_paket', 'left') // Join with paket table
        ->where('booking.id_user', $user_id)
        ->orderBy('booking.id_booking', 'DESC')
        ->limit(1)
        ->get()
        ->getRow();
}



public function updateBookingFile($id_booking, $data)
{
    return $this->db->table('booking')
        ->where('id_booking', $id_booking)
        ->update($data);
}



public function getWhere($table, $where) {
    $query = $this->db->table($table)->getWhere($where);
    if ($query && $query->getNumRows() > 0) {
        return $query->getRowArray(); // Kembalikan data dalam bentuk array
    }
    return null; // Jika tidak ada data, kembalikan null
}
public function getWhereLogin($table, $where) {
    return $this->db->table($table)
    ->where($where)
    ->get()
    ->getRow();
}
public function getActivityLogs() {
    $query = $this->db->table('activity_logs')
    ->join('user', 'activity_logs.user_id = user.id_user', 'left')
    ->select('user.username, activity_logs.activity, activity_logs.description, activity_logs.timestamp')
    ->orderBy('activity_logs.timestamp', 'DESC')
    ->get();

    return $query->getResultArray(); // Kembalikan data sebagai array untuk iterasi di view
}
public function logActivity($user_id, $activity, $description) {
    // Pastikan tabel yang akan di-insert ada
    if (!empty($user_id) && !empty($activity)) {
        $data = [
            'user_id' => $user_id,
            'activity' => $activity,
            'description' => $description,
            'timestamp' => date('Y-m-d H:i:s')
        ];
        // Menyimpan data ke dalam tabel activity_logs
        $this->db->table('activity_logs')->insert($data);
    }
}

public function insertUlasan($data)
{
    // Insert data into the 'ulasan' table
    return $this->db->table('ulasan')->insert($data);
}


public function join3Tabel()
{
    // Build the SQL query to join the tables
    $builder = $this->db->table('peminjaman');
    $builder->select('peminjaman.id_peminjaman, peminjaman.id_user, peminjaman.id_buku, peminjaman.tanggal_peminjaman, peminjaman.tanggal_pengembalian, peminjaman.status_peminjaman, buku.judul, buku.penulis, buku.penerbit, buku.tahun_terbit, user.nama_lengkap');
    
    // Join the 'buku' and 'user' tables with 'peminjaman'
    $builder->join('buku', 'peminjaman.id_buku = buku.id_buku', 'left');
    $builder->join('user', 'peminjaman.id_user = user.id_user', 'left');
    
    // Execute the query and return the result
    return $builder->get()->getResult();
}

public function getBooks()
{
    return $this->db->table('buku')->get()->getResult();
}
public function tampilulasan($table)
{
    // Assuming 'ulasan' table has 'id_ulasan' column along with 'ulasan', 'rating', etc.
    return $this->db->table($table)->select('id_ulasan, ulasan, rating')->get()->getResult();
}


    // Your existing join3TabelUlasan() method
    public function join3TabelUlasan()
    {
        $builder = $this->db->table('ulasan');
        $builder->select('ulasan.id_ulusan, ulasan.id_user, ulasan.id_buku, ulasan.ulasan, ulasan.rating, buku.judul, buku.penulis, buku.penerbit, buku.tahun_terbit, user.nama_lengkap');
        $builder->join('buku', 'ulasan.id_buku = buku.id_buku', 'left');
        $builder->join('user', 'ulasan.id_user = user.id_user', 'left');
        return $builder->get()->getResult();
    }


public function tampil($org)
{
    return $this->db->table($org)->get()->getResult();
}

                public function joinWhere($table, $tabel2, $on, $where)
                {
                    return $this->db->table($table)
                    ->join($tabel2, $on, 'right')
                    ->where($where)
                    ->get()
                    ->getResult();
                }

                public function tambah($table,$where)
                {
                    return $this->db->table($table)->insert($where);
                }
                public function hapus($kolom,$where)
                {
                    return $this->db->table($kolom)->delete($where);
                }
                public function editpw($table, $data, $where)
                {
                    return $this->db->table($table)->update($data, $where);
                }
                // public function edit($kin,$isi,$where)
                // {
                //     return $this->db->table($kin)->update($isi,$where);
                // }
                public function upload($file)
                {
                    $imageName = $file->getName();
                    $file->move(ROOTPATH.'public/img',$imageName);
                }

                public function upload1($file)
                {
                    $imageName = $file->getName();
    $file->move(ROOTPATH . 'public/img', $imageName);  // Ensure the file moves to the 'public/img' directory
}

public function editgambar($table, $data, $where)
{
    return $this->db->table($table)->update($data, $where);
}

public function edit($tabel, $isi, $where){
    return $this->db->table($tabel)
    ->update($isi, $where);
 }

public function query($query)
{
    return $this->db->query($query)
    ->getResult();
}
public function getLaporanByDate($start_date, $end_date)
{
    return $this->db->table('buku')
    ->where('tahun_terbit >=', $start_date)
    ->where('tahun_terbit <=', $end_date)
    ->get()
    ->getResult();
}

public function getLaporanByDateForExcel($start_date, $end_date)
{
    $query = $this->db->table('buku')
    ->where('tahun_terbit >=', $start_date)
    ->where('tahun_terbit <=', $end_date)
    ->get();

    return $query->getResultArray();
}

// In M_burger.php
public function getPackagesForBooking()
{
    $builder = $this->db->table('paket');
    $builder->select('paket.id_paket, paket.nama_paket, paket.harga');
    $builder->join('booking', 'booking.id_paket = paket.id_paket', 'left');
    $builder->where('paket.status', 'available'); // Show only available packages
    return $builder->get()->getResult();
}
public function join($kin,$tabel2,$on,$where)
{
    return $this->db->table($kin)
    ->join($tabel2,$on,"left")
    ->getWhere($where)->getRow();
}
public function joinn($tabel, $tabel2, $on){
 return $this->db->table($tabel)
 ->join($tabel2, $on,'left')
 ->get()
 ->getResult();

}
 // M_burger.php
public function findAllCategories()
{
    return $this->db->table('kategori')
                    ->get()
                    ->getResult();
}

public function findAllBuku()
{
    return $this->db->table('buku')
                    ->get()
                    ->getResult();
}

public function tampil2($table)
{
    // Modify the query to join the 'kategori' table
    return $this->db->table($table)
                    ->select('buku.*, kategori.nama_kategori')  // Select the book details and category name
                    ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')  // Perform a LEFT JOIN to include books without categories
                    ->get()
                    ->getResult();
}




}
?>