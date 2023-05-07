<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TicketPrice
 * 
 * @property int $id_price
 * @property int|null $id_company
 * @property int|null $id_country
 * @property int|null $children_price
 * @property int|null $normal_price
 * @property int|null $price_senior
 * @property int|null $id_discount
 * 
 * @property UserCompany|null $user_company
 * @property Country|null $country
 * @property Collection|Ticket[] $tickets
 *
 * @package App\Models
 */
class TicketPrice extends Model
{
	protected $table = 'ticket_price';
	protected $primaryKey = 'id_price';
	public $timestamps = false;

	protected $casts = [
		'id_company' => 'int',
		'id_country' => 'int',
		'children_price' => 'int',
		'normal_price' => 'int',
		'price_senior' => 'int',
		'id_discount' => 'int'
	];

	protected $fillable = [
		'id_company',
		'id_country',
		'children_price',
		'normal_price',
		'price_senior',
		'id_discount'
	];

	public function user_company()
	{
		return $this->belongsTo(UserCompany::class, 'id_company');
	}

	public function country()
	{
		return $this->belongsTo(Country::class, 'id_country');
	}

	public function tickets()
	{
		return $this->hasMany(Ticket::class, 'id_price');
	}
}
