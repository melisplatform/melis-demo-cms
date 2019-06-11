# Melis Demo Cms

A demo site that provides examples on how to use the services of the Melis modules.

## Getting Started

These instructions will get you a copy of the project up and running on your machine.  

## Vhost Configuration
MELIS_MODULE variable (identifies which site will be loaded as the front office for this domain).  
We should set this variable with `MelisDemoCms`  
Vhost should look like this:
```
<VirtualHost *:80>
    DocumentRoot "PATH_DOCROOT/public"
    <Directory "PATH_DOCROOT/public">
        Options +Indexes +FollowSymLinks +ExecCGI
        DirectoryIndex index.php
        Order allow,deny
        Allow from all
        AllowOverride All
        Require all granted
    </Directory>

    ServerName www.mysite.local:80
    SetEnv MELIS_PLATFORM "development"
    SetEnv MELIS_MODULE "MelisDemoCms"

</VirtualHost>
```

## Requirements

* composer/installers 
* php 7  

This will automatically be done when using composer.

## Installing

Run the composer command:
```
composer require melisplatform/melis-demo-cms
```

## Modules Used In The Site
* Melis Front
* Melis Engine
* Melis Cms
* Melis Cms Slider
* Melis Cms Prospects
* Melis Cms News

## Services  
* MelisSiteConfigService  
Provides services to retrieve the config for your sites.  
File: `/melis-front/src/Service/MelisSiteConfigService.php`  

    `MelisFrontSiteConfigListener` used to update the site's config on the regular config service by merging the config from the file and the one on the database.
    * `getSiteConfigByKey(key, section = 'sites', language = null)`  
    This function retrieves a specific config by key.  
    
        Parameter    | Type       |Description
        ------------ | ---------- |-----
        key          | String     |Key of the config.
        pageId       | Int        |Used determine the site id, name, and language and on where to get the config
        section      | String/Int |The section on where to get the config or site Id
        language     | String     |Language on which to get the config  
        
        To call the service. 
        ```
        $siteConfigSvc = $this->getServiceLocator()->get('MelisSiteConfigService');
        ```
        To get a specific `key` of the current site and the language of the page with id 1
        ```
        $siteConfigSvc = $this->getServiceLocator()->get('MelisSiteConfigService');

        $config = $siteConfigSvc->getSiteConfigByKey('key', 1);
        ```
        But what if we wanted to get the key from another language of the current site? We can achieve this by defining the language on where to get the config.
        ```
        $siteConfigSvc = $this->getServiceLocator()->get('MelisSiteConfigService');
                
        $config = $siteConfigSvc->getSiteConfigByKey('key', 1,'sites', 'fr');
        // The language of the page is now overridden by the specified language.
        ```  
        We can also get a particular `key` from another site by using the `site Id`.  
        ```
        $siteConfigSvc = $this->getServiceLocator()->get('MelisSiteConfigService');
        
        $config = $siteConfigSvc->getSiteConfigByKey('key', 1, 1);
        // Return all the values of the specified key from all languages from the site with id 1.
        // The expected output is an array of values from different languages
        
        $config = $siteConfigSvc->getSiteConfigByKey('key', 1, 1, 'fr');
        // Return all the values of the specified key for the French language from the site with id 1.
        ```
        There is also a different section apart from sites. Currently, we have two sections which are sites and allSites.
        ```
        $siteConfigSvc = $this->getServiceLocator()->get('MelisSiteConfigService');
        
        $config = $siteConfigSvc->getSiteConfigByKey('key', 1, 'allSites');
        // Returns the key from the allSites section of the config
        // Language for the page is not applied but still used to get the site id and name to map for the config
        ```
* MelisSiteTranslationService  
  Provides services to translate text and list all site translations  
  File: `/melis-front/src/Service/MelisSiteTranslationService.php`  
  
  * `getText(translationKey, langId, siteId)`  .
    
    Parameter      | Type    |Description
    ------------   |-------- | -----
    translationKey | String  | Key of the translation.
    langId         | Int     | An identifier on which language to get the translation
    siteId         | Int     | An identifier on which site to get the translation
    
    To call the service.
    ```
    $melisSiteTranslationSvc = $this->getServiceLocator()->get('MelisSiteTranslationService');
    ```
    To get a particular translation, You need to specify the translation key along with the lang id and site id.
    ```
    $test = $melisSiteTranslationService->getText('key', 1, 1);
    // Retrieves the translation for the language id 1 and site id 1.
    ```
    
