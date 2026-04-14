<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Executive Admin Dashboard - Trip.com</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --accent: #3b82f6;
            --success: #10b981;
            --danger: #ef4444;
            --bg-dark: #0f172a;
            --slate-50: #f8fafc;
            --slate-100: #f1f5f9;
            --slate-800: #1e293b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: 
                radial-gradient(circle at top right, rgba(37, 99, 235, 0.2), transparent),
                radial-gradient(circle at bottom left, rgba(29, 78, 216, 0.2), transparent),
                var(--bg-dark) url('https://cdn.pixabay.com/photo/2014/10/07/13/48/mountain-477832_1280.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-blend-mode: overlay;
            min-height: 100vh;
            color: var(--slate-100);
            padding: 40px 20px;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            animation: slideIn 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Glass Card Main */
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(25px) saturate(180%);
            -webkit-backdrop-filter: blur(25px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        /* Header Navigation */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding-bottom: 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .brand {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.8rem;
            font-weight: 800;
            letter-spacing: -1px;
            background: linear-gradient(to right, #fff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-actions {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
            border: none;
        }

        .btn-primary:hover {
            background: var(--accent);
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(37, 99, 235, 0.4);
        }

        .btn-ghost {
            color: #94a3b8;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-ghost:hover {
            background: rgba(255, 255, 255, 0.05);
            color: var(--danger);
        }

        /* Table Styling */
        h3 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            margin: 30px 0 20px 0;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        h3::before {
            content: '';
            width: 8px;
            height: 24px;
            background: var(--primary);
            border-radius: 4px;
        }

        .table-container {
            background: rgba(15, 23, 42, 0.4);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            overflow: hidden;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            padding: 20px;
            background: rgba(255, 255, 255, 0.03);
            color: #94a3b8;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
        }

        td {
            padding: 20px;
            font-size: 0.9rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
            color: #cbd5e1;
        }

        tr:last-child td { border: none; }

        tr:hover td {
            background: rgba(255, 255, 255, 0.02);
            color: #fff;
        }

        /* Status & Badges */
        .badge-price {
            font-family: 'Inter', sans-serif;
            font-weight: 800;
            color: #fbbf24;
        }

        .badge-stock {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 700;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        /* Action Links */
        .actions {
            display: flex;
            gap: 15px;
        }

        .act-edit { color: var(--accent); text-decoration: none; font-weight: 700; }
        .act-delete { color: var(--danger); text-decoration: none; font-weight: 700; }
        .act-edit:hover, .act-delete:hover { opacity: 0.7; }

        .empty-state {
            padding: 40px;
            text-align: center;
            color: #64748b;
            font-style: italic;
        }

        @media (max-width: 768px) {
            .glass-card { padding: 20px; }
            header { flex-direction: column; gap: 20px; }
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        <div class="glass-card">
            <header>
                <div class="brand">CONTROL CENTER</div>
                <div class="nav-actions">
                    <a href="/admin/schedules/create" class="btn btn-primary">+ New Schedule</a>
                    <a href="/logout" class="btn btn-ghost">Logout</a>
                </div>
            </header>

            <h3>Active Flight Schedules</h3>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Aircraft</th>
                            <th>Route</th>
                            <th>Departure</th>
                            <th>Pricing</th>
                            <th>Inventory</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $s)
                        <tr>
                            <td><strong style="color: #fff">{{ $s->plane_name }}</strong></td>
                            <td>{{ $s->origin }} <span style="color: var(--accent)">→</span> {{ $s->destination }}</td>
                            <td>{{ $s->departure }}</td>
                            <td class="badge-price">Rp {{ number_format($s->price) }}</td>
                            <td><span class="badge-stock">{{ $s->stock }} Seats</span></td>
                            <td class="actions">
                                <a href="/admin/schedules/edit/{{ $s->id }}" class="act-edit">EDIT</a>
                                <a href="/admin/schedules/delete/{{ $s->id }}" class="act-delete" onclick="return confirm('Archive this schedule?')">DELETE</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h3>Global Transaction History</h3>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer Name</th>
                            <th>Aircraft</th>
                            <th>Seats</th>
                            <th>Net Amount</th>
                            <th>Date & Time</th>
                            <th>Bank</th>
                            <th>Proof</th>
                            <th>Status</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $b)
                        <tr>
                            <td style="color: #64748b">#{{ $b->id }}</td>
                            <td><strong style="color: #fff">{{ $b->user->name }}</strong></td>
                            <td>{{ $b->schedule->plane_name }}</td>
                            <td>{{ $b->total_seats }}</td>
                            <td class="badge-price">Rp {{ number_format($b->total_price) }}</td>
                            <td style="font-size: 0.8rem; color: #64748b">{{ $b->created_at->format('d/m/Y | H:i') }}</td>
                            <td>{{ $b->payment_name }}</td>
                            <td><img src="{{ 'storage/' . $b->payment_proof }}" width="80" onclick="window.open(this.src)"></td>
                            <td>{{ $b->status }}</td>
                            <td>
                            <form action="{{ route('admin.booking.updateStatus', $b->id) }}" method="POST"
                                style="display:flex; gap:6px;">
                                @csrf

                                <select name="status" style="padding:6px; border-radius:6px;">
                                    <option value="pending" {{ $b->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="success" {{ $b->status == 'success' ? 'selected' : '' }}>Success
                                    </option>
                                    <option value="failed" {{ $b->status == 'failed' ? 'selected' : '' }}>Failed
                                    </option>
                                    <option value="canceled" {{ $b->status == 'canceled' ? 'selected' : '' }}>
                                        Canceled</option>
                                </select>

                                <button type="submit">Update</button>
                            </form>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>


