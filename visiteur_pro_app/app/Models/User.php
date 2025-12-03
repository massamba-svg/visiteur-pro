<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relation : Un utilisateur a un rôle
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relation : Un utilisateur a plusieurs visites
     */
    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    // ==========================================
    // Méthodes de vérification des rôles
    // ==========================================

    /**
     * Vérifie si l'utilisateur a un rôle spécifique
     */
    public function hasRole(string $roleName): bool
    {
        return $this->role?->name === $roleName;
    }

    /**
     * Vérifie si l'utilisateur est Administrateur
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('Administrateur');
    }

    /**
     * Vérifie si l'utilisateur est Gestionnaire
     */
    public function isManager(): bool
    {
        return $this->hasRole('Gestionnaire');
    }

    /**
     * Vérifie si l'utilisateur est Réceptionniste
     */
    public function isReceptionist(): bool
    {
        return $this->hasRole('Réceptionniste');
    }

    // ==========================================
    // Méthodes de vérification des permissions
    // ==========================================

    /**
     * Peut gérer les rôles des utilisateurs (Admin uniquement)
     */
    public function canManageRoles(): bool
    {
        return $this->isAdmin();
    }

    /**
     * Peut voir les rapports (Admin et Gestionnaire)
     */
    public function canViewReports(): bool
    {
        return $this->isAdmin() || $this->isManager();
    }

    /**
     * Peut créer/modifier des clients (Admin et Gestionnaire)
     */
    public function canManageClients(): bool
    {
        return $this->isAdmin() || $this->isManager();
    }

    /**
     * Peut supprimer des clients (Admin uniquement)
     */
    public function canDeleteClients(): bool
    {
        return $this->isAdmin();
    }

    /**
     * Peut modifier/supprimer des visites (Admin et Gestionnaire)
     */
    public function canEditVisits(): bool
    {
        return $this->isAdmin() || $this->isManager();
    }

    /**
     * Peut ajouter des visites (tous les rôles)
     */
    public function canCreateVisits(): bool
    {
        return true;
    }

    /**
     * Peut terminer des visites (tous les rôles)
     */
    public function canEndVisits(): bool
    {
        return true;
    }

    /**
     * Peut consulter les clients (tous les rôles)
     */
    public function canViewClients(): bool
    {
        return true;
    }

    /**
     * Peut voir l'historique complet (tous les rôles, mais lecture seule pour Réceptionniste)
     */
    public function canViewHistory(): bool
    {
        return true;
    }
}
