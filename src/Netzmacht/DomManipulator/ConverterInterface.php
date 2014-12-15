<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\DomManipulator;

/**
 * Interface ConverterInterface describes an converter between dom document and html.
 *
 * @package Netzmacht\DomManipulator
 */
interface ConverterInterface
{
    /**
     * Parse html into a dom document.
     *
     * @param string $html     Html to get parsed.
     * @param string $encoding Encoding of html.
     *
     * @return \DOMDocument
     */
    public function parseHtml($html, $encoding = 'UTF-8');

    /**
     * Convert a dom document into html.
     *
     * @param \DOMDocument $document Dom document.
     * @param string       $encoding Output encoding.
     *
     * @return string
     */
    public function toHtml(\DOMDocument $document, $encoding = 'UTF-8');
}
