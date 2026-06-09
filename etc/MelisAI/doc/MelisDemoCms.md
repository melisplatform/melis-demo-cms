---
title: MelisDemoCms (demo / reference site)
package: melisplatform/melis-demo-cms
doc_type: module-documentation
audience: [users, developers, ai]
language: en
module_version: unversioned
last_reviewed: 2026-06-08
maintainer: Melis Technology
keywords: [demo, site, example, reference, website, front office, templating plugins, drag and drop, templates, site config, slider, news, prospects, setup, installer, melis, cms]
screenshots_dir: ./images
---

# MelisDemoCms — Functional & Technical Documentation (for AI)

> **What this is.** MelisDemoCms is the **official example website** for Melis Platform — a
> ready-to-install **site module** built to teach developers how a Melis front-office site is wired:
> page controllers, **templating plugins**, **drag-and-drop** zones, site **config & translations**,
> and the **slider / news / prospects** modules in action. It's the "**Demo CMS**" the installer
> offers, and the codebase you copy patterns from when building your own site.
>
> **Two parts:** **[Part A — Functional Guide](#part-a--functional-guide)** ·
> **[Part B — Technical Reference](#part-b--technical-reference)** (developers/AI, with examples).
> Consumed by the **MelisAI** MCP. Reviewed 2026-06-08.

---

## 0. Where MelisDemoCms sits

> It's a **site module**, not a back-office tool. Unlike everything else in the platform, this is an
> actual **front-office website** that lives under `module/MelisSites/` and is selected as a domain's
> front-office by the **`MELIS_MODULE`** vhost variable (`MELIS_MODULE = "MelisDemoCms"`).

- **MelisInstaller** offers it as the **"Demo CMS"** starting point at first-run.
  → [MelisInstaller doc](../../../melis-installer/etc/MelisAI/doc/MelisInstaller.md)
- **MelisMarketPlace** can install it as a **site product** (its `MelisSetupPostDownload/PostUpdate`
  hooks run the setup). → [MelisMarketPlace doc](../../../melis-marketplace/etc/MelisAI/doc/MelisMarketPlace.md)
- **MelisPlatformSkeleton** hosts site modules under `module/MelisSites/`.
  → [MelisPlatformSkeleton doc](../../../melis-platform-skeleton/etc/MelisAI/doc/MelisPlatformSkeleton.md)
- It **demonstrates** the CMS trio + content modules: **MelisFront / MelisEngine / MelisCms** plus
  **MelisCmsSlider**, **MelisCmsNews**, **MelisCmsProspects**, **MelisCmsPageScriptEditor**.
  → [MelisCms](../../../melis-cms/etc/MelisAI/doc/MelisCms.md) ·
  [MelisFront](../../../melis-front/etc/MelisAI/doc/MelisFront.md)

Marketplace group: **Melis Site**. *"A ready-to-install website made with the goal of being an example
for developers… presents the dos and don'ts."*

---
---

# PART A — Functional Guide

## A1. What MelisDemoCms is

A complete sample website you can install in one step and then **explore from the back-office** (its
pages, templates and plugins are all editable in MelisCms) — and **read the source** to learn how
each piece is built.

![The live MelisDemoCms front-office home page — top nav (News / Team / Our Services / Our Process / FAQ / Contact), the "Melis Demo Cms" hero with a call-to-action, and a dashboard hero graphic.](./images/melisdemocms-site.png)

Crucially, it's a **tutorial**: it deliberately builds different pages in **different ways** so you
can see the trade-offs — some pages place plugins **manually in code**, others are **full
drag-and-drop**, others **mix** both. Each page demonstrates a real building block of a website:

| Page | What it shows (functionally) | Plugins used | How it's built |
|---|---|---|---|
| **Home** | hero + two **sliders/carousels**, a **testimonials** slider, a **GDPR banner** | 2× Slider, ShowListFromFolder, GdprBanner | **manual** (controller renders, view echoes) |
| **News** (list) | a **paginated news list** | News *List* | **mixed** (plugin + drop zones) |
| **News** (details) | one article + a **latest-news** sidebar | News *Show* + *Latest* | **mixed** |
| **Team** | a **team slider** + free content | Slider | **mixed** (slider + zones + tags) |
| **Services** (list/details) | editable text/media content, no plugins | — | **inline tags** only |
| **FAQ** | an FAQ **listing** + three FAQ **category** blocks | 4× ShowListFromFolder | **mixed** |
| **Contact** | a **prospect/contact form** | Prospects *ShowForm* | **mixed** (form + zones) |
| **Testimonial** | editable testimonial content | — | **drag-drop zone + tags** |
| **Search** | **search results** (paginated) | Front *SearchResults* | **mixed** *(currently disabled)* |
| **DragDrop / Template** | demo pages, each showing one **template style** | — / 1× Slider | **drag-drop / static / mixed** showcases |
| **404** | a simple error page | — | **inline tags** |

A shared **menu** (header / white / footer variants, via the Front menu plugin) wraps every page.
Part B explains the three techniques and the exact plugins per page.

## A2. Install & view it

1. `composer require melisplatform/melis-demo-cms` (or pick **Demo CMS** in the installer).
2. Point a vhost at `public/` and set **`MELIS_MODULE "MelisDemoCms"`** (which site is the front-office
   for that domain) + `MELIS_PLATFORM`.
3. The site **self-installs** (its setup creates the site, pages and config). Browse the domain to see
   the front-office; edit it under **MelisCms** in the back-office.

> **Screenshots.** The home-page capture above is the AI-doc screenshot (see the
> [Screenshot index](#screenshot-index)). The best way to see the rest is the **live site** once
> installed; the `etc/MarketPlace/melis-demo-cms.xml` promo references (Home/News/Team/Contact/FAQ)
> are separate store images.

---
---

# PART B — Technical Reference

## B1. It's a site module (metadata)

| Item | Value |
|---|---|
| Package | `melisplatform/melis-demo-cms` · type `melisplatform-module` · **`melis-site: true`** · category `cms` |
| Namespace | `MelisDemoCms\` (PSR-4 → `src/`) · module name `MelisDemoCms` |
| Install path | `module/MelisSites/{$name}` (via `extra.installer-paths`, `installer-name: MelisDemoCms`) |
| Selected as front-office by | the **`MELIS_MODULE`** vhost env var = `MelisDemoCms` |
| Requires | `melis-cms`, `melis-cms-slider`, `melis-cms-prospects`, `melis-cms-news`, `melis-cms-page-script-editor` (`^5.2`); suggests `melis-engine`, `melis-front` |
| `config/module.load.php` | the modules this site loads: AssetManager, Engine, Front, CmsNews, CmsSlider, CmsProspects, MelisDemoCms, CmsPageScriptEditor |

## B2. The three composition techniques (the tutorial heart)

The demo teaches **three ways** to put content/plugins on a page. Most real pages **combine** them.

### (1) Manual placement — plugin rendered in the controller

The developer wires the plugin: instantiate it, `render()` with params (the **template** + **site
config** values), `addChild` it under a name, then the `.phtml` echoes `$this->name`.
`HomeController::indexAction` is the canonical example:

```php
// Controller
$cfg    = $this->getServiceManager()->get('MelisSiteConfigService');
$slider = $this->MelisCmsSliderShowSliderPlugin();                   // plugin from melis-cms-slider
$homeSlider1 = $slider->render([
    'template_path' => 'MelisDemoCms/plugins/home-carousel-slider',  // THIS site's template
    'id' => 'homeSlider1', 'pageId' => $this->idPage,
    'sliderId' => $cfg->getSiteConfigByKey('home_page_slider_1_id', $this->idPage),  // config-driven
]);
$this->view->addChild($homeSlider1, 'homeSlider1');
// view (home/index.phtml):  <?= $this->homeSlider1 ?>
```

**Use when:** the plugin needs computed parameters / config, or the layout is fixed and
developer-owned. *Pages: Home, Team (slider), News (lists), FAQ (lists), Contact (form), Search.*

### (2) Full drag-and-drop — a zone the BO user fills

The `.phtml` declares a **drop zone**; a back-office editor drags any plugin into it and the choice is
saved in the **page XML** — **no controller code**. The zone helper:

```php
<?= $this->MelisDragDropZone($this->idPage, "dragdropzone_home_1") ?>   // a named, droppable zone
```

**Use when:** marketers/editors should compose the page freely. *Pages: DragDrop, the
Template showcase (1-zone / 2-zone / centered).*

### (3) Inline editable tags — small editable blocks in code

For fixed-but-editable text/media (titles, paragraphs, an image), the `.phtml` wraps a default value
in a **tag** the BO user can edit in place — not a full plugin:

```php
<?= $this->MelisTag($this->idPage, 'static-html-1', 'html', '<h1>Accessible…</h1>') ?>   // 'html' | 'textarea' | 'media'
```

**Use when:** the developer owns the structure but the client should tweak copy/images.
*Pages: Services, Testimonial, 404, and the static/mixed templates.*

> All three coexist: e.g. **News** = a News-list **plugin** (manual) **+** top/bottom **drop zones**
> for banners; **mixed-template** = `MelisTag` blocks **+** two drop zones. **Plugins come from other
> modules, templates are this site's `.phtml`, content/IDs come from site config.**

## B3. Templating-plugin template overrides (`melis.plugins.config.php`)

A site supplies its **own templates** for shared plugins (so the same plugin looks different per site).
`config/melis.plugins.config.php` registers them under each module's plugin:

| Plugin (from) | Site templates |
|---|---|
| `MelisFrontMenuPlugin` (front) | `menu`, `white-menu`, `footer-menu` |
| `MelisFrontShowListFromFolderPlugin` (front) | `faq-listing`, `faq-values`, `home-testimonial-slider` |
| `MelisFrontGdprBannerPlugin` (front) | `gdpr-banner` |
| `MelisCmsSliderShowSliderPlugin` (slider) | `home-carousel-slider`, `home-slider2`, `team-slider` |
| *(news plugins)* | `news-list`, `news-details`, `latest-news-vertical/horizontal` |

`config/module.config.php`'s `template_map` maps each `MelisDemoCms/plugins/*` key to its `.phtml`,
and `controller_map['MelisDemoCms'] = true` enables view-template auto-resolution for the controllers.

## B4. Per-page plugin inventory (exact plugins + technique)

Which **templating plugins** each page renders and how (manual `addChild` / drop **zone** / inline
**tag**). Plugin classes are real; `template_path` is this site's override; config keys feed IDs.

| Page · controller → view | Plugins (class · template_path · config key) | Drop zones | Tags |
|---|---|---|---|
| **Home** `Home::index` → `home/index` | `MelisCmsSliderShowSliderPlugin` ×2 (`home-carousel-slider`/`home_page_slider_1_id`, `home-slider2`/`home_page_slider_2_id`) · `MelisFrontShowListFromFolderPlugin` (`home-testimonial-slider`/`testimonials_folder_id`) · `MelisFrontGdprBannerPlugin` (`gdpr-banner`) | — | yes |
| **News list** `News::news` → `news/news` | `MelisCmsNewsListNewsPlugin` (`news-list`, paginated 6, `news_details_page_id`) | `dragdropzone_news_1/2` | — |
| **News details** `News::newsDetails` → `news/news-details` | `MelisCmsNewsShowNewsPlugin` (`news-details`) · `MelisCmsNewsLatestNewsPlugin` (`latest-news-vertical`, 5) | `dragdropzone_news_details_1/2` | — |
| **Team** `Team::team` → `team/team` | `MelisCmsSliderShowSliderPlugin` (`team-slider`/`team_page_slider_1_id`) | `dragdropzone_team_1/2` | yes |
| **Services** `Services::services / serviceDetails` | *(none)* | — | yes |
| **FAQ** `Faq::faq` → `faq/faq` | `MelisFrontShowListFromFolderPlugin` ×4 (`faq-listing`/`faq_page_id`; `faq-values` ×3 → `delivery_folder_id`/`product_folder_id`/`payment_folder_id`) | `dragdropzone_faq_1/2` | yes |
| **Contact** `Contact::contact` → `contact/contact` | `MelisCmsProspectsShowFormPlugin` (`prospect-form`; fields `pros_name,company,country,telephone,email,theme,message`) | `dragdropzone_contact_1/2` | — |
| **Testimonial** `Testimonial::testimonial` | *(none)* | `testimonial_html_1` | yes |
| **Search** `Search::searchResults` *(disabled)* | `MelisFrontSearchResultsPlugin` (`search-results`, paginated 10) | `dragdropzone_search_result_1/2` | — |
| **DragDrop / Template** showcases | `Template::static` renders `MelisCmsSliderShowSliderPlugin` manually; the rest are zone-only | per template (below) | per template |

Every page also gets the **menu** (header/footer) from `MelisFrontMenuPlugin` via the layout.

### Template demonstrations (`view/melis-demo-cms/template/`)

The `Template` controller exposes one action per template so you can see each style live:

| Template | Technique it teaches | Zones / content |
|---|---|---|
| `static-template` | **manual + tags**, no zones | echoes `$this->staticSlider` (a Slider rendered in the controller) + `MelisTag` html/textarea/media blocks |
| `dragdrop` | **simplest drag-drop** | one zone `dragdropzone_home_1` |
| `dragdrop2zones` | **multiple zones** around fixed content | `dragdropzone2_home_1` … static text … `dragdropzone2_home_2` |
| `centered-dragdrop` | **styled/centered zones** | `centered_dragdrop_html_1/2` inside a centered container |
| `mixed-template` | **the hybrid** | `dragdropzone_mixed_template_1` + `MelisTag` blocks + `dragdropzone_mixed_template_2` |

So a developer can compare, side by side: *fix everything in code* (static) → *let editors do
everything* (dragdrop) → *fix the skeleton, open a few zones* (mixed).

## B5. Templates, config, translations & search

- **Page templates** (`view/melis-demo-cms/template/`): `static-template`, `dragdrop`,
  `dragdrop2zones`, `centered-dragdrop`, `mixed-template` — examples of **static** vs **drag-and-drop
  zone** templates a CMS page can use (detailed in §B4).
- **Site config & translations** — `config/MelisDemoCms.config.php` holds the site's config (slider
  IDs, folder IDs, etc.); read it with **`MelisSiteConfigService::getSiteConfigByKey($key, $pageId,
  $section, $lang)`** or the **`$this->SiteConfig(...)`** view helper, and translate with
  **`MelisSiteTranslationService::getText()`** / **`$this->SiteTranslation(...)`** (both from
  MelisFront — the README documents them with examples). `assets.config.php` declares CSS/JS.
- **Search** — a **Lucene** index (`luceneIndex/`) + `SearchController` provide on-site search; note
  it's currently **disabled** in `module.config.php` (a `@TODO change to elastic search`).

## B6. Self-install (marketplace / installer hooks)

Because it's a site product, the module installs itself when downloaded:

- `src/Controller/MelisSetupController` (the `/MelisDemoCms/setup` route + setup form),
  `MelisSetupPostDownloadController` and `MelisSetupPostUpdateController` run **after a marketplace
  download / update** to create the site, its pages, templates and config (`config/setup/download.config.php`,
  `update.config.php`).
- Listeners: `SetupDemoCmsListener` (drives the setup), `MelisDemoCmsCreateConfigListener` (writes the
  site config), `SiteMenuCustomizationListener` (customises the front menu),
  `LatestNewsHorizontalListener` (feeds a news plugin). Service `DemoCmsService` + `MelisPlatformTable`
  back the setup.

## B7. Quick code map

```
melis-demo-cms/                     (the example front-office SITE module → module/MelisSites/MelisDemoCms)
├── composer.json                 → melis-site:true; installer-paths → MelisSites; requires cms+slider+news+prospects+page-script-editor
├── config/
│   ├── module.config.php         → routes (home / '/' / setup), controllers, plugin template_map, controller_map
│   ├── module.load.php           → the modules this site loads
│   ├── melis.plugins.config.php  → the site's template overrides for shared plugins
│   ├── MelisDemoCms.config(.stub) → site config (slider/folder ids…) · assets.config.php
│   └── setup/  download.config.php · update.config.php
├── src/
│   ├── Controller/  Home · News · Team · Services · Faq · Contact · Testimonial · DragDrop · Template · Page404 · Search(disabled)
│   │              + MelisSetup(+PostDownload/PostUpdate) · BaseController
│   ├── Service/DemoCmsService.php · Model/Tables/MelisPlatformTable.php
│   ├── Listener/  SetupDemoCms · CreateConfig · SiteMenuCustomization · LatestNewsHorizontal
│   └── Module.php
├── view/
│   ├── melis-demo-cms/  one folder per page (home, news, team, services, faq, contact, testimonial, drag-drop) + template/ (5 layouts)
│   ├── plugins/  menu/white-menu/footer-menu · sliders · news · faq · prospect-form · gdpr-banner · search-results
│   └── layout/  defaultLayout · errorLayout · setupLayout
├── luceneIndex/                   → on-site search index
└── etc/  MarketPlace (promo xml) + MelisAI/doc (this doc)
```

---

## Screenshot index

| File (`./images/`) | Content |
|---|---|
| `melisdemocms-site.png` | The live **MelisDemoCms** front-office home page — top nav (News/Team/Our Services/Our Process/FAQ/Contact), the "Melis Demo Cms" hero + CTA, and a dashboard hero graphic. |

---

*Document for AI consumption (MelisAI MCP) — `melisplatform/melis-demo-cms`. Part A = functional;
Part B = technical with examples. The official example/reference Melis website (a site module under
module/MelisSites) showing controllers, templating plugins, drag-and-drop, site config and the
slider/news/prospects modules. Last reviewed 2026-06-08.*
