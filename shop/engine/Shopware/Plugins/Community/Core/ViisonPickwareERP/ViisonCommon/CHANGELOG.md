## 2.125.1

* Fix bug in Classes/Util/Util::getCurrentUser() that lead to a null exception in POS checkout.

## 2.125.0

* Adds the exception `Shopware\Plugins\ViisonCommon\Exceptions\FileSystemException`.

## 2.124.2

* Fix `Shopware\Plugins\ViisonCommon\Classes\Util\Util::getCurrentUser()` if no session exists (e.g. during unit tests).

## 2.124.1

* Fixes the array access to be PHP 5.3 compliant.

## 2.124.0

* Adds support for translating config stores.
* Adds `\Shopware\Plugins\ViisonCommon\Classes\Localization\BootstrapSnippetManager` which allows using snippets from within install / update methods.
* Adds a method `\Shopware\Plugins\ViisonCommon\Classes\Installation\InstallationMessageUtil::formatUpdateMessage` which can be used to format an array of update hints into a message returned from plugin bootstrap methods.

## 2.123.0

* Fixes a minor styling issue of the ExtJs pagination toolbar component.
* Adds some more common CSS styles.
* Fixes some PhpDoc comments.

## 2.122.2

* Adds a workaround for the DomPdf problem 'No block-level parent found.  Not good.' in Util::createDompdfInstance().

## 2.122.1

* Fixes a possible Doctrine exception caused by `\Shopware\Plugins\ViisonCommon\Classes\Installation\ConfigForm\InstallationHelper`.

## 2.122.0

* Adds `\Shopware\Plugins\ViisonCommon\Classes\Util\Localization` which has a method that maps a language code to the canonical primary locale for that language.
* Adds `\Shopware\Plugins\ViisonCommon\Classes\Installation\ConfigForm\InstallationHelper` which allows defining config form translations in an idempotent manner.
* Adds a new plugin Bootstrap `ViisonCommon_Plugin_BootstrapV5` with a method `updateConfigFormTranslations()` which transparently applies config form translations by reading them from `plugin.json`, `description.xx.html` and a new `form.ini` file.

## 2.121.2

* Decodes the currency symbol if it is stored as HTML entity in the database.
* Fix wrong orientation when merging PDF contents.

## 2.121.1

* Fix ExceptionTranslation.

## 2.121.0

* Adds an exception translator service.

## 2.120.0

* Deprecates `Shopware\Plugins\ViisonCommon\Classes\Installation\SQLHelper::addColumnIfNotExistsAfterColumnName()` in favour of `Shopware\Plugins\ViisonCommon\Classes\Installation\SQLHelper::addColumnIfNotExists()`.
* Adds a new util method `Shopware\Plugins\ViisonCommon\Classes\Util\Util::getVariantAdditionalTexts()` for creating the variant additional texts for several article details at once.
* Deprecates `Shopware\Plugins\ViisonCommon\Classes\Util\Util::getVariantAdditionalText()` in favour of `Shopware\Plugins\ViisonCommon\Classes\Util\Util::getVariantAdditionalTexts()`.

## 2.119.0

* Add workaround for Dompdf `stream()` incompatibility with Shopware 5.3.

## 2.118.1

* Adds support for thumbnail quality settings to the Media Album installation helper `Shopware\Plugins\ViisonCommon\Classes\Installation\MediaAlbum\InstallationHelper::createMediaAlbumUnlessExists()`.

## 2.118.0

* Adds a helper method `Shopware\Plugins\ViisonCommon\Classes\Util\Util::getShopUrl()`, which assembles and returns the shop url for a given shop model entity with a fallback for missing `secureHost` and/or `secureBasePath` values.

## 2.117.1

* Fixes 5.3 compat issue in test suite.

## 2.117.0

* Adds a test suite.
* Fixes logic errors in `\Shopware\Plugins\ViisonCommon\Classes\Subscribers\OrderStatusSubscriber`.

## 2.116.0

* Adds a new method `\Shopware\Plugins\ViisonCommon\Classes\Util\Doctrine::customModelsShareNamespace()` for comparing namespaces of `ModelEntity` instances.

## 2.115.2

* Removes usage of `sys_get_temp_dir()` that was introduced in `v2.115.0`.

## 2.115.1

* Improves joining PDFs

## 2.115.0

