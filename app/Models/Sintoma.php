<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sintoma extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];
    protected $with = ['vacina'];

    public function paciente() {
        return $this->belongsTo(Usuario::class, 'paciente_id', 'id');
    } 

    public function vacina() {
        return $this->belongsTo(Vacina::class);
    } 
}
