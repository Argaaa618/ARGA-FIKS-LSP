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

        * { margin: 0; padding: 0; box-sizing: border-box; }

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
            max-width: 1300px;
            margin: 0 auto;
            animation: slideIn 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(25px) saturate(180%);
            -webkit-backdrop-filter: blur(25px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

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

        /* SEARCH & FILTER STYLING */
        .controls-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 20px;
            flex-wrap: wrap;
        }

        .search-wrapper { flex: 1; min-width: 300px; }
        
        .search-input {
            width: 100%;
            padding: 12px 20px;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            color: white;
            outline: none;
            transition: 0.3s;
        }
        .search-input:focus { border-color: var(--primary); box-shadow: 0 0 15px rgba(37, 99, 235, 0.2); }

        .filter-group { display: flex; gap: 8px; overflow-x: auto; }

        .filter-chip {
            padding: 8px 16px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            color: #94a3b8;
            cursor: pointer;
            font-size: 0.75rem;
            font-weight: 700;
            transition: 0.3s;
            white-space: nowrap;
        }
        .filter-chip:hover { background: rgba(255,255,255,0.1); }
        .filter-chip.active { background: var(--primary); color: white; border-color: var(--primary); }

        .nav-actions { display: flex; gap: 12px; }

        .btn {
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary { background: var(--primary); color: white; border: none; box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3); }
        .btn-primary:hover { background: var(--accent); transform: translateY(-2px); }
        .btn-ghost { color: #94a3b8; border: 1px solid rgba(255, 255, 255, 0.1); }
        .btn-ghost:hover { background: rgba(255,255,255,0.05); color: var(--danger); }

        h3 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            margin: 40px 0 20px 0;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        h3::before { content: ''; width: 8px; height: 24px; background: var(--primary); border-radius: 4px; }

        .table-container {
            background: rgba(15, 23, 42, 0.4);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            overflow-x: auto;
            margin-bottom: 20px;
        }

        table { width: 100%; border-collapse: collapse; text-align: left; min-width: 1000px; }
        th {
            padding: 20px;
            background: rgba(255, 255, 255, 0.03);
            color: #94a3b8;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
        }
        td { padding: 18px 20px; font-size: 0.85rem; border-bottom: 1px solid rgba(255, 255, 255, 0.03); color: #cbd5e1; }

        /* Components */
        .badge-price { font-weight: 800; color: #fbbf24; }
        .badge-stock {
            background: rgba(16, 185, 129, 0.1); color: var(--success);
            padding: 6px 12px; border-radius: 8px; font-size: 0.8rem; font-weight: 700;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .status-badge {
            padding: 6px 12px; border-radius: 8px; font-size: 0.7rem; font-weight: 700;
            text-transform: uppercase; display: inline-block;
        }
        .status-pending { background: rgba(251, 191, 36, 0.1); color: #fbbf24; border: 1px solid rgba(251, 191, 36, 0.2); }
        .status-success { background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.2); }
        .status-failed { background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.2); }
        .status-canceled { background: rgba(148, 163, 184, 0.1); color: #94a3b8; border: 1px solid rgba(148, 163, 184, 0.2); }

        .proof-img { border-radius: 8px; border: 2px solid rgba(255,255,255,0.1); transition: 0.3s; cursor: zoom-in; object-fit: cover; }
        .proof-img:hover { transform: scale(1.15); border-color: var(--primary); }

        .select-glass {
            background: rgba(15, 23, 42, 0.8); color: #fff; border: 1px solid rgba(255,255,255,0.1);
            padding: 8px; border-radius: 8px; outline: none; font-size: 0.75rem; cursor: pointer;
        }

        .btn-update {
            background: var(--primary); color: white; border: none; padding: 8px 15px;
            border-radius: 8px; font-size: 0.7rem; font-weight: 800; cursor: pointer; transition: 0.3s;
        }
        .btn-update:hover { background: var(--accent); box-shadow: 0 0 15px rgba(37, 99, 235, 0.4); }

        .act-edit { color: var(--accent); text-decoration: none; font-weight: 700; margin-right: 10px; }
        .act-delete { color: var(--danger); text-decoration: none; font-weight: 700; }

        @media (max-width: 768px) { .glass-card { padding: 20px; } header { flex-direction: column; gap: 20px; } }
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
                            <td><span style="color: #94a3b8; font-size: 0.8rem;">{{ $s->departure }}</span></td>
                            <td class="badge-price">Rp {{ number_format($s->price) }}</td>
                            <td><span class="badge-stock">{{ $s->stock }} Seats</span></td>
                            <td>
                                <a href="/admin/schedules/edit/{{ $s->id }}" class="act-edit">EDIT</a>
                                <a href="/admin/schedules/delete/{{ $s->id }}" class="act-delete" onclick="return confirm('Archive this schedule?')">DELETE</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h3>Global Transaction History</h3>
            
            <div class="controls-row">
                <div class="search-wrapper">
                    <input type="text" id="txnSearch" class="search-input" placeholder="Search customer, aircraft, or route..." onkeyup="filterTransactions()">
                </div>
                <div class="filter-group">
                    <div class="filter-chip active" onclick="setTxnFilter('all', this)">All</div>
                    <div class="filter-chip" onclick="setTxnFilter('pending', this)">Pending</div>
                    <div class="filter-chip" onclick="setTxnFilter('success', this)">Success</div>
                    <div class="filter-chip" onclick="setTxnFilter('failed', this)">Failed</div>
                    <div class="filter-chip" onclick="setTxnFilter('canceled', this)">Canceled</div>
                </div>
            </div>

            <div class="table-container">
                <table id="txnTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Aircraft / Route</th>
                            <th>Seats</th>
                            <th>Net Amount</th>
                            <th>Date & Time</th>
                            <th>Proof</th>
                            <th>Status</th>
                            <th>Update Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $b)
                        <tr class="txn-row" data-status="{{ strtolower($b->status) }}">
                            <td style="color: #64748b">#{{ $b->id }}</td>
                            <td><strong class="cust-name" style="color: #fff">{{ $b->user->name }}</strong></td>
                            <td>
                                <div class="aircraft-name">{{ $b->schedule->plane_name }}</div>
                                <div class="route-info" style="font-size: 0.7rem; color: #94a3b8">{{ $b->schedule->origin }} → {{ $b->schedule->destination }}</div>
                            </td>
                            <td>{{ $b->total_seats }}</td>
                            <td class="badge-price">Rp {{ number_format($b->total_price) }}</td>
                            <td style="font-size: 0.75rem; color: #94a3b8">{{ $b->created_at->format('d/m/Y | H:i') }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $b->payment_proof) }}" 
                                     class="proof-img" width="50" height="35" 
                                     onclick="window.open(this.src)" title="Click to view">
                            </td>
                            <td>
                                <span class="status-badge status-{{ strtolower($b->status) }}">
                                    {{ $b->status }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('admin.booking.updateStatus', $b->id) }}" method="POST" style="display:flex; gap:5px;">
                                    @csrf
                                    <select name="status" class="select-glass">
                                        <option value="pending" {{ $b->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="success" {{ $b->status == 'success' ? 'selected' : '' }}>Success</option>
                                        <option value="failed" {{ $b->status == 'failed' ? 'selected' : '' }}>Failed</option>
                                        <option value="canceled" {{ $b->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                    </select>
                                    <button type="submit" class="btn-update">SET</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        let currentFilter = 'all';

        function setTxnFilter(status, el) {
            // Update UI chip aktif
            document.querySelectorAll('.filter-chip').forEach(chip => chip.classList.remove('active'));
            el.classList.add('active');
            
            currentFilter = status;
            filterTransactions();
        }

        function filterTransactions() {
            const searchQuery = document.getElementById('txnSearch').value.toLowerCase();
            const rows = document.querySelectorAll('.txn-row');

            rows.forEach(row => {
                const customerName = row.querySelector('.cust-name').innerText.toLowerCase();
                const aircraft = row.querySelector('.aircraft-name').innerText.toLowerCase();
                const route = row.querySelector('.route-info').innerText.toLowerCase();
                const status = row.getAttribute('data-status');

                // Cek apakah data cocok dengan pencarian (Nama, Pesawat, atau Rute)
                const matchesSearch = customerName.includes(searchQuery) || 
                                      aircraft.includes(searchQuery) || 
                                      route.includes(searchQuery);
                
                // Cek apakah status cocok dengan filter
                const matchesFilter = (currentFilter === 'all' || status === currentFilter);

                if (matchesSearch && matchesFilter) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }
    </script>
</body>
</html>