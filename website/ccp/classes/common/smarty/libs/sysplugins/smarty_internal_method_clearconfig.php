<?php

/**
 * Smarty Method ClearConfig
 *
 * Smarty::clearConfig() method
 *
 * @package    Smarty
 * @subpackage PluginsInternal
 * @author     Uwe Tews
 */
class Smarty_Internal_Method_ClearConfig
{
    /**
     * Valid for all objects
     *
     * @var int
     */
    public $objMap = 7;

    /**
     * clear a single or all config variables
     *
     * @api  Smarty::clearConfig()
     * @link https://www.smarty.net/docs/en/api.clear.config.tpl
     *
     * @param \Smarty_Internal_Data|\Smarty_Internal_Template|\Smarty $data
     * @param string|NULL                                             $name variable name or NULL
     *
     * @return \Smarty_Internal_Data|\Smarty_Internal_Template|\Smarty
     */
    public function clearConfig(Smarty_Internal_Data $data, $name = NULL)
    {
        if (isset($name)) {
            unset($data->config_vars[ $name ]);
        } else {
            $data->config_vars = array();
        }
        return $data;
    }
}
