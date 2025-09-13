<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Tender;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name','email','password','role','company_name'
    ];

    protected $hidden = [
        'password','remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // relationships
    public function tendersCreated() {
        return $this->hasMany(Tender::class, 'created_by');
    }

    public function applications() {
        return $this->hasMany(Application::class);
    }

    // role helpers
    public function isAdmin() { return $this->role === 'admin'; }
    public function isParty() { return $this->role === 'party'; }
    public function isUser() { return $this->role === 'user'; }
}
