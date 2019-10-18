<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
	protected $table = 'patients';
	protected $fillable = [
		'titleNameInput',
		'firstNameInput',
		'lastNameInput',
		'hnInput',
		'anInput'
	];
}
