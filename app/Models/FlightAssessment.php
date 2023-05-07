<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FlightAssessment
 * 
 * @property int $id_flight_assessment
 * @property int|null $id_company
 * @property int|null $id_flight
 * @property float|null $assessment
 * @property string|null $description
 * 
 * @property UserCompany|null $user_company
 * @property Flight|null $flight
 *
 * @package App\Models
 */
class FlightAssessment extends Model
{
	protected $table = 'flight_assessment';
	protected $primaryKey = 'id_flight_assessment';
	public $timestamps = false;

	protected $casts = [
		'id_company' => 'int',
		'id_flight' => 'int',
		'assessment' => 'float'
	];

	protected $fillable = [
		'id_company',
		'id_flight',
		'assessment',
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
