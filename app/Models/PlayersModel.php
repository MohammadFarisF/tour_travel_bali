<?php

namespace App\Models;

use CodeIgniter\Model;

class PlayersModel extends Model
{
	protected $table = 'players';
	protected $primaryKey = 'id_pemain';
	protected $returnType = 'array';
	protected $allowedFields = [
		'id_pemain',
		'nopung',
		'nama',
		'posisi',
		'kebangsaan',
		'harga_pasar',
		'bergabung',
		'status'
	];

	public function transfers()
	{
		return $this->hasMany('App\Models\TransferModel', 'id_pemain');
	}
}
