<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Humano
 * 
 * @property int $id
 * @property int $vida
 * @property int $forca
 * @property int $ataque
 * @property int $defesa
 * @property int $agilidade
 *
 * @package App\Models
 */
class Humano extends Model
{
	protected $table = 'humano';
	public $timestamps = false;

	protected $casts = [
		'vida' => 'int',
		'forca' => 'int',
		'ataque' => 'int',
		'defesa' => 'int',
		'agilidade' => 'int'
	];

	protected $fillable = [
		'vida',
		'forca',
		'ataque',
		'defesa',
		'agilidade'
	];
}
