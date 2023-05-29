<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;


/**
 * Class UserPassenger
 *
 * @property int $id_passenger
 * @property int $id_users
 * @property string|null $name
 * @property string|null $surname
 * @property int|null $telephone
 * @property string|null $dni
 * @property float|null $points
 *
 * @property User|null $user
 * @property Collection|Discount[] $discounts
 * @property Collection|Ticket[] $tickets
 *
 * @package App\Models
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
