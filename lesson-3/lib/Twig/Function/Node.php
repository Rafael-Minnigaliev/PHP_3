<?php

/*
 * This file is part of Twig.
 *
 * (c) 2011 Fabien Potencier
 *
 * For the full copyright and license information, please templates the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Represents a templates function as a node.
 *
 * Use Twig_SimpleFunction instead.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @deprecated since 1.12 (to be removed in 2.0)
 */
class Twig_Function_Node extends Twig_Function
{
    protected $class;

    public function __construct($class, array $options = array())
    {
        parent::__construct($options);

        $this->class = $class;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function compile()
    {
    }
}
