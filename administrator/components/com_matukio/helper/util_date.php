<?php
/**
 * Matukio
 * @package Joomla!
 * @Copyright (C) 2012 - Yves Hoppe - compojoom.com
 * @All rights reserved
 * @Joomla! is Free Software
 * @Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
 * @version $Revision: 1.0.0 $
 **/

defined( '_JEXEC' ) or die ( 'Restricted access' );

class MatukioHelperUtilsDate
{

    /**
     * @static
     * @return mixed
     */

    public static function getCurrentDate()
    {

        $app = JFactory::getApplication();
        $offset = $app->getCfg('offset');
        $date = JFactory::getDate();
        $date->setOffset($offset);
        return $date->toformat();
    }
}