<?php

namespace App\Http\Controllers;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ItemController extends Controller
{
    public function index()
    {
        return Item::orderBy('created_at', 'DESC')->get();
    }

    public function store(Request $request)
    {
        $newItem = new Item;
        $newItem->name = $request->item["name"];
        $newItem->save();

        return $newItem;
    }

    public function update(Request $request, $id)
    {
        $existingItem = Item::find($id);
        if ($existingItem)
        {
            $existingItem->is_done = $request->item['is_done'] ? true : false;
            $existingItem->done_at = $request->item['is_done'] ? Carbon::now() : null;
            $existingItem->save();
            return $existingItem;
        }

        return "Item not found cocksucker";
    }

    public function destroy($id)
    {
        $existingItem = Item::find($id);
        if($existingItem)
        {
            $existingItem->delete();
            return "Deleted Successfully";
        }

        return "Item not found dumbass";
    }
}
