<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2015 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisDemoCms\Controller;

use Zend\View\Model\ViewModel;

class Page404Controller extends BaseController
{
    public function indexAction()
    {
    	$view = new ViewModel();
    	return $view;
    }
}