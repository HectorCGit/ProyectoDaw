<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FlightRating
 * 
 * @property int $id_flight_rating
 * @property int|null $id_company
 * @property int|null $id_flight
 * @property float|null $rating
 * @property string|null $description
 * 
 * @property UserCompany|null $user_company
 * @property Flight|null $flight
 *
 * @package App\Models
 */
class FlightRating extends Model
{
	protected $table = 'flight_rating';
	protected $primaryKey = 'id_flight_rating';
	public $timestamps = false;

	protected $casts = [
		'id_company' => 'int',
		'id_flight' => 'int',
		'rating' => 'float'
	];

	protected $fillable = [
		'id_company',
		'id_flight',
		'rating',
		'description'
	];

	public function user_company()
	{
		return $this->belongsTo(UserCompany::class, 'id_company');
	}

	public function flight()
	{
		return $this->belongsTo(Flight::class, 'id_flight');
	}
}
