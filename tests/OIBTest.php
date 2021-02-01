<?php

use PHPUnit\Framework\TestCase;
use Tesla\OIB\OIB;

class OIBTest extends TestCase
{
    public function testValidateMany()
    {
        $invalidOibs = [
            '73963178454',
            '25878484848',
            '73963178454AA',
            '25878484848ZZ',
            '87783564545',
            '87783564545GG',
        ];
        $validOibs = [
            '78745548455',
            '12345678911',
            '91145678919',
            '87884784457',
            '87871118443',
            '36875454458',
        ];
        $oibs = [
            // FALSE
            [
                $invalidOibs[1],
                [
                    $invalidOibs[2],
                    [
                        $invalidOibs[3],
                    ],
                ],
                $invalidOibs[4],
            ],
            $invalidOibs[5],

            // TRUE
            [
                $validOibs[1],
                [
                    $validOibs[2],
                ],
                $validOibs[3],
                [
                    $validOibs[4],
                ],
                $validOibs[5],
            ],
        ];

        $validated = OIB::validateMany($invalidOibs[0], $oibs, $validOibs[0]);

        foreach ($invalidOibs as $invalidOib) {
            $this->assertFalse($validated[$invalidOib]);
        }

        foreach ($validOibs as $validOib) {
            $this->assertTrue($validated[$validOib]);
        }
    }

    public function testIsValidLength()
    {
        $this->assertFalse(OIB::isValidLength('000AA123-45AA6911AA a45'));
        $this->assertFalse(OIB::isValidLength('AA12345AA68911AA'));
        $this->assertFalse(OIB::isValidLength('12345678911A7A'));

        $this->assertTrue(OIB::isValidLength('14567891157'));
        $this->assertTrue(OIB::isValidLength('82345540611'));
        $this->assertTrue(OIB::isValidLength('12345678911'));
    }

    public function testIsValidOib()
    {
        $this->assertFalse(OIB::validate('73963178454'));
        $this->assertFalse(OIB::validate('73963178454AA'));
        $this->assertFalse(OIB::validate('87783564545'));

        $this->assertTrue(OIB::validate('12345678911'));
        $this->assertTrue(OIB::validate('87884784457'));
        $this->assertTrue(OIB::validate('36875454458'));
    }
}
