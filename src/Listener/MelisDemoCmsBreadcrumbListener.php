<?php 

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2016 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisDemoCms\Listener;

use Laminas\EventManager\EventManagerInterface;
use Laminas\EventManager\ListenerAggregateInterface;
use Laminas\Session\Container;

class MelisDemoCmsBreadcrumbListener implements ListenerAggregateInterface
{
    private $serviceManager;
	
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $sharedEvents      = $events->getSharedManager();
        
        $callBackHandler = $sharedEvents->attach(
        	'*',
            'MelisFrontBreadcrumbPlugin_melistemplating_plugin_end',
        	function($e){
        	    // Getting the Service Locator from param target
        	    $this->serviceManager = $e->getTarget()->getServiceManager();

        	    // Getting the Datas from the Event Parameters
        	    $params = $e->getParams();   
                $pageId = $params['pluginFronConfig']['pageId'];//current active page
	            $viewVariables = $params['view']->getVariables();
                $breadcrumb = $viewVariables->breadcrumb;

                //when on homepage, set breadcrumb to null
                if (count($breadcrumb) == 1 && $breadcrumb[0]['uri'] == '/') {
                    $breadcrumb = [];
                } else {

                    foreach ($breadcrumb as $key => $val) {
                        //set homepage breadcrumb label to 'Home'
                        if ($key == 0) {
                            $breadcrumb[0]['label'] = 'Home';  
                        } else {

                            $siteConfigSrv = $this->serviceManager->get('MelisSiteConfigService');                        
                            $newsPageId = $siteConfigSrv->getSiteConfigByKey('news_page_id', $pageId);

                            //add breadcrumb entry for the news detail page  
                            if ($newsPageId == $val['idPage']) {
                                     
                                // Retrieving the router details, This will return URL details in Object
                                $router = $this->serviceManager->get('router');  
                                $uri = $router->getRequestUri();
                                $path = $uri->getPath();
                                $queryString = $uri->getQuery();
                                $uriPath = !empty($queryString) ? ($path."?".$queryString) : $path;
                                    
                                $queryStringArr = $uri->getQueryAsArray();               
                                $newsId = $queryStringArr['newsId'] ?: null;

                                if ($newsId) {
                                    //get the title of the news 
                                    /** @var \MelisCmsNews\Service\MelisCmsNewsService $newsSrv */
                                    $newsSrv =  $this->serviceManager->get('MelisCmsNewsService');
                                    $container = new Container('melisplugins');
                                    $langId = $container['melis-plugins-lang-id'];
                                    $newsDataRes = $newsSrv->getNewsById($newsId, $langId);
                                    $newsTitle = $newsDataRes->cnews_title;
                                    
                                    if ($newsTitle) {
                                        // set breadcrumb for news detail page
                                        $breadcrumb[] = [
                                            "label" => $newsTitle,
                                            "menu" => "LINK",
                                            "uri" => $uriPath,
                                            "idPage" => $pageId,
                                            "isActive" => 1,
                                        ];
                                    }                                    
                                }
                            }
                        }
                    }//end foreach                   
                }

                //set updated breadcrumb items
                $view = $params['view'];
                $view->breadcrumb = $breadcrumb;
                $e->setParam('view', $view); 	  
        	},
        100);
        
        $this->listeners[] = $callBackHandler;
    }
    
    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }
}