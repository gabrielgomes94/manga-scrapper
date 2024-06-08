<?php

namespace App\Spiders;

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
        //
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

        foreach ($links as $link) {
            $chapterLinks[] = $link->getUri();

            yield $this->request(
                'GET',
                $link->getUri(),
                'parseChapter'
            );
        }

        yield $this->item($chapterLinks ?? []);

//        yield
    }

    public function parseChapter(Response $response): Generator
    {
//        dd($response->html());
        $images = $response->filter('.js-pages-container img')->images();
        dd($images[10]->getUri());

        yield $this->item([]);
    }
}
