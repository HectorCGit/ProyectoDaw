<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Topic
 * 
 * @property int $id_topic
 * @property Carbon|null $dateAndTime
 * @property string|null $content
 * 
 * @property Collection|Message[] $messages
 *
 * @package App\Models
 */
class Topic extends Model
{
	protected $table = 'topics';
	protected $primaryKey = 'id_topic';
	public $timestamps = false;

	protected $casts = [
		'dateAndTime' => 'datetime'
	];

	protected $fillable = [
		'dateAndTime',
		'content'
	];

	public function messages()
	{
		return $this->hasMany(Message::class, 'id_topic');
	}
}
