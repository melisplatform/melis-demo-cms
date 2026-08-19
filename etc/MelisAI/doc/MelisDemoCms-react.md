---
title: MelisDemoCms module — React back-office
package: melisplatform/melis-demo-cms
doc_type: module-documentation-react
audience: [users, developers, ai]
language: en
module_version: unversioned
last_reviewed: 2026-08-19
maintainer: Melis Technology
keywords: [demo, sample site, reference site, cms, pages, front office, website, react back-office, cms page editor, media, templates, sites, no brick, server-rendered]
screenshots_dir: ./images/react
related_docs: [./MelisDemoCms.md]
---

# MelisDemoCms (React back-office) — Site-Role Documentation (for AI)

> **What this is.** MelisDemoCms is the **official demo / sample website** shipped with Melis
> Platform — an actual front-office **site module** (its controllers, templates and plugins
> render a real website), **not a back-office tool**. It has **no React back-office UI of its
> own**: no `ui-react/` brick source, no `public/ui-react/brick.manifest.json`, no
> `config/react-api.php`, no `config/react.capabilities.php`. It **never appears as a tool** in
> `/melis-react`. This document explains **what the module is** and **how it relates to the React
> back-office**: you manage its pages and content through the **generic React CMS tools** (the
> CMS page editor, Media, Sites, Templates…), while the site itself is server-rendered by
> **MelisFront / MelisEngine**.
>
> For the full module reference (page-by-page composition, templating plugins, drag-and-drop, site
> config, installers) read the **[legacy doc](./MelisDemoCms.md)** — this file does not repeat it,
> it only covers the React relationship.
>
> **How this document is organised — two clearly separated parts:**
> - **[Part A — Functional](#part-a--functional)** — plain language: what the demo site is, and
>   how an author works on it from `/melis-react`.
> - **[Part B — Technical](#part-b--technical)** — the real front controllers / templates /
>   installers, and why there is no React BO surface here.
>
> **Audience**: consumed by the **MelisAI** MCP. **Status**: reviewed 2026-08-19.

---

## 0. Where this lives in the React back-office — read this first

**Brick kind: none.** MelisDemoCms is a **site module** (a front-office website), not a
back-office tool, so it is **not migrated to React** and is **not meant to be**. It:

- has **no brick** (no `ui-react/` project, no `public/ui-react/brick.manifest.json`),
- exposes **no `react-api` endpoints** (no `config/react-api.php`),
- declares **no capabilities** (no `config/react.capabilities.php`),
- shows **no sidebar entry** and **no menu node** in `/melis-react`.

What it *is* in relation to `/melis-react`: it is **content that the generic React CMS tools
operate on**. The demo site's pages, templates and media are edited with the same React tools you
use for any Melis site — the **CMS page editor** (edit its pages), **Media**, **Sites**,
**Templates**, etc. The website itself is **server-rendered** by MelisFront/MelisEngine when a
visitor browses the domain; the React back-office never renders the front page, it only manages
the underlying CMS data.

> ⚠ Do not look for a "MelisDemoCms" tool in `/melis-react` — there isn't one. You reach its
> content through the **CMS Pages** tree (open one of its pages in the page editor) and the other
> generic CMS tools.

Cross-links: [MelisDemoCms legacy doc](./MelisDemoCms.md) · the CMS trio it demonstrates —
[MelisCms](../../../melis-cms/etc/MelisAI/doc/MelisCms.md) ·
[MelisFront](../../../melis-front/etc/MelisAI/doc/MelisFront.md).

---
---

# PART A — Functional

## A1. What the demo site is

MelisDemoCms is the **ready-to-install example website** for Melis — the "Demo CMS" the installer
offers. It is a complete, browsable front-office site whose purpose is to **teach** how a Melis
website is wired: page controllers, templating plugins, drag-and-drop zones, site config and the
slider / news / prospects modules in action.

![The live MelisDemoCms front-office home page — top navigation (News / Team / Our Services / Our Process / FAQ / Contact), the "Melis Demo Cms" hero with the strapline "A demo site to show you the possibilities of Melis Platform and a case study for developers to enter the ecosystem" and a "Try to Free" call-to-action, over a dashboard hero graphic.](./images/react/melisdemocms-site.png)

*The rendered demo website (server-rendered front office). This is what MelisDemoCms produces for
a visitor — it is NOT a React back-office screen; there is no React tool for this module.*

The site ships a set of front-office **pages / sections**, each demonstrating a real website
building block:

- **Home** — hero + two sliders/carousels, a testimonials slider, a GDPR banner.
- **News** — a paginated news list and article-detail pages (with a latest-news sidebar).
- **Team** — a team slider plus free content.
- **Services** (Our Services) — editable text/media content.
- **Our Process / FAQ** — an FAQ listing plus FAQ category blocks.
- **Contact** — a prospect / contact form.
- **Testimonial** — editable testimonial content.
- **Search** — search results (currently disabled in the demo).
- **DragDrop / Template** showcases — demo pages, each illustrating one template style.
- **404** — a simple error page.

The exact plugins, templates and composition technique for each page are in the
[legacy doc](./MelisDemoCms.md) (§B4 per-page inventory).

## A2. How you work on it in `/melis-react`

Because MelisDemoCms has no tool of its own, you edit it with the **generic React CMS tools**:

- **CMS page editor** — open any of the demo site's pages (Home, News, Team, FAQ, Contact…) from
  the **CMS Pages** tree and edit them: inline editable blocks, drag-and-drop zones and the plugins
  each page hosts. This is the primary way an author changes the demo site's content.
- **Media** — manage the images/files the pages reference.
- **Sites** — the domain/language settings for the demo site.
- **Templates** — the page templates the CMS pages use.

> **Where:** sidebar → **CMS Pages** → open a demo-site page in the editor. There is no
> "MelisDemoCms" entry in the sidebar — the module is the *content*, not a tool.

## A3. Common tasks — "How do I…?"

- **Edit a demo page's text/images** → open the page in the **CMS page editor** and edit its inline
  blocks / zones. (Save & publish as with any CMS page.)
- **Swap an image** → use the **Media** tool, then reference it from the page.
- **Change the site's domain/language** → the **Sites** tool.
- **Understand how a page is built (plugins, zones, tags)** → read the
  [legacy doc](./MelisDemoCms.md) §B2–B4; it is the tutorial reference.
- **(Re)install the demo site** → not a React action — see the installer / marketplace hooks in the
  [legacy doc](./MelisDemoCms.md) §B6.

---
---

# PART B — Technical

## B1. Metadata & dependencies

| Item | Value |
|---|---|
| Package | `melisplatform/melis-demo-cms` · type `melisplatform-module` · **`melis-site: true`** · category `cms` · namespace `MelisDemoCms\` (PSR-4 → `src/`) |
| Install path | `module/MelisSites/{$name}` (`extra.installer-paths`, `installer-name: MelisDemoCms`) |
| Selected as front-office by | the **`MELIS_MODULE`** vhost env var = `MelisDemoCms` |
| Requires | `melis-cms`, `melis-cms-slider`, `melis-cms-prospects`, `melis-cms-news`, `melis-cms-page-script-editor` (`^6.0`); suggests `melis-engine`, `melis-front` |
| React presence | **None** — no brick, no `react-api`, no capabilities, no UI |
| React relationship | Its **pages / templates / media are managed by the generic React CMS tools** (CMS page editor, Media, Sites, Templates). The site itself is **server-rendered by MelisFront/MelisEngine**. |

## B2. Why there is no React BO surface

MelisDemoCms is a **front-office site module**, the opposite of a back-office tool. Its code is
made of **front controllers + view templates + templating-plugin overrides** that render the
public website, plus **setup controllers/listeners** that install the demo site. None of this is a
back-office tool, so none of the React BO signals exist:

- no `ui-react/` Vite project, no `public/ui-react/brick.js` / `brick.manifest.json`;
- no `config/react-api.php` (no `/melis/react-api/…` endpoints);
- no `config/react.capabilities.php` (no capability tree);
- nothing to discover via `GET /melis/react-api/react-modules`, and no `forwardKey`/`melisKey`.

The React back-office reaches this module **indirectly**: its pages are ordinary CMS pages, so the
generic **CMS page editor** and the other CMS tools (Media, Sites, Templates) operate on them just
as they do for any Melis site. The rendering of the live site remains **100% server-side** via
MelisFront/MelisEngine (`.phtml` templates + templating plugins), untouched by the React shell.

## B3. The site's front controllers, templates & plugins (real names)

The module's real surface is its **front controllers** (one per page/section) rendering the site's
own `.phtml` templates and templating-plugin overrides:

| Controller (`src/Controller/`) | Renders |
|---|---|
| `HomeController` | Home (2× slider, testimonials list, GDPR banner) — the site's `/` route |
| `NewsController` | News list + article details |
| `TeamController` | Team page (team slider) |
| `ServicesController` | Our Services (list / details) |
| `FaqController` | FAQ listing + category blocks |
| `ContactController` | Contact / prospect form |
| `TestimonialController` | Testimonial content |
| `SearchController` | On-site search results (Lucene; disabled in the demo) |
| `TemplateController` / `DragDropController` | Template-style showcases (static / drag-drop / mixed) |
| `Page404Controller` | 404 error page |
| `BaseController` | Shared base for the front controllers |

Templating-plugin **template overrides** are declared in `config/melis.plugins.config.php`
(the site's own `.phtml` for shared plugins: menu variants, sliders, news, FAQ, prospect form,
GDPR banner, search results), and `config/module.config.php` maps `MelisDemoCms/plugins/*` keys to
their templates. All of this is server-rendered — see the [legacy doc](./MelisDemoCms.md) §B2–B5
for the full per-page plugin inventory and the three composition techniques.

## B4. The MelisSetup* installers (also not React)

The module installs the demo **site + its pages/media/config** through setup controllers and
listeners — a back-end / CLI concern, again with no React surface:

- `MelisSetupController` (the `/MelisDemoCms/setup` route + form),
  `MelisSetupPostDownloadController`, `MelisSetupPostUpdateController` — run after a marketplace
  download / update to create the site, its pages, templates and config
  (`config/setup/download.config.php`, `update.config.php`).
- Listeners: `SetupDemoCmsListener` (drives the setup), `MelisDemoCmsCreateConfigListener` (writes
  the site config), `SiteMenuCustomizationListener` (customises the front menu),
  `LatestNewsHorizontalListener` (feeds a news plugin). Backed by `DemoCmsService` +
  `Model/Tables/MelisPlatformTable`.

Details: [legacy doc](./MelisDemoCms.md) §B6.

## B5. Quick code map (React-relevant view)

```
melis-demo-cms/                     (the example front-office SITE module → module/MelisSites/MelisDemoCms)
├── composer.json                 → melis-site:true, category cms, requires cms+slider+news+prospects+page-script-editor
├── config/
│   ├── module.config.php         → front routes ('/', home, setup), controllers, plugin template_map, controller_map
│   ├── module.load.php           → the modules this site loads
│   ├── melis.plugins.config.php  → the site's template overrides for shared plugins
│   └── MelisDemoCms.config(.stub) · assets.config.php · setup/{download,update}.config.php
├── src/
│   ├── Controller/  Home · News · Team · Services · Faq · Contact · Testimonial · DragDrop · Template · Page404 · Search
│   │              + MelisSetup(+PostDownload/PostUpdate) · BaseController      (all FRONT / setup — no MelisReactApi* controller)
│   ├── Service/DemoCmsService.php · Model/Tables/MelisPlatformTable.php · Listener/… · Module.php
├── view/                         → per-page .phtml + plugins/ overrides + layout/   (server-rendered front office)
├── luceneIndex/                  → on-site search index
└── etc/MelisAI/doc/
    ├── MelisDemoCms.md            → legacy / full doc (cross-linked)
    └── MelisDemoCms-react.md      → THIS doc (site role in relation to the React BO)

(no ui-react/, no public/ui-react/, no config/react-api.php, no config/react.capabilities.php — no React brick or tool)

Managed via the generic React CMS tools:
  CMS page editor (edit its pages) · Media · Sites · Templates      (in /melis-react, from melis-core + melis-cms bricks)
Rendered by: MelisFront / MelisEngine (server-side .phtml + templating plugins)
```

---

## Screenshot index

Filename → content lookup for the MelisAI MCP. Under `./images/react/`.

| Image file | Content |
|---|---|
| `melisdemocms-site.png` | The rendered **MelisDemoCms** front-office home page (server-rendered demo website) — top nav (News/Team/Our Services/Our Process/FAQ/Contact), the "Melis Demo Cms" hero + "Try to Free" CTA, over a dashboard hero graphic. **Not** a React back-office screen (this module has no React tool). |

---

*Document for AI consumption (MelisAI MCP) — site role of `melisplatform/melis-demo-cms` in
relation to the React back-office. This module is the demo/sample front-office website and has no
React back-office tool/brick; its pages and content are managed through the generic React CMS
tools (CMS page editor, Media, Sites, Templates) and the site is server-rendered by
MelisFront/MelisEngine. Full module reference: [./MelisDemoCms.md](./MelisDemoCms.md). Last reviewed
2026-08-19.*
