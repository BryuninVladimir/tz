<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class Item
 * Table Items
 * Inventory Item
 * @package App\Models
 *
 * integer id
 * string name
 * string type     weapon, helmet, chest
 * integer weight
 * integer char_id nullable
 * boolean equipped nullable

 */
class Item extends Model
{
    /**
     * Make $this equipped (set status 'equipped' = 1) To Char and Log it
     *
     * @param Char $char
     * @return void
     */
    public function equip(Char $char)
    {
        Item::whereCharId($char->id)->whereEquipped(1)->whereType($this->type)->update(['equipped'=> 0]);
        $this->equipped = 1;
        $this->Update();
        self::Log('equpped', $char->id);
    }

    /**
     * set status 'equipped' to $this = 0 and log it
     *
     * @return void
     */
    public function unequip()
    {
        $this->equipped = 0;
        $this->Update();
        self::Log('unequpped', $this->char_id);
    }

    /**
     * add $this to CharInventory and log it
     * set $this char_id = Char id
     *
     * @param Char $char
     *
     * @return void
     */
    public function addToCharInventory(Char $char)
    {
        $this->char_id = $char->id;
        $this->Update();
        self::Log('added to inventory', $char->id);
    }

    /**remove $this from inventory  and log it
     * set $this char_id = null
     *@return void
     */
    public function removeFromInventory()
    {
        self::Log('removed from inventory', $this->char_id);
        $this->char_id = null;
        $this->Update();
    }

    /**get Items thats charid os null
     * @return Item array
     */
    public static function getUnsignedItems()
    {
        return Item::whereNull('char_id')
            ->get();
    }

    /** get array of Equipped Items for Char
     * @param Char $char
     * @return array (helmet = Item, weapon = Item, chest = Item)
     */
    public static function getCharEquippedItems(Char $char)
    {
        return array(
            "helmet" => self::getCharEquippedItemByType($char, 'helmet'),
            "weapon" => self::getCharEquippedItemByType($char, 'weapon'),
            "chest" => self::getCharEquippedItemByType($char, 'chest')
        );

    }

    /**get Equpped item for Char by itemType (helmet, weapon, chest)
     * @param Char $char
     * @param $itemType
     * @return Item
     */
    private static function getCharEquippedItemByType(Char $char, $itemType)
    {
        return Item::whereCharId($char->id)
            ->whereType($itemType)
            ->whereEquipped(1)
            ->first();
    }

    /**make journal log on inventory actions
     * @param $status
     * @param $charId
     * @return void
     */
    private function Log($status, $charId)
    {
        $JournalItem = new JournalItem();
        $JournalItem->item_id = $this->id;
        $JournalItem->char_id = $charId;
        $JournalItem->status  = $status;
        $JournalItem->save();
    }

    use HasFactory;
}
