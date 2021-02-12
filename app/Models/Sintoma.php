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

    public function getSintomaAttribute(){
    
        switch($this->attributes['tipo_id']) {
            case 1: return 'Dor de cabeça';
            case 2: return 'Enjoo';
            case 3: return 'Sintoma 3';
            default: $this->attributes['outro'];
        }
    }
}
