<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Admin
 * 
 * @property int $id_admin
 * @property int|null $id_usuario
 * 
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class Admin extends Model
{
	protected $table = 'admin';
	protected $primaryKey = 'id_admin';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_admin' => 'int',
		'id_usuario' => 'int'
	];

	protected $fillable = [
		'id_usuario'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'id_usuario');
	}
}
