<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ClienteEmpresa
 * 
 * @property int $id_empresa
 * @property int|null $id_usuario
 * @property string|null $Nombre
 * @property int|null $Telefono
 * @property string|null $email
 * 
 * @property Usuario|null $usuario
 * @property Collection|PrecioBillete[] $precio_billetes
 * @property Collection|ValoracionVuelo[] $valoracion_vuelos
 * @property Collection|Vuelo[] $vuelos
 *
 * @package App\Models
 */
class ClienteEmpresa extends Model
{
	protected $table = 'cliente_empresa';
	protected $primaryKey = 'id_empresa';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_empresa' => 'int',
		'id_usuario' => 'int',
		'Telefono' => 'int'
	];

	protected $fillable = [
		'id_usuario',
		'Nombre',
		'Telefono',
		'email'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'id_usuario');
	}

	public function precio_billetes()
	{
		return $this->hasMany(PrecioBillete::class, 'id_empresa');
	}

	public function valoracion_vuelos()
	{
		return $this->hasMany(ValoracionVuelo::class, 'id_empresa');
	}

	public function vuelos()
	{
		return $this->hasMany(Vuelo::class, 'id_empresa');
	}
}
