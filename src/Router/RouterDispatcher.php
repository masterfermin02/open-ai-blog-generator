<?php declare(strict_types = 1);


namespace App\Router;

use \FastRoute\Dispatcher;
use \Auryn\Injector;


class RouterDispatcher implements RouteDispatcherInterface {

	protected $dispatchers = [
		Dispatcher::NOT_FOUND          => NoFoundDispatcher::class,
		Dispatcher::METHOD_NOT_ALLOWED => MethodNotAllowedDispatcher::class,
		Dispatcher::FOUND              => FoundDispatcher::class,
	];

	protected $dispatchIndex;
	protected $routeInfo;
	protected $injector;

	public function __construct(array $routeInfo, Injector $injector)
	{
		list($index) = $routeInfo;
		$this->dispatchIndex = $index;
		$this->routeInfo    = $routeInfo;
		$this->injector     = $injector;
	}

	public function dispatch(): void
	{
		$this->injector->make($this->dispatchers[$this->dispatchIndex])->dispatch();
	}

}
