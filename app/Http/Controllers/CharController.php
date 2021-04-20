<?php

namespace App\Http\Controllers;

use App\Models\Char;
use App\Models\Item;
use App\Models\JournalItem;
use App\User;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/** Controller for action on url like /char/* and for main page
 * Class CharController
 * @package App\Http\Controllers
 */
class CharController extends Controller

{
    /** show detail Char page
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $char = Char::find($id);

        $inventoryItems = $char->getInventoryItems();
        $otherItems = Item::getUnsignedItems();
        $equippedItems = Item::getCharEquippedItems($char);
        $itemsJournal  = JournalItem::where('char_id',$char->id)->orderBy('created_at', 'desc')->get();
        /* получение имени для Item, т.к. в журнале хранится только ссылка на Item */
        foreach ($itemsJournal as $key => $item){
            $itemsJournal[$key]['item'] = Item::find($item->item_id);
        }

        return view('char.detail', [
            'char' => $char,
            'inventory' => $inventoryItems,
            'otherItems' => $otherItems,
            'equippedItems' => $equippedItems,
            'itemsJournal' => $itemsJournal
        ]);
    }

    /** form for adding new Char
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addForm()
    {
        if(Auth::check()) {
            return view('char.add');
        }else{
            return redirect('/login');
        }
    }

    /** method for post request from addForm which add new Char
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'Name' => 'required|min:2',
        ]);
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        $char = new Char();
        $char->Name = $request->Name;
        $char->strength = $request->Strength;
        $char->stamina = $request->Stamina;
        $char->save();

        return redirect('/');
    }

    /** Char list
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function list()
    {
        return view('char.list', ['chars' => Char::orderBy('created_at', 'desc')->get()]);
    }
}
