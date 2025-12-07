<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des Visites</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px solid #135bec;
            padding-bottom: 15px;
        }
        .header h1 {
            color: #135bec;
            margin: 0 0 10px 0;
            font-size: 22px;
        }
        .header p {
            color: #666;
            margin: 0;
            font-size: 10px;
        }
        .summary {
            background: #f9f9f9;
            padding: 15px;
            margin-bottom: 20px;
            border-left: 4px solid #135bec;
        }
        .summary p {
            margin: 5px 0;
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
            padding: 8px;
            text-align: left;
            font-weight: bold;
            font-size: 10px;
        }
        table td {
            padding: 7px 8px;
            border-bottom: 1px solid #ddd;
            font-size: 10px;
        }
        table tbody tr:nth-child(even) {
            background: #f9f9f9;
        }
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #ddd;
            text-align: center;
            color: #666;
            font-size: 9px;
        }
        .status-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: bold;
        }
        .status-completed {
            background: #d4edda;
            color: #155724;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Historique des Visites</h1>
        <p>Généré le {{ now()->format('d/m/Y à H:i') }}</p>
    </div>

    <div class="summary">
        <p><strong>Nombre total de visites :</strong> {{ $visits->count() }}</p>
        <p><strong>Période couverte :</strong> 
            @if($visits->count() > 0)
                {{ $visits->last()->arrival_time->format('d/m/Y') }} - {{ $visits->first()->arrival_time->format('d/m/Y') }}
            @else
                N/A
            @endif
        </p>
    </div>

    @if($visits->count() > 0)
        <table>
            <thead>
                <tr>
                    <th style="width: 12%;">Date</th>
                    <th style="width: 18%;">Visiteur</th>
                    <th style="width: 18%;">Client</th>
                    <th style="width: 16%;">Personne rencontrée</th>
                    <th style="width: 12%;">Motif</th>
                    <th style="width: 8%;">Arrivée</th>
                    <th style="width: 8%;">Départ</th>
                    <th style="width: 8%;">Durée</th>
                </tr>
            </thead>
            <tbody>
                @foreach($visits as $index => $visit)
                    <tr>
                        <td>{{ $visit->arrival_time->format('d/m/Y') }}</td>
                        <td>{{ $visit->visitor_name }}</td>
                        <td>{{ $visit->client ? $visit->client->full_name : 'N/A' }}</td>
                        <td>{{ $visit->person_met }}</td>
                        <td>{{ $visit->reason }}</td>
                        <td>{{ $visit->arrival_time->format('H:i') }}</td>
                        <td>{{ $visit->departure_time ? $visit->departure_time->format('H:i') : '-' }}</td>
                        <td>
                            @if($visit->departure_time)
                                @php
                                    $duration = $visit->arrival_time->diffInMinutes($visit->departure_time);
                                    $hours = floor($duration / 60);
                                    $minutes = $duration % 60;
                                @endphp
                                @if($hours > 0)
                                    {{ $hours }}h {{ $minutes }}min
                                @else
                                    {{ $minutes }}min
                                @endif
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    
                    {{-- Page break every 30 rows --}}
                    @if(($index + 1) % 30 == 0 && $index + 1 < $visits->count())
                        </tbody>
                        </table>
                        <div class="page-break"></div>
                        <div class="header">
                            <h1>Historique des Visites (suite)</h1>
                            <p>Page {{ floor(($index + 1) / 30) + 1 }}</p>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 12%;">Date</th>
                                    <th style="width: 18%;">Visiteur</th>
                                    <th style="width: 18%;">Client</th>
                                    <th style="width: 16%;">Personne rencontrée</th>
                                    <th style="width: 12%;">Motif</th>
                                    <th style="width: 8%;">Arrivée</th>
                                    <th style="width: 8%;">Départ</th>
                                    <th style="width: 8%;">Durée</th>
                                </tr>
                            </thead>
                            <tbody>
                    @endif
                @endforeach
            </tbody>
        </table>
    @else
        <p style="text-align: center; padding: 40px; color: #999;">Aucune visite dans l'historique.</p>
    @endif

    <div class="footer">
        <p>Visiteur Pro - Système de gestion des visites</p>
        <p>Document confidentiel - Tous droits réservés</p>
    </div>
</body>
</html>
