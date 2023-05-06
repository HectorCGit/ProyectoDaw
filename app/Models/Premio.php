<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Premio
 * 
 * @property int $id_premio
 * @property string|null $tipo
 *
 * @package App\Models
 */
class Premio extends Model
{
	protected $table = 'premios';
	protected $primaryKey = 'id_premio';
	public $timestamps = false;

	protected $fillable = [
		'tipo'
	];
}
