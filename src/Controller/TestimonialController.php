<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2015 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisDemoCms\Controller;

use Laminas\View\Model\ViewModel;

class TestimonialController extends BaseController
{
    public function testimonialAction()
    {
        return $this->view;
    }
}