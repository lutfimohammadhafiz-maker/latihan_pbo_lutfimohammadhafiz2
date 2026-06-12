<?php
// detail.php
require_once 'TiketManager.php';

$id_tiket = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$tiketManager = new TiketManager();
$tickets = $tiketManager->getAllTickets();

$selectedTicket = null;
foreach($tickets as $ticket) {
    if($ticket->getIdTiket() == $id_tiket) {
        $selectedTicket = $ticket;
        break;
    }
}

if(!$selectedTicket) {
    header("Location: index.php");
    exit();
}

$info = $selectedTicket->displayInfo();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Tiket - <?php echo htmlspecialchars($info['nama_film']); ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .ticket {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        
        .ticket-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .ticket-header h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        .ticket-body {
            padding: 30px;
        }
        
        .detail-row {
            display: flex;
            padding: 15px 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .detail-label {
            width: 150px;
            font-weight: 600;
            color: #495057;
        }
        
        .detail-value {
            flex: 1;
            color: #212529;
        }
        
        .price-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            text-align: center;
        }
        
        .price-box .label {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 5px;
        }
        
        .price-box .amount {
            font-size: 32px;
            font-weight: bold;
            color: #28a745;
        }
        
        .btn-back {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            background: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .btn-back:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }
        
        .facilities-box {
            background: #e7f3ff;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
        }
        
        @media (max-width: 768px) {
            .detail-row {
                flex-direction: column;
            }
            
            .detail-label {
                width: 100%;
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="ticket">
            <div class="ticket-header">
                <h1>🎟️ Detail Tiket Bioskop</h1>
                <p>ID Tiket: #<?php echo $info['id_tiket']; ?></p>
            </div>
            <div class="ticket-body">
                <div class="detail-row">
                    <div class="detail-label">Nama Film</div>
                    <div class="detail-value"><?php echo htmlspecialchars($info['nama_film']); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Jadwal Tayang</div>
                    <div class="detail-value"><?php echo date('l, d F Y H:i', strtotime($info['jadwal_tayang'])); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Jenis Studio</div>
                    <div class="detail-value"><?php echo $info['jenis_studio']; ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Jumlah Kursi</div>
                    <div class="detail-value"><?php echo $info['jumlah_kursi']; ?> kursi tersedia</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Harga Dasar</div>
                    <div class="detail-value">Rp <?php echo number_format($info['harga_dasar'], 0, ',', '.'); ?></div>
                </div>
                
                <div class="facilities-box">
                    <strong>✨ Fasilitas & Layanan Tambahan:</strong><br><br>
                    <?php echo nl2br(htmlspecialchars($info['fasilitas'])); ?>
                </div>
                
                <div class="price-box">
                    <div class="label">Total Harga Tiket</div>
                    <div class="amount">Rp <?php echo number_format($info['harga_akhir'], 0, ',', '.'); ?></div>
                </div>
                
                <center>
                    <a href="index.php" class="btn-back">← Kembali ke Daftar Film</a>
                </center>
            </div>
        </div>
    </div>
</body>
</html>