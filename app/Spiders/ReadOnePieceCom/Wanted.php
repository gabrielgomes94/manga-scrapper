<?php

namespace App\Spiders\ReadOnePieceCom;

class Wanted extends BaseReadOnePieceCom
{
    public array $startUrls = [
        'https://ww10.readonepiece.com/manga/wanted-one-piece/'
    ];

    protected string $name = 'wanted';
}
