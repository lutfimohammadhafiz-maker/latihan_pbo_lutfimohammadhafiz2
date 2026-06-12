<?php
// TiketManager.php
require_once 'koneksi.php';
require_once 'TiketReguler.php';
require_once 'TiketIMAX.php';
require_once 'TiketVelvet.php';

class TiketManager {
    private $db;
    private $connection;
    
    public function __construct() {
        $this->db = new Database();
        $this->connection = $this->db->getConnection();
    }
    
    // Method untuk mengambil semua tiket
    public function getAllTickets() {
        $tickets = [];
        $query = "SELECT * FROM tabel_tiket ORDER BY id_tiket";
        $result = $this->connection->query($query);
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tickets[] = $this->createTicketObject($row);
            }
        }
        
        return $tickets;
    }
    
    // Method untuk mengambil tiket berdasarkan jenis studio
    public function getTicketsByStudio($jenis_studio) {
        $tickets = [];
        $query = "SELECT * FROM tabel_tiket WHERE jenis_studio = ? ORDER BY id_tiket";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $jenis_studio);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tickets[] = $this->createTicketObject($row);
            }
        }
        
        return $tickets;
    }
    
    // Factory method untuk membuat objek tiket berdasarkan jenis studio
    private function createTicketObject($row) {
        switch($row['jenis_studio']) {
            case 'Reguler':
                return new TiketReguler(
                    $row['id_tiket'],
                    $row['nama_film'],
                    $row['jadwal_tayang'],
                    $row['jumlah_kursi'],
                    $row['harga_dasar_tiket'],
                    $row['tipe_audio']
                );
            case 'IMAX':
                return new TiketIMAX(
                    $row['id_tiket'],
                    $row['nama_film'],
                    $row['jadwal_tayang'],
                    $row['jumlah_kursi'],
                    $row['harga_dasar_tiket'],
                    $row['kacamata_3d_id'],
                    $row['efek_gerak_fitur']
                );
            case 'Velvet':
                return new TiketVelvet(
                    $row['id_tiket'],
                    $row['nama_film'],
                    $row['jadwal_tayang'],
                    $row['jumlah_kursi'],
                    $row['harga_dasar_tiket'],
                    $row['lokasi_baris'],
                    $row['bantal_selimut_pack'],
                    $row['layanan_butler']
                );
            default:
                return null;
        }
    }
    
    // Method untuk menambah tiket baru
    public function addTicket($data) {
        $query = "INSERT INTO tabel_tiket (nama_film, jadwal_tayang, jumlah_kursi, harga_dasar_tiket, 
                  jenis_studio, tipe_audio, kacamata_3d_id, efek_gerak_fitur, lokasi_baris, 
                  bantal_selimut_pack, layanan_butler) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ssidsssssss", 
            $data['nama_film'], 
            $data['jadwal_tayang'], 
            $data['jumlah_kursi'], 
            $data['harga_dasar_tiket'],
            $data['jenis_studio'],
            $data['tipe_audio'],
            $data['kacamata_3d_id'],
            $data['efek_gerak_fitur'],
            $data['lokasi_baris'],
            $data['bantal_selimut_pack'],
            $data['layanan_butler']
        );
        
        return $stmt->execute();
    }
    
    // Method untuk update tiket
    public function updateTicket($id_tiket, $data) {
        $query = "UPDATE tabel_tiket SET nama_film = ?, jadwal_tayang = ?, jumlah_kursi = ?, 
                  harga_dasar_tiket = ?, jenis_studio = ?, tipe_audio = ?, kacamata_3d_id = ?, 
                  efek_gerak_fitur = ?, lokasi_baris = ?, bantal_selimut_pack = ?, layanan_butler = ? 
                  WHERE id_tiket = ?";
        
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ssidsssssssi", 
            $data['nama_film'], 
            $data['jadwal_tayang'], 
            $data['jumlah_kursi'], 
            $data['harga_dasar_tiket'],
            $data['jenis_studio'],
            $data['tipe_audio'],
            $data['kacamata_3d_id'],
            $data['efek_gerak_fitur'],
            $data['lokasi_baris'],
            $data['bantal_selimut_pack'],
            $data['layanan_butler'],
            $id_tiket
        );
        
        return $stmt->execute();
    }
    
    // Method untuk menghapus tiket
    public function deleteTicket($id_tiket) {
        $query = "DELETE FROM tabel_tiket WHERE id_tiket = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id_tiket);
        return $stmt->execute();
    }
    
    // Method untuk mencari tiket berdasarkan film
    public function searchTicketByFilm($keyword) {
        $tickets = [];
        $query = "SELECT * FROM tabel_tiket WHERE nama_film LIKE ? ORDER BY id_tiket";
        $keyword = "%{$keyword}%";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $keyword);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tickets[] = $this->createTicketObject($row);
            }
        }
        
        return $tickets;
    }
}
?>