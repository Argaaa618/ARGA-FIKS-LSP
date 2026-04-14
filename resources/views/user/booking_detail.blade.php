<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Booking - Arga.com</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #0087ff; --dark: #1e293b; --light: #64748b; --border: #e2e8f0; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

        body {
            min-height: 100vh; display: grid; place-items: center; padding: 20px;
            background: linear-gradient(#f4f7feee, #f4f7feee), url('https://a-static.besthdwallpaper.com/mount-fuji-japan-wallpaper-1920x1080-80383_48.jpg') center/cover fixed;
        }

        .checkout-container {
            width: 100%; max-width: 1000px; background: #fff; border-radius: 30px;
            display: grid; grid-template-columns: 400px 1fr; overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15);
        }

        /* Bagian Kiri (Tiket) */
        .ticket-preview { background: var(--primary); padding: 40px; color: #fff; position: relative; }
        .ticket-preview::after {
            content: ''; position: absolute; right: -15px; top: 0; bottom: 0; width: 30px;
            background: radial-gradient(circle, #fff 10px, transparent 0) center/30px 30px;
        }

        .back-btn { color: #ffffffcc; text-decoration: none; font-size: 0.8rem; font-weight: 700; display: block; margin-bottom: 30px; transition: .3s; }
        .back-btn:hover { color: #fff; transform: translateX(-5px); }

        .info-row { margin-bottom: 25px; }
        .info-row label { display: block; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1.5px; opacity: 0.7; font-weight: 700; }
        .info-row p { font-size: 1.1rem; font-weight: 700; }

        .route-visual { 
            display: flex; justify-content: space-between; align-items: center;
            background: rgba(255,255,255,0.1); padding: 20px; border-radius: 15px;
        }

        /* Bagian Kanan (Form) */
        .booking-form { padding: 50px; overflow-y: auto; }
        .booking-form h3 { font-weight: 800; font-size: 1.4rem; margin-bottom: 25px; color: var(--dark); }

        .input-label { font-weight: 800; font-size: 0.75rem; color: var(--light); text-transform: uppercase; margin-bottom: 8px; display: block; }

        input[type="number"], select {
            width: 100%; padding: 15px; border-radius: 12px; border: 2px solid var(--border);
            font-weight: 700; transition: .3s; margin-bottom: 20px; appearance: none;
            background: #fff; color: var(--dark); outline: none;
        }

        select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 18px;
            cursor: pointer;
        }

        input:focus, select:focus { border-color: var(--primary); box-shadow: 0 0 0 4px rgba(0, 135, 255, 0.1); }

        .total-section { background: #f8fafc; padding: 25px; border-radius: 18px; margin: 20px 0; }
        .total-section p { display: flex; justify-content: space-between; font-weight: 700; color: var(--light); margin-bottom: 10px; }
        .grand-total { 
            font-size: 1.5rem; color: var(--primary); border-top: 2px dashed var(--border);
            padding-top: 15px; margin-top: 10px; font-weight: 800;
        }

        button {
            width: 100%; background: var(--primary); color: #fff; border: none; padding: 18px;
            border-radius: 15px; font-weight: 800; cursor: pointer; transition: .3s; font-size: 1rem;
        }
        button:hover { background: #0059b3; transform: translateY(-2px); box-shadow: 0 10px 20px #0087ff33; }

        @media (max-width: 768px) {
            .checkout-container { grid-template-columns: 1fr; }
            .ticket-preview::after { display: none; }
        }
    </style>
</head>
<body>

<div class="checkout-container">
    <div class="ticket-preview">
        <a href="/dashboard" class="back-btn">← Back to Schedules</a>
        <h2 style="font-weight: 800; margin-bottom: 40px;">Ticket Review</h2>

        <div class="info-row">
            <label>Aircraft</label>
            <p>{{ $schedule->plane_name }}</p>
        </div>

        <div class="route-visual">
            <div><label>From</label><p>{{ $schedule->origin }}</p></div>
            <div style="font-size: 1.2rem;">✈</div>
            <div style="text-align: right;"><label>To</label><p>{{ $schedule->destination }}</p></div>
        </div>

        <div class="info-row" style="margin-top: 30px;">
            <label>Departure</label>
            <p>{{ date('d M Y, H:i', strtotime($schedule->departure)) }}</p>
        </div>

        <div class="info-row">
            <label>Price / Seat</label>
            <p>Rp {{ number_format($schedule->price, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="booking-form">
        <h3>Complete Booking</h3>
        <form action="/booking/{{ $schedule->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <label class="input-label">How many seats?</label>
            <input type="number" name="total_seats" min="1" max="{{ $schedule->stock }}" required id="input_kursi" placeholder="Enter amount">
            
            <div class="total-section">
                <p>Subtotal (<span id="count_label">0</span> seats) <span id="subtotal">Rp 0</span></p>
                <p>Service Fee <span>Free</span></p>
                <p class="grand-total">Total Payment <span id="total_harga">Rp 0</span></p>
            </div>
            
            <label class="input-label">Transfer via Bank</label>
            <select name="payment_name" required>
                <option value="" disabled selected>Pilih bank...</option>
                <option value="BCA">Bank BCA 90915272617</option>
                <option value="BNI">Bank BNI 98291733712</option>
                <option value="Mandiri">Bank Mandiri 761271621</option>
            </select>

            <label for="">Upload Bukti Pendaftaran</label>
            <input type="file" name="payment_proof" accept="image/*" required>

            <button type="submit">Confirm & Book Now</button>
        </form>
    </div>
</div>

<script>
    const input = document.getElementById('input_kursi');
    const price = {{ $schedule->price }};
    const format = (v) => "Rp " + v.toLocaleString('id-ID');

    input.addEventListener('input', () => {
        const seats = parseInt(input.value) || 0;
        const val = seats * price;
        
        document.getElementById('count_label').innerText = seats;
        document.getElementById('subtotal').innerText = format(val);
        document.getElementById('total_harga').innerText = format(val);
    });
</script>

</body>
</html>


