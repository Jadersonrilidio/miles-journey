<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class DestinyBuilder extends Builder
{
    /**
     * 
     */
    public function whereLocation(string|null $location): self
    {
        return $this->orderBy('created_at')
            ->when($location, function ($query, string $location) {
                $query->where('name', 'like', "%$location%");
            });
    }
}
