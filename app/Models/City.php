<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class City
 * 
 * @property int $id_city
 * @property int $id_country
 * @property string|null $name
 * @property string|null $airport
 * 
 * @property Country $country
 *
 * @package App\Models
 */
class City extends Model
{
	protected $table = 'cities';
	protected $primaryKey = 'id_city';
	public $timestamps = false;

	protected $casts = [
		'id_country' => 'int'
	];

	protected $fillable = [
		'id_country',
		'name',
		'airport'
	];

	public function country()
	{
		return $this->belongsTo(Country::class, 'id_country');
	}
}
