<?php

declare(strict_types=1);

namespace Nogues\Salary;

use \DateTime;

/**
 * Salary class.
 */
final class Salary
{
    /**
     * Effective date.
     *
     * @var \DateTime
     */
    private $effectiveDate;

    /**
     * Money value.
     *
     * @var float
     */
    private $salary;

    public function __construct(DateTime $effectiveDate, float $salary)
    {
        $this->effectiveDate = $effectiveDate;
        $this->salary        = $salary;
    }

    /**
     * Get effective date.
     *
     * @return \DateTime
     */
    public function getEffectiveDate(): DateTime
    {
        return $this->effectiveDate;
    }

    /**
     * Get salary.
     *
     * @return float
     */
    public function getSalary(): float
    {
        return $this->salary;
    }
}
