<?php

declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Nameserver extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'domain_name',
        'nameserver',
        'ip',
    ];

    public function user(): Relation
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
