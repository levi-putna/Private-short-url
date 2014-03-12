<?php

/**
 * Opaque ID encoder.
 *
 * Translates between 32-bit integers (such as resource IDs) and obfuscated
 * scrambled values, as a one-to-one mapping. Supports hex and base64 url-safe
 * string representations. Expects a secret integer key in the constructor.
 *
 * @since   1.0.0
 * @package StructureWiki
 * @author  Levi Putna <levi.putna@gmail.com>
 */
class ObfuscationHelper {
    const KEY = 'w82QsBGiQMdua';

    /**
     * Encode a value according to the encoding mode selected upon instantiation.
     */
    static public function encode($i) {
        return self::transcode($i);
    }

    /**
     * Decode a value according to the encoding mode selected upon instantiation.
     */
    static public function decode($s) {
        return self::transcode($s);
    }

    /**
     * Produce an integer hash of a 16-bit integer, returning a transformed 16-bit integer.
     */
    static protected function transform($i) {
        $i = (self::KEY ^ $i) * 0x9e3b;
        return $i >> ($i & 0xf) & 0xffff;
    }

    /**
     * Reversibly transcode a 32-bit integer to a scrambled form, returning a new 32-bit integer.
     */
    static public function transcode($i) {
        $r = $i & 0xffff;
        $l = $i >> 16 & 0xffff ^ self::transform($r);
        return (($r ^ self::transform($l)) << 16) + $l;
    }
}
 