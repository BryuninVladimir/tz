<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JournalItem
 * Table journal_items
 * integer item_id   link to Item
 * integer char_id   link to Char
 * string  status    status of operation
 * date    created_at
 * @package App\Models
 */
class JournalItem extends Model
{


    use HasFactory;
}
