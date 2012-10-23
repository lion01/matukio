<?php
/**
 * Matukio
 * @package Joomla!
 * @Copyright (C) 2012 - Yves Hoppe - compojoom.com
 * @All rights reserved
 * @Joomla! is Free Software
 * @Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
 * @version $Revision: 2.0.0 $
 **/

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class MatukioControllerRequests extends JController {

    public function display($cachable = false, $urlparams = false) {
        $document = JFactory::getDocument();
        //$viewType = $document->getType();
        $view = $this->getView('requests', 'raw');

        $view->display();
    }

}
