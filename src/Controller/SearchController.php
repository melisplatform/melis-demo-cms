<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2015 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisDemoCms\Controller;

class SearchController extends BaseController
{
    public function searchResultsAction()
    {
        $searchResultPlugin = $this->MelisFrontSearchResultsPlugin();
        $searchResultsParameters = [
            'template_path' => 'MelisDemoCms/plugins/search-results',
            'pageId' => $this->idPage,
            'siteModuleName' => 'MelisDemoCms',
            'pagination' => [
                'nbPerPage' => 10,
                'nbPageBeforeAfter' => 3
            ]
        ];

        $this->view->addChild($searchResultPlugin->render($searchResultsParameters), 'searchResults');

        return $this->view;
    }
}