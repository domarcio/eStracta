<?php

declare(strict_types=1);

namespace Nogues\Salary;

use \ArrayIterator;

/**
 * Contract to parse a HTML content.
 */
interface Parse
{
    /**
     * Get collection with parsed data.
     *
     * @return ArrayIterator
     */
    public function collection(): ArrayIterator;
}
