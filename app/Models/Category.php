<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $slug
 * @property int $_lft
 * @property int $_rgt
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Kalnoy\Nestedset\Collection|\App\Models\SubCategory[] $cateChildren
 * @property-read int|null $cate_children_count
 * @property-read \Kalnoy\Nestedset\Collection|Category[] $children
 * @property-read int|null $children_count
 * @property-read Category|null $parent
 * @property-read \App\Models\Product|null $product
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\Supplier|null $supplier
 * @method static \Kalnoy\Nestedset\Collection|static[] all($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category ancestorsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category ancestorsOf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category applyNestedSetScope(?string $table = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category countErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category d()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category defaultOrder(string $dir = 'asc')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category descendantsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category descendantsOf($id, array $columns = [], $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category fixSubtree($root)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category fixTree($root = null)
 * @method static \Kalnoy\Nestedset\Collection|static[] get($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category getNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category getPlainNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category getTotalErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category hasChildren()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category hasParent()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category isBroken()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category leaves(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category makeGap(int $cut, int $height)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category moveNode($key, $position)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category newModelQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category newQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category orWhereAncestorOf(bool $id, bool $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category orWhereDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category orWhereNodeBetween($values)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category orWhereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category query()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category rebuildSubtree($root, array $data, $delete = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category rebuildTree(array $data, $delete = false, $root = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category reversed()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category root(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereAncestorOf($id, $andSelf = false, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereAncestorOrSelf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereCreatedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereDescendantOf($id, $boolean = 'and', $not = false, $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereDescendantOrSelf(string $id, string $boolean = 'and', string $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereDescription($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereIsAfter($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereIsBefore($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereIsLeaf()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereIsRoot()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereLft($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereName($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereNodeBetween($values, $boolean = 'and', $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereParentId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereRgt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereSlug($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereUpdatedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category withDepth(string $as = 'depth')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category withoutRoot()
 * @mixin \Eloquent
 */
class Category extends Model
{
    use NodeTrait;
    protected $table = 'categories';
    protected  $fillable = ['name', 'description', 'slug'];
    private $CATEGORIES = [
        [
            'name' => 'mens',
            'children' => [
                [
                    'name' => 'shop by category',
                    'children' => [
                        [
                            'name' => 'All Products',
                            'category_id' => 1
                        ],
                        [
                            'name' => 'Base Layers',
                            'category_id' => 1
                        ],
                        [
                            'name' => 'Pants',
                            'category_id' => 1
                        ],
                        [
                            'name' => 'Hoodies & Jackets',
                            'category_id' => 1
                        ],
                        [
                            'name' => 'Shorts',
                            'category_id' => 1
                        ],
                        [
                            'name' => 'T-Shirts & Tops',
                            'category_id' => 1
                        ],
                    ],
                    'category_id' => 1,
                ],
                [
                    'name' => 'shop by collection',
                    'children' => [
                        [
                            'name' => 'Arrival',
                            'category_id' => 1
                        ],
                        [
                            'name' => 'Legacy',
                            'category_id' => 1
                        ],
                        [
                            'name' => 'Seamless',
                            'category_id' => 1
                        ],
                        [
                            'name' => 'Speed',
                            'category_id' => 1
                        ],
                    ],
                    'category_id' => 1
                ],
            ]
        ],
        [
            'name' => 'womens',
            'children' => [
                [
                    'name' => 'shop by category',
                    'children' => [
                        ['name' => 'All Products', 'category_id' => 2],
                        ['name' => 'Pants & Leggings', 'category_id' => 2],
                        ['name' => 'Crop Tops', 'category_id' => 2],
                        ['name' => 'Hoodies & Jackets', 'category_id' => 2],
                        ['name' => 'Shorts', 'category_id' => 2],
                        ['name' => 'Swimmwear', 'category_id' => 2],
                    ], 'category_id' => 2
                ],
                [
                    'name' => 'shop by collection',
                    'children' => [
                        ['name' => 'Camo', 'category_id' => 2],
                        ['name' => 'Energy', 'category_id' => 2],
                        ['name' => 'Fit', 'category_id' => 2],
                        ['name' => 'Flex', 'category_id' => 2],
                    ], 'category_id' => 2
                ],
            ]
        ],
        [
            'name' => 'accessories',
            'children' => [
                ['name' => 'Bags', 'category_id' => 3],
                ['name' => 'Bottles', 'category_id' => 3],
                ['name' => 'Equipment', 'category_id' => 3],
                ['name' => 'Headwear', 'category_id' => 3],
                ['name' => 'View All', 'category_id' => 3],
            ], 'category_id' => 3
        ]
    ];

    public function cateChildren()
    {
        return $this->hasMany('App\Models\SubCategory');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function product()
    {
        return $this->hasOneThrough('App\Models\Product', 'App\Models\SubCategory');
    }
}
