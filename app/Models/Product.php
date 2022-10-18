<?php

namespace App\Models;

use App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $masp
 * @property string $product_name
 * @property string|null $product_description
 * @property int|null $supplier_id
 * @property int|null $product_price
 * @property int|null $available_size
 * @property int|null $available_colors
 * @property int|null $discount
 * @property int|null $product_available
 * @property int|null $discount_available
 * @property int|null $current_order
 * @property string|null $picture
 * @property string|null $second_image
 * @property int|null $ranking
 * @property string|null $note
 * @property string|null $slug
 * @property int|null $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Kalnoy\Nestedset\Collection|\App\Models\SubCategory[] $categories
 * @property-read int|null $categories_count
 * @property-read \App\Models\SubCategory|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ColorProduct[] $colors
 * @property-read int|null $colors_count
 * @property-read \App\Models\Category|null $mainCate
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ColorProductPicture[] $pictures
 * @property-read int|null $pictures_count
 * @property-read \App\Models\Supplier|null $supplier
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereAvailableColors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereAvailableSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCurrentOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDiscountAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMasp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProductAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProductDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProductPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereRanking($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSecondImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    protected $fillable = [
        'product_name', 'product_description', 'category_id', 'product_price', 'supplier_product_id', 'supplier_id', 'category_id',
        'available_size', 'available_colors', 'size_id', 'color_id', 'discount', 'product_available', 'discount_available',
        'current_order', 'picture', 'ranking', 'note', 'second_image', 'slug', 'masp'
    ];

    public function colors()
    {
        return $this->hasMany('App\Models\ColorProduct', 'product_id', 'id');
        // return $this->belongsToMany('App\Models\Color');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\SubCategory', 'product_category', 'product_id', 'sub_category_id');
    }

    public function mainCate()
    {
        return $this->hasOneThrough(
            'App\Models\Category',
            'App\Models\SubCategory',
            'category_id',
            'id',
            'category_id',
            'category_id'
        );
    }
    public function pictures()
    {
        return $this->hasMany("App\Models\ColorProductPicture", 'product_id', 'id');
        return $this->hasManyThrough('App\Models\Color', 'App\Models\ColorProductPicture', 'color_id', 'product_id', 'id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\SubCategory');
    }
}
