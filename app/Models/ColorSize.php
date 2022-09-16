<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ColorSize
 *
 * @property int $id
 * @property string $name
 * @property int|null $quantity
 * @property int|null $color_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ColorSize newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorSize newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorSize query()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorSize whereColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorSize whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorSize whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorSize whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorSize whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorSize whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ColorSize extends Model
{
    protected $fillable = ['color_id', 'name', 'quantity'];
}
