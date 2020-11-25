<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Dado
 * 
 * @property int $id
 * @property string $codigo
 * @property int $inicial
 * @property int $final
 *
 * @package App\Models
 */
class Dado extends Model
{
	protected $table = 'dado';
	public $timestamps = false;

	protected $casts = [
		'inicial' => 'int',
		'final' => 'int'
	];

	protected $fillable = [
		'codigo',
		'inicial',
		'final'
	];
}
