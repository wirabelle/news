<?php

namespace App\Command;

use App\Importer\NewsImporter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportNewsCommand extends Command
{
    protected static $defaultName = 'app:import-news';

    protected $newsImporter;

    public function __construct(NewsImporter $newsImporter)
    {
        $this->newsImporter = $newsImporter;

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->newsImporter->import();

        return Command::SUCCESS;
    }
}
