<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UsuarioEmpresa
 * 
 * @property int $id_empresa
 * @property int|null $id_usuario
 * @property string|null $nombre
 * @property int|null $telefono
 * 
 * @property Usuario|null $usuario
 * @property Collection|PrecioBillete[] $precio_billetes
 * @property Collection|ValoracionVuelo[] $valoracion_vuelos
 * @property Collection|Vuelo[] $vuelos
 *
 * @package App\Models
 */
class UsuarioEmpresa extends Model
{
	protected $table = 'usuario_empresa';
	protected $primaryKey = 'id_empresa';
	public $timestamps = false;

	protected $casts = [
		'id_usuario' => 'int',
		'telefono' => 'int'
	];

	protected $fillable = [
		'id_usuario',
		'nombre',
		'telefono'
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
