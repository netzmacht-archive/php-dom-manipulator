<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\DomManipulator\Converter;

use Masterminds\HTML5;
use Netzmacht\DomManipulator\ConverterInterface;

/**
 * Class Html5Converter uses the Masterminds html5 parser/serializer.
 *
 * It is much slower than the integrated dom converter but it handles html5 better than the dom document converter.
 *
 * @package Netzmacht\DomManipulator\Converter
 */
class Html5Converter implements ConverterInterface
{
    /**
     * @var HTML5
     */
    private $html5Parser;

    /**
     * Construct.
     *
     * @param HTML5 $html5Parser Html5 parser
     */
    function __construct(HTML5 $html5Parser)
    {
        $this->html5Parser = $html5Parser;
    }

    /**
     * {@inheritdoc}
     */
    public function parseHtml($html, $encoding = 'UTF-8')
    {
        $inputStream = new HTML5\Parser\StringInputStream($html, $encoding);

        return $this->html5Parser->parse($inputStream);
    }

    /**
     * {@inheritdoc}
     */
    public function toHtml(\DOMDocument $document, $encoding = 'UTF-8')
    {
        $this->html5Parser->saveHTML($document);
    }
}
