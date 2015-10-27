<?php

namespace Api\Transformers;

use App\Cat;
use League\Fractal\TransformerAbstract;

class CatTransformer extends TransformerAbstract
{
	public function transform(Cat $cat)
	{
		return [
			'id' 	=> (int) $cat->id,
			'name'  => $cat->name,
			'age'	=> (int) $cat->age
		];
	}
}