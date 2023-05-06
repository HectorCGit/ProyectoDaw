<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PrecioBillete
 * 
 * @property int $id_precio
 * @property int|null $id_empresa
 * @property int|null $id_pais
 * @property int|null $precio_niños
 * @property int|null $precio_normal
 * @property int|null $precio_mayores
 * @property int|null $id_descuento
 * 
 * @property UsuarioEmpresa|null $usuario_empresa
 * @property Paise|null $paise
 * @property Collection|Billete[] $billetes
 *
 * @package App\Models
 */
class PrecioBillete extends Model
{
	protected $table = 'precio_billete';
	protected $primaryKey = 'id_precio';
	public $timestamps = false;

	protected $casts = [
		'id_empresa' => 'int',
		'id_pais' => 'int',
		'precio_niños' => 'int',
		'precio_normal' => 'int',
		'precio_mayores' => 'int',
		'id_descuento' => 'int'
	];

	protected $fillable = [
		'id_empresa',
		'id_pais',
		'precio_niños',
		'precio_normal',
		'precio_mayores',
		'id_descuento'
	];

	public function usuario_empresa()
	{
		return $this->belongsTo(UsuarioEmpresa::class, 'id_empresa');
	}

	public function paise()
	{
		return $this->belongsTo(Paise::class, 'id_pais');
	}

	public function billetes()
	{
		return $this->hasMany(Billete::class, 'id_precio');
	}
}
