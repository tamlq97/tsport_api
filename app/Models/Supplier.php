<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Supplier
 *
 * @property int $id
 * @property string|null $supplier_code
 * @property string|null $company_name
 * @property string|null $contact_fname
 * @property string|null $contact_lname
 * @property string|null $contact_title
 * @property string|null $address
 * @property string|null $address2
 * @property string|null $city
 * @property string|null $state
 * @property string|null $postal_code
 * @property string|null $country
 * @property string|null $phone
 * @property string|null $fax
 * @property string|null $email
 * @property string|null $website
 * @property string|null $payment_methods
 * @property string|null $discount_type
 * @property string|null $discount_rate
 * @property string|null $type_goods
 * @property int|null $discount_available
 * @property int|null $current_order
 * @property int $user_id
 * @property string|null $size_url
 * @property string|null $logo
 * @property int|null $ranking
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Kalnoy\Nestedset\Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier query()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereContactFname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereContactLname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereContactTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereCurrentOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereDiscountAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereDiscountRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier wherePaymentMethods($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereRanking($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSizeUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSupplierCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereTypeGoods($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereWebsite($value)
 * @mixin \Eloquent
 */
class Supplier extends Model
{
    protected $guarded = [];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'supplier_code';
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
