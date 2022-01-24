<?php

namespace App\Importer;

use Psr\Log\LoggerAwareInterface;

interface NewsImporterInterface extends LoggerAwareInterface
{
    /**
     * Get importer data.
     */
    public function getData(): ?array;
}
