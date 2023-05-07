<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Award
 * 
 * @property int $id_award
 * @property string|null $type
 *
 * @package App\Models
 */
class Award extends Model
{
	protected $table = 'awards';
	protected $primaryKey = 'id_award';
	public $timestamps = false;

	protected $fillable = [
		'type'
	];
}
