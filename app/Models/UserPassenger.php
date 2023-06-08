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
class UserPassenger extends User
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
        'telephone' => ['required', 'min:10000000', 'max:1000000000', 'integer'],
        'dni' => ['required', 'regex:/^[0-9]{8}[A-Z]{1}$/'],
        'points' =>['required','numeric'],
    ];
    protected $perPage = 20;
	protected $fillable = [
		'id_users',
		'name',
		'surname',
		'telephone',
		'dni',
		'points'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_users');
	}

	public function discounts()
	{
		return $this->hasMany(Discount::class, 'id_passenger');
	}

	public function tickets()
	{
		return $this->hasMany(Ticket::class, 'id_passenger');
	}
}