* Add util method to join multiple PDF documents into one

## 2.114.1

* Fixes a Shopware 5.3 smarty security compatibility issue that occurred when rendering grid-based document templates.

## 2.114.0

* Adds `\Shopware\Plugins\ViisonCommon\Classes\Util\Util::getTempDir()`, which returns `$SHOPWARE/media/temp`, which is guaranteed to be writable and should always be used when writing temporary files.
* Adds `\Shopware\Plugins\ViisonCommon\Classes\Util\Util::createDompdfInstance()`, which creates a `Dompdf` instance that is configured to use the Shopware `media/temp` directory for writing temporary files. This method should always be used instead of calling `new Dompdf()` directly.

## 2.113.1

* Fixes an (accidentally committed) typo in the ExtJS component name of `Shopware.apps.ViisonCommonGridLabelPrinting.view.TemplateChooser`

## 2.113.0

* ESLint is now used in a pre-commit hook to lint all JavaScript code
* ExtJS sub applications and extensions can now be loaded without Smarty rendering (see [README](/README.md#smarty-less-backend-sub-applications) for more info

## 2.112.0

* Minor refactoring

## 2.111.0

* Fixes wrong version number in RealVersion.php

## 2.110.0

* Adds utility method `\Shopware\Plugins\ViisonCommon\Classes\Util\Doctrine::builderHasJoin` which tests whether a `QueryBuilder` already has a particular join.

## 2.109.0

* Adds a ExtJs grid feature style `.viison-common--grid.has-feature--hide-disabled-editors`, which hides all disabled editors of a row editor. To use this style add the following line to your grid specification:
```
    {
        xtype: 'grid',
        ...
        cls: 'viison-common--grid has-feature--hide-disabled-editors',
        ...
    }
```

## 2.108.0

* Adds ExtJS method viisonAddProtectedDocument() to the DocumentBoxGuard

## 2.107.0

* Adds a function to copy and convert the values from one config form field to another
* Changes the accessibility of `Shopware\Plugins\ViisonCommon\Classes\Installation\SQLHelper::getConstraintIdentifier()` to `public`

## 2.106.0

* Add Shopware\Plugins\ViisonCommon\Classes\Util\Document::copyDocumentTypeElements(...)
* Add a FormElementMigrator

## 2.105.4

* Fixes a warning in PHP < 5.5 caused by replacing the existing error handler in the polyfill loader

## 2.105.3

* Fixes the firing of `ViisonCommonComboBox`'s custom change event, if both old and new value are `null`.

## 2.105.2

* Fixes viison_common_variant_combo_box and use correct additionalText or Configurator/Options.
* Don't fire events for non-changes when value is `null` in `ViisonCommonComboBox`.

## 2.105.1

* Fixes a snippet error in the index popup window.

## 2.105.0

* Adds a new abstract subscriber `Shopware\Plugins\ViisonCommon\Classes\Subscribers\Backend\VariantGeneration` that makes it easy to control which fields and attributes are copied or reset when generating variants or duplicating articles

## 2.104.0

* Adds new method `Shopware\Plugins\ViisonCommon\Classes\Installation\SQLHelper::addUniqueConstraintIfNotExists()` for idempotently creating unique constraints on tables

## 2.103.0

* Adds some extra styles for summary rows in analytics tables.

## 2.102.2

* Fixes a mistake in the `box-shadow` definition for `.viison-common--info-panel.has--shadow`.

## 2.102.1

* Fixes `Shopware\Plugins\ViisonCommon\Classes\Installation\SQLHelper::removeForeignKeyConstraintIfExists()`

## 2.102.0

* Adds `viison_currency` smarty modifier plugin that formats a currency, respecting the per-currency symbol position.

## 2.101.0

* Rename addForeignKeyConstraint function in SQLHelper. Keep function as deprecated.

## 2.100.0

* Add addForeignKeyConstraint function to SQLHelper

## 2.99.0

* Adds a document context class for documents that are not bound tight to an order.

## 2.98.0

* Adds `\Shopware\Plugins\ViisonCommon\Classes\Installation\SQLHelper::addIndexIfNotExists` which creates database column indices idempotently.

## 2.97.6

* Fixes vertical offset on every page after the first in barcode gridlayout documents
* Fixes logic and parsing bugs in OrderStatusSubscriber

## 2.97.5

* Fixes attribute uninstalling of OrderActivityPerformedDateSubscriber

## 2.97.4

* Fixes another corner case in the polyfill loader error handler which caused infinite loops.

## 2.97.3

* Fixes the polyfill loader to register its custom error handler at most once

## 2.97.2

* Fixes the custom error handler in `Polyfill/Loader.php` to swallow only `E_USER_ERROR` level errors and pass everything else on to the original handler, if available

## 2.97.1

* Fix missing code in `\Shopware\Plugins\ViisonCommon\Classes\Subscribers\HideDocumentTypeSubscriber`.

## 2.97.0

* No longer uses a replace hook in `\Shopware\Plugins\ViisonCommon\Classes\Subscribers\HideDocumentTypeSubscriber` and also allows passing the number sequence name as an identifying attribute

## 2.96.0

* Add `ViisonCommon\Classes\Subscribers\TemplateMailComponent` to add and use our custom, hookable template mail.

## 2.95.4

* Fix PHP 5.3 compat issue -.-

## 2.95.3

* Makes sure `\Shopware\Plugins\ViisonCommon\Subscribers\Api\Error` works correctly when API compatibility layers are active.

## 2.95.2

* Fixes a PHP 7 compatibility issue in `\Shopware\Plugins\ViisonCommon\Classes\Subscribers\DocumentBoxGuard`

## 2.95.1

* Adds a hack to map `Accept-Language: de-AT` to `de-DE` in \Shopware\Plugins\ViisonCommon\Components\LocalizedApiSnippetManager because the way Shopware resolves snippets for a language is stupid.

## 2.95.0

* Adds a new Class 'Shopware\Plugins\ViisonCommon\Classes\SmartyPlugins', which currently contains only a single plugin that allows using a custom `js_snippet` block in smarty. This block behaves like the default `s` (snippet) tag, but escapes any single quotes in the snippet value, which makes it safe to use the block in JavaScript strings defined by single quotes. The plugins must be registered manually by calling the static 'register()' method somewhere in the plugin's `afterInit()`.
* Removes the subscriber on the `template` service added in `2.94.0`

## 2.94.0

* Adds a subscriber on the `template` service, which allows using a custom `js_snippet` block in smarty. This block behaves like the default `s` (snippet) tag, but escapes any single quotes in the snippet value, which makes it safe to use the block in JavaScript strings defined by single quotes.
* Extend 'Classes/Subscribers/DocumentBoxGuard' and add view to hide button in backend view

## 2.93.0

* Adds `FrontendArticleCartEnabler`

## 2.92.0

* Fix document creation for language subshops in `Components/Document.php`

## 2.91.0

* Adds a streaming CSV writer helper

## 2.90.0

* Adds a custom error handler to the polyfill loader that swallows errors on the `E_USER_ERROR` level

## 2.89.0

*Peseudo release to fix the version*

## 2.88.0

* Requires `viison/shopware-plugin-dev-error-handler` as a dev dependency. Make sure to add the VCS repository `git@github.com:VIISON/shopware-plugin-dev-error-handler.git` to your plugin, to make `composer install` work.
* Replaces the trowing of some exceptions in the `ViisonCommonJSLoader` with `trigger_error`

## 2.87.0

* Make the new common subscriber `Shopware\Plugins\ViisonCommon\Subscribers\Common` a proxy of the old subscriber `Shopware\Plugins\ViisonCommon\Subscriber\Common` to fix backwards compatibility with old version of `ViisonCommon_Plugin_Bootstrap`

## 2.86.1

* Fixes PHP 5.3 backwards compatibility issues in `ApiException` & friends.

## 2.86.0

* Adds `ApiException` that supports localized API error messages based on the `Accept-Languages` header and custom http status codes
* Renames `./Subscriber/` to `./Subscribers/` for consistency reason. Leaves a delegate Subscriber in place to prevent breaking backwards compatibility.

## 2.85.0

* Adds a Shopware polyfill loader `Polyfill/Loader.php` that can be `require`d in the plugin's `Bootstrap::afterInit()` to make certain novel Shopware interfaces available in all Shopware versions
* Marks `Components/CSRFWhiteListAware.php` as deprecated. Please use the new polyfill loader.

## 2.84.2

* Fix default vars in `Shopware\Plugins\ViisonCommon\Component\Document`

## 2.84.1

* Fix var assignment in `Shopware\Plugins\ViisonCommon\Component\Document`

## 2.84.0

* Adds `Shopware\Plugins\ViisonCommon\Component\Document` for document initialization and rendering instead of `Shopware\Plugins\ViisonCommon\Classes\DocumentHelper`

## 2.83.0

* Fixes the abstract services subscriber (`Shopware\Plugins\ViisonCommon\Classes\Subscribers\Services`) to support service names using camel case

## 2.82.0

* Adds an abstract class `Shopware\Plugins\ViisonCommon\Classes\AbstractSubscriberRegistrator` that can be used by dependencies like this one to register all its subscribers exactly once
* Adds an implementation of `Shopware\Plugins\ViisonCommon\Classes\AbstractSubscriberRegistrator` (`Shopware\Plugins\ViisonCommon\Classes\SubscriberRegistrator`) for registering the ViisonCommon subscriber (usage is explained inline)

## 2.81.0

* Adds an optional sixth parameter `$controllerClass` to `Shopware\Plugins\ViisonCommon\Components\ViisonCommonJSLoader::registerSubApplication()`, which can be used to specify a custom controller class that will be loaded when fetching the sub app's view params
* Adds support for the custom controller class to the abstract `Shopware\Plugins\ViisonCommon\Classes\Subscribers\SubApplicationRegistration` subscriber

## 2.80.3

* Move DocumentHelper from PickwareERP to ViisonCommon
* Fix log entries if no user-auth could be found

## 2.80.2

* Fix possible racecondition with the pagination toolbar

## 2.80.1

* Add HideDocumentTypeSubscriber to hide certain document types in backend

## 2.80.0

* Pass the plugin path as a third argument to services created by `Shopware\Plugins\ViisonCommon\Classes\Subscribers\Services`

## 2.79.2

* Rename pagination toolbar xtype

## 2.79.0

* Adds support for custom report help texts to ViisonCommonAnalytics. The help text will be displayed in front of the reports table view and uses the common info panel styling. In order do display a custom help text set the variable `viisonCommonAnalyticsHelpText` in the table class of your report:
```
Ext.define('Shopware.apps.TestReport.view.table.Report', {
    extend: 'Shopware.apps.Analytics.view.main.Table',
    alias: 'widget.test-report',

    viisonCommonAnalyticsHelpText: 'Cum sociis natoque penatibus mus.',

    ...
```

## 2.78.8

* Adds styles for a common info panel. One can use these styles e.g. to render an info panel based on an ExtJS container:
```
    {
        xtype: 'container',
        cls: 'viison-common--info-panel',
        html: 'Nulla vitae elit libero, a pharetra augue. Donec sed odio dui.' // info text
    }
```

## 2.78.7

* Fixes typo

## 2.78.6

* Fixes pagination layout

## 2.78.5

* Fixes the translation of document components when using `Shopware\Plugins\ViisonCommon\Classes\Util\Document::changeDocumentLanguage()`

## 2.78.4

* Fixes smarty syntax error

## 2.78.3

* Add pagination toolbar

## 2.78.2

* Removes Backend subscribers from `\Shopware\Plugins\ViisonCommon\Classes\Subscribers\OrderStatusSubscriber` since this case is already covered by the Doctrine update/persist lifecycle subscribers

## 2.78.1

* Removes API subscribers from `\Shopware\Plugins\ViisonCommon\Classes\Subscribers\OrderStatusSubscriber` since this case is already covered by the Doctrine update/persist lifecycle subscribers

## 2.78.0

* Adds the general `\Shopware\Plugins\ViisonCommon\Classes\Subscribers\OrderStatusSubscriber` that can be used to detect changes in order status and / or order payment status.

## 2.77.1

* Fixes the change event handling of `Shopware.apps.ViisonCommonComboBox.view.ComboBox` if no row is selected
* Fixes the change event handling of `Shopware.apps.ViisonCommonComboBox.view.ComboBox` for non-numeric value fields

## 2.77.0

* Adds a new event handler `addLessFiles` to the view subscriber base class `Shopware\Plugins\ViisonCommon\Classes\Subscribers\ViewLoading`, which allows to easily register a plugins less files to Shopware's assets processing queue by overriding the class method `getLessFiles` and returning a list of all less files, which should be added to the queue.
