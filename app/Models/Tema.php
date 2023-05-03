<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tema
 * 
 * @property int $id_tema
 * @property Carbon|null $fechayHora
 * @property string|null $contenido
 * 
 * @property Collection|Mensaje[] $mensajes
 *
 * @package App\Models
 */
class Tema extends Model
{
	protected $table = 'tema';
	protected $primaryKey = 'id_tema';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_tema' => 'int',
		'fechayHora' => 'datetime'
	];

	protected $fillable = [
		'fechayHora',
		'contenido'
	];

	public function mensajes()
	{
		return $this->hasMany(Mensaje::class, 'id_tema');
	}
}
