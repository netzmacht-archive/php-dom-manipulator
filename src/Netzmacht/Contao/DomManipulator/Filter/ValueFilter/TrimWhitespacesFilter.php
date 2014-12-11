<?php

/**
 * @package    contribute
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Contao\DomManipulator\Filter\ValueFilter;

use Netzmacht\Contao\DomManipulator\Filter\ValueFilterInterface;

class TrimWhitespacesFilter implements ValueFilterInterface
{
    /**
     * {@inheritdoc}
     */
    public function filter($value)
    {
        return trim(preg_replace('/\s+/',  ' ', $value));
    }
}
