<?php

defined('_JEXEC') or die;
$document = JFactory::getDocument();
$modulePath = JURI::base() . 'modules/mod_bootstrap_breadcrumbs/';


$jquery = $params->get('jquery');
$bootstrap = $params->get('bootstrap');



if ($bootstrap == 'no') {
    $document->addStyleSheet($modulePath . 'css/bootstrap.css');
    $document->addStyleSheet($modulePath . 'css/bootstrap-theme.css');
}

class ModBootstrapBreadCrumbsHelper
{
	public static function getList(&$params)
	{
		// Get the PathWay object from the application
		$app		= JFactory::getApplication();
		$pathway	= $app->getPathway();
		$items		= $pathway->getPathWay();

		$count = count($items);

		// Don't use $items here as it references JPathway properties directly
		$crumbs	= array();
		for ($i = 0; $i < $count; $i ++)
		{
			$crumbs[$i] = new stdClass;
			$crumbs[$i]->name = stripslashes(htmlspecialchars($items[$i]->name, ENT_COMPAT, 'UTF-8'));
			$crumbs[$i]->link = JRoute::_($items[$i]->link);
		}

		if ($params->get('showHome', 1))
		{
			$item = new stdClass;
			$item->name = htmlspecialchars($params->get('homeText', JText::_('MOD_BREADCRUMBS_HOME')));
			$item->link = JRoute::_('index.php?Itemid=' . $app->getMenu()->getDefault()->id);
			array_unshift($crumbs, $item);
		}

		return $crumbs;
	}

	/**
	 * Set the breadcrumbs separator for the breadcrumbs display.
	 *
	 * @param   string	$custom	Custom xhtml complient string to separate the
	 * items of the breadcrumbs
	 * @return  string	Separator string
	 * @since   1.5
	 */
	public static function setSeparator($custom = null)
	{
		$lang = JFactory::getLanguage();

		// If a custom separator has not been provided we try to load a template
		// specific one first, and if that is not present we load the default separator
		if ($custom == null)
		{
			if ($lang->isRTL())
			{
				$_separator = JHtml::_('image', 'system/arrow_rtl.png', null, null, true);
			}
			else
			{
				$_separator = JHtml::_('image', 'system/arrow.png', null, null, true);
			}
		}
		else
		{
			$_separator = htmlspecialchars($custom);
		}

		return $_separator;
	}
}