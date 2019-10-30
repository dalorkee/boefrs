<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
	protected $table = 'patients';
	protected $primaryKey = 'id';
	protected $fillable = [
		'titleNameInput',
		'firstNameInput',
		'lastNameInput',
		'hnInput',
		'anInput'
	];
}
