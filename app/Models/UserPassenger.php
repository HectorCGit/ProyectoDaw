<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserPassenger
 *
 * @property $id_passenger
 * @property $id_users
 * @property $name
 * @property $surname
 * @property $telephone
 * @property $dni
 * @property $points
 *
 * @property Discount[] $discounts
 * @property Ticket[] $tickets
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class UserPassenger extends Model
{
    use HasFactory;
    protected $table = 'user_passenger';
    protected $primaryKey = 'id_passenger';
    public $timestamps = false;

    protected $casts = [
        'id_users' => 'int',
        'telephone' => 'int',
        'points' => 'float'
    ];
    static $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'password' => ['required', 'string', 'min:8'],
        'telephone' => ['required', 'min:10000000', 'max:1000000000', 'integer'],
        'dni' => ['required', 'regex:/^[0-9]{8}[A-Z]{1}$/'],
        'points' =>['required','numeric'],
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_passenger','id_users','name','surname','telephone','dni','points'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function discounts()
    {
        return $this->hasMany('App\Models\Discount', 'id_passenger', 'id_passenger');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket', 'id_passenger', 'id_passenger');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'id_users');
    }


}
