<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Usuario
 * 
 * @property int $Id_usuario
 * @property string|null $nom_usuario
 * @property string|null $Clave
 * 
 * @property Collection|Admin[] $admins
 * @property Collection|ClienteEmpresa[] $cliente_empresas
 * @property Collection|ClientePasajero[] $cliente_pasajeros
 * @property Collection|Mensaje[] $mensajes
 *
 * @package App\Models
 */
class Usuario extends Model
{
	protected $table = 'usuarios';
	protected $primaryKey = 'Id_usuario';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Id_usuario' => 'int'
	];

	protected $fillable = [
		'nom_usuario',
		'Clave'
	];

	public function admins()
	{
		return $this->hasMany(Admin::class, 'id_usuario');
	}

	public function cliente_empresas()
	{
		return $this->hasMany(ClienteEmpresa::class, 'id_usuario');
	}

	public function cliente_pasajeros()
	{
		return $this->hasMany(ClientePasajero::class, 'id_usuario');
	}

	public function mensajes()
	{
		return $this->hasMany(Mensaje::class, 'id_usuario');
	}
}
