<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $table = 'produtos';
    protected $fillable = ['nome', 'id_marca', 'tensao', 'descricao'];
    protected $hidden = ['created_at', 'updated_at'];

    public function marca()
    {
        return $this->hasOne(Marca::class, 'id', 'id_marca');
    }
}
