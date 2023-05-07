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
 * @property int $id_users
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Admin extends Model
{
	protected $table = 'admin';
	protected $primaryKey = 'id_admin';
	public $timestamps = false;

	protected $casts = [
		'id_users' => 'int'
	];

	protected $fillable = [
		'id_users'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_users');
	}
}
