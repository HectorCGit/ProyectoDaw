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
 * 
 * @property Collection|City[] $cities
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
		'name'
	];

	public function cities()
	{
		return $this->hasMany(City::class, 'id_country');
	}

	public function ticket_prices()
	{
		return $this->hasMany(TicketPrice::class, 'id_country');
	}
}
