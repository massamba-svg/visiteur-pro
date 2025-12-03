<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    /**
     * Display the help center page.
     */
    public function index()
    {
        $faqSections = [
            [
                'icon' => 'calendar_month',
                'icon_color' => 'blue',
                'title' => 'Gestion des Visites',
                'description' => 'Comment ajouter, modifier et gérer les visites',
                'questions' => [
                    [
                        'question' => 'Comment ajouter une nouvelle visite ?',
                        'answer' => 'Cliquez sur le bouton « Ajouter une visite » dans le tableau de bord ou allez dans la section Visites. Remplissez le formulaire avec les informations requises (nom du visiteur, entreprise, personne rencontrée, motif de la visite et heure d\'arrivée).',
                    ],
                    [
                        'question' => 'Comment enregistrer le départ d\'un visiteur ?',
                        'answer' => 'Allez dans l\'historique des visites récentes, trouvez le visiteur dont l\'heure de départ n\'est pas enregistrée, et cliquez sur le bouton « Enregistrer le Départ ».',
                    ],
                    [
                        'question' => 'Puis-je modifier une visite enregistrée ?',
                        'answer' => 'Oui, vous pouvez accéder à l\'historique, sélectionner une visite, et utiliser le bouton d\'édition pour la modifier. Cependant, les visites terminées ne peuvent être supprimées.',
                    ],
                ],
            ],
            [
                'icon' => 'groups',
                'icon_color' => 'green',
                'title' => 'Gestion des Clients',
                'description' => 'Ajouter, consulter et gérer les clients',
                'questions' => [
                    [
                        'question' => 'Ajouter un nouveau client',
                        'answer' => 'Accédez à la section Clients, cliquez sur « Ajouter un Client », puis remplissez les informations essentielles : nom, entreprise, email et téléphone.',
                    ],
                    [
                        'question' => 'Consulter l\'historique d\'un client',
                        'answer' => 'Sélectionnez un client dans la liste pour voir ses détails complets et l\'historique de toutes ses visites avec les dates et les motifs.',
                    ],
                    [
                        'question' => 'Comment filtrer les clients ?',
                        'answer' => 'Utilisez la barre de recherche en haut de la section Clients pour filtrer par nom, entreprise ou email. Des options de tri sont également disponibles.',
                    ],
                ],
            ],
            [
                'icon' => 'bar_chart',
                'icon_color' => 'red',
                'title' => 'Gestion des Rapports',
                'description' => 'Créer, consulter et exporter des rapports',
                'questions' => [
                    [
                        'question' => 'Comment créer un nouveau rapport ?',
                        'answer' => 'Allez dans la section Rapports, cliquez sur « Créer un Rapport », choisissez le type de rapport souhaité, puis suivez les étapes de configuration.',
                    ],
                    [
                        'question' => 'Puis-je personnaliser les rapports ?',
                        'answer' => 'Oui, vous pouvez sélectionner les données à inclure, choisir le format de présentation, et appliquer des filtres pour affiner les informations affichées.',
                    ],
                    [
                        'question' => 'Comment exporter un rapport ?',
                        'answer' => 'Après avoir généré un rapport, cliquez sur le bouton « Exporter » et choisissez le format souhaité (PDF, Excel, etc.).',
                    ],
                ],
            ],
        ];

        return view('help.index', compact('faqSections'));
    }

    /**
     * Search help articles.
     */
    public function search(Request $request)
    {
        $query = $request->input('q');
        
        // For now, redirect back to help index
        // Could implement full-text search later
        return redirect()->route('help.index');
    }
}
