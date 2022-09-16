<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductDetail
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $color
 * @property string|null $size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductDetail whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductDetail extends Model
{
    //
}
