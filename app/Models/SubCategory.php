<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 * App\Models\SubCategory
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $category_id
 * @property string|null $slug
 * @property int $_lft
 * @property int $_rgt
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Kalnoy\Nestedset\Collection|SubCategory[] $children
 * @property-read int|null $children_count
 * @property-read \App\Models\Category $parent
 * @method static \Kalnoy\Nestedset\Collection|static[] all($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory ancestorsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory ancestorsOf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory applyNestedSetScope(?string $table = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory countErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory d()
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory defaultOrder(string $dir = 'asc')
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory descendantsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory descendantsOf($id, array $columns = [], $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory fixSubtree($root)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory fixTree($root = null)
 * @method static \Kalnoy\Nestedset\Collection|static[] get($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory getNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory getPlainNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory getTotalErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory hasChildren()
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory hasParent()
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory isBroken()
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory leaves(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory makeGap(int $cut, int $height)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory moveNode($key, $position)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory newModelQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory newQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory orWhereAncestorOf(bool $id, bool $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory orWhereDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory orWhereNodeBetween($values)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory orWhereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory query()
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory rebuildSubtree($root, array $data, $delete = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory rebuildTree(array $data, $delete = false, $root = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory reversed()
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory root(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory whereAncestorOf($id, $andSelf = false, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory whereAncestorOrSelf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory whereCategoryId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory whereCreatedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory whereDescendantOf($id, $boolean = 'and', $not = false, $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory whereDescendantOrSelf(string $id, string $boolean = 'and', string $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory whereDescription($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory whereId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory whereIsAfter($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory whereIsBefore($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory whereIsLeaf()
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory whereIsRoot()
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory whereLft($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory whereName($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory whereNodeBetween($values, $boolean = 'and', $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory whereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory whereParentId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory whereRgt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory whereSlug($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory whereUpdatedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory withDepth(string $as = 'depth')
 * @method static \Kalnoy\Nestedset\QueryBuilder|SubCategory withoutRoot()
 * @mixin \Eloquent
 */
class SubCategory extends Model
{
    use NodeTrait;
    protected $table = 'sub_categories';
    protected $fillable = ['name', 'description', 'category_id', 'slug','parent_id'];

    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
}
