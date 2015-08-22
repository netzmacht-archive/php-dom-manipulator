<?php

/**
 * @package    contribute
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\DomManipulator;

/**
 * Class DomManipulator is a rule based dom manipulator.
 *
 * @package Netzmacht\Contao\DomManipulator
 */
class DomManipulator
{
    /**
     * Html to DOM converter.
     *
     * @var ConverterInterface
     */
    private $converter;

    /**
     * Set of dom manipulation rules.
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
     * Construct.
     *
     * @param ConverterInterface    $converter  Html to dom converter.
     * @param array|RuleInterface[] $rules      Rules.
     * @param bool                  $silentMode Set silent mode.
     *
     * @internal param string $encoding Charset encoding.
     */
    public function __construct(ConverterInterface $converter, array $rules = array(), $silentMode = false)
    {
        $this->addRules($rules);
        $this->setSilentMode($silentMode);

        $this->converter = $converter;
    }

    /**
     * Get converter.
     *
     * @return ConverterInterface
     */
    public function getConverter()
    {
        return $this->converter;
    }

    /**
     * Get the dom document.
     *
     * @return \DOMDocument
     */
    public function getDocument()
    {
        return $this->document;
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
     * @param array|RuleInterface[] $rules Rules.
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
     * Get all rules.
     *
     * @return RuleInterface[]
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * Load html into the manipulator.
     *
     * @param string      $buffer  HTML buffer.
     * @param string|bool $charset Encoding Charset. If false encoding is ignored. If not set the dom charset is used.
     *
     * @return $this
     */
    public function loadHtml($buffer, $charset = 'UTF-8')
    {
        $this->document = $this->converter->parseHtml($buffer, $charset);

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
     * @return $this
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
    }

    /**
     * Get the html.
     *
     * @return string
     */
    public function getHtml()
    {
        return $this->converter->toHtml($this->document);
    }
}
