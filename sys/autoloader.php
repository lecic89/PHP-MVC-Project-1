<?php

spl_autoload_register(function($c)
{
	if (in_array($c, [
				'AdminAuthController',
				'AuthController',
				'Controller',
				'DB',
				'Hash',
				'Http',
				'Logger',
				'Misc',
				'Model',
				'ModelInterface',
				'Redirect',
				'RegExConstants',
				'RegExHelper',
				'Sanitize',
				'Session'
			]))
	{
		require_once 'sys/classes/'.$c.'.php';
	}
	elseif (preg_match('|^([A-Z][a-z]+)+Controller$|', $c))
	{
		require_once 'app/controllers/'.$c.'.php';
	}
	elseif (preg_match('|^([A-Z][a-z]+)+Model$|', $c))
	{
		require_once 'app/models/'.$c.'.php';
	}
	elseif ($c === 'Config')
	{
		require_once $c.'.php';
	}
});
