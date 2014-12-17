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

use Netzmacht\DomManipulator\ConverterInterface;

/**
 * Class DomDocumentParser uses the internal DOM html loadHTML/saveHTML converting.
 *
 * @package Netzmacht\DomManipulator\Parser
 */
class DomDocumentConverter implements ConverterInterface
{
    /**
     * Dom document configuration.
     *
     * @var array
     */
    private $config = array(
        'version'             => '1.1',
        'strictErrorChecking' => false,
    );

    /**
     * Construct.
     *
     * @param array $config Additional dom document config.
     */
    public function __construct(array $config = array())
    {
        $this->config = array_merge($this->config, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function parseHtml($html, $encoding = 'UTF-8')
    {
        $document = new \DOMDocument();

        foreach ($this->config as $name => $value) {
            $document->$name = $value;
        }

        $document->encoding = $encoding;

        if ($encoding !== false) {
            // Tell the parser which charset to use
            $encoding = $encoding ?: $document->encoding;
            $encoding = '<?xml encoding="' . $encoding . '" ?>';
            $html     = $encoding . $html;

            // @codingStandardsIgnoreStart
            @$document->loadHTML($html);
            // @codingStandardsIgnoreEnd

            foreach ($document->childNodes as $item) {
                if ($item->nodeType == XML_PI_NODE) {
                    $document->removeChild($item);
                }
            }
        } else {
            // @codingStandardsIgnoreStart
            @$document->loadHTML($html);
            // @codingStandardsIgnoreEnd
        }

        return $document;
    }

    /**
     * {@inheritdoc}
     */
    public function toHtml(\DOMDocument $document, $encoding = 'UTF-8')
    {
        $html = $document->saveHTML();

        // Thanks to Tristan Lins @see http://goo.gl/3yfwMm
        $html = str_replace(
            array('%5B', '%5D', '%7B', '%7D', '%20'),
            array('[', ']', '{',   '}',   ' '),
            $html
        );
        $html = preg_replace_callback(
            '~\{%.*%\}~U',
            function ($matches) {
                return html_entity_decode($matches[0], ENT_QUOTES, 'UTF-8');
            },
            $html
        );
        $html = preg_replace_callback(
            '~##.*##~U',
            function ($matches) {
                return html_entity_decode($matches[0], ENT_QUOTES, 'UTF-8');
            },
            $html
        );

        return $html;
    }
}
