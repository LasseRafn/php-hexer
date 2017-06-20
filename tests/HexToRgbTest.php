<?php

use PHPUnit\Framework\TestCase;

class HexToRgbTest extends TestCase
{
    public function test_can_convert_to_rgb() {
    	// Black
	    $hex = new \LasseRafn\Hexer\Hex('#000');

	    $this->assertEquals([
	    	'r' => 0,
	        'g' => 0,
	        'b' => 0
	    ], $hex->toRgb());

	    // White
	    $hex = new \LasseRafn\Hexer\Hex('#fff');

	    $this->assertEquals([
	    	'r' => 255,
	        'g' => 255,
	        'b' => 255
	    ], $hex->toRgb());

	    // 6 chars
	    $hex = new \LasseRafn\Hexer\Hex('#ff000');

	    $this->assertEquals([
	    	'r' => 255,
	        'g' => 0,
	        'b' => 0
	    ], $hex->toRgb());

	    // No hashtag
	    $hex = new \LasseRafn\Hexer\Hex('007F00');

	    $this->assertEquals([
	    	'r' => 0,
	        'g' => 127,
	        'b' => 0
	    ], $hex->toRgb());

	    // With brightness modified
	    $hex = new \LasseRafn\Hexer\Hex('007F00');

	    $this->assertEquals([
	    	'r' => 128,
	        'g' => 255,
	        'b' => 128
	    ], $hex->lighten(50)->toRgb());
    }
}
