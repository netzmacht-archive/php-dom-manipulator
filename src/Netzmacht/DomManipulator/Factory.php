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

use Netzmacht\DomManipulator\Converter\DomDocumentConverter;

/**
 * ManipulatorFactory creates the dom manipulator.
 *
 * @package Netzmacht\Contao\DomManipulator
 */
class Factory
{
    /**
     * Create manipulator in silent mode.
     *
     * @var bool
     */
    private $silentMode = false;

    /**
     * Converter will be inject into the manipualator.
     *
     * @var ConverterInterface
     */
    private $converter;

    /**
     * Collection of rules.
     *
     * @var array
     */
    private $rules = array();

    /**
     * Add a rule to the event.
     *
     * @param RuleInterface $rule     Rule being added.
     * @param int           $priority Define a priority.
     *
     * @return $this
     */
    public function addRule(RuleInterface $rule, $priority = 0)
    {
        $this->rules[$priority][] = $rule;

        return $this;
    }

    /**
     * Add multiple rules.
     *
     * @param array|RuleInterface[] $rules    List of rules.
     * @param int                   $priority Priority is used for each rule.
     *
     * @return $this
     */
    public function addRules(array $rules, $priority = 0)
    {
        foreach ($rules as $rule) {
            $this->addRule($rule, $priority);
        }

        return $this;
    }

    /**
     * Get rules prioritized.
     *
     * @return RuleInterface[]
     */
    public function getRules()
    {
        $rules = array();

        ksort($this->rules);

        foreach ($this->rules as $prioritized) {
            $rules = array_merge($rules, $prioritized);
        }

        return $rules;
    }

    /**
     * Get the converter.
     *
     * @return ConverterInterface
     */
    public function getConverter()
    {
        if (!$this->converter) {
            $this->converter = new DomDocumentConverter();
        }

        return $this->converter;
    }

    /**
     * Set the converter.
     *
     * @param ConverterInterface $converter The converter.
     *
     * @return $this
     */
    public function setConverter(ConverterInterface $converter)
    {
        $this->converter = $converter;

        return $this;
    }

    /**
     * Check if manipulator should use silent mode.
     *
     * @return boolean
     */
    public function isSilentMode()
    {
        return $this->silentMode;
    }

    /**
     * Set the silent mode.
     *
     * @param boolean $silentMode Silent mode.
     *
     * @return $this
     */
    public function setSilentMode($silentMode)
    {
        $this->silentMode = $silentMode;

        return $this;
    }

    /**
     * Create the manipulator.
     *
     * @return DomManipulator
     */
    public function create()
    {
        return new DomManipulator($this->getConverter(), $this->getRules(), $this->silentMode);
    }
}
