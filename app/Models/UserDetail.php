<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserDetail
 *
 * @property int $id
 * @property string $contact_fname
 * @property string $contact_lname
 * @property string $address
 * @property string $city
 * @property string $country
 * @property string $phone
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $avatar
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDetail whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDetail whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDetail whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDetail whereContactFname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDetail whereContactLname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDetail whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDetail wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDetail whereUserId($value)
 * @mixin \Eloquent
 */
class UserDetail extends Model
{
    //
    protected $guarded=[];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
