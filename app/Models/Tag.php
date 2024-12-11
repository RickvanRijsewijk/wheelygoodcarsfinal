<?php
// In Tag.php model
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function cars()
    {
        return $this->belongsToMany(Car::class, 'car_tag', 'tag_id', 'car_id');
    }
}
