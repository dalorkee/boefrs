<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
	protected $table = 'patient';
	protected $fillable = [
		'titleNameInput',
		'otherTitleNameInput',
		'firstNameInput',
		'lastNameInput',
		'hnInput',
		'anInput'
	];
}
