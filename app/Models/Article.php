<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 17 Feb 2017 13:49:07 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Article
 * 
 * @property int $id
 * @property string $title
 * @property string $content
 * @property \Carbon\Carbon $date_added
 * @property \Carbon\Carbon $date_edited
 * @property bool $posted
 * @property string $image_name
 * @property int $category_id
 * 
 * @property \App\Models\Category $category
 *
 * @package App\Models
 */
class Article extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'posted' => 'bool',
		'category_id' => 'int'
	];

	protected $dates = [
		'date_added',
		'date_edited'
	];

	protected $fillable = [
		'title',
		'content',
		'date_added',
		'date_edited',
		'posted',
		'image_name',
		'category_id'
	];

	public function category()
	{
		return $this->belongsTo(\App\Models\Category::class);
	}
}
