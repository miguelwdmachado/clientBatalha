<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Partida
 * 
 * @property int $id
 * @property Carbon $inicio
 * @property Carbon|null $fim
 * @property string|null $vencedor
 * 
 * @property Collection|Rodada[] $rodadas
 *
 * @package App\Models
 */
class Partida extends Model
{
	protected $table = 'partida';
	public $timestamps = false;

	protected $dates = [
		'inicio',
		'fim'
	];

	protected $fillable = [
		'inicio',
		'fim',
		'vencedor'
	];

	public function rodadas()
	{
		return $this->belongsToMany(Rodada::class, 'partida_rodada', 'id_partida', 'id_rodada');
	}
}
