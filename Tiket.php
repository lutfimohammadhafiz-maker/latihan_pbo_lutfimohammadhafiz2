<?php
// Tiket.php - Super Class
abstract class Tiket {
    protected $id_tiket;
    protected $nama_film;
    protected $jadwal_tayang;
    protected $jumlah_kursi;
    protected $harga_dasar_tiket;
    protected $jenis_studio;
    
    // Constructor
    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar_tiket, $jenis_studio) {
        $this->id_tiket = $id_tiket;
        $this->nama_film = $nama_film;
        $this->jadwal_tayang = $jadwal_tayang;
        $this->jumlah_kursi = $jumlah_kursi;
        $this->harga_dasar_tiket = $harga_dasar_tiket;
        $this->jenis_studio = $jenis_studio;
    }
    
    // Encapsulation: Getter methods
    public function getIdTiket() {
        return $this->id_tiket;
    }
    
    public function getNamaFilm() {
        return $this->nama_film;
    }
    
    public function getJadwalTayang() {
        return $this->jadwal_tayang;
    }
    
    public function getJumlahKursi() {
        return $this->jumlah_kursi;
    }
    
    public function getHargaDasarTiket() {
        return $this->harga_dasar_tiket;
    }
    
    public function getJenisStudio() {
        return $this->jenis_studio;
    }
    
    // Setter methods dengan validasi
    public function setJumlahKursi($jumlah) {
        if ($jumlah > 0) {
            $this->jumlah_kursi = $jumlah;
            return true;
        }
        return false;
    }
    
    // Abstract method - harus diimplementasikan oleh child class
    abstract public function hitungHargaAkhir();
    
    abstract public function getFasilitasTambahan();
    
    // Method untuk menampilkan info tiket
    public function displayInfo() {
        return [
            'id_tiket' => $this->id_tiket,
            'nama_film' => $this->nama_film,
            'jadwal_tayang' => $this->jadwal_tayang,
            'jumlah_kursi' => $this->jumlah_kursi,
            'harga_dasar' => $this->harga_dasar_tiket,
            'jenis_studio' => $this->jenis_studio,
            'harga_akhir' => $this->hitungHargaAkhir(),
            'fasilitas' => $this->getFasilitasTambahan()
        ];
    }
}
?>