* For SEO, URL Services, and Templating Plugins **[See Full documentation for Melis Front here](https://github.com/melisplatform/melis-front)**
* For Page, and Tree System Services and Engine Plugins **[See Full documentation for Melis Engine here](https://github.com/melisplatform/melis-engine)**
* For Cms plugins (tags, basic page elements) and Services **[See Full documentation for Melis Cms here](https://github.com/melisplatform/melis-cms)**
* For Cms Slider Plugins and Services **[See Full documentation for Melis Cms Slider here](https://github.com/melisplatform/melis-cms-slider)**
* For Cms News Plugins (news list, latest news, and details) and Services **[See Full documentation for Melis Cms News here](https://github.com/melisplatform/melis-cms-news)**
* For Cms Prospects Plugin (contact form) and Services **[See Full documentation for Melis Cms Prospects here](https://github.com/melisplatform/melis-cms-prospects)**
    
## View Helpers

### Melis Front View Helpers:  
* MelisSiteConfigHelper  
This helper is used to get a specific config for a site.  
File: `/melis-front/src/View/Helper/MelisDragDropZoneHelper.php`  
Function: `SiteConfig(key, sectiom = 'sites', language = null)`

    Parameter    | Type       | Description
    ------------ | ---------- | ------
    key          | String     |Key of the config.
    section      | String/Int |The section on where to get the config or site Id
    language     | String     |Language on which to get the config  
    
    To call the helper. 
    ```
    $this->SiteConfig('key');
    ```
    To get a `specific key` from the config for the `current site`.
    ```
    $config = $this->SiteConfig('key');
    ```
    But what if we wanted to get the `key` from another `language` of the `current site`? We can achieve this by defining the `language` on where to get the `config`.  
    ```    
    $config = $this->SiteConfig('key', 'sites', 'fr');
    // The language of the page is now overridden by the specified language.
    ```  
    We can also get a particular `key` from another site by using the `site Id`.
    ```
    $config = $this->SiteConfig('key', 1);
    // Return all the values of the specified key from all languages from the site with id 1.
    // The expected output is an array of values from different languages
    
    $config = $this->SiteConfig('key', 1, 'fr');
    // Return all the values of the specified key for the French language from the site with id 1.
    ```
    There is also a different `section` apart from `sites`. Currently, we have two sections which are `sites` and `allSites`.  
    ```
    $config = $this->SiteConfig('key', 'allSites');
    // Returns the key from the allSites section of the config
    ```
* MelisSiteTranslation  
This helper is used to get a specific translation for a site.  
File: `/melis-front/src/View/Helper/MelisSiteTranslationHelper.php`  
Function: `getText(translationkey, langId, siteId)`  

    Parameter      | Type    |Description
    ------------   |-------- | -----
    translationKey | String  | Key of the translation.
    langId         | Int     | An identifier on which language to get the translation
    siteId         | Int     | An identifier on which site to get the translation
    
    To call the helper method.
    ```
    $this->SiteTranslation('translationKey', 'langId', 'siteId');
    ```
    To get a particular translation, You need to specify the translation key along with the lang id and site id.
    ```
    $text = $this->SiteTranslation('key', 1, 1);
    // Retrieves the translation for the language id 1 and site id 1.
    ```
    
* For More Melis Front View Helpers **[See Full documentation for Melis Front here](https://github.com/melisplatform/melis-front)**
    
    
## Authors

* **Melis Technology** - [www.melistechnology.com](https://www.melistechnology.com/)

See also the list of [contributors](https://github.com/melisplatform/melis-demo-cms/contributors) who participated in this project.


## License

This project is licensed under the OSL-3.0 License - see the [LICENSE.md](LICENSE.md) file for details
