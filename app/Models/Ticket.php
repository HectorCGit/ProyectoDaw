<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ticket
 * 
 * @property int $id_ticket
 * @property int|null $id_flight
 * @property int|null $id_passenger
 * @property int|null $id_discount
 * @property int|null $id_price
 * @property int|null $check_in
 * @property int|null $num_suitcases
 * 
 * @property UserPassenger|null $user_passenger
 * @property Discount|null $discount
 * @property TicketPrice|null $ticket_price
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
		'id_price' => 'int',
		'check_in' => 'int',
		'num_suitcases' => 'int'
	];

	protected $fillable = [
		'id_flight',
		'id_passenger',
		'id_discount',
		'id_price',
		'check_in',
		'num_suitcases'
	];

	public function user_passenger()
	{
		return $this->belongsTo(UserPassenger::class, 'id_passenger');
	}

	public function discount()
	{
		return $this->belongsTo(Discount::class, 'id_discount');
	}

	public function ticket_price()
	{
		return $this->belongsTo(TicketPrice::class, 'id_price');
	}

	public function flight()
	{
		return $this->belongsTo(Flight::class, 'id_flight');
	}
}
