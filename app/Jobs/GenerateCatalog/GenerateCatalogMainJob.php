<?php

namespace App\Jobs\GenerateCatalog;


class GenerateCatalogMainJob extends AbstractJob
{

    /**
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \Throwable
     */
    public function handle()
    {
        $this->debug('start');

        // Спочатку кешуємо продукти
        GenerateCatalogCacheJob::dispatchSync();

        // Створюємо ланцюг завдань формування файлів з цінами
        $chainPrices = $this->getChainPrices();

        // Основні підзавдання
        $chainMain = [
            new GenerateCategoriesJob, // Генерація категорій
            new GenerateDeliveriesJob, // Генерація способів доставок
            new GeneratePointsJob, // Генерація пунктів видачі
        ];

        // Підзавдання, які мають виконуваться останніми
        $chainLast = [
            // Архівування файлів і перенесення архіву в публічний каталог
            new ArchiveUploadsJob,
            // Відправка повідомлення зовнішньому сервісу про те, що можна завантажувати новий файл каталога товарів
            new SendPriceRequestJob,
        ];

        $chain = array_merge($chainPrices, $chainMain, $chainLast);

        GenerateGoodsFileJob::withChain($chain)->dispatch();  //створюємо файл з товарами
        //GenerateGoodsFileJob::dispatch()->chain($chain);

        $this->debug('finish');
    }


    /**
     * Формування ланцюгів підзавдань по генерації файлів з цінами
     *
     * @return array
     */
    private function getChainPrices()
    {
        $result = [];
        $products = collect([1, 2, 3, 4, 5]);
        $fileNum = 1;

        foreach ($products->chunk(1) as $chunk) {
            $result[] = new GeneratePricesFileChunkJob($chunk, $fileNum);
            $fileNum++;
        }

        return $result;
    }
}
