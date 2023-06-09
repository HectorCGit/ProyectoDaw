<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class UserCompany
 *
 * @property int $id_company
 * @property int|null $id_users
 * @property string|null $name
 * @property int|null $telephone
 *
 * @property User|null $user
 * @property Collection|Flight[] $flights
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class UserCompany extends User
{
    use HasFactory;
	protected $table = 'user_company';
	protected $primaryKey = 'id_company';
	public $timestamps = false;

    static $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'password' => ['required', 'string', 'min:8'],
        'telephone' => ['required', 'min:10000000', 'max:1000000000', 'integer'],
    ];

    protected $perPage = 20;
	protected $casts = [
		'id_users' => 'int',
		'telephone' => 'int'
	];

	protected $fillable = [
		'id_users',
		'name',
		'telephone'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_users');
	}


	public function flights()
	{
		return $this->hasMany(Flight::class, 'id_company');
	}


}
