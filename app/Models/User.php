<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * Les attributs modifiables en masse.
     * Permet de définir les champs qui peuvent être assignés lors de la création ou mise à jour d'un utilisateur.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Ajout du champ "role"
    ];

    /**
     * Les attributs à masquer dans les réponses JSON.
     * On cache le mot de passe et le token de connexion pour des raisons de sécurité.
     *
     * @var array<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les attributs qui doivent être castés (convertis automatiquement) avant d’être utilisés.
     * Cela permet de s'assurer que certains champs sont bien formatés.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Convertit la date de vérification en format DateTime
            'password' => 'hashed', // Stocke le mot de passe sous forme de hash sécurisé
        ];
    }

    /**
     * Définir les valeurs par défaut des attributs.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'role' => 'acheteur', // Par défaut, un nouvel utilisateur est un acheteur
    ];

    /**
     * Vérifie si l'utilisateur a le rôle "vendeur".
     *
     * @return bool
     */
    public function isVendeur(): bool
    {
        return $this->role === 'vendeur';
    }
}

