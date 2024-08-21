<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NamecheapProfile extends Model
{
    use HasFactory;

    protected $hidden = [
        'api_key',
    ];

    protected $fillable = [
        'user_id',
        'surname',
        'firstname',
        'api_key',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
