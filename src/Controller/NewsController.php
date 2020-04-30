<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2015 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisDemoCms\Controller;

use MelisCmsNews\Controller\Plugin\MelisCmsNewsLatestNewsPlugin;
use MelisCmsNews\Controller\Plugin\MelisCmsNewsListNewsPlugin;
use MelisCmsNews\Controller\Plugin\MelisCmsNewsShowNewsPlugin;

class NewsController extends BaseController
{
    public function newsAction()
    {
        // Get site config service
        $siteConfigSrv = $this->getServiceManager()->get('MelisSiteConfigService');

        // Initialize list news plugin
        /** @var MelisCmsNewsListNewsPlugin $newsListPlugin */
        $newsListPlugin = $this->MelisCmsNewsListNewsPlugin();
        // Set parameters
        $parameters = [
            'template_path' => 'MelisDemoCms/plugins/news-list',
            'pageId' => $this->idPage,
            'pageIdNews' => $siteConfigSrv->getSiteConfigByKey('news_details_page_id', $this->idPage),
            'pagination' => [
                'nbPerPage' => 6,
                'nbPageBeforeAfter' => 3
            ],
            'filter' => [
                'column' => 'cnews_publish_date',
                'order' => 'DESC',
                'unpublish_filter' => true,
                'site_id' => $siteConfigSrv->getSiteConfigByKey('home_page_id', $this->idPage)
            ]
        ];
        // Render news list plugin
        $newsList = $newsListPlugin->render($parameters);
        // Add rendered plugin to the view
        $this->view->addChild($newsList, 'newsList');
        $this->view->setVariable('idPage', $this->idPage);
        $this->view->setVariable('renderMode', $this->renderMode);

//        $this->layout()->setVariables([
//            'pageJs' => [
//                '/MelisDemoCms/js/news.js',
//            ]
//        ]);

        return  $this->view;
    }

    public function newsDetailsAction()
    {
        // Get site config service
        $siteConfigSrv = $this->getServiceManager()->get('MelisSiteConfigService');

        // Initialize show news plugin
        /** @var MelisCmsNewsShowNewsPlugin $newsPlugin */
        $newsPlugin = $this->MelisCmsNewsShowNewsPlugin();
        // Set parameters
        $parameters = [
            'id' => 'newsDetails',
            'template_path' => 'MelisDemoCms/plugins/news-details'
        ];
        // Render show news plugin
        $newsDetails = $newsPlugin->render($parameters);
        // Add rendered plugin to the view
        $this->view->addChild($newsDetails, 'newsDetails');

        // Initialize latest news plugin
        /** @var MelisCmsNewsLatestNewsPlugin $latestNewsPlugin */
        $latestNewsPlugin = $this->MelisCmsNewsLatestNewsPlugin();
        // Set parameters
        $latestNewsParameters = [
            'template_path' => 'MelisDemoCms/plugins/latest-news-vertical',
            'pageIdNews' => $this->idPage,
            'filter' => [
                'column' => 'cnews_publish_date',
                'order' => 'DESC',
                'limit' => 5,
                'unpublish_filter' => true,
                'date_max' => null,
                'site_id' => $siteConfigSrv->getSiteConfigByKey('home_page_id', $this->idPage),
            ]
        ];
        // Render latest news plugin
        $latestNews = $latestNewsPlugin->render($latestNewsParameters);
        // Add rendered plugin to the view
        $this->view->addChild($latestNews, 'latestNews');

        $this->view->setVariable('idPage', $this->idPage);
        $this->view->setVariable('renderMode', $this->renderMode);

        return $this->view;
    }
}