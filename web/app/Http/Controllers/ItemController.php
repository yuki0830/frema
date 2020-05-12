<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Google\Cloud\Storage\StorageClient;

class ItemController extends Controller
{
    public function __construct()
    {
        // 認証が必要
        // $this->middleware('auth')->except(['index', 'download', 'show']);
    }

    /**
     * 写真一覧
     */
    public function index()
    {
        $items = Item::with(['category'])
            ->orderBy('id', 'asc')->paginate();

        // $dir = "/foo/bar";
        // $file_name = "test.log";
        // $options = [
        //     'name' => $dir.$file_name
        //     ];
        // $client = new StorageClient();
        // $bucket = $client->bucket('fremanager-dev'); // 作成したバケット名
        // $bucket->upload(
        //     fopen(storage_path('logs/laravel.log'), 'r'), $options
        // );

        return $items;
    }
    /**
     * 写真一覧
     */
    public function edit(Request $request)
    {
        // Item::where('id', $request->id)->update(['name' => $request->name]);

        // $items = Item::with(['category'])

        // ->orderBy(Item::CREATED_AT, 'desc')->paginate();

        // $dir = "/foo/bar";
        // $file_name = "test.log";
        // $options = [
        //     'name' => $dir.$file_name
        //     ];
        // $client = new StorageClient();
        // $bucket = $client->bucket('fremanager-dev'); // 作成したバケット名
        // $bucket->upload(
        //     fopen(storage_path('logs/laravel.log'), 'r'), $options
        // );

        // $dir = "/foo/bar";
        // $file_name = "test.log";
        if ($request->image != null) {
            $options = [
                'predefinedAcl' => 'publicRead'
            ];
            $path = $request->file('image')->store('images/item');
            $client = new StorageClient();
            $bucket = $client->bucket('fremanager-dev'); // 作成したバケット名
            $obj = $bucket->upload(
                fopen(storage_path('app/' . $path), 'r'),
                $options
            );
            Storage::delete($path);
            $item = Item::where('id', $request->id)->first();
            $oldObj = $bucket->object($item->filename)->delete();
            Item::where('id', $request->id)->update(['name' => $request->name, 'filename' => $obj->name()]);
        } else {
            Item::where('id', $request->id)->update(['name' => $request->name]);
        }

        // return $items;
    }
    /**
     * 写真一覧
     */
    public function add(Request $request)
    {
        if ($request->image != null) {
            $options = [
                'predefinedAcl' => 'publicRead'
            ];
            $path = $request->file('image')->store('images/item');
            $client = new StorageClient();
            $bucket = $client->bucket('fremanager-dev'); // 作成したバケット名
            $obj = $bucket->upload(
                fopen(storage_path('app/' . $path), 'r'),
                $options
            );
            // Storage::delete($path);
            Item::create(['name' => $request->name, 'filename' => $obj->name()]);
        } else {
            Item::create(['name' => $request->name]);
        }

        // return $items;
    }
}
