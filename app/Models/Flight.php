<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Flight
 * 
 * @property int $id_flight
 * @property int|null $id_company
 * @property int|null $num_passenger
 * @property int|null $num_seat
 * @property int|null $check_in
 * @property Carbon|null $dateAndTime
 * @property int $id_origin_city
 * @property int $id_destination_city
 * @property string $flight_hours
 * 
 * @property City $city
 * @property UserCompany|null $user_company
 * @property Collection|FlightAssessment[] $flight_assessments
 * @property Collection|Ticket[] $tickets
 *
 * @package App\Models
 */
class Flight extends Model
{
	protected $table = 'flights';
	protected $primaryKey = 'id_flight';
	public $timestamps = false;

	protected $casts = [
		'id_company' => 'int',
		'num_passenger' => 'int',
		'num_seat' => 'int',
		'check_in' => 'int',
		'dateAndTime' => 'datetime',
		'id_origin_city' => 'int',
		'id_destination_city' => 'int'
	];

	protected $fillable = [
		'id_company',
		'num_passenger',
		'num_seat',
		'check_in',
		'dateAndTime',
		'id_origin_city',
		'id_destination_city',
		'flight_hours'
	];

	public function city()
	{
		return $this->belongsTo(City::class, 'id_destination_city');
	}

	public function user_company()
	{
		return $this->belongsTo(UserCompany::class, 'id_company');
	}

	public function flight_assessments()
	{
		return $this->hasMany(FlightAssessment::class, 'id_flight');
	}

	public function tickets()
	{
		return $this->hasMany(Ticket::class, 'id_flight');
	}
}
