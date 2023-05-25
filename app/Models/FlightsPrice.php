<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FlightsPrice
 * 
 * @property int $id_price
 * @property int|null $economic_price
 * @property int|null $business_price
 * @property int|null $id_discount
 * 
 * @property Collection|Flight[] $flights
 *
 * @package App\Models
 */
class FlightsPrice extends Model
{
	protected $table = 'flights_price';
	protected $primaryKey = 'id_price';
	public $timestamps = false;

	protected $casts = [
		'economic_price' => 'int',
		'business_price' => 'int',
		'id_discount' => 'int'
	];

	protected $fillable = [
		'economic_price',
		'business_price',
		'id_discount'
	];

	public function flights()
	{
		return $this->hasMany(Flight::class, 'id_price');
	}
}
