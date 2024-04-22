<?php

namespace App\Models;

use App\Casts\PriceCast;
use App\Models\Traits\CreateWithUuid;
use App\ValueObjects\Price;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destiny extends Model
{
    use HasFactory, CreateWithUuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'destinies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'photo',
        'price',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $hidden = [
        'id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'photo' => 'string',
        'price' => PriceCast::class,
    ];
}
