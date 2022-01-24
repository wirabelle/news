<?php

namespace App\Factory;

use App\Importer\NewsImporterInterface;
use App\Importer\RSSImporter;

class NewsImporterFactory
{
    /**
     * Create importer from type and options.
     */
    public function create(string $type, array $options): ?NewsImporterInterface
    {
        switch ($type) {
            case 'rss':
                // TODO Option resolver
                return new RSSImporter($options);
        }

        return null;
    }
}
