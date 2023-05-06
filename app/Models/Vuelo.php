<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Vuelo
 * 
 * @property int $id_vuelo
 * @property int|null $id_empresa
 * @property int|null $num_pasajeros
 * @property int|null $num_asientos
 * @property int|null $check_in
 * @property Carbon|null $fechayHora
 * @property int|null $id_pais
 * 
 * @property Paise|null $paise
 * @property UsuarioEmpresa|null $usuario_empresa
 * @property Collection|Billete[] $billetes
 * @property Collection|ValoracionVuelo[] $valoracion_vuelos
 *
 * @package App\Models
 */
class Vuelo extends Model
{
	protected $table = 'vuelos';
	protected $primaryKey = 'id_vuelo';
	public $timestamps = false;

	protected $casts = [
		'id_empresa' => 'int',
		'num_pasajeros' => 'int',
		'num_asientos' => 'int',
		'check_in' => 'int',
		'fechayHora' => 'datetime',
		'id_pais' => 'int'
	];

	protected $fillable = [
		'id_empresa',
		'num_pasajeros',
		'num_asientos',
		'check_in',
		'fechayHora',
		'id_pais'
	];

	public function paise()
	{
		return $this->belongsTo(Paise::class, 'id_pais');
	}

	public function usuario_empresa()
	{
		return $this->belongsTo(UsuarioEmpresa::class, 'id_empresa');
	}

	public function billetes()
	{
		return $this->hasMany(Billete::class, 'id_vuelo');
	}

	public function valoracion_vuelos()
	{
		return $this->hasMany(ValoracionVuelo::class, 'id_vuelo');
	}
}
