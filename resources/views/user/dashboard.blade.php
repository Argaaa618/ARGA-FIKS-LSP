<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traveler Dashboard - Trip.com</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0087ff;
            --bg: #f4f7fe;
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
            background-color: var(--bg);
            color: var(--text-dark);
            padding-bottom: 50px;
        }

        /* Navbar */
        .navbar {
            background: var(--white);
            padding: 20px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: -1px;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-light);
            font-weight: 600;
            margin-left: 25px;
            font-size: 0.9rem;
            transition: 0.3s;
        }

        .nav-links a:hover { color: var(--primary); }

        /* Hero Section with Fuji Background */
        .hero {
            padding: 80px 5% 140px 5%;
            background: 
                linear-gradient(rgba(15, 23, 42, 0.5), rgba(0, 89, 179, 0.7)), 
                url('https://a-static.besthdwallpaper.com/mount-fuji-japan-wallpaper-1920x1080-80383_48.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            margin-bottom: -80px;
            border-radius: 0 0 40px 40px;
        }

        .hero h2 { 
            font-size: 2.8rem; 
            font-weight: 800; 
            margin-bottom: 10px;
            text-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }

        .hero p { 
            font-size: 1.1rem;
            opacity: 0.95; 
            font-weight: 500; 
            text-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }

        /* Main Container */
        .container {
            padding: 0 5%;
            max-width: 1300px;
            margin: 0 auto;
        }

        /* Flight Grid */
        .flight-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
        }

        /* Card Layout */
        .flight-card {
            background: var(--white);
            border-radius: 24px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(255, 255, 255, 0.1);
            
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .flight-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .top-content {
            flex-grow: 1;
        }

        .plane-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .plane-name {
            font-weight: 800;
            color: var(--primary);
            font-size: 1rem;
        }

        .status-badge {
            font-size: 0.65rem;
            background: #e0f2fe;
            color: #0369a1;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .route-area {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
            text-align: center;
        }

        .city h4 { font-size: 1.4rem; font-weight: 800; letter-spacing: -0.5px; }
        .city p { font-size: 0.8rem; color: var(--text-light); font-weight: 600; }

        .plane-icon {
            color: #cbd5e1;
            font-size: 1.2rem;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .plane-icon::before {
            content: '';
            position: absolute;
            width: 70%;
            height: 1px;
            border-bottom: 2px dashed #e2e8f0;
        }

        .plane-icon span {
            background: white;
            padding: 0 10px;
            z-index: 1;
        }

        /* Detail Box */
        .flight-details {
            background: #f8fafc;
            border-radius: 18px;
            padding: 18px;
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
        }

        .detail-item span {
            display: block;
            font-size: 0.65rem;
            color: var(--text-light);
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .detail-item p { font-weight: 700; font-size: 0.95rem; }

        /* Price & Button (Sejajar di Bawah) */
        .price-booking {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 20px;
            border-top: 1px solid #f1f5f9;
            margin-top: auto;
        }

        .price-tag {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--success);
        }

        .btn-book {
            background: var(--primary);
            color: white;
            padding: 12px 28px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: 800;
            font-size: 0.85rem;
            transition: 0.3s;
        }

        .btn-book:hover {
            background: #0059b3;
            box-shadow: 0 8px 20px rgba(0, 135, 255, 0.4);
            transform: scale(1.05);
        }

        @media (max-width: 600px) {
            .flight-grid { grid-template-columns: 1fr; }
            .hero h2 { font-size: 2rem; }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo">TRIP.COM</div>
        <div class="nav-links">
            <a href="/history">History</a>
            <a href="/logout" style="color: #ef4444;">Logout</a>
        </div>
    </nav>

    <div class="hero">
        <div class="container">
            <h2>Halo, {{ Auth::user()->name }}!</h2>
            <p>Temukan tiket pesawat dengan harga terbaik hari ini.</p>
        </div>
    </div>

    <div class="container">
        <h3 style="margin-bottom: 30px; font-weight: 800; color: white; position: relative; z-index: 1;">Jadwal Penerbangan</h3>
        
        <div class="flight-grid">
            @foreach($schedules as $item)
            <div class="flight-card">
                <div class="top-content">
                    <div class="plane-info">
                        <div class="plane-name">{{ $item->plane_name }}</div>
                        <div class="status-badge">Available</div>
                    </div>

                    <div class="route-area">
                        <div class="city">
                            <h4>{{ $item->origin }}</h4>
                            <p>Origin</p>
                        </div>
                        <div class="plane-icon">
                            <span>✈</span>
                        </div>
                        <div class="city">
                            <h4>{{ $item->destination }}</h4>
                            <p>Destination</p>
                        </div>
                    </div>
                </div>

                <div class="flight-details">
                    <div class="detail-item">
                        <span>Time</span>
                        <p>{{ date('H:i', strtotime($item->departure)) }}</p>
                    </div>
                    <div class="detail-item">
                        <span>Date</span>
                        <p>{{ date('d M Y', strtotime($item->departure)) }}</p>
                    </div>
                    <div class="detail-item">
                        <span>Seats</span>
                        <p>{{ $item->stock }} Left</p>
                    </div>
                </div>

                <div class="price-booking">
                    <div class="price-tag">Rp {{ number_format($item->price) }}</div>
                    <a href="/booking/{{ $item->id }}" class="btn-book">Book Now</a>
                </div>
            </div>
            @endforeach
        </div>

        @if($schedules->isEmpty())
        <div style="text-align: center; padding: 100px 0; color: #64748b;">
            <h1 style="font-size: 4rem; margin-bottom: 20px;">☁️</h1>
            <h3>Belum ada jadwal tersedia...</h3>
        </div>
        @endif
    </div>

</body>
</html>
