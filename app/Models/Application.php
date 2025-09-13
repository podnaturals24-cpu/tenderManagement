<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model {
    use HasFactory;

    protected $fillable = [
        'tender_id','user_id','status','message'
    ];

    public function tender() {
        return $this->belongsTo(Tender::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
