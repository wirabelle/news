<?php

namespace App\Importer;

use App\Entity\News;
use App\Factory\NewsImporterFactory;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsImporter implements LoggerAwareInterface
{
    /**
     * @var NewsImporterFactory
     */
    protected $newsImporterFactory;
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;
    /**
     * @var array
     */
    protected $feeds;
    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(NewsImporterFactory $newsImporterFactory, EntityManagerInterface $entityManager, $feeds)
    {
        $this->newsImporterFactory = $newsImporterFactory;
        $this->entityManager = $entityManager;
        $this->feeds = $feeds;
    }

    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    /**
     * Import news from config.
     */
    public function import(?string $feedName): void
    {
        foreach ($this->feeds as $feed => $feedConfig) {
            $this->resolveOptions($feedConfig);

            // Check specific feed
            if (
                null !== $feedName
                && $feed !== $feedName
            ) {
                continue;
            }

            // Create importer
            $importer = $this->newsImporterFactory->create($feedConfig['type'], $feedConfig['options']);

            // Skip if not exists
            if (!$importer instanceof NewsImporterInterface) {
                $this->logger->error("Unable to create new importer of type '{$feedConfig['type']}'");
                continue;
            }

            $importer->setLogger($this->logger);

            // Get importer data
            $data = $importer->getData();

            // Create entities
            foreach ($data as $datum) {
                $news = (new News())
                    ->setTitle($datum['title'])
                    ->setDescription($datum['description'])
                    ->setImage($datum['image'])
                    ->setPublishedAt($datum['publishedAt'])
                ;

                $this->entityManager->persist($news);
            }
        }

        $this->entityManager->flush();
    }

    /**
     * Resoslve Importer options.
     */
    protected function resolveOptions(array $options): array
    {
        return (new OptionsResolver())
            ->setRequired(['type', 'options'])
            ->setAllowedTypes('type', 'string')
            ->setAllowedTypes('options', 'array')
            ->resolve($options);
    }
}
