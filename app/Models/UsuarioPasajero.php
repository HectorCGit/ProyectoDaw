<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UsuarioPasajero
 * 
 * @property int $id_pasajero
 * @property int|null $id_usuario
 * @property string|null $nombre
 * @property string|null $apellidos
 * @property int|null $telefono
 * @property string|null $dni
 * @property float|null $puntos
 * 
 * @property Usuario|null $usuario
 * @property Collection|Billete[] $billetes
 * @property Collection|Descuento[] $descuentos
 *
 * @package App\Models
 */
class UsuarioPasajero extends Model
{
	protected $table = 'usuario_pasajero';
	protected $primaryKey = 'id_pasajero';
	public $timestamps = false;

	protected $casts = [
		'id_usuario' => 'int',
		'telefono' => 'int',
		'puntos' => 'float'
	];

	protected $fillable = [
		'id_usuario',
		'nombre',
		'apellidos',
		'telefono',
		'dni',
		'puntos'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'id_usuario');
	}

	public function billetes()
	{
		return $this->hasMany(Billete::class, 'id_pasajero');
	}

	public function descuentos()
	{
		return $this->hasMany(Descuento::class, 'id_pasajero');
	}
}
