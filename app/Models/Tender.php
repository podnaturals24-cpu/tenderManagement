<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tender extends Model {
    use HasFactory;

    protected $fillable = [
        'title','description','created_by','status','party_id','closing_date'
    ];

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function party() {
        return $this->belongsTo(User::class, 'party_id');
    }

    public function applications() {
        return $this->hasMany(Application::class);
    }
}
