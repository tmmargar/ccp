<?php

/**
 * class for undefined variable object
 * This class defines an object for undefined variable handling
 *
 * @package    Smarty
 * @subpackage Template
 */
class Smarty_Undefined_Variable extends Smarty_Variable
{
    /**
     * Returns NULL for not existing properties
     *
     * @param string $name
     *
     * @return NULL
     */
    public function __get($name)
    {
        return NULL;
    }

    /**
     * Always returns an empty string.
     *
     * @return string
     */
    public function __toString()
    {
        return '';
    }
}
