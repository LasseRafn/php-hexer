<?php

namespace LasseRafn\Hexer;

use LasseRafn\Hexer\Exceptions\HexTooLongException;
use LasseRafn\Hexer\Exceptions\HexTooShortException;
use LasseRafn\Hexer\Exceptions\PercentageTooHighException;
use LasseRafn\Hexer\Exceptions\PercentageTooLowException;

class Hex
{
    private $hex;
    private $brightnessModifier;

    const HEX_MIN_LENGTH = 3;
    const HEX_MAX_LENGTH = 6;

    public function __construct($hex)
    {
        $this->hex = $hex;
        $this->brightnessModifier = new HexBrightnessModifier();

        $this->validateHex();
    }

    /**
     * @param int $percentage
     *
     * @return string
     */
    public function lighten($percentage = 0)
    {
        $this->validatePercentage($percentage);

        if ($percentage === 0) {
            return $this->hex;
        }

        return $this->brightnessModifier->adjustBrightness($this->hex, $percentage);
    }

    /**
     * @param int $percentage
     *
     * @return string
     */
    public function darken($percentage = 0)
    {
        $this->validatePercentage($percentage);

        if ($percentage === 0) {
            return $this->hex;
        }

        return $this->brightnessModifier->adjustBrightness($this->hex, $percentage * -1);
    }

    private function validatePercentage($percentage)
    {
        if ($percentage < 0) {
            throw new PercentageTooLowException("The percentage ({$percentage}) is below zero (0)");
        }

        if ($percentage > 100) {
            throw new PercentageTooHighException("The percentage ({$percentage}) is above 100");
        }
    }

    private function validateHex()
    {
        $hex = str_replace('#', '', $this->hex);

        if (strlen($hex) < self::HEX_MIN_LENGTH) {
            throw new HexTooShortException("The hex ({$hex}) was too short. Minimum length is: ".self::HEX_MIN_LENGTH.' characters, without hashtag.');
        }

        if (strlen($hex) > self::HEX_MAX_LENGTH) {
            throw new HexTooLongException("The hex ({$hex}) was too long. Maximum length is: ".self::HEX_MAX_LENGTH.' characters, without hashtag.');
        }
    }
}
