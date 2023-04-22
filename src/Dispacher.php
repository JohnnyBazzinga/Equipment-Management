<?php

namespace src;

class Dispacher{

	public function dispach($callback, array $params = [], $namespace = "app\\")	{	
    //print_r($callback['namespace']);
		if(is_callable($callback['callback']))		{
      
			return call_user_func_array($callback['callback'], array_values($params));
			
		} elseif (is_string($callback['callback'])) {
			
			if(!!strpos($callback['callback'], '@') !== false) {
				
				if(!empty($callback['namespace']))				{
					$namespace = $callback['namespace'];
				}

				$callback['callback'] = explode('@', $callback['callback']);

				$controller = $namespace.$callback['callback'][0];
				$method = $callback['callback'][1];

				$rc = new \ReflectionClass($controller);

				if($rc->isInstantiable() && $rc->hasMethod($method))				{
					return call_user_func_array(array(new $controller, $method), array_values($params));
					
				} else {
          
					throw new \Exception("Erro ao despachar: controller não pode ser instanciado, ou método não exite");				
				}
			}
		}else
      
		throw new \Exception("Erro ao despachar: método não implementado");
	}
}

?>