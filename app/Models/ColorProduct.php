<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ColorProduct
 *
 * @property int $id
 * @property string $name
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ColorProductPicture[] $pictures
 * @property-read int|null $pictures_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ColorSize[] $sizes
 * @property-read int|null $sizes_count
 * @method static \Illuminate\Database\Eloquent\Builder|ColorProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorProduct whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ColorProduct extends Model
{
    protected $fillable = ['name', 'product_id'];
    public function sizes()
    {
        return $this->hasMany('App\Models\ColorSize', 'color_id', 'id');
    }
    public function pictures()
    {
        return $this->hasMany('App\Models\ColorProductPicture', 'color_id', 'id');
    }
}
