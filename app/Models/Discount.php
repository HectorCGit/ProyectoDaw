<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Discount
 * 
 * @property int $id_discount
 * @property float|null $percentage
 * @property int|null $id_passenger
 * 
 * @property UserPassenger|null $user_passenger
 * @property Collection|Ticket[] $tickets
 *
 * @package App\Models
 */
class Discount extends Model
{
	protected $table = 'discounts';
	protected $primaryKey = 'id_discount';
	public $timestamps = false;

	protected $casts = [
		'percentage' => 'float',
		'id_passenger' => 'int'
	];

	protected $fillable = [
		'percentage',
		'id_passenger'
	];

	public function user_passenger()
	{
		return $this->belongsTo(UserPassenger::class, 'id_passenger');
	}

	public function tickets()
	{
		return $this->hasMany(Ticket::class, 'id_discount');
	}
}
