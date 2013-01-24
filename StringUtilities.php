<?php

namespace SPE\StringUtilitiesBundle;

/**
 * String muveletekkel kapcsolatos fuggvenyek gyujtoosztalya
 */
class StringUtilities
{
    /**
     * Veletlen karaktersorozat letrehozasa.
     *
     * @param integer $lenght = 10
     * @param boolean $number = false
     * @param boolean $uppercase = false
     *
     * @return string
     */
    public function getRandomString( $length = 10, $number = false, $uppercase = false )
    {
        $chars = 'abcdefghijklmnopqrstuvwxyz';
        if( $uppercase ) {
            $chars .= strtoupper($chars);
        }
        if( $number ) {
            $chars .= '0123456789';
        }

        $str = '';

        for( $i = 0; $i < $length; ++$i ) {
            $str .= $chars[ mt_rand(0, strlen($chars) - 1) ];
        }

        return $str;
    }

    /**
     * Megadott stringbol lecsereli a specialis karaktereket
     * Kod nagyresze a symfony1.4-es dokumentaciojabol van.
     *
     * @param string $text
     *
     * @return string
     */
    public function slugify($text)
    {
        // transliterate
        if( class_exists('Normalizer') /* php5-intl csomaggal jon */) {
            $text = preg_replace('/\p{M}/u', '', \Normalizer::normalize($text, \Normalizer::FORM_D));
        }
        else if( function_exists('iconv') ) {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }

        // replace non letter or digits by -
        $text = preg_replace('#[^\\pL\d]+#u', '-', $text);

        // trim
        $text = trim($text, '-');

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('#[^-\w]+#', '', $text);

        return ( empty($text) )
            ? 'n-a'
            : $text
            ;
    }
}

