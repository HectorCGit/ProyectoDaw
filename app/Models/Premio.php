<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Premio
 * 
 * @property int $Id_premio
 * @property string|null $tipo
 *
 * @package App\Models
 */
class Premio extends Model
{
	protected $table = 'premios';
	protected $primaryKey = 'Id_premio';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Id_premio' => 'int'
	];

	protected $fillable = [
		'tipo'
	];
}
