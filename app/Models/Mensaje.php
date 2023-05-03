<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Mensaje
 * 
 * @property int $Id_mensaje
 * @property int|null $id_usuario
 * @property int|null $id_tema
 * @property Carbon|null $fechayHora
 * @property string|null $contenido
 * 
 * @property Usuario|null $usuario
 * @property Tema|null $tema
 *
 * @package App\Models
 */
class Mensaje extends Model
{
	protected $table = 'mensaje';
	protected $primaryKey = 'Id_mensaje';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Id_mensaje' => 'int',
		'id_usuario' => 'int',
		'id_tema' => 'int',
		'fechayHora' => 'datetime'
	];

	protected $fillable = [
		'id_usuario',
		'id_tema',
		'fechayHora',
		'contenido'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'id_usuario');
	}

	public function tema()
	{
		return $this->belongsTo(Tema::class, 'id_tema');
	}
}
