<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Category;
use App\Item;

class DummyDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:dummy-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->categories();
        $this->items();
    }

    private function categories()
    {
        $categories = [
            "文房具",
            "キッチン",
            "スマホ",
            "化粧品",
            "ドリンク"
        ];

        foreach ($categories as $category) {
            $row = new Category();
            $row["name"] = $category;
            $row->save();
        }
    }

    private function items()
    {
        $item = new Item();
        $item["name"] = "商品A";
        $item["filename"] = "4xmy6P8Q6H0zUDgT1lZgEiRUrtwELnAujjalFBHN.png";
        $item["cost"] = 1000;
        $item["stock"] = 1000;
        $item["category_id"] = 1;
        $item->save();

        $item = new Item();
        $item["name"] = "商品B";
        $item["filename"] = "GkoKvyfsXdRFw7RbAzjsLw4j4WO0QGOJy1Wsl9G8.jpeg";
        $item["cost"] = 2000;
        $item["stock"] = 2000;
        $item["category_id"] = 2;
        $item->save();

        $item = new Item();
        $item["name"] = "商品C";
        $item["filename"] = "NTezY4k6d9P0yGbbfj2e0mDT3TsAiV34m4g57VNG.png";
        $item["cost"] = 3000;
        $item["stock"] = 3000;
        $item["category_id"] = 3;
        $item->save();
    }
}
