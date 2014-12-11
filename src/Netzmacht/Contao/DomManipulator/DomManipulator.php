<?php

/**
 * @package    contribute
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Contao\DomManipulator;

/**
 * Class DomManipulator provides an
 *
 * @package Netzmacht\Contao\DomManipulator
 */
class DomManipulator
{
    /**
     * Rules.
     *
     * @var array|RuleInterface[]
     */
    private $rules = array();

    /**
     * Dom document.
     *
     * @var \DOMDocument
     */
    private $document;

    /**
     * Silent mode will ignore exceptions caused by broken rules.
     *
     * @var bool
     */
    private $silentMode;

    /**
     * Default Dom Config.
     *
     * This property is protected so you could easily override it in a subclass.
     *
     * @var array
     */
    protected static $defaultDomConfig = array(
        'version'             => '1.1',
        'encoding'            => 'utf-8',
        'strictErrorChecking' => false,
    );

    /**
     * Construct.
     *
     * @param \DOMDocument    $document   The dom Document being manipulated.
     * @param RuleInterface[] $rules      Rules.
     * @param bool            $silentMode Set silent mode.
     *
     * @internal param string $encoding Charset encoding.
     */
    public function __construct(\DOMDocument $document, array $rules = array(), $silentMode = false)
    {
        $this->addRules($rules);
        $this->setSilentMode($silentMode);

        $this->document = $document;
    }

    /**
     *
     * @param array $domConfig
     * @param array $rules
     * @param bool  $silentMode
     *
     * @return static
     */
    public static function forNewDocument(array $domConfig = array(), array $rules = array(), $silentMode = false)
    {
        $domConfig = array_merge(static::$defaultDomConfig, $domConfig);
        $document  = new \DOMDocument();

        foreach ($domConfig as $name => $value) {
            $document->$name = $value;
        }

        return new static($document, $rules, $silentMode);
    }

    /**
     * Add new rule.
     *
     * @param RuleInterface $rule Manipulator rule.
     *
     * @return $this
     */
    public function addRule(RuleInterface $rule)
    {
        $this->rules[] = $rule;

        return $this;
    }

    /**
     * Add rules to manipulator.
     *
     * @param RuleInterface[] $rules Rules.
     *
     * @return $this
     */
    public function addRules(array $rules)
    {
        foreach ($rules as $rule) {
            $this->addRule($rule);
        }

        return $this;
    }

    /**
     * Load html into the manipulator.
     *
     * @param string      $buffer  HTML buffer.
     * @param string|bool $charset Encoding Charset. If false encoding is ignored. If not set the dom charset is used.
     *
     * @return $this
     */
    public function loadHtml($buffer, $charset = null)
    {
        if ($charset !== false) {
            // Tell the parser which charset to use
            $charset  = $charset ?: $this->document->encoding;
            $encoding = '<?xml encoding="' . $charset . '" ?>';
            $buffer   = $encoding . $buffer;

            @$this->document->loadHTML($buffer);

            foreach ($this->document->childNodes as $item) {
                if ($item->nodeType == XML_PI_NODE) {
                    $this->document->removeChild($item);
                }
            }
        } else {
            @$this->document->loadHTML($buffer);
        }

        return $this;
    }

    /**
     * Check if manipulator is in silent mode.
     *
     * @return bool
     */
    public function isSilentMode()
    {
        return $this->silentMode;
    }

    /**
     * Set silent mode.
     *
     * @param bool $silentMode Silent mode.
     *
     * @return $this
     */
    public function setSilentMode($silentMode)
    {
        $this->silentMode = (bool) $silentMode;

        return $this;
    }

    /**
     * Manipulate document.
     *
     * @throws \Exception If a broken rule is executed and silent mode is not enabled.
     *
     * @return string
     */
    public function manipulate()
    {
        foreach ($this->rules as $rule) {
            try {
                $nodeList = $rule->query($this->document);

                foreach ($nodeList as $node) {
                    $rule->apply($node);
                }
            } catch (\Exception $e) {
                if (!$this->isSilentMode()) {
                    throw $e;
                }
            }
        }

        return $this->document->saveHTML();
    }
}
