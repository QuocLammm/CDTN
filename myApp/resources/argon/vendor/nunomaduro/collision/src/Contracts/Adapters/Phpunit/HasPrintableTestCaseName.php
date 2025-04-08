<?php

declare(strict_types=1);

namespace NunoMaduro\Collision\Contracts\Adapters\Phpunit;

/**
 * @internal
 */
interface HasPrintableTestCaseName
{
    /**
     * Returns the pay case name that should be used by the printer.
     */
    public function getPrintableTestCaseName(): string;
}
