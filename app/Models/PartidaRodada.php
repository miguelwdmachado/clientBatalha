<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PartidaRodada
 * 
 * @property int $id_partida
 * @property int $id_rodada
 * 
 * @property Partida $partida
 * @property Rodada $rodada
 *
 * @package App\Models
 */
class PartidaRodada extends Model
{
	protected $table = 'partida_rodada';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_partida' => 'int',
		'id_rodada' => 'int'
	];

	protected $fillable = [
		'id_partida',
		'id_rodada'
	];

	public function partida()
	{
		return $this->belongsTo(Partida::class, 'id_partida');
	}

	public function rodada()
	{
		return $this->belongsTo(Rodada::class, 'id_rodada');
	}
}
