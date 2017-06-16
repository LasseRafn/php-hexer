<?php

use PHPUnit\Framework\TestCase;

class HexModifierTest extends TestCase
{
    public function test_can_darken_color()
    {
        // Regular
        $hex = new \LasseRafn\Hexer\Hex('#fff');

        $this->assertEquals('#d9d9d9', $hex->darken(15));

        // With uppercase
        $hex = new \LasseRafn\Hexer\Hex('#FFF');

        $this->assertEquals('#d9d9d9', $hex->darken(15));

        // With 6 characters
        $hex = new \LasseRafn\Hexer\Hex('#ffffff');

        $this->assertEquals('#d9d9d9', $hex->darken(15));

        // Without hashtag
        $hex = new \LasseRafn\Hexer\Hex('fff');

        $this->assertEquals('d9d9d9', $hex->darken(15));
    }

    public function test_can_lighten_color()
    {
        // Regular
        $hex = new \LasseRafn\Hexer\Hex('#333');

        $this->assertEquals('#595959', $hex->lighten(15));

        // With uppercase
        $hex = new \LasseRafn\Hexer\Hex('#333');

        $this->assertEquals('#595959', $hex->lighten(15));

        // With 6 characters
        $hex = new \LasseRafn\Hexer\Hex('#333333');

        $this->assertEquals('#595959', $hex->lighten(15));

        // Without hashtag
        $hex = new \LasseRafn\Hexer\Hex('333');

        $this->assertEquals('595959', $hex->lighten(15));
    }

    public function test_can_modify_colors_beside_black_and_white()
    {
        // Regular
        $hex = new \LasseRafn\Hexer\Hex('#ff000');

        $this->assertEquals('#ff2626', $hex->lighten(15));

        // With uppercase
        $hex = new \LasseRafn\Hexer\Hex('#5e77b0');

        $this->assertEquals('#2b447d', $hex->darken(20));

        // With large percentages
        $hex = new \LasseRafn\Hexer\Hex('21ed4a');

        $this->assertEquals('d4fffd', $hex->lighten(70));
    }

    public function test_will_fail_with_too_long_hex_input()
    {
        $this->expectException(\LasseRafn\Hexer\Exceptions\HexTooLongException::class);

        new \LasseRafn\Hexer\Hex('#fffffff');
        new \LasseRafn\Hexer\Hex('fffffff');
    }

    public function test_will_fail_with_too_short_hex_input()
    {
        $this->expectException(\LasseRafn\Hexer\Exceptions\HexTooShortException::class);

        new \LasseRafn\Hexer\Hex('#22');
        new \LasseRafn\Hexer\Hex('22');
    }

    public function test_will_fail_with_too_low_percentage_input()
    {
        $this->expectException(\LasseRafn\Hexer\Exceptions\PercentageTooLowException::class);

        $hex = new \LasseRafn\Hexer\Hex('#fff');
        $hex->lighten(-10);
    }

    public function test_will_fail_with_too_high_percentage_input()
    {
        $this->expectException(\LasseRafn\Hexer\Exceptions\PercentageTooHighException::class);

        $hex = new \LasseRafn\Hexer\Hex('#fff');
        $hex->lighten(101);
    }

    public function test_will_fail_with_a_non_integer_percentage_input()
    {
        $this->expectException(\LasseRafn\Hexer\Exceptions\PercentageIsNotAnInteger::class);

        $hex = new \LasseRafn\Hexer\Hex('#fff');
        $hex->lighten('ab12');
    }

    public function test_will_return_initial_hex_with_zero_percentage()
    {
        $hex = new \LasseRafn\Hexer\Hex('#fff');

        $this->assertEquals('#fff', $hex->lighten());
        $this->assertEquals('#fff', $hex->darken());
    }
}
