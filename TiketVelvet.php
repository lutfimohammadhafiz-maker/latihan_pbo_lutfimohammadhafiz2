<?php
// TiketVelvet.php
require_once 'Tiket.php';

class TiketVelvet extends Tiket {
    private $lokasi_baris;
    private $bantal_selimut_pack;
    private $layanan_butler;
    private $harga_tambahan_pack;
    private $harga_tambahan_baris;
    
    const HARGA_PREMIUM_PACK = 25000;
    const HARGA_LUXURY_PACK = 35000;
    const HARGA_EXCLUSIVE_PACK = 50000;
    const HARGA_BARIS_A = 20000;
    const HARGA_BARIS_B = 15000;
    const HARGA_BARIS_C = 10000;
    
    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar_tiket, $lokasi_baris, $bantal_selimut_pack, $layanan_butler) {
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar_tiket, 'Velvet');
        $this->lokasi_baris = $lokasi_baris;
        $this->bantal_selimut_pack = $bantal_selimut_pack;
        $this->layanan_butler = $layanan_butler;
        $this->setHargaTambahan();
    }
    
    private function setHargaTambahan() {
        // Harga tambahan untuk pack
        switch($this->bantal_selimut_pack) {
            case 'Premium Pack':
                $this->harga_tambahan_pack = self::HARGA_PREMIUM_PACK;
                break;
            case 'Luxury Pack':
                $this->harga_tambahan_pack = self::HARGA_LUXURY_PACK;
                break;
            case 'Exclusive Pack':
                $this->harga_tambahan_pack = self::HARGA_EXCLUSIVE_PACK;
                break;
            default:
                $this->harga_tambahan_pack = 0;
        }
        
        // Harga tambahan untuk baris kursi
        switch($this->lokasi_baris) {
            case 'Baris A':
                $this->harga_tambahan_baris = self::HARGA_BARIS_A;
                break;
            case 'Baris B':
                $this->harga_tambahan_baris = self::HARGA_BARIS_B;
                break;
            case 'Baris C':
                $this->harga_tambahan_baris = self::HARGA_BARIS_C;
                break;
            default:
                $this->harga_tambahan_baris = 0;
        }
    }
    
    public function hitungHargaAkhir() {
        return $this->harga_dasar_tiket + $this->harga_tambahan_pack + $this->harga_tambahan_baris;
    }
    
    public function getFasilitasTambahan() {
        $fasilitas = "Seat Location: " . $this->lokasi_baris . " (+Rp " . number_format($this->harga_tambahan_baris, 0, ',', '.') . ")";
        $fasilitas .= "\nPack: " . $this->bantal_selimut_pack . " (+Rp " . number_format($this->harga_tambahan_pack, 0, ',', '.') . ")";
        $fasilitas .= "\nButler Service: " . $this->layanan_butler;
        return $fasilitas;
    }
    
    public function getLokasiBaris() {
        return $this->lokasi_baris;
    }
    
    public function getBantalSelimutPack() {
        return $this->bantal_selimut_pack;
    }
    
    public function getLayananButler() {
        return $this->layanan_butler;
    }
}
?>