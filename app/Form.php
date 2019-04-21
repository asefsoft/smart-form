<?php

namespace MyApp;

use Illuminate\Database\Eloquent\Model;
use MyApp\FilledForm;

class Form extends Model
{

	protected $table = 'forms';
	protected $fillable = ['title', 'questions'];

	public function filled_forms() {
	    return $this->hasMany(FilledForm::class,'form_id');
    }


}
