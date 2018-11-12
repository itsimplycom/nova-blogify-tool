<?php
/**
 * Created by PhpStorm.
 * User: ngi
 * Date: 30/10/2018
 * Time: 10:07
 */

namespace Its\NovaBlogifyTool\Traits;


use Illuminate\Support\Str;

trait BlogifyResource {

	/**
	 * Get the displayable label of the resource.
	 *
	 * @return string
	 */
	public static function label()
	{
		return trim(implode(" ", preg_split('/(?=[A-Z])/', Str::plural(class_basename(get_called_class())))));
	}

}