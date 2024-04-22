<?php declare(strict_types = 1);

namespace App\Router;

class ArrayRouterReader implements RouterReader
{

	public function readeRoute(): array
	{
		return [
			['GET', '/', ['App\Controllers\Homepage', 'show']],
            ['GET', '/blog', ['App\Controllers\BlogController', 'show']],
            ['GET', '/post/{slug}', ['App\Controllers\BlogController', 'post']],
			['GET', '/{slug}', ['App\Controllers\Page', 'show']],
		];
	}
}
