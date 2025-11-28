<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Employee extends Model
{
use HasFactory;


protected $fillable = [
'name',
'email',
'phone',
'position',
'position_id'
];

public function positionRelation()
{
    return $this->belongsTo(Position::class, 'position_id');
}
}
?>