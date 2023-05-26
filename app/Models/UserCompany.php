<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
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
 * @property Collection|FlightRating[] $flight_ratings
 * @property Collection|Flight[] $flights
 *
 * @package App\Models
 */
class UserCompany extends User
{
	protected $table = 'user_company';
	protected $primaryKey = 'id_company';
	public $timestamps = false;

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

	public function flight_ratings()
	{
		return $this->hasMany(FlightRating::class, 'id_company');
	}

	public function flights()
	{
		return $this->hasMany(Flight::class, 'id_company');
	}


}

