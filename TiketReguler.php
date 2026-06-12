<?php
// TiketReguler.php
require_once 'Tiket.php';

class TiketReguler extends Tiket {
    private $tipe_audio;
    private $harga_tambahan_audio;
    
    // Constanta untuk harga tambahan audio
    const HARGA_DOLBY_DIGITAL = 5000;
    const HARGA_DTS_SURROUND = 7000;
    const HARGA_DOLBY_ATMOS = 10000;
    const HARGA_DTS_HD = 8000;
    
    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar_tiket, $tipe_audio) {
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar_tiket, 'Reguler');
        $this->tipe_audio = $tipe_audio;
        $this->setHargaTambahanAudio();
    }
    
    // Encapsulation: private method
    private function setHargaTambahanAudio() {
        switch($this->tipe_audio) {
            case 'Dolby Digital':
                $this->harga_tambahan_audio = self::HARGA_DOLBY_DIGITAL;
                break;
            case 'DTS Surround':
                $this->harga_tambahan_audio = self::HARGA_DTS_SURROUND;
                break;
            case 'Dolby Atmos':
                $this->harga_tambahan_audio = self::HARGA_DOLBY_ATMOS;
                break;
            case 'DTS-HD':
                $this->harga_tambahan_audio = self::HARGA_DTS_HD;
                break;
            default:
                $this->harga_tambahan_audio = 0;
        }
    }
    
    // Implementasi abstract method
    public function hitungHargaAkhir() {
        return $this->harga_dasar_tiket + $this->harga_tambahan_audio;
    }
    
    public function getFasilitasTambahan() {
        return "Audio System: " . $this->tipe_audio . " (+Rp " . number_format($this->harga_tambahan_audio, 0, ',', '.') . ")";
    }
    
    public function getTipeAudio() {
        return $this->tipe_audio;
    }
}
?>