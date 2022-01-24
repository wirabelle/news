<?php

namespace App\Importer;

use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RSSImporter implements NewsImporterInterface
{
    /**
     * @var array
     */
    protected $options;
    /**
     * @var Client
     */
    protected $client;
    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(array $options)
    {
        $this->options = $this->resolveOptions($options);
        $this->client = new Client([
            'base_uri' => $options['url'],
        ]);
    }

    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    /**
     * {@inheritDoc}
     */
    public function getData(): ?array
    {
        // Http get
        $response = $this->client->get($this->options['path']);

        // Check response
        if (200 !== $response->getStatusCode()) {
            $this->logger->error("Unable to get RSS data from {$this->options['url']}{$this->options['path']}");

            return null;
        }

        // Process xml content
        $content = $response->getBody()->getContents();

        try {
            libxml_use_internal_errors(true);
            $rss = new \SimpleXMLElement($content);
        } catch (\Exception $e) {
            $this->logger->error("Fail to process xml content '{$content}'");

            throw $e;
        }

        // Build data
        $data = [];
        foreach ($rss->channel->item as $item) {
            $mediaAttr = $item->children('media', true)->content->attributes();

            $data[] = [
                'title' => (string) $item->title,
                'description' => (string) $item->description,
                'publishedAt' => new \DateTime($item->pubDate),
                'image' => (string) $mediaAttr['url'],
            ];
        }

        return $data;
    }

    /**
     * Resoslve Importer options.
     */
    protected function resolveOptions(array $options): array
    {
        return (new OptionsResolver())
            ->setRequired(['url', 'path'])
            ->setAllowedTypes('url', 'string')
            ->setAllowedTypes('path', 'string')
            ->resolve($options);
    }
}
