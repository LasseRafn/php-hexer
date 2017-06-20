<?php

namespace LasseRafn\Hexer;

class HexParser
{
    /**
     * @param string $hex
     *
     * @return mixed|string
     */
    public function parse($hex)
    {
        $hex = str_replace('#', '', $hex);
        $hex = strtolower($hex);

        if (strlen($hex) === 3) {
            $hex = str_repeat(substr($hex, 0, 1), 2).str_repeat(substr($hex, 1, 1), 2).str_repeat(substr($hex, 2, 1), 2);
        }

        return $hex;
    }
}
