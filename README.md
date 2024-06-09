## Mangá Scrapper

A tool to scrap mangá's chapters from several websites online. 

Built with Roach PHP on top of Laravel.

Supports:
- [readonepiece.com](https://ww10.readonepiece.com)

## Installation and usage

Requires PHP 8.3 and Composer

- Install dependencies: `composer install`
- Run scrapper: `php artisan roach:run <spider>`
- It will download and save into `/storage/app/public/`

If you have Docker and Docker Compose in your environment, then you can also run it inside Sail's container:
```bash
vendor/bin/sail up -d
vendor/bin/sail php artisan roach:run <spider>
```

### Spider's options

#### ReadOnePiece.Com

| Mangá                                                                                                                 | Command                                                                 |
|-----------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------------|
| [One Piece](https://ww10.readonepiece.com/manga/one-piece/)                                                           | `php artisan roach:run App\\Spiders\\ReadOnePieceCom\\OnePieceOriginal` |
| [One Piece Colored](https://ww10.readonepiece.com/manga/one-piece-digital-colored-comics/)                            | `php artisan roach:run App\\Spiders\\ReadOnePieceCom\\OnePieceColored`  |
| [Wanted!](https://ww10.readonepiece.com/manga/wanted-one-piece/https://ww10.readonepiece.com/manga/wanted-one-piece/) | `php artisan roach:run App\\Spiders\\ReadOnePieceCom\\Wanted`           |
| [Monsters](https://ww10.readonepiece.com/manga/monsters/)                                                             | `php artisan roach:run App\\Spiders\\ReadOnePieceCom\\Monsters`         |
