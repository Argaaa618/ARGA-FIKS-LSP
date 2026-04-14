<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Booking - Arga.com</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { 
            --primary: #0087ff; 
            --primary-soft: rgba(0, 135, 255, 0.1);
            --dark: #0f172a; 
            --light: #64748b; 
            --border: #e2e8f0; 
            --success: #10b981;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

        body {
            min-height: 100vh; display: grid; place-items: center; padding: 20px;
            background: linear-gradient(135deg, rgba(244, 247, 254, 0.9), rgba(244, 247, 254, 0.8)), 
                        url('https://a-static.besthdwallpaper.com/mount-fuji-japan-wallpaper-1920x1080-80383_48.jpg') center/cover fixed;
        }

        .checkout-container {
            width: 100%; max-width: 1000px; background: #fff; border-radius: 32px;
            display: grid; grid-template-columns: 380px 1fr; overflow: hidden;
            box-shadow: 0 40px 100px -20px rgba(0,0,0,0.15);
        }

        /* Bagian Kiri (Tiket) */
        .ticket-preview { 
            background: var(--primary); padding: 45px; color: #fff; position: relative;
            background-image: radial-gradient(circle at 10% 20%, rgba(255,255,255,0.1) 0%, transparent 20%);
        }
        
        /* Efek Gerigi Tiket */
        .ticket-preview::after {
            content: ''; position: absolute; right: -15px; top: 0; bottom: 0; width: 30px;
            background: radial-gradient(circle, #fff 10px, transparent 11px) center/30px 30px;
        }

        .back-btn { 
            color: rgba(255,255,255,0.8); text-decoration: none; font-size: 0.85rem; 
            font-weight: 700; display: inline-flex; align-items: center; gap: 8px; 
            margin-bottom: 40px; transition: .3s; 
        }
        .back-btn:hover { color: #fff; transform: translateX(-5px); }

        .info-row { margin-bottom: 28px; }
        .info-row label { display: block; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 2px; opacity: 0.7; font-weight: 800; margin-bottom: 5px; }
        .info-row p { font-size: 1.15rem; font-weight: 700; line-height: 1.4; }

        .route-visual { 
            display: flex; justify-content: space-between; align-items: center;
            background: rgba(255,255,255,0.15); padding: 25px; border-radius: 20px;
            backdrop-filter: blur(10px); margin: 30px 0;
        }

        /* Bagian Kanan (Form) */
        .booking-form { padding: 50px 60px; height: 100%; }
        .booking-form h3 { font-weight: 800; font-size: 1.6rem; margin-bottom: 30px; color: var(--dark); letter-spacing: -0.5px; }

        .input-label { font-weight: 800; font-size: 0.75rem; color: var(--light); text-transform: uppercase; margin-bottom: 10px; display: block; letter-spacing: 1px; }

        input[type="number"], select, input[type="file"] {
            width: 100%; padding: 16px; border-radius: 14px; border: 2px solid var(--border);
            font-weight: 600; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
            margin-bottom: 24px; background: #fff; color: var(--dark); outline: none;
        }

        /* Styling Khusus Input File */
        input[type="file"] {
            padding: 12px; font-size: 0.85rem; cursor: pointer;
            background: #f8fafc; border-style: dashed;
        }
        input[type="file"]::file-selector-button {
            background: var(--primary); border: none; padding: 8px 16px;
            border-radius: 8px; color: white; font-weight: 700; margin-right: 15px;
            transition: .3s;
        }
        input[type="file"]:hover::file-selector-button { background: var(--dark); }

        input:focus, select:focus { 
            border-color: var(--primary); 
            box-shadow: 0 0 0 4px var(--primary-soft);
            background: #fff;
        }

        .total-section { 
            background: #f8fafc; padding: 30px; border-radius: 24px; margin: 30px 0;
            border: 1px solid var(--border);
        }
        .total-section p { display: flex; justify-content: space-between; font-weight: 600; color: var(--light); margin-bottom: 12px; }
        
        .grand-total { 
            font-size: 1.6rem; color: var(--primary); border-top: 2px dashed var(--border);
            padding-top: 20px; margin-top: 15px; font-weight: 800;
        }

        button {
            width: 100%; background: var(--primary); color: #fff; border: none; padding: 20px;
            border-radius: 18px; font-weight: 800; cursor: pointer; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
            font-size: 1.05rem; text-transform: uppercase; letter-spacing: 1px;
        }
        button:hover { 
            background: var(--dark); transform: translateY(-3px); 
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.2); 
        }

        @media (max-width: 850px) {
            .checkout-container { grid-template-columns: 1fr; border-radius: 0; }
            .ticket-preview::after { display: none; }
            .booking-form { padding: 40px 30px; }
        }
    </style>
</head>
<body>

<div class="checkout-container">
    <div class="ticket-preview">
        <a href="/dashboard" class="back-btn"><span>←</span> Back to Schedules</a>
        <h2 style="font-weight: 800; margin-bottom: 45px; font-size: 2rem; letter-spacing: -1px;">Ticket Review</h2>

        <div class="info-row">
            <label>Aircraft Designation</label>
            <p>{{ $schedule->plane_name }}</p>
        </div>

        <div class="route-visual">
            <div><label>Origin</label><p>{{ $schedule->origin }}</p></div>
            <div style="font-size: 1.5rem; filter: drop-shadow(0 0 10px rgba(255,255,255,0.5));">✈</div>
            <div style="text-align: right;"><label>Destination</label><p>{{ $schedule->destination }}</p></div>
        </div>

        <div class="info-row">
            <label>Departure Schedule</label>
            <p>{{ date('d M Y', strtotime($schedule->departure)) }}<br>
               <span style="font-size: 0.9rem; opacity: 0.8;">At {{ date('H:i', strtotime($schedule->departure)) }} UTC</span>
            </p>
        </div>

        <div class="info-row">
            <label>Fare per Passenger</label>
            <p style="color: #ffd700;">Rp {{ number_format($schedule->price, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="booking-form">
        <h3>Passenger Details</h3>
        <form action="/booking/{{ $schedule->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <label class="input-label">Number of Passengers</label>
            <input type="number" name="total_seats" min="1" max="{{ $schedule->stock }}" required id="input_kursi" placeholder="E.g. 2">
            
            <label class="input-label">Payment Gateway</label>
            <select name="payment_name" required>
                <option value="" disabled selected>Select Bank Transfer...</option>
                <option value="BCA">Bank BCA — 90915272617</option>
                <option value="BNI">Bank BNI — 98291733712</option>
                <option value="Mandiri">Bank Mandiri — 761271621</option>
            </select>

            <label class="input-label">Upload Transfer Receipt</label>
            <input type="file" name="payment_proof" accept="image/*" required title="Bukti pembayaran">

            <div class="total-section">
                <p>Base Fare (<span id="count_label">0</span>x) <span id="subtotal">Rp 0</span></p>
                <p>Tax & Service <span style="color: var(--success); font-weight: 800;">INCLUDED</span></p>
                <p class="grand-total">Total Payment <span id="total_harga">Rp 0</span></p>
            </div>
            
            <button type="submit">Finalize Booking</button>
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