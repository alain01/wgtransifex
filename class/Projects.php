<?php

namespace XoopsModules\Wgtransifex;

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgTransifex module for xoops
 *
 * @copyright     2020 XOOPS Project (https://xooops.org)
 * @license        GPL 2.0 or later
 * @package        wgtransifex
 * @since          1.0
 * @min_xoops      2.5.9
 * @author         TDM XOOPS - Email:<info@email.com> - Website:<http://xoops.org>
 */

use XoopsModules\Wgtransifex;

defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object Projects
 */
class Projects extends \XoopsObject
{
	/**
	 * Constructor 
	 *
	 * @param null
	 */
	public function __construct()
	{
		$this->initVar('pro_id', XOBJ_DTYPE_INT);
		$this->initVar('pro_description', XOBJ_DTYPE_TXTBOX);
		$this->initVar('pro_source_language_code', XOBJ_DTYPE_TXTBOX);
		$this->initVar('pro_slug', XOBJ_DTYPE_TXTBOX);
		$this->initVar('pro_name', XOBJ_DTYPE_TXTBOX);
		$this->initVar('pro_resources', XOBJ_DTYPE_INT);
        $this->initVar('pro_translations', XOBJ_DTYPE_INT);
        $this->initVar('pro_date', XOBJ_DTYPE_INT);
		$this->initVar('pro_submitter', XOBJ_DTYPE_INT);
		$this->initVar('pro_status', XOBJ_DTYPE_INT);
	}

	/**
	 * @static function &getInstance
	 *
	 * @param null
	 */
	public static function getInstance()
	{
		static $instance = false;
		if (!$instance) {
			$instance = new self();
		}
	}

	/**
	 * The new inserted $Id
	 * @return inserted id
	 */
	public function getNewInsertedIdProjects()
	{
		$newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
		return $newInsertedId;
	}

	/**
	 * @public function getForm
	 * @param bool $action
	 * @return \XoopsThemeForm
	 */
	public function getFormProjects($action = false)
	{
		if (false === $action) {
			$action = $_SERVER['REQUEST_URI'];
		}
		// Title
		$title = $this->isNew() ? sprintf(_AM_WGTRANSIFEX_PROJECT_ADD) : sprintf(_AM_WGTRANSIFEX_PROJECT_EDIT);
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		// Form Text proDescription
		$form->addElement(new \XoopsFormText( _AM_WGTRANSIFEX_PROJECT_DESCRIPTION, 'pro_description', 50, 255, $this->getVar('pro_description') ) );
		// Form Text proSource_language_code
		$form->addElement(new \XoopsFormText( _AM_WGTRANSIFEX_PROJECT_SOURCE_LANGUAGE_CODE, 'pro_source_language_code', 50, 255, $this->getVar('pro_source_language_code') ) );
		// Form Text proSlug
		$form->addElement(new \XoopsFormText( _AM_WGTRANSIFEX_PROJECT_SLUG, 'pro_slug', 50, 255, $this->getVar('pro_slug') ) );
		// Form Text proName
		$form->addElement(new \XoopsFormText( _AM_WGTRANSIFEX_PROJECT_NAME, 'pro_name', 50, 255, $this->getVar('pro_name') ) );
		// Form Select Status proStatus
		$proStatusSelect = new \XoopsFormSelect( _AM_WGTRANSIFEX_PROJECT_STATUS, 'pro_status', $this->getVar('pro_status'));
		$proStatusSelect->addOption(Constants::STATUS_NONE, _AM_WGTRANSIFEX_STATUS_NONE);
		$proStatusSelect->addOption(Constants::STATUS_OFFLINE, _AM_WGTRANSIFEX_STATUS_OFFLINE);
		$proStatusSelect->addOption(Constants::STATUS_SUBMITTED, _AM_WGTRANSIFEX_STATUS_SUBMITTED);
		$proStatusSelect->addOption(Constants::STATUS_BROKEN, _AM_WGTRANSIFEX_STATUS_BROKEN);
        $proStatusSelect->addOption(Constants::STATUS_READTX, _AM_WGTRANSIFEX_STATUS_READTX);
		$form->addElement($proStatusSelect );
        // Form Text proResources
        $form->addElement(new \XoopsFormText( _AM_WGTRANSIFEX_RESOURCES_NB, 'pro_resources', 50, 255, $this->getVar('pro_resources') ) );
        // Form Text proTranslations
        $form->addElement(new \XoopsFormText( _AM_WGTRANSIFEX_TRANSLATIONS_NB, 'pro_translations', 50, 255, $this->getVar('pro_translations') ) );
		// Form Text Date Select proDate
		$proDate = $this->isNew() ? 0 : $this->getVar('pro_date');
		$form->addElement(new \XoopsFormDateTime( _AM_WGTRANSIFEX_PROJECT_DATE, 'pro_date', '', $proDate ) );
		// Form Select User proSubmitter
		$form->addElement(new \XoopsFormSelectUser( _AM_WGTRANSIFEX_PROJECT_SUBMITTER, 'pro_submitter', false, $this->getVar('pro_submitter') ) );
		// To Save
		$form->addElement(new \XoopsFormHidden('op', 'save'));
		$form->addElement(new \XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));
		return $form;
	}

	/**
	 * Get Values
	 * @param null $keys 
	 * @param null $format 
	 * @param null$maxDepth 
	 * @return array
	 */
	public function getValuesProjects($keys = null, $format = null, $maxDepth = null)
	{
		$ret = $this->getValues($keys, $format, $maxDepth);
		$ret['id']                   = $this->getVar('pro_id');
		$ret['description']          = $this->getVar('pro_description');
		$ret['source_language_code'] = $this->getVar('pro_source_language_code');
		$ret['slug']                 = $this->getVar('pro_slug');
		$ret['name']                 = $this->getVar('pro_name');
        $ret['resources']            = $this->getVar('pro_resources');
        $ret['translations']         = $this->getVar('pro_translations');
		$ret['date']                 = formatTimeStamp($this->getVar('pro_date'), 'm');
		$ret['submitter']            = \XoopsUser::getUnameFromId($this->getVar('pro_submitter'));
		$status                      = $this->getVar('pro_status');
		$ret['status']               = $status;
		switch($status) {
			case Constants::STATUS_NONE:
			default:
				$status_text = _AM_WGTRANSIFEX_STATUS_NONE;
			break;
			case Constants::STATUS_OFFLINE:
				$status_text = _AM_WGTRANSIFEX_STATUS_OFFLINE;
			break;
			case Constants::STATUS_SUBMITTED:
				$status_text = _AM_WGTRANSIFEX_STATUS_SUBMITTED;
			break;
            case Constants::STATUS_APPROVED:
                $status_text = _AM_WGTRANSIFEX_STATUS_APPROVED;
            break;
            case Constants::STATUS_READTX:
                $status_text = _AM_WGTRANSIFEX_STATUS_READTX;
            break;
		}
		$ret['status_text']          = $status_text;
		return $ret;
	}

	/**
	 * Returns an array representation of the object
	 *
	 * @return array
	 */
	public function toArrayProjects()
	{
		$ret = [];
		$vars = $this->getVars();
		foreach(array_keys($vars) as $var) {
			$ret[$var] = $this->getVar('"{$var}"');
		}
		return $ret;
	}
}
