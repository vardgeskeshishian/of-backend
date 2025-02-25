<?php

namespace App\Services;

use DOMDocument;
use Exception;
use Illuminate\Support\Arr;

readonly class HTMLContentExtractor
{
    public DOMDocument $dom;

    public function __construct()
    {
        $this->dom = new DOMDocument();
    }

    /**
     * @throws Exception
     */
    private function loadHTML($content): void
    {
        $content = mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8');

        $content = '<?xml encoding="UTF-8">' . $content;

        if (@$this->dom->loadHTML($content) === false) {
            throw new Exception('Failed to load HTML content');
        }
    }

    /**
     * @throws Exception
     */
    public function extractTagContent(string|null $content, string $tag): array
    {
        $response = [];

        if (empty($content)) {
            return $response;
        }

        $this->loadHTML($content);

        $tags = $this->dom->getElementsByTagName($tag);

        foreach ($tags as $tag) {
            $response[] = trim($tag->textContent);
        }

        return $response;
    }


    /**
     * @throws Exception
     */
    public function extractTagContents(array $contents, string $tag): array
    {
        $response = [];

        if (empty($contents)) {
            return $response;
        }

        foreach ($contents as $content) {
            $response[] = $this->extractTagContent($content, $tag);
        }

        return Arr::collapse($response);
    }
}
