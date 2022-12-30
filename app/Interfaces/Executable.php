<?php
declare(strict_types=1);

namespace App\Interfaces;

/**
 *
 */
interface Executable
{
    /**
     * @return bool
     */
    public function execute(): bool;
}
