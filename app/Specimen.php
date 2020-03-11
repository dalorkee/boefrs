<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specimen extends Model
{
	protected $table = 'specimen';
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'ref_pt_id',
		'specimen_type_id',
		'specimen_other',
		'specimen_date',
		'ref_user_id'
	];
}
