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
            --pending: #f59e0b;
            --danger: #ef4444;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-image: 
                linear-gradient(to bottom, rgba(248, 250, 252, 0.8), rgba(248, 250, 252, 0.9)),
                url('https://a-static.besthdwallpaper.com/mount-fuji-japan-wallpaper-1920x1080-80383_48.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            padding: 60px 20px;
            flex: 1;
        }

        .header { margin-bottom: 30px; }

        .back-link {
            text-decoration: none;
            color: var(--primary);
            font-size: 0.9rem;
            font-weight: 700;
            display: inline-block;
            margin-bottom: 15px;
            transition: 0.3s;
        }
        .back-link:hover { opacity: 0.7; transform: translateX(-5px); }

        h2 { font-size: 2.2rem; font-weight: 800; letter-spacing: -1px; color: #0f172a; margin-bottom: 25px; }

        /* CONTROLS */
        .controls-wrapper {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 30px;
        }

        .search-box input {
            width: 100%;
            padding: 15px 20px;
            border-radius: 15px;
            border: 2px solid var(--white);
            background: var(--white);
            font-family: inherit;
            font-size: 0.95rem;
            font-weight: 600;
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.05);
            outline: none;
            transition: 0.3s;
        }

        .search-box input:focus { border-color: var(--primary); }

        .filter-wrapper { display: flex; gap: 10px; overflow-x: auto; padding-bottom: 5px; }

        .filter-btn {
            padding: 10px 20px;
            border-radius: 12px;
            border: 2px solid var(--white);
            background: var(--white);
            color: var(--text-light);
            font-size: 0.85rem;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
            white-space: nowrap;
        }

        .filter-btn.active { background: var(--primary); color: white; border-color: var(--primary); }

        /* CARDS */
        .history-list { display: flex; flex-direction: column; gap: 15px; }

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

        .user-tag {
            font-size: 0.7rem;
            color: var(--primary);
            font-weight: 800;
            text-transform: uppercase;
            display: block;
            margin-bottom: 4px;
        }

        .flight-info { flex: 2; }
        .plane-name { font-weight: 800; color: #0f172a; font-size: 1.1rem; }
        .route { font-size: 0.85rem; color: var(--text-light); font-weight: 600; margin-top: 3px; }

        .order-details {
            flex: 1.2;
            text-align: center;
            border-left: 2px solid #f1f5f9;
            border-right: 2px solid #f1f5f9;
            padding: 0 20px;
        }

        .price { font-weight: 800; color: var(--primary); font-size: 1.1rem; }
        .seats-count { font-size: 0.75rem; color: var(--text-light); font-weight: 600; }

        .order-status { flex: 1; text-align: right; padding-left: 20px; }
        
        .status-badge {
            display: inline-block;
            font-size: 0.65rem;
            padding: 5px 12px;
            border-radius: 8px;
            font-weight: 800;
            text-transform: uppercase;
        }
        
        .status-success { background: #f0fdf4; color: var(--success); }
        .status-pending { background: #fffbeb; color: var(--pending); }
        .status-failed { background: #fef2f2; color: var(--danger); }

        .date { display: block; font-size: 0.8rem; color: var(--text-light); margin-top: 5px; font-weight: 600; }

        @media (max-width: 700px) {
            .order-card { flex-direction: column; text-align: center; gap: 15px; }
            .order-details { border: none; padding: 10px 0; border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9; width: 100%; }
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

        <div class="controls-wrapper">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Cari nama pemesan, pesawat, atau rute..." onkeyup="filterOrders()">
            </div>
            
            <div class="filter-wrapper">
                <button class="filter-btn active" onclick="setFilter('all', this)">Semua</button>
                <button class="filter-btn" onclick="setFilter('success', this)">Berhasil</button>
                <button class="filter-btn" onclick="setFilter('pending', this)">Pending</button>
                <button class="filter-btn" onclick="setFilter('failed', this)">Gagal</button>
            </div>
        </div>

        <div class="history-list" id="orderList">
            @forelse ($orders as $item)
            <div class="order-card" data-status="{{ strtolower($item->status) }}">
                <div class="flight-info">
                    <span class="user-tag">Pemesan: <span class="user-name">{{ $item->user->name }}</span></span>
                    <span class="plane-name">{{ $item->schedule->plane_name }}</span>
                    <p class="route">{{ $item->schedule->origin }} ✈ {{ $item->schedule->destination }}</p>
                </div>

                <div class="order-details">
                    <p class="price">Rp {{ number_format($item->total_price) }}</p>
                    <span class="seats-count">{{ $item->total_seats }} Kursi</span>
                </div>

                <div class="order-status">
                    <span class="status-badge status-{{ strtolower($item->status) }}">{{ $item->status }}</span>
                    <span class="date">{{ $item->created_at->format('d M Y') }}</span>
                </div>
            </div>
            @empty
            <div style="text-align: center; padding: 60px; background: white; border-radius: 20px; border: 2px dashed #cbd5e1;">
                <p style="color: var(--text-light); font-weight: 600;">Data tidak ditemukan.</p>
            </div>
            @endforelse
        </div>
    </div>

    <script>
        let currentStatusFilter = 'all';

        function setFilter(status, btn) {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            currentStatusFilter = status;
            filterOrders();
        }

        function filterOrders() {
            const searchText = document.getElementById('searchInput').value.toLowerCase();
            const cards = document.querySelectorAll('.order-card');

            cards.forEach(card => {
                const userName = card.querySelector('.user-name').innerText.toLowerCase();
                const planeName = card.querySelector('.plane-name').innerText.toLowerCase();
                const route = card.querySelector('.route').innerText.toLowerCase();
                const cardStatus = card.getAttribute('data-status');

                // Pencarian mencakup Nama User, Pesawat, dan Rute
                const matchesSearch = userName.includes(searchText) || 
                                      planeName.includes(searchText) || 
                                      route.includes(searchText);
                
                const matchesStatus = (currentStatusFilter === 'all' || cardStatus === currentStatusFilter);

                card.style.display = (matchesSearch && matchesStatus) ? 'flex' : 'none';
            });
        }
    </script>

</body>
</html>