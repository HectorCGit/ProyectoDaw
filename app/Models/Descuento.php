<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Descuento
 * 
 * @property int $id_descuento
 * @property float|null $porcentaje
 * @property int|null $id_pasajero
 * 
 * @property UsuarioPasajero|null $usuario_pasajero
 * @property Collection|Billete[] $billetes
 *
 * @package App\Models
 */
class Descuento extends Model
{
	protected $table = 'descuentos';
	protected $primaryKey = 'id_descuento';
	public $timestamps = false;

	protected $casts = [
		'porcentaje' => 'float',
		'id_pasajero' => 'int'
	];

	protected $fillable = [
		'porcentaje',
		'id_pasajero'
	];

	public function usuario_pasajero()
	{
		return $this->belongsTo(UsuarioPasajero::class, 'id_pasajero');
	}

	public function billetes()
	{
		return $this->hasMany(Billete::class, 'id_descuento');
	}
}
