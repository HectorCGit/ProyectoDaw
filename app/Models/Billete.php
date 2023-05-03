<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Billete
 * 
 * @property int $id_billete
 * @property int|null $id_vuelo
 * @property int|null $id_pasajero
 * @property int|null $id_descuento
 * @property int|null $id_precio
 * @property int|null $check_in
 * @property int|null $num_maletas
 * 
 * @property ClientePasajero|null $cliente_pasajero
 * @property Descuento|null $descuento
 * @property PrecioBillete|null $precio_billete
 * @property Vuelo|null $vuelo
 *
 * @package App\Models
 */
class Billete extends Model
{
	protected $table = 'billetes';
	protected $primaryKey = 'id_billete';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_billete' => 'int',
		'id_vuelo' => 'int',
		'id_pasajero' => 'int',
		'id_descuento' => 'int',
		'id_precio' => 'int',
		'check_in' => 'int',
		'num_maletas' => 'int'
	];

	protected $fillable = [
		'id_vuelo',
		'id_pasajero',
		'id_descuento',
		'id_precio',
		'check_in',
		'num_maletas'
	];

	public function cliente_pasajero()
	{
		return $this->belongsTo(ClientePasajero::class, 'id_pasajero');
	}

	public function descuento()
	{
		return $this->belongsTo(Descuento::class, 'id_descuento');
	}

	public function precio_billete()
	{
		return $this->belongsTo(PrecioBillete::class, 'id_precio');
	}

	public function vuelo()
	{
		return $this->belongsTo(Vuelo::class, 'id_vuelo');
	}
}
