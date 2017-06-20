<?php

namespace LasseRafn\Hexer;

class HexBrightnessModifier
{
    const STEPS = 255;
    const STEPS_MAX = 255;
    const STEPS_MIN = -255;

    private $hadHashtag = false;
	private $parser;

	public function __construct()
	{
		$this->parser = new HexParser;
	}

	/**
     * @param string $hex
     * @param int    $percentage
     *
     * @return string
     */
    public function adjustBrightness($hex, $percentage)
    {
        $steps = $this->generateSteps($percentage);

	    $this->hadHashtag = $hex[0] === '#';

	    $hex = $this->parser->parse($hex);
        $hex = $this->adjustHex($hex, $steps);

        // Append hashtag if was inputted with a hashtag
        if ($this->hadHashtag) {
            $hex = "#{$hex}";
        }

        return $hex;
    }

    /**
     * @param int $percentage
     *
     * @return int
     */
    private function generateSteps($percentage)
    {
        $steps = (int) round(($percentage / 100) * self::STEPS);
        $steps = max(self::STEPS_MIN, min(self::STEPS_MAX, $steps));

        return $steps;
    }

    /**
     * @param string $hex
     * @param int    $steps
     *
     * @return string
     */
    private function adjustHex($hex, $steps)
    {
        $return = '';
        $parts = str_split($hex, 2);

        foreach ($parts as $color) {
            $color = hexdec($color);
            $color = max(0, min(255, $color + $steps));

            $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT);
        }

        $return = strtolower($return);

        return $return;
    }
}
