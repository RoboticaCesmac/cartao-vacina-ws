<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacina extends Model {
    use HasFactory;

    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

    public function paciente() {
        return $this->belongsTo(Usuario::class, 'paciente_id', 'id');
    } 

    public function getVacinaAttribute() {
        switch($this->attributes['tipo']) {
            case 1: return 'Astrazeneca(Fiocruz)';
            case 2: return 'Coronavac(Butantan)';
            case 3: return 'Peizer';
            case 4: return 'Moderna';
            default: return $this->attributes['outro'];
        }
    }

}
