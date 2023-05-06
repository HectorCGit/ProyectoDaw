<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ValoracionVuelo
 * 
 * @property int $id_valoracion_vuelo
 * @property int|null $id_empresa
 * @property int|null $id_vuelo
 * @property float|null $valoracion
 * @property string|null $descripcion
 * 
 * @property UsuarioEmpresa|null $usuario_empresa
 * @property Vuelo|null $vuelo
 *
 * @package App\Models
 */
class ValoracionVuelo extends Model
{
	protected $table = 'valoracion_vuelo';
	protected $primaryKey = 'id_valoracion_vuelo';
	public $timestamps = false;

	protected $casts = [
		'id_empresa' => 'int',
		'id_vuelo' => 'int',
		'valoracion' => 'float'
	];

	protected $fillable = [
		'id_empresa',
		'id_vuelo',
		'valoracion',
		'descripcion'
	];

	public function usuario_empresa()
	{
		return $this->belongsTo(UsuarioEmpresa::class, 'id_empresa');
	}

	public function vuelo()
	{
		return $this->belongsTo(Vuelo::class, 'id_vuelo');
	}
}
