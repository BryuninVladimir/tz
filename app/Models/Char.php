<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class Char
 * @package App\Models
 *
 * primary_key id
 * string name
 * integer strength
 * integer stamina
 *
 */
class Char extends Model
{
     use HasFactory;

    /** sum all item weight for $this  in Char inventory and in Equipped Items
     * @return string
     */
    public function getInventoryWeight()
    {
        return Item::select(DB::raw('sum(weight) as summa'))->where('char_id', $this->id)->groupBy('char_id')->value('summa');
    }

    /** get Inventory Capacity for $this,
     * Strength + Stamina * 5
     * @return int
     */
    public function getCharMaxWeight()
    {
        return $this->strength + $this->stamina * 5;
    }

    /**check is enough freespace for Item in $this inventory
     *
     * @param Item $item
     * @return bool
     */
    public function checkFreeSpaceForItem(Item $item)
    {
        $CharMaxWeight = self::getCharMaxWeight();
        $InventoryWeight = self::getInventoryWeight();

        return ($CharMaxWeight - ($InventoryWeight + $item->weight) > 0);

    }

    /** get invetory items for $this Char
     * @return Item array
     */
    public function getInventoryItems()
    {
        return Item::where('char_id', $this->id)
            ->where(function ($query) {
                $query->whereNull('equipped')
                      ->orWhere('equipped', 0);
            })->get();
    }


}
