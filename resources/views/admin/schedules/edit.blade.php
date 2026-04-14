<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Mission - Control Center</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #f59e0b; /* Warna Amber biar beda sama Create */
            --primary-glow: rgba(245, 158, 11, 0.3);
            --accent: #3b82f6;
            --bg-dark: #0f172a;
            --glass: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: 
                radial-gradient(circle at bottom right, rgba(245, 158, 11, 0.1), transparent),
                var(--bg-dark) url('https://cdn.pixabay.com/photo/2014/10/07/13/48/mountain-477832_1280.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-blend-mode: overlay;
            min-height: 100vh;
            color: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .form-card {
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(25px) saturate(180%);
            -webkit-backdrop-filter: blur(25px) saturate(180%);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 45px;
            width: 100%;
            max-width: 650px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6);
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        .header-area {
            margin-bottom: 35px;
            border-left: 4px solid var(--primary);
            padding-left: 20px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            color: #64748b;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 800;
            margin-bottom: 10px;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .back-link:hover { color: #fff; transform: translateX(-5px); }

        h2 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.8rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: -1px;
            text-transform: uppercase;
        }

        .input-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            font-size: 0.7rem;
            font-weight: 800;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            padding: 16px 20px;
            color: #fff;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            transition: all 0.3s;
        }

        input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.07);
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-glow);
        }

        .grid-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }

        button {
            width: 100%;
            background: var(--primary);
            color: #0f172a; /* Kontras gelap biar tegas */
            border: none;
            padding: 18px;
            border-radius: 14px;
            font-weight: 900;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 15px;
            box-shadow: 0 10px 20px -5px var(--primary-glow);
        }

        button:hover {
            transform: translateY(-3px);
            filter: brightness(1.1);
            box-shadow: 0 15px 30px -5px var(--primary-glow);
        }

        /* Styling Calendar Icon biar putih */
        input[type="datetime-local"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            opacity: 0.6;
            cursor: pointer;
        }

        @media (max-width: 580px) {
            .grid-row { grid-template-columns: 1fr; }
            .form-card { padding: 30px 20px; }
        }
    </style>
</head>
<body>

    <div class="form-card">
        <div class="header-area">
            <a href="/dashboard" class="back-link">← Abort & Return</a>
            <h2>Edit Flight Mission</h2>
        </div>

        <form action="/admin/schedules/update/{{ $schedule->id }}" method="POST">
            @csrf
            
            <div class="input-group">
                <label>Aircraft Specification</label>
                <input type="text" name="plane_name" value="{{ $schedule->plane_name }}" required>
            </div>

            <div class="grid-row">
                <div class="input-group">
                    <label>Origin Hub</label>
                    <input type="text" name="origin" value="{{ $schedule->origin }}" required>
                </div>
                <div class="input-group">
                    <label>Destination Hub</label>
                    <input type="text" name="destination" value="{{ $schedule->destination }}" required>
                </div>
            </div>

            <div class="input-group">
                <label>Deployment Timeline</label>
                <input type="datetime-local" name="departure" 
                       value="{{ date('Y-m-d\TH:i', strtotime($schedule->departure)) }}" required>
            </div>

            <div class="grid-row">
                <div class="input-group">
                    <label>Updated Price (IDR)</label>
                    <input type="number" name="price" value="{{ $schedule->price }}" required>
                </div>
                <div class="input-group">
                    <label>Stock Capacity</label>
                    <input type="number" name="stock" value="{{ $schedule->stock }}" required>
                </div>
            </div>

            <button type="submit">Push Changes to System</button>
        </form>
    </div>

</body>
</html>
