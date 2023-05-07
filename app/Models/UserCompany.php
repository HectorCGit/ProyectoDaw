<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserCompany
 * 
 * @property int $id_company
 * @property int|null $id_users
 * @property string|null $name
 * @property int|null $telephone
 * 
 * @property User|null $user
 * @property Collection|FlightAssessment[] $flight_assessments
 * @property Collection|Flight[] $flights
 * @property Collection|TicketPrice[] $ticket_prices
 *
 * @package App\Models
 */
class UserCompany extends Model
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

	public function flight_assessments()
	{
		return $this->hasMany(FlightAssessment::class, 'id_company');
	}

	public function flights()
	{
		return $this->hasMany(Flight::class, 'id_company');
	}

	public function ticket_prices()
	{
		return $this->hasMany(TicketPrice::class, 'id_company');
	}
}
