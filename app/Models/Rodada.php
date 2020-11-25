<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Rodada
 * 
 * @property int $id
 * @property int $id_partida
 * @property Carbon $inicio
 * @property Carbon|null $fim
 * @property int $id_atacante
 * @property string $t_atacante
 * @property int $id_defensor
 * @property int $t_defensor
 * @property string|null $vencedor
 * 
 * @property Collection|Partida[] $partidas
 *
 * @package App\Models
 */
class Rodada extends Model
{
	protected $table = 'rodada';
	public $timestamps = false;

	protected $casts = [
		'id_partida' => 'int',
		'id_atacante' => 'int',
		'id_defensor' => 'int',
		't_defensor' => 'int'
	];

	protected $dates = [
		'inicio',
		'fim'
	];

	protected $fillable = [
		'id_partida',
		'inicio',
		'fim',
		'id_atacante',
		't_atacante',
		'id_defensor',
		't_defensor',
		'vencedor'
	];

	public function partidas()
	{
		return $this->belongsToMany(Partida::class, 'partida_rodada', 'id_rodada', 'id_partida');
	}
}
