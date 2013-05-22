<?php

namespace SPE\StringUtilitiesBundle\Tests;

use SPE\StringUtilitiesBundle\StringUtilities;

class StringUtilitiesTest extends \PHPUnit_Framework_TestCase
{
    protected $st;

    protected function setUp()
    {
        $this->st = new StringUtilities();
    }

    protected function checkSlug($slug, $str)
    {
        $this->assertEquals($slug, $this->st->slugify($str));
    }


    public function testRandomString()
    {
        // 10 hosszu
        $str = $this->st->getRandomString(10);
        $this->assertEquals(10, strlen($str));

        // csak kis betuk
        $str = $this->st->getRandomString(19, false, false);
        $this->assertGreaterThan(0, preg_match('/^[a-z]{19}$/', $str));

        // csak kis egy nagy betuk
        $str = $this->st->getRandomString(18, false, true);
        $this->assertGreaterThan(0, preg_match('/^[a-zA-Z]{18}$/', $str));

        // kis, nagy betuk, szamok
        $str = $this->st->getRandomString(17, true, true);
        $this->assertGreaterThan(0, preg_match('/^[a-zA-Z0-9]{17}$/', $str));

        // kis betuk es szamok
        $str = $this->st->getRandomString(16, true, false);
        $this->assertGreaterThan(0, preg_match('/^[a-z0-9]{16}$/', $str));
    }

    public function testSlugify()
    {
        // converts all characters to lower case
        $this->checkSlug('sensio', 'Sensio');

        // replaces a white space by a -
        $this->checkSlug('sensio-labs', 'sensio labs');

        // replaces several white spaces by a single -
        $this->checkSlug('sensio-labs', 'sensio   labs');

        // removes - at the beginning of a string
        $this->checkSlug('sensio', '  sensio');

        // removes - at the end of a string
        $this->checkSlug('sensio', 'sensio  ');

        // replaces non-ASCII characters by a -
        $this->checkSlug('paris-france', 'paris,france');

        // converts the empty string to n-a
        $this->checkSlug('n-a', '');

        // removes accents
        $this->checkSlug('developpeur-web', 'Développeur Web');

        // removes accents
        $this->checkSlug('ouooueauiouooueaui', 'öüóőúéáűíÖÜÓŐÚÉÁŰÍ');
    }
}
