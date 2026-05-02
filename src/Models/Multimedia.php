<?php

declare(strict_types=1);

namespace Misaf\VendraMultimedia\Models;

use Misaf\VendraTenant\Traits\BelongsToTenant;
use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMediaLibrary;

/**
 * Misaf\VendraMultimedia\Models\Multimedia.
 *
 * @property int $tenant_id
 */
final class Multimedia extends SpatieMediaLibrary
{
    use BelongsToTenant;

    protected $hidden = [
        'tenant_id',
    ];

    protected function casts(): array
    {
        return [
            'tenant_id' => 'integer',
            ...parent::casts(),
        ];
    }
}
