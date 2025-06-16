<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DiggingDeeperController extends Controller
{
    /**
     * Базова інформація
     * @url https://laravel.com/docs/11.x/collections#introduction
     *
     * Довідкова інформація
     * @url https://laravel.com/api/11.x/Illuminate/Support/Collection.html
     *
     * Варіант колекції для моделі eloquent
     * @url https://laravel.com/api/11.x/Illuminate/Database/Eloquent/Collection.html
     *
     */

    public function collections()
    {
        $result = [];

        /**
         * @var \Illuminate\Database\Eloquent\Collection $eloquentCollection
         */
        $eloquentCollection = BlogPost::withTrashed()->get();

        dd(__METHOD__, $eloquentCollection, $eloquentCollection->toArray());

        /**
         * @var \Illuminate\Support\Collection $collection
         */
        $collection = collect($eloquentCollection->toArray());

        /* dd(
             get_class($eloquentCollection),
             get_class($collection),
             $collection
         );*/


        $result['first'] = $collection->first();
        $result['last'] = $collection->last();

        $result['where']['data'] = $collection
            ->where('category_id', 10)
            ->values()
            ->keyBy('id');

        $result['where']['count'] = $result['where']['data']->count();
        $result['where']['isEmpty'] = $result['where']['data']->isEmpty();
        $result['where']['isNotEmpty'] = $result['where']['data']->isNotEmpty();


        if ($result['where']['data']->isNotEmpty()) {
            //
        }

        $result['where_first'] = $collection
            ->firstWhere('created_at', '>', '2020-02-24 03:46:16');

        $result['map']['all'] = $collection->map(function ($item) {
            $newItem = new \stdClass();
            $newItem->item_id = $item['id'];
            $newItem->item_name = $item['title'];
            $newItem->exists = is_null($item['deleted_at']);

            return $newItem;
        });

        $result['map']['not_exists'] = $result['map']['all']->where('exists', '=', false)->values()->keyBy('item_id');

        //dd ($result);

        $collection->transform(function ($item) {
            $newItem = new \stdClass();
            $newItem->item_id = $item->item_id ?? $item['id'];
            $newItem->item_name = $item->item_name ?? $item['title'];
            $newItem->exists = $item->exists ?? (isset($item['deleted_at']) ? is_null($item['deleted_at']) : true);
            $newItem->created_at = (isset($item->created_at) && $item->created_at instanceof Carbon)
                ? $item->created_at
                : (isset($item['created_at']) ? Carbon::parse($item['created_at']) : null);

            return $newItem;
        });

        //dd ($collection);

        $newItem = new \stdClass;
        $newItem->id = 9999;
        $newItem->created_at = Carbon::now();
        $newItem->item_name = 'Новий елемент 1';
        $newItem->exists = true;

        $newItem2 = new \stdClass;
        $newItem2->id = 8888;
        $newItem2->created_at = Carbon::parse('2025-02-11 10:00:00');
        $newItem2->item_name = 'Новий елемент 2';
        $newItem2->exists = true;

        $collection->prepend($newItem);
        $collection->push($newItem2);
        $pulledItem = $collection->pull(1);

        //dd(compact('collection', 'newItemFirst' , 'newItemLast', 'pulledItem'));

        $filtered = $collection->filter(function ($item) {
            if (!isset($item->created_at)) {
                return false; // Пропускаємо елементи без created_at
            }

            $createdAt = $item->created_at instanceof Carbon ? $item->created_at : Carbon::parse($item->created_at);

            $byDay = $createdAt->isFriday();
            $byDate = $createdAt->day == 11;

            $result = $byDay && $byDate;

            return $result;
        });

        //dd(compact('filtered'));

        $sortedSimpleCollection = collect([5, 3, 1, 2, 4])->sort()->values();
        $sortedAscCollection = $collection->sortBy('created_at');
        $sortedDescCollection = $collection->sortByDesc('item_id');

        //dd(compact('sortedSimpleCollection', 'sortedAscCollection', 'sortedDescCollection'));

        return view('welcome');
    }
}
