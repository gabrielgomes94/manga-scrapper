<?php

namespace App\Spiders\Processors;

use RoachPHP\ItemPipeline\ItemInterface;
use RoachPHP\ItemPipeline\Processors\ItemProcessorInterface;

class DownloadImages implements ItemProcessorInterface
{

    /**
     * @inheritDoc
     */
    public function configure(array $options): void
    {
        // TODO: Implement configure() method.
    }

    public function processItem(ItemInterface $item): ItemInterface
    {
        $chapter = 'cap_' . $item['chapter'];
        $directory = "storage/app/public/$chapter/";

        echo "Baixando $chapter...\n";

        foreach ($item['links'] as $key => $link) {
            if (!is_dir($directory)) {
                mkdir($directory);
            }

            $extension = pathinfo($link)['extension'];

            copy($link, "storage/app/public/$chapter/$key.$extension");
        }

        return $item;
    }
}
