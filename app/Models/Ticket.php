<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ticket
 * 
 * @property int $id_ticket
 * @property int|null $id_flight
 * @property int|null $id_passenger
 * @property int|null $id_discount
 * @property int|null $check_in
 * @property int|null $num_suitcases
 * @property string $ticket_name_passenger
 * @property string $ticket_surname_passenger
 * @property int|null $price
 * @property Carbon|null $shopping_date
 * @property bool $active
 * 
 * @property UserPassenger|null $user_passenger
 * @property Discount|null $discount
 * @property Flight|null $flight
 *
 * @package App\Models
 */
class Ticket extends Model
{
	protected $table = 'tickets';
	protected $primaryKey = 'id_ticket';
	public $timestamps = false;

	protected $casts = [
		'id_flight' => 'int',
		'id_passenger' => 'int',
		'id_discount' => 'int',
		'check_in' => 'int',
		'num_suitcases' => 'int',
		'price' => 'int',
		'shopping_date' => 'datetime',
		'active' => 'bool'
	];

	protected $fillable = [
		'id_flight',
		'id_passenger',
		'id_discount',
		'check_in',
		'num_suitcases',
		'ticket_name_passenger',
		'ticket_surname_passenger',
		'price',
		'shopping_date',
		'active'
	];

	public function user_passenger()
	{
		return $this->belongsTo(UserPassenger::class, 'id_passenger');
	}

	public function discount()
	{
		return $this->belongsTo(Discount::class, 'id_discount');
	}

	public function flight()
	{
		return $this->belongsTo(Flight::class, 'id_flight');
	}
}
