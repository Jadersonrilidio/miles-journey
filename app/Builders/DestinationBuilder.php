<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class DestinationBuilder extends Builder
{
    /**
     * 
     */
    public function whenLocation(string|null $location): self
    {
        return $this->orderBy('created_at')
            ->when($location, function ($query, string $location) {
                $query->where('name', 'like', "%$location%");
            });
    }
}
