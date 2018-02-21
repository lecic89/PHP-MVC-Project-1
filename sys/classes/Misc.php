<?php

/**
 * Klasa Misc je klasa sa metodima opste namene.
 */
final class Misc
{

	/**
	 * Pomoćna funkcija za rad sa stringovima
	 * @param string $haystack
	 * @param string $needle
	 * @return TRUE|FALSE
	 */
	public static final function startsWith($haystack, $needle)
	{
		return $needle === '' || strrpos($haystack, $needle, -strlen($haystack)) !== false;
	}

	/**
	 * Pomoćna funkcija za rad sa stringovima
	 * @param string $haystack
	 * @param string $needle
	 * @return TRUE|FALSE
	 */
	public static final function endsWith($haystack, $needle)
	{
		return $needle === '' || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
	}

}
