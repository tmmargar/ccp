<?php

/**
 * Smarty Method GetConfigVariable
 *
 * Smarty::getConfigVariable() method
 *
 * @package    Smarty
 * @subpackage PluginsInternal
 * @author     Uwe Tews
 */
class Smarty_Internal_Method_GetConfigVariable
{
    /**
     * Valid for all objects
     *
     * @var int
     */
    public $objMap = 7;

    /**
     * gets  a config variable value
     *
     * @param \Smarty|\Smarty_Internal_Data|\Smarty_Internal_Template $data
     * @param string                                                  $varName the name of the config variable
     * @param bool                                                    $errorEnable
     *
     * @return NULL|string  the value of the config variable
     */
    public function getConfigVariable(Smarty_Internal_Data $data, $varName = NULL, $errorEnable = true)
    {
        return $data->ext->configLoad->_getConfigVariable($data, $varName, $errorEnable);
    }
}
