<?php

namespace App\Spiders\ReadOnePieceCom;

class Monsters extends BaseReadOnePieceCom
{
    public array $startUrls = [
        'https://ww10.readonepiece.com/manga/monsters/'
    ];

    protected string $name = 'monsters';
}
