<?php

namespace App\Processors;

use Illuminate\Support\Facades\Log;
use RoachPHP\ItemPipeline\ItemInterface;
use RoachPHP\ItemPipeline\Processors\ItemProcessorInterface;
use Throwable;

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
        $name = $item['name'];
        $directory = "storage/app/public/$name/$chapter/";

        foreach ($item['links'] as $key => $link) {
            is_dir($directory) || mkdir($directory, 0777, true);
            $extension = pathinfo($link)['extension'];

            try {
                copy($link, "$directory/$key.$extension");
            } catch (Throwable $throwable) {
                Log::info(
                    "Error while downloading $chapter on $name",
                    [
                        'type' => $throwable::class,
                        'message' => $throwable->getMessage(),
                    ]
                );
            }
        }

        return $item;
    }
}
