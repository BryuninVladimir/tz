<?php

namespace App\Http\Controllers;

use App\Models\Char;
use App\Models\Item;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**Controller for action on url like /inventory/*
 * Class InventoryController
 * @package App\Http\Controllers
 */
class InventoryController extends Controller

{
    /** equip Item to Char and log it
     * @param $charId
     * @param $itemId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function equip($charId, $itemId)
    {
        $item = Item::find($itemId);
        $char = Char::find($charId);
        $item->equip($char);
        return redirect::back();

    }

    /** add Item to Char inventory and log it
     * @param $charId
     * @param $itemId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add($charId, $itemId)
    {
        $item = Item::find($itemId);
        $char = Char::find($charId);
        if($char->checkFreeSpaceForItem($item))
        {
            $item->addToCharInventory($char);
            return redirect::back();
        }
        else
        {
            return redirect::back()->withErrors(['Item is too heavy!']);;
        }
    }

    /**remove Item from Char inventory and log it
     * @param $charId
     * @param $itemId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($charId, $itemId)
    {
        $item = Item::find($itemId);
        $item->removeFromInventory();

        return redirect::back();
    }

    /** unequip Item from Char and log it
     * @param $charId
     * @param $itemId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unequip($charId, $itemId)
    {
        $item = Item::find($itemId);
        $item->unequip();

        return redirect::back();
    }


}
