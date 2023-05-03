<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientePasajero
 * 
 * @property int $id_pasajero
 * @property int|null $id_usuario
 * @property string|null $Nombre
 * @property string|null $Apellidos
 * @property int|null $Telefono
 * @property string|null $Email
 * @property string|null $DNI
 * @property float|null $puntos
 * 
 * @property Usuario|null $usuario
 * @property Collection|Billete[] $billetes
 * @property Collection|Descuento[] $descuentos
 *
 * @package App\Models
 */
class ClientePasajero extends Model
{
	protected $table = 'cliente_pasajero';
	protected $primaryKey = 'id_pasajero';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_pasajero' => 'int',
		'id_usuario' => 'int',
		'Telefono' => 'int',
		'puntos' => 'float'
	];

	protected $fillable = [
		'id_usuario',
		'Nombre',
		'Apellidos',
		'Telefono',
		'Email',
		'DNI',
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
