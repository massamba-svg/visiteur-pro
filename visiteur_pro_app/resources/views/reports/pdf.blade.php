<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport d'Activité</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #135bec;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #135bec;
            margin: 0 0 10px 0;
            font-size: 24px;
        }
        .header p {
            color: #666;
            margin: 0;
        }
        .stats-grid {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        .stat-box {
            display: table-cell;
            width: 25%;
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
            background: #f9f9f9;
        }
        .stat-box .label {
            font-size: 10px;
            color: #666;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .stat-box .value {
            font-size: 24px;
            font-weight: bold;
            color: #135bec;
        }
        .section {
            margin-bottom: 30px;
        }
        .section h2 {
            color: #135bec;
            font-size: 16px;
            border-bottom: 2px solid #135bec;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table thead {
            background: #135bec;
            color: white;
        }
        table th {
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }
        table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        table tbody tr:nth-child(even) {
            background: #f9f9f9;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            color: #666;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Rapport d'Activité</h1>
        <p>Généré le {{ now()->format('d/m/Y à H:i') }}</p>
    </div>

    <!-- KPIs -->
    <div class="stats-grid">
        <div class="stat-box">
            <div class="label">Visites Totales</div>
            <div class="value">{{ number_format($totalVisits, 0, ',', ' ') }}</div>
        </div>
        <div class="stat-box">
            <div class="label">Clients Actifs</div>
            <div class="value">{{ $activeClients }}</div>
        </div>
        <div class="stat-box">
            <div class="label">Taux de Conversion</div>
            <div class="value">{{ $conversionRate }}%</div>
        </div>
        <div class="stat-box">
            <div class="label">Durée Moyenne</div>
            <div class="value">{{ $avgDuration }} min</div>
        </div>
    </div>

    <!-- Monthly Visits -->
    <div class="section">
        <h2>Tendance des Visites (6 derniers mois)</h2>
        <table>
            <thead>
                <tr>
                    <th>Mois</th>
                    <th>Nombre de visites</th>
                </tr>
            </thead>
            <tbody>
                @foreach($monthlyVisits as $month)
                    <tr>
                        <td>{{ $month['month'] }}</td>
                        <td><strong>{{ $month['count'] }}</strong></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Top Clients -->
    <div class="section">
        <h2>Top 5 Clients</h2>
        <table>
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Entreprise</th>
                    <th>Nombre de visites</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topClients as $client)
                    <tr>
                        <td>{{ $client->full_name }}</td>
                        <td>{{ $client->company ?? 'N/A' }}</td>
                        <td><strong>{{ $client->visits_count }}</strong></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Visits by Purpose -->
    <div class="section">
        <h2>Visites par Motif</h2>
        <table>
            <thead>
                <tr>
                    <th>Motif</th>
                    <th>Nombre de visites</th>
                </tr>
            </thead>
            <tbody>
                @foreach($visitsByPurpose as $visit)
                    <tr>
                        <td>{{ $visit->reason }}</td>
                        <td><strong>{{ $visit->count }}</strong></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>Visiteur Pro - Système de gestion des visites</p>
        <p>Document confidentiel - Tous droits réservés</p>
    </div>
</body>
</html>
