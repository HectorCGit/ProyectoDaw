<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Prize
 * 
 * @property int $id_prize
 * @property string|null $type
 *
 * @package App\Models
 */
class Prize extends Model
{
	protected $table = 'prizes';
	protected $primaryKey = 'id_prize';
	public $timestamps = false;

	protected $fillable = [
		'type'
	];
}
