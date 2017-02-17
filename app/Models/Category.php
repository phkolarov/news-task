<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 17 Feb 2017 13:49:07 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Category
 * 
 * @property int $id
 * @property string $name
 * 
 * @property \Illuminate\Database\Eloquent\Collection $articles
 *
 * @package App\Models
 */
class Category extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function articles()
	{
		return $this->hasMany(\App\Models\Article::class);
	}
}
