<?php

namespace SPE\StringUtilitiesBundle\Tests;

use SPE\StringUtilitiesBundle\StringUtilities;

class StringUtilitiesTest extends \PHPUnit_Framework_TestCase
{
    public function testRandomString()
    {
        $st = new StringUtilities;

        // 10 hosszu
        $str = $st->getRandomString(10);
        $this->assertEquals(10, strlen($str));

        // csak kis betuk
        $str = $st->getRandomString(19, false, false);
        $this->assertGreaterThan(0, preg_match('/^[a-z]{19}$/', $str));

        // csak kis egy nagy betuk
        $str = $st->getRandomString(18, false, true);
        $this->assertGreaterThan(0, preg_match('/^[a-zA-Z]{18}$/', $str));

        // kis, nagy betuk, szamok
        $str = $st->getRandomString(17, true, true);
        $this->assertGreaterThan(0, preg_match('/^[a-zA-Z0-9]{17}$/', $str));

        // kis betuk es szamok
        $str = $st->getRandomString(16, true, false);
        $this->assertGreaterThan(0, preg_match('/^[a-z0-9]{16}$/', $str));
    }

    public function testSlugify()
    {
        $st = new StringUtilities;

        // converts all characters to lower case
        $this->assertEquals('sensio', $st->slugify('Sensio'));

        // replaces a white space by a -
        $this->assertEquals('sensio-labs', $st->slugify('sensio-labs'));

        // replaces several white spaces by a single -
        $this->assertEquals('sensio-labs', $st->slugify('sensio   labs'));

        // removes - at the beginning of a string
        $this->assertEquals('sensio', $st->slugify('  sensio'));

        // removes - at the end of a string
        $this->assertEquals('sensio', $st->slugify('sensio  '));

        // replaces non-ASCII characters by a -
        $this->assertEquals('paris-france', $st->slugify('paris,france'));

        // converts the empty string to n-a
        $this->assertEquals('n-a', $st->slugify(''));

        // removes accents
        $this->assertEquals('developpeur-web', $st->slugify('Développeur Web'));

        // removes accents
        $this->assertEquals('ouooueauiouooueaui', $st->slugify('öüóőúéáűíÖÜÓŐÚÉÁŰÍ'));
    }
}
