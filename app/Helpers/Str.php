<?php

declare(strict_types=1);

namespace App\Helpers;

use Cocur\Slugify\Slugify;

class Str
{
    /**
     * @param string $title
     * @param array|string|null $options
     *
     * @return string
     */
    public static function slug(string $title, array|string|null $options = null): string
    {
        /**
         * @var Slugify $slugify
         */
        $slugify = app(Slugify::class);
        return $slugify->slugify($title, $options);
    }
}
