<?php
// index.php
require_once 'TiketManager.php';

$tiketManager = new TiketManager();
$activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'all';
$searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';

// Handle search
if (!empty($searchKeyword)) {
    $tickets = $tiketManager->searchTicketByFilm($searchKeyword);
} else {
    switch($activeTab) {
        case 'reguler':
            $tickets = $tiketManager->getTicketsByStudio('Reguler');
            break;
        case 'imax':
            $tickets = $tiketManager->getTicketsByStudio('IMAX');
            break;
        case 'velvet':
            $tickets = $tiketManager->getTicketsByStudio('Velvet');
            break;
        default:
            $tickets = $tiketManager->getAllTickets();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pemesanan Tiket Bioskop</title>
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
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .header h1 {
            font-size: 2em;
            margin-bottom: 10px;
        }
        
        .header p {
            opacity: 0.9;
        }
        
        .nav-tabs {
            display: flex;
            background: #f8f9fa;
            border-bottom: 2px solid #e9ecef;
            padding: 0 20px;
        }
        
        .nav-tabs a {
            padding: 15px 25px;
            text-decoration: none;
            color: #495057;
            font-weight: 600;
            transition: all 0.3s;
            border-bottom: 3px solid transparent;
        }
        
        .nav-tabs a:hover {
            color: #667eea;
            background: #f1f3f5;
        }
        
        .nav-tabs a.active {
            color: #667eea;
            border-bottom-color: #667eea;
        }
        
        .search-bar {
            padding: 20px;
            background: white;
            border-bottom: 1px solid #e9ecef;
        }
        
        .search-form {
            display: flex;
            gap: 10px;
            max-width: 500px;
        }
        
        .search-input {
            flex: 1;
            padding: 10px 15px;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        .search-input:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .search-btn {
            padding: 10px 20px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .search-btn:hover {
            background: #5a67d8;
            transform: translateY(-2px);
        }
        
        .clear-search {
            background: #6c757d;
        }
        
        .clear-search:hover {
            background: #5a6268;
        }
        
        .content {
            padding: 20px;
        }
        
        .stats {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 25px;
            border-radius: 10px;
            flex: 1;
        }
        
        .stat-card h3 {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 5px;
        }
        
        .stat-card .number {
            font-size: 28px;
            font-weight: bold;
        }
        
        .ticket-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
        }
        
        .ticket-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s;
            border: 1px solid #e9ecef;
            cursor: pointer;
        }
        
        .ticket-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        
        .ticket-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px;
            position: relative;
        }
        
        .studio-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255,255,255,0.2);
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .ticket-header h3 {
            margin-bottom: 5px;
            font-size: 18px;
        }
        
        .ticket-body {
            padding: 15px;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #f1f3f5;
        }
        
        .info-label {
            font-weight: 600;
            color: #495057;
        }
        
        .info-value {
            color: #212529;
        }
        
        .price {
            font-size: 20px;
            font-weight: bold;
            color: #28a745;
            margin-top: 10px;
            text-align: right;
        }
        
        .facilities {
            margin-top: 15px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
            font-size: 14px;
            white-space: pre-line;
        }
        
        .facilities strong {
            color: #667eea;
        }
        
        .no-data {
            text-align: center;
            padding: 50px;
            color: #6c757d;
        }
        
        @media (max-width: 768px) {
            .nav-tabs {
                flex-wrap: wrap;
            }
            
            .nav-tabs a {
                flex: 1;
                text-align: center;
                padding: 10px;
                font-size: 14px;
            }
            
            .ticket-grid {
                grid-template-columns: 1fr;
            }
            
            .stats {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎬 Sistem Pemesanan Tiket Bioskop</h1>
            <p>PBO - TRPL 1A | Luthfi M Hafiz</p>
        </div>
        
        <div class="nav-tabs">
            <a href="?tab=all" class="<?php echo $activeTab == 'all' ? 'active' : ''; ?>">🎥 Semua Film</a>
            <a href="?tab=reguler" class="<?php echo $activeTab == 'reguler' ? 'active' : ''; ?>">📺 Reguler</a>
            <a href="?tab=imax" class="<?php echo $activeTab == 'imax' ? 'active' : ''; ?>">🎬 IMAX 3D</a>
            <a href="?tab=velvet" class="<?php echo $activeTab == 'velvet' ? 'active' : ''; ?>">💺 Velvet Class</a>
        </div>
        
        <div class="search-bar">
            <form method="GET" class="search-form">
                <input type="hidden" name="tab" value="<?php echo $activeTab; ?>">
                <input type="text" name="search" class="search-input" placeholder="Cari film..." value="<?php echo htmlspecialchars($searchKeyword); ?>">
                <button type="submit" class="search-btn">🔍 Cari</button>
                <?php if (!empty($searchKeyword)): ?>
                    <a href="?tab=<?php echo $activeTab; ?>" class="search-btn clear-search">✖ Clear</a>
                <?php endif; ?>
            </form>
        </div>
        
        <div class="content">
            <div class="stats">
                <div class="stat-card">
                    <h3>Total Film</h3>
                    <div class="number"><?php echo count($tickets); ?></div>
                </div>
                <div class="stat-card">
                    <h3>Total Kursi</h3>
                    <div class="number">
                        <?php 
                        $totalKursi = 0;
                        foreach($tickets as $ticket) {
                            $totalKursi += $ticket->getJumlahKursi();
                        }
                        echo $totalKursi;
                        ?>
                    </div>
                </div>
                <div class="stat-card">
                    <h3>Harga Termurah</h3>
                    <div class="number">
                        <?php 
                        $minPrice = PHP_INT_MAX;
                        foreach($tickets as $ticket) {
                            $price = $ticket->hitungHargaAkhir();
                            if($price < $minPrice) $minPrice = $price;
                        }
                        echo $minPrice != PHP_INT_MAX ? 'Rp ' . number_format($minPrice, 0, ',', '.') : 'Rp 0';
                        ?>
                    </div>
                </div>
            </div>
            
            <?php if(count($tickets) > 0): ?>
                <div class="ticket-grid">
                    <?php foreach($tickets as $ticket): ?>
                        <?php $info = $ticket->displayInfo(); ?>
                        <div class="ticket-card" onclick="location.href='detail.php?id=<?php echo $info['id_tiket']; ?>'">
                            <div class="ticket-header">
                                <div class="studio-badge"><?php echo $info['jenis_studio']; ?></div>
                                <h3><?php echo htmlspecialchars($info['nama_film']); ?></h3>
                                <small>ID Tiket: #<?php echo $info['id_tiket']; ?></small>
                            </div>
                            <div class="ticket-body">
                                <div class="info-row">
                                    <span class="info-label">📅 Jadwal Tayang:</span>
                                    <span class="info-value">
                                        <?php echo date('d/m/Y H:i', strtotime($info['jadwal_tayang'])); ?>
                                    </span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">💺 Jumlah Kursi:</span>
                                    <span class="info-value"><?php echo $info['jumlah_kursi']; ?> kursi</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">💰 Harga Dasar:</span>
                                    <span class="info-value">Rp <?php echo number_format($info['harga_dasar'], 0, ',', '.'); ?></span>
                                </div>
                                
                                <div class="facilities">
                                    <strong>✨ Fasilitas Tambahan:</strong><br>
                                    <?php echo nl2br(htmlspecialchars($info['fasilitas'])); ?>
                                </div>
                                
                                <div class="price">
                                    🎫 Total: Rp <?php echo number_format($info['harga_akhir'], 0, ',', '.'); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="no-data">
                    <h3>😢 Tidak ada tiket yang ditemukan</h3>
                    <p>Silahkan coba dengan kata kunci yang berbeda</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>