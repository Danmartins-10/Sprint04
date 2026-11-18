<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pergunta extends Model
{
    use HasFactory;

    protected $table = 'perguntas';

    protected $fillable = [
        'evento_id',
        'texto_pergunta',
        'autor',
    ];

    public function evento(): BelongsTo
    {
        return $this->belongsTo(Evento::class);
    }
}
