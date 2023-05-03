<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Paise
 * 
 * @property int $id_pais
 * @property string|null $nombre
 * @property string|null $capital
 * @property string|null $aeropuerto
 * 
 * @property Collection|PrecioBillete[] $precio_billetes
 * @property Collection|Vuelo[] $vuelos
 *
 * @package App\Models
 */
class Paise extends Model
{
	protected $table = 'paises';
	protected $primaryKey = 'id_pais';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_pais' => 'int'
	];

	protected $fillable = [
		'nombre',
		'capital',
		'aeropuerto'
	];

	public function precio_billetes()
	{
		return $this->hasMany(PrecioBillete::class, 'id_pais');
	}

	public function vuelos()
	{
		return $this->hasMany(Vuelo::class, 'id_pais');
	}
}
