<?php

namespace App\Spiders\ReadOnePieceCom;

class OnePieceOriginal extends BaseReadOnePieceCom
{
    public array $startUrls = [
        'https://ww10.readonepiece.com/manga/one-piece/'
    ];

    protected string $name = 'one_piece';
}
