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
 * @property int|null $num_passengers
 * @property int|null $num_seats
 * @property int|null $num_check_in
 * @property Carbon|null $departing
 * @property int $id_origin_city
 * @property int $id_destination_city
 * @property string $flight_hours
 * @property int $id_price
 *
 * @property City $city
 * @property UserCompany|null $user_company
 * @property FlightsPrice $flights_price
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
		'num_passengers' => 'int',
		'num_seats' => 'int',
		'num_check_in' => 'int',
		'departing' => 'datetime',
		'id_origin_city' => 'int',
		'id_destination_city' => 'int',
		'id_price' => 'int'
	];

	protected $fillable = [
		'id_company',
		'num_passengers',
		'num_seats',
		'num_check_in',
		'departing',
		'id_origin_city',
		'id_destination_city',
		'flight_hours',
		'id_price'
	];

	public function city()
	{
		return $this->belongsTo(City::class, 'id_destination_city');
	}

	public function user_company()
	{
		return $this->belongsTo(UserCompany::class, 'id_company');
	}

	public function flights_price()
	{
		return $this->belongsTo(FlightsPrice::class, 'id_price');
	}


	public function tickets()
	{
		return $this->hasMany(Ticket::class, 'id_flight');
	}
}
