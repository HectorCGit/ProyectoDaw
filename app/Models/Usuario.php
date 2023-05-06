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
 * @property int $id_usuario
 * @property string|null $nom_usuario
 * @property string|null $email
 * @property string|null $clave
 * 
 * @property Collection|Admin[] $admins
 * @property Collection|Mensaje[] $mensajes
 * @property Collection|UsuarioEmpresa[] $usuario_empresas
 * @property Collection|UsuarioPasajero[] $usuario_pasajeros
 *
 * @package App\Models
 */
class Usuario extends Model
{
	protected $table = 'usuarios';
	protected $primaryKey = 'id_usuario';
	public $timestamps = false;

	protected $fillable = [
		'nom_usuario',
		'email',
		'clave'
	];

	public function admins()
	{
		return $this->hasMany(Admin::class, 'id_usuario');
	}

	public function mensajes()
	{
		return $this->hasMany(Mensaje::class, 'id_usuario');
	}

	public function usuario_empresas()
	{
		return $this->hasMany(UsuarioEmpresa::class, 'id_usuario');
	}

	public function usuario_pasajeros()
	{
		return $this->hasMany(UsuarioPasajero::class, 'id_usuario');
	}
}
