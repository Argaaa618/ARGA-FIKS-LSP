<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Mission - Control Center</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
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
                radial-gradient(circle at top right, rgba(37, 99, 235, 0.1), transparent),
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
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 40px;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header-area {
            margin-bottom: 30px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 15px;
            transition: color 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .back-link:hover { color: var(--accent); }

        h2 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.8rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: -1px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 0.75rem;
            font-weight: 800;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 8px;
            margin-left: 4px;
        }

        input {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            padding: 14px 20px;
            color: #fff;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            transition: all 0.3s;
        }

        input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.2);
        }

        input::placeholder {
            color: #475569;
        }

        /* Khusus input angka & date biar kelihat tegas */
        input[type="datetime-local"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            cursor: pointer;
        }

        .grid-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        button {
            width: 100%;
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 16px;
            border-radius: 14px;
            font-weight: 800;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
        }

        button:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(37, 99, 235, 0.4);
        }

        @media (max-width: 480px) {
            .grid-row { grid-template-columns: 1fr; }
            .form-card { padding: 25px; }
        }
    </style>
</head>
<body>

    <div class="form-card">
        <div class="header-area">
            <a href="/dashboard" class="back-link">← Return to Base</a>
            <h2>New Flight Mission</h2>
        </div>

        <form action="/admin/schedules/store" method="POST">
            @csrf

            <div class="input-group">
                <label>Aircraft Designation</label>
                <input type="text" name="plane_name" placeholder="E.g. Garuda Indonesia GA-123" required>
            </div>

            <div class="grid-row">
                <div class="input-group">
                    <label>Origin</label>
                    <input type="text" name="origin" placeholder="City (CGK)" required>
                </div>
                <div class="input-group">
                    <label>Destination</label>
                    <input type="text" name="destination" placeholder="City (DPS)" required>
                </div>
            </div>

            <div class="input-group">
                <label>Departure Timeline</label>
                <input type="datetime-local" name="departure" required>
            </div>

            <div class="grid-row">
                <div class="input-group">
                    <label>Unit Price (IDR)</label>
                    <input type="number" name="price" placeholder="1.500.000" required>
                </div>
                <div class="input-group">
                    <label>Available Units</label>
                    <input type="number" name="stock" placeholder="Max Seats" required>
                </div>
            </div>

            <button type="submit">Deploy Schedule</button>
        </form>
    </div>

</body>
</html>
