<?php

namespace App\Models;

use App\Builders\DestinationBuilder;
use App\Casts\PriceCast;
use App\Models\Traits\CreateWithUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory, CreateWithUuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'destinations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'photo_1',
        'photo_2',
        'price',
        'meta',
        'description',
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
        'photo_1' => 'string',
        'photo_2' => 'string',
        'price' => PriceCast::class,
        'meta' => 'string',
        'description' => 'string',
    ];

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     *
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function newEloquentBuilder($query): DestinationBuilder
    {
        return new DestinationBuilder($query);
    }
}
