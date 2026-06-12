<?php
// TiketIMAX.php
require_once 'Tiket.php';

class TiketIMAX extends Tiket {
    private $kacamata_3d_id;
    private $efek_gerak_fitur;
    private $harga_tambahan_3d;
    private $harga_tambahan_efek;
    
    const HARGA_3D = 15000;
    const HARGA_MOTION_SEAT = 10000;
    const HARGA_VIBRATION = 8000;
    const HARGA_WIND_EFFECT = 7000;
    const HARGA_WATER_SPLASH = 12000;
    
    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar_tiket, $kacamata_3d_id, $efek_gerak_fitur) {
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar_tiket, 'IMAX');
        $this->kacamata_3d_id = $kacamata_3d_id;
        $this->efek_gerak_fitur = $efek_gerak_fitur;
        $this->setHargaTambahan();
    }
    
    private function setHargaTambahan() {
        // Harga untuk kacamata 3D
        $this->harga_tambahan_3d = self::HARGA_3D;
        
        // Harga untuk efek gerak
        switch($this->efek_gerak_fitur) {
            case 'Motion Seat':
                $this->harga_tambahan_efek = self::HARGA_MOTION_SEAT;
                break;
            case 'Vibration Effect':
                $this->harga_tambahan_efek = self::HARGA_VIBRATION;
                break;
            case 'Wind Effect':
                $this->harga_tambahan_efek = self::HARGA_WIND_EFFECT;
                break;
            case 'Water Splash':
                $this->harga_tambahan_efek = self::HARGA_WATER_SPLASH;
                break;
            default:
                $this->harga_tambahan_efek = 0;
        }
    }
    
    public function hitungHargaAkhir() {
        return $this->harga_dasar_tiket + $this->harga_tambahan_3d + $this->harga_tambahan_efek;
    }
    
    public function getFasilitasTambahan() {
        $fasilitas = "3D Glasses (" . $this->kacamata_3d_id . ") +Rp " . number_format($this->harga_tambahan_3d, 0, ',', '.');
        $fasilitas .= "\nMotion Effect: " . $this->efek_gerak_fitur . " +Rp " . number_format($this->harga_tambahan_efek, 0, ',', '.');
        return $fasilitas;
    }
    
    public function getKacamata3dId() {
        return $this->kacamata_3d_id;
    }
    
    public function getEfekGerakFitur() {
        return $this->efek_gerak_fitur;
    }
}
?>