<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__).'/helper.php';

$list	= ModBootstrapBreadCrumbsHelper::getList($params);
$count	= count($list);

$separator = ModBootstrapBreadCrumbsHelper::setSeparator($params->get('separator'));
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_bootstrap_breadcrumbs', $params->get('layout', 'default'));
