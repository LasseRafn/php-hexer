<?php

namespace LasseRafn\Hexer;

class HexToRgb
{
	private $parser;

	public function __construct()
	{
		$this->parser = new HexParser;
	}

	/**
	 * @param string $hex
	 *
	 * @return array
	 */
	public function convertToRgb( $hex )
	{
		$hex = $this->parser->parse( $hex );

		return $this->generateRgb( $hex );
	}

	/**
	 * @param string $hex
	 *
	 * @return array
	 */
	private function generateRgb( $hex )
	{
		list($red, $green, $blue) = array_map('hexdec', str_split($hex, 2));

		return [
			'r' => $red,
			'g' => $green,
			'b' => $blue,
		];
	}
}
