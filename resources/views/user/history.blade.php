<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - Trip.com</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0087ff;
            --bg: #f8fafc;
            --white: #ffffff;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --success: #10b981;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            /* FIX: Background Full & Fixed */
            background-image: 
                linear-gradient(to bottom, rgba(248, 250, 252, 0.8), rgba(248, 250, 252, 0.9)),
                url('https://a-static.besthdwallpaper.com/mount-fuji-japan-wallpaper-1920x1080-80383_48.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed; /* Gambar nggak ikut kegulung */
            background-repeat: no-repeat;
            
            color: var(--text-dark);
            min-height: 100vh; /* Paksa tinggi body minimal se-layar penuh */
            display: flex;
            flex-direction: column;
        }

        .container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            padding: 60px 20px;
            flex: 1; /* Biar container ngambil ruang sisa */
        }

        .header {
            margin-bottom: 30px;
        }

        .back-link {
            text-decoration: none;
            color: var(--primary);
            font-size: 0.9rem;
            font-weight: 700;
            display: inline-block;
            margin-bottom: 15px;
            transition: 0.3s;
        }

        .back-link:hover { opacity: 0.7; }

        h2 {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -1px;
            color: #0f172a;
        }

        .history-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .order-card {
            background: var(--white);
            border-radius: 20px;
            padding: 25px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.8);
            transition: 0.3s;
        }

        .order-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.1);
            border-color: var(--primary);
        }

        .flight-info { flex: 2; }
        .plane-name { font-weight: 800; color: #0f172a; font-size: 1.1rem; }
        .route { font-size: 0.9rem; color: var(--text-light); font-weight: 600; margin-top: 5px; }

        .order-details {
            flex: 1;
            text-align: center;
            border-left: 2px solid #f1f5f9;
            border-right: 2px solid #f1f5f9;
            padding: 0 20px;
        }

        .seats-count { font-size: 0.7rem; color: var(--text-light); font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; }
        .price { font-weight: 800; color: var(--primary); font-size: 1.2rem; margin-top: 2px; }

        .order-status { flex: 1; text-align: right; padding-left: 20px; }
        .status-badge {
            display: inline-block;
            font-size: 0.7rem;
            background: #f0fdf4;
            color: var(--success);
            padding: 6px 14px;
            border-radius: 10px;
            font-weight: 800;
        }

        .date { display: block; font-size: 0.85rem; color: var(--text-light); margin-top: 8px; font-weight: 600; }

        @media (max-width: 700px) {
            .order-card { flex-direction: column; text-align: center; gap: 20px; }
            .order-details { border: none; padding: 15px 0; border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9; width: 100%; }
            .order-status { text-align: center; padding: 0; }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <a href="/dashboard" class="back-link">← Kembali ke Dashboard</a>
            <h2>Riwayat Pemesanan</h2>
        </div>

        <div class="history-list">
            @forelse ($orders as $item)
            <div class="order-card">
                <div class="flight-info">
                    <span class="plane-name">{{ $item->schedule->plane_name }}</span>
                    <p class="route">{{ $item->schedule->origin }} ✈ {{ $item->schedule->destination }}</p>
                </div>

                <div class="order-details">
                    <span class="seats-count">{{ $item->total_seats }} Kursi dipesan</span>
                    <p class="price">Rp {{ number_format($item->total_price) }}</p>
                </div>

                <div class="order-status">
                    <span class="status-badge">{{ $item->status }}</span>
                    <span class="date">{{ $item->created_at->format('d M Y') }}</span>
                </div>
            </div>
            @empty
            <div style="text-align: center; padding: 80px 20px; background: white; border-radius: 30px; border: 2px dashed #e2e8f0;">
                <p style="color: var(--text-light); font-weight: 600;">Belum ada perjalanan yang tercatat.</p>
            </div>
            @endforelse
        </div>
    </div>

</body>
</html>
