<?php

namespace Tesla\OIB;

class OIB
{
    /**
     * @param string $oib
     * @return bool
     */
    public static function validate(string $oib): bool
    {
        if (!self::isValidLength($oib)) {
            return false;
        }

        $oib = self::clean($oib);

        if (!self::isValidLength($oib)) {
            return false;
        }

        return self::check($oib);
    }

    /**
     * @param mixed ...$oibs
     * @return array
     */
    public static function validateMany(...$oibs): array
    {
        $oibsData = self::flatten($oibs);
        $oibs = [];
        foreach ($oibsData as $oib) {
            $oibs[$oib] = self::validate($oib);
        }

        return $oibs;
    }

    /**
     * @param string $oib
     * @return bool
     */
    public static function isValidLength(string $oib): bool
    {
        return mb_strlen($oib) === 11;
    }

    /**
     * @param string $oib
     * @return string
     */
    protected static function clean(string $oib): string
    {
        $oib = trim($oib);
        preg_match_all('!\d+!', $oib, $matches);
        $numbers = $matches[0];

        return implode('', $numbers);
    }

    /**
     * @param string $oib
     * @return bool
     */
    protected static function check(string $oib): bool
    {
        $leftover = 10;
        for ($i = 0; $i < 10; $i++) {
            $currentDigit = (int)$oib[$i];
            $sum = $currentDigit + $leftover;

            $tmpLeftover = $sum % 10;
            if ($tmpLeftover === 0) {
                $tmpLeftover = 10;
            }

            $mul = $tmpLeftover * 2;
            $leftover = $mul % 11;
        }

        if ($leftover === 1) {
            $controlDigit = 0;
        } else {
            $controlDigit = 11 - $leftover;
        }

        if (((int)$oib[10]) === $controlDigit) {
            return true;
        }

        return false;
    }

    /**
     * @param array $array
     * @param $depth
     * @return array
     */
    public static function flatten(array $array, $depth = INF): array
    {
        $result = [];
        foreach ($array as $item) {
            if (!is_array($item)) {
                $result[] = $item;
            } else {
                $values = $depth === 1
                    ? array_values($item)
                    : self::flatten($item, $depth - 1);

                foreach ($values as $value) {
                    $result[] = $value;
                }
            }
        }

        return $result;
    }
}
