<?php

namespace LasseRafn\Hexer;

use LasseRafn\Hexer\Exceptions\HexTooLongException;
use LasseRafn\Hexer\Exceptions\HexTooShortException;
use LasseRafn\Hexer\Exceptions\PercentageIsNotAnInteger;
use LasseRafn\Hexer\Exceptions\PercentageTooHighException;
use LasseRafn\Hexer\Exceptions\PercentageTooLowException;

class Hex
{
	private $hex;
	private $brightnessModifier;
	private $rgbConverter;

	const HEX_MIN_LENGTH = 3;
	const HEX_MAX_LENGTH = 6;

	public function __construct( $hex )
	{
		$this->hex                = $hex;
		$this->brightnessModifier = new HexBrightnessModifier;
		$this->rgbConverter       = new HexToRgb;

		$this->validateHex();
	}

	public function __toString()
	{
		return (string) $this->hex;
	}

	/**
	 * @param int $percentage
	 *
	 * @return static
	 */
	public function lighten( $percentage = 0 )
	{
		$this->validatePercentage( $percentage );

		if ( $percentage === 0 )
		{
			return new static($this->hex);
		}

		return new static($this->brightnessModifier->adjustBrightness( $this->hex, $percentage ));
	}

	/**
	 * @param int $percentage
	 *
	 * @return static
	 */
	public function darken( $percentage = 0 )
	{
		$this->validatePercentage( $percentage );

		if ( $percentage === 0 )
		{
			return new static( $this->hex );
		}

		return new static( $this->brightnessModifier->adjustBrightness( $this->hex, $percentage * -1 ) );
	}

	/**
	 * @return array
	 */
	public function toRgb()
	{
		return $this->rgbConverter->convertToRgb( $this->hex );
	}

	/**
	 * @param integer $percentage
	 *
	 * @throws PercentageTooHighException
	 * @throws PercentageTooLowException
	 * @throws PercentageIsNotAnInteger
	 */
	private function validatePercentage( $percentage )
	{
		if ( ! is_int( $percentage ) )
		{
			throw new PercentageIsNotAnInteger( "The percentage ({$percentage}) is not an integer." );
		}

		if ( $percentage < 0 )
		{
			throw new PercentageTooLowException( "The percentage ({$percentage}) is below zero (0)" );
		}

		if ( $percentage > 100 )
		{
			throw new PercentageTooHighException( "The percentage ({$percentage}) is above 100" );
		}
	}

	/**
	 * @throws HexTooLongException
	 * @throws HexTooShortException
	 */
	private function validateHex()
	{
		$hex = str_replace( '#', '', $this->hex );

		if ( strlen( $hex ) < self::HEX_MIN_LENGTH )
		{
			throw new HexTooShortException( "The hex ({$hex}) was too short. Minimum length is: " . self::HEX_MIN_LENGTH . ' characters, without hashtag.' );
		}

		if ( strlen( $hex ) > self::HEX_MAX_LENGTH )
		{
			throw new HexTooLongException( "The hex ({$hex}) was too long. Maximum length is: " . self::HEX_MAX_LENGTH . ' characters, without hashtag.' );
		}
	}
}
