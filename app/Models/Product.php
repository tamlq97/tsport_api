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
 * @property string|null $masp
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

    public static function store($credentials)
    {
        return Product::create([
            'product_name' => $credentials['product_name'],
            'product_price' => $credentials['product_price'],
            'category_id' => $credentials['cate_name']['id'],
            'product_description' => $credentials['product_description'],
        ]);
    }

    public static function updateColorProduct($credentials, $product)
    {
        $prodPath = storage_path('app/public/products/' . $product->id);
        $color = Models\ColorProduct::find($credentials['color_name']['id']);
        $colorPath = storage_path('app/public/products/' . $product->id . '/colors/' . $color->id);
        if (File::exists($prodPath) && File::exists($colorPath)) {
            $filesProdInStorage = File::allFiles($colorPath);
            foreach ($filesProdInStorage as $file) {
                foreach ($color->pictures as $img) {
                    if ($img->name != $file->getFileName()) {
                        ColorProductPicture::where('color_id', $img->id)->where('product_id', $product->id)->delete();
                    }
                    if ($file->getFilename() != $img->name) {
                        File::delete($prodPath . '/colors/' . $color->id . '/' . $img->type . '/' . $file->getFilename());
                    }
                }
            }
        }
        DB::delete("
                delete from color_product_pictures where color_product_pictures.color_id = '" . $color->id . "'
                and product_id = '" . $product->id . "'
                ");


        $sizesID = [];
        foreach ($credentials['size'] as $key => $value) {
            Models\ColorSize::updateOrCreate(['name' => $value['name'], 'color_id' => $color->id]);
        }
    }

    public static function storeImage($credentials, $product)
    {
        $color = $credentials['color_name'];
        Log::warning("SOMETHING_RUN1", [$credentials['image']]);
        if (!empty($credentials['image'])) {
            foreach ($credentials['image'] as $key => $file) {
                $picture = new ColorProductPicture();
                $name = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $type = $picture->getType($extension);
                Log::warning("SOMETHING", ['run here']);
                $file->storeAs('products/' . $product->id . '/colors/' . $color['id'] . '/' . $type . '/', $name);
                $picture::updateOrCreate([
                    'name' => $name,
                    'src' => $name,
                    'type' => $type,
                    'extension' => $extension,
                    'color_id' => $color['id'],
                    'product_id' => $product->id
                ]);
            }
        }
    }
    public static function storeImageIfExist($img1, $img2, $imagesMore, $product)
    {
        $picture = new ColorProductPicture();
        $img1Name = $img1->getClientOriginalName();
        $img1Ext = $img1->getClientOriginalExtension();
        $img1->storeAs('products/' . $product->id . '/' . $picture->getType($img1Ext) . '/', $img1Name);
        $img1->storeAs('products/' . $product->id . '/colors/' . $picture->getType($img1Ext) . '/', $img1Name);
        $img2Name = $img2->getClientOriginalName();
        $img2Ext = $img2->getClientOriginalExtension();
        $img2->storeAs('products/' . $product->id . '/' . $picture->getType($img2Ext) . '/', $img2Name);

        if (!empty($imagesMore)) {
            foreach ($imagesMore as $key => $file) {
                $name = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $type = $picture->getType($extension);

                $file->storeAs('products/' . $product->id . '/' . $type . '/', $name);
                // if ($picture->upload($type, $file, $name, $extension, $product)) {
                $picture::create([
                    'name' => $name,
                    'src' => $name,
                    'type' => $type,
                    'extension' => $extension,
                    'product_id' => $product->id,
                ]);
                // }
            }
        }
    }
}
