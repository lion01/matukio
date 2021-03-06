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

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

class MatukioViewParticipants extends JViewLegacy {

    public function display($tpl = NULL) {

        $art = JFactory::getApplication()->input->getInt('art', 0);
        $cid = JFactory::getApplication()->input->getInt('cid', 0);

        if(empty($cid)){
            JError::raiseError('404', "COM_MATUKIO_NO_ID");
            return;
        }

        $database = JFactory::getDBO();
        $dateid = JFactory::getApplication()->input->getInt('dateid', 1);
        $catid = JFactory::getApplication()->input->getInt('catid', 0);
        $search = JFactory::getApplication()->input->get('search', '');
        $limit = JFactory::getApplication()->input->getInt('limit', 5);
        $limitstart = JFactory::getApplication()->input->getInt('limitstart', 0);
        $cid = JFactory::getApplication()->input->getInt('cid', 0);

        $kurs = JTable::getInstance('matukio', 'Table');
        $kurs->load($cid);

        //echo $art;
        if ($art == 0) {
            $anztyp = array(JTEXT::_('COM_MATUKIO_EVENTS'), 0);
        } elseif ($art == 1) {
            $anztyp = array(JTEXT::_('COM_MATUKIO_MY_BOOKINGS'), 1);
        } elseif ($art == 2) {
            $anztyp = array(JTEXT::_('COM_MATUKIO_MY_OFFERS'), 2);
        } else if ($art == 3) {
            $anztyp = array(JTEXT::_('COM_MATUKIO_MY_OFFERS'), 3);
        }

        $database->setQuery("SELECT a.*, cc.*, a.id AS sid, a.name AS aname, a.email AS aemail FROM #__matukio_bookings
                AS a LEFT JOIN #__users AS cc ON cc.id = a.userid WHERE a.semid = '" . $kurs->id . "' ORDER BY a.id");
        $rows = $database->loadObjectList();

        if ($database->getErrorNum()) {
            echo $database->stderr();
            return false;
        }
        MatukioHelperUtilsBasic::expandPathway($anztyp[0], JRoute::_("index.php?option=com_matukio&art=" . $art));//"javascript:semauf(" . $anztyp[1] . ",'','');");
        MatukioHelperUtilsBasic::expandPathway($kurs->title, "");

        //HTML_FrontMatukio::sem_g010($art, $rows, $search, $limit, $limitstart, $kurs, $catid, $dateid);

        $this->rows = $rows;
        $this->art = $art;
        $this->search = $search;
        $this->limit = $limit;
        $this->limitstart = $limitstart;
        $this->kurs = $kurs;
        $this->catid = $catid;
        $this->dateid = $dateid;

        parent::display($tpl);
    }
}