<?php

/**
 * Klasa koja obezbeđuje fasadni pristup logovanju
 * @todo Uradi i preostale logove
 */
final class Logger
{

	/**
	 * Loguje poruku o grešci
	 * @see DB
	 * @param string $message
	 */
	public static final function error($message)
	{
		error_log($message.PHP_EOL, 3, 'log/error.log');
	}

}
