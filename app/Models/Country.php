<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 * 
 * @property int $id_country
 * @property string|null $name
 * @property string|null $capital
 * @property string|null $airport
 * 
 * @property Collection|Flight[] $flights
 * @property Collection|TicketPrice[] $ticket_prices
 *
 * @package App\Models
 */
class Country extends Model
{
	protected $table = 'countries';
	protected $primaryKey = 'id_country';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'capital',
		'airport'
	];

	public function flights()
	{
		return $this->hasMany(Flight::class, 'id_country');
	}

	public function ticket_prices()
	{
		return $this->hasMany(TicketPrice::class, 'id_country');
	}
}
