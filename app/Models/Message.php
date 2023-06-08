<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 * 
 * @property int $id_message
 * @property int|null $id_users
 * @property int|null $id_topic
 * @property string|null $content
 * @property Carbon|null $dateAndTime
 * 
 * @property User|null $user
 * @property Topic|null $topic
 *
 * @package App\Models
 */
class Message extends Model
{
	protected $table = 'messages';
	protected $primaryKey = 'id_message';
	public $timestamps = false;

	protected $casts = [
		'id_users' => 'int',
		'id_topic' => 'int',
		'dateAndTime' => 'datetime'
	];

	protected $fillable = [
		'id_users',
		'id_topic',
		'content',
		'dateAndTime'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_users');
	}

	public function topic()
	{
		return $this->belongsTo(Topic::class, 'id_topic');
	}
}
