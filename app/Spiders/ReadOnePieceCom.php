<?php

namespace App\Spiders;

use App\Processors\DownloadImages;
use Generator;
use RoachPHP\Downloader\Middleware\RequestDeduplicationMiddleware;
use RoachPHP\Extensions\LoggerExtension;
use RoachPHP\Extensions\StatsCollectorExtension;
use RoachPHP\Http\Response;
use RoachPHP\Spider\BasicSpider;
use RoachPHP\Spider\ParseResult;

class ReadOnePieceCom extends BasicSpider
{
    public array $startUrls = [
        'https://ww10.readonepiece.com/manga/one-piece-digital-colored-comics/'
    ];

    public array $downloaderMiddleware = [
        RequestDeduplicationMiddleware::class,
    ];

    public array $spiderMiddleware = [
        //
    ];

    public array $itemProcessors = [
        DownloadImages::class
    ];

    public array $extensions = [
        LoggerExtension::class,
        StatsCollectorExtension::class,
    ];

    public int $concurrency = 2;

    public int $requestDelay = 2;

    /**
     * @return Generator<ParseResult>
     */
    public function parse(Response $response): Generator
    {
        $links = $response->filter('body a.mt-3')->links();

        yield $this->request(
            'GET',
            $links[0]->getUri(),
            'parseChapter'
        );

        foreach ($links as $link) {
            yield $this->request(
                'GET',
                $link->getUri(),
                'parseChapter'
            );
        }
    }

    public function parseChapter(Response $response): Generator
    {
        $images = $response->filter('.js-pages-container img')->images();
        $chapter = $response->filter('body #top > h1')->text();
        $chapterNumber = $this->parseChapterNumber($chapter);

        foreach ($images as $image) {
            $links[] = $image->getUri();
        }

        yield $this->item([
            'links' => $links ?? [],
            'chapter' => $chapterNumber,
        ]);
    }

    private function parseChapterNumber(string $chapter): int
    {
        $matches = '';
        preg_match('/\d+/', $chapter, $matches);

        return $matches[0] ?? '';
    }
}
