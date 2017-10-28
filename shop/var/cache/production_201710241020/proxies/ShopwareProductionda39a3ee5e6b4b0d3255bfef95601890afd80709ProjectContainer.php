<?php
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InactiveScopeException;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;
class ShopwareProductionda39a3ee5e6b4b0d3255bfef95601890afd80709ProjectContainer extends Shopware\Components\DependencyInjection\Container
{
    private $parameters;
    private $targetDirs = array();
    public function __construct()
    {
        $this->parameters = $this->getDefaultParameters();
        $this->services =
        $this->scopedServices =
        $this->scopeStacks = array();
        $this->scopes = array();
        $this->scopeChildren = array();
        $this->methodMap = array(
            'acl' => 'getAclService',
            'application' => 'getApplicationService',
            'attributesubscriber' => 'getAttributesubscriberService',
            'basket_cleanup_cron_job_subscriber' => 'getBasketCleanupCronJobSubscriberService',
            'basket_persister' => 'getBasketPersisterService',
            'basket_signature_generator' => 'getBasketSignatureGeneratorService',
            'bootstrap' => 'getBootstrapService',
            'cache' => 'getCacheService',
            'cache_factory' => 'getCacheFactoryService',
            'categorydenormalization' => 'getCategorydenormalizationService',
            'categoryduplicator' => 'getCategoryduplicatorService',
            'categorysubscriber' => 'getCategorysubscriberService',
            'config' => 'getConfigService',
            'config_factory' => 'getConfigFactoryService',
            'config_writer' => 'getConfigWriterService',
            'corelogger' => 'getCoreloggerService',
            'cron' => 'getCronService',
            'cron_adapter' => 'getCronAdapterService',
            'currency' => 'getCurrencyService',
            'currency_factory' => 'getCurrencyFactoryService',
            'customer_search.dbal.condition.account_mode_handler' => 'getCustomerSearch_Dbal_Condition_AccountModeHandlerService',
            'customer_search.dbal.condition.age_handler' => 'getCustomerSearch_Dbal_Condition_AgeHandlerService',
            'customer_search.dbal.condition.assigned_to_stream_handler' => 'getCustomerSearch_Dbal_Condition_AssignedToStreamHandlerService',
            'customer_search.dbal.condition.customer_attribute_handler' => 'getCustomerSearch_Dbal_Condition_CustomerAttributeHandlerService',
            'customer_search.dbal.condition.has_address_with_country_handler' => 'getCustomerSearch_Dbal_Condition_HasAddressWithCountryHandlerService',
            'customer_search.dbal.condition.has_canceled_orders_handler' => 'getCustomerSearch_Dbal_Condition_HasCanceledOrdersHandlerService',
            'customer_search.dbal.condition.has_newsletter_registration' => 'getCustomerSearch_Dbal_Condition_HasNewsletterRegistrationService',
            'customer_search.dbal.condition.has_order_count_handler' => 'getCustomerSearch_Dbal_Condition_HasOrderCountHandlerService',
            'customer_search.dbal.condition.has_total_order_amount_handler' => 'getCustomerSearch_Dbal_Condition_HasTotalOrderAmountHandlerService',
            'customer_search.dbal.condition.is_customer_since_handler' => 'getCustomerSearch_Dbal_Condition_IsCustomerSinceHandlerService',
            'customer_search.dbal.condition.is_in_customer_group_handler' => 'getCustomerSearch_Dbal_Condition_IsInCustomerGroupHandlerService',
            'customer_search.dbal.condition.ordered_at_weekday_handler' => 'getCustomerSearch_Dbal_Condition_OrderedAtWeekdayHandlerService',
            'customer_search.dbal.condition.ordered_in_last_days_handler' => 'getCustomerSearch_Dbal_Condition_OrderedInLastDaysHandlerService',
            'customer_search.dbal.condition.ordered_in_shop_handler' => 'getCustomerSearch_Dbal_Condition_OrderedInShopHandlerService',
            'customer_search.dbal.condition.ordered_on_device_handler' => 'getCustomerSearch_Dbal_Condition_OrderedOnDeviceHandlerService',
            'customer_search.dbal.condition.ordered_product_handler' => 'getCustomerSearch_Dbal_Condition_OrderedProductHandlerService',
            'customer_search.dbal.condition.ordered_product_of_category_handler' => 'getCustomerSearch_Dbal_Condition_OrderedProductOfCategoryHandlerService',
            'customer_search.dbal.condition.ordered_product_of_manufacturer_handler' => 'getCustomerSearch_Dbal_Condition_OrderedProductOfManufacturerHandlerService',
            'customer_search.dbal.condition.ordered_with_delivery_handler' => 'getCustomerSearch_Dbal_Condition_OrderedWithDeliveryHandlerService',
            'customer_search.dbal.condition.ordered_with_payment_handler' => 'getCustomerSearch_Dbal_Condition_OrderedWithPaymentHandlerService',
            'customer_search.dbal.condition.registered_in_shop_handler' => 'getCustomerSearch_Dbal_Condition_RegisteredInShopHandlerService',
            'customer_search.dbal.condition.salutation_handler' => 'getCustomerSearch_Dbal_Condition_SalutationHandlerService',
            'customer_search.dbal.condition.search_term_handler' => 'getCustomerSearch_Dbal_Condition_SearchTermHandlerService',
            'customer_search.dbal.gateway.service' => 'getCustomerSearch_Dbal_Gateway_ServiceService',
            'customer_search.dbal.handler_registry' => 'getCustomerSearch_Dbal_HandlerRegistryService',
            'customer_search.dbal.indexing.cron_job_subscriber' => 'getCustomerSearch_Dbal_Indexing_CronJobSubscriberService',
            'customer_search.dbal.indexing.customer_order_hydrator' => 'getCustomerSearch_Dbal_Indexing_CustomerOrderHydratorService',
            'customer_search.dbal.indexing.indexer' => 'getCustomerSearch_Dbal_Indexing_IndexerService',
            'customer_search.dbal.indexing.order_gateway' => 'getCustomerSearch_Dbal_Indexing_OrderGatewayService',
            'customer_search.dbal.indexing.provider' => 'getCustomerSearch_Dbal_Indexing_ProviderService',
            'customer_search.dbal.number_search' => 'getCustomerSearch_Dbal_NumberSearchService',
            'customer_search.dbal.search_index_populate_command' => 'getCustomerSearch_Dbal_SearchIndexPopulateCommandService',
            'customer_search.dbal.sorting.age_sorting_handler' => 'getCustomerSearch_Dbal_Sorting_AgeSortingHandlerService',
            'customer_search.dbal.sorting.average_amount_handler' => 'getCustomerSearch_Dbal_Sorting_AverageAmountHandlerService',
            'customer_search.dbal.sorting.average_product_amount_handler' => 'getCustomerSearch_Dbal_Sorting_AverageProductAmountHandlerService',
            'customer_search.dbal.sorting.city_handler' => 'getCustomerSearch_Dbal_Sorting_CityHandlerService',
            'customer_search.dbal.sorting.customer_group_handler' => 'getCustomerSearch_Dbal_Sorting_CustomerGroupHandlerService',
            'customer_search.dbal.sorting.customer_since_handler' => 'getCustomerSearch_Dbal_Sorting_CustomerSinceHandlerService',
            'customer_search.dbal.sorting.last_name_handler' => 'getCustomerSearch_Dbal_Sorting_LastNameHandlerService',
            'customer_search.dbal.sorting.last_order_handler' => 'getCustomerSearch_Dbal_Sorting_LastOrderHandlerService',
            'customer_search.dbal.sorting.number_handler' => 'getCustomerSearch_Dbal_Sorting_NumberHandlerService',
            'customer_search.dbal.sorting.order_count_handler' => 'getCustomerSearch_Dbal_Sorting_OrderCountHandlerService',
            'customer_search.dbal.sorting.street_name_handler' => 'getCustomerSearch_Dbal_Sorting_StreetNameHandlerService',
            'customer_search.dbal.sorting.total_amount_handler' => 'getCustomerSearch_Dbal_Sorting_TotalAmountHandlerService',
            'customer_search.dbal.sorting.zip_code_handler' => 'getCustomerSearch_Dbal_Sorting_ZipCodeHandlerService',
            'date' => 'getDateService',
            'db' => 'getDbService',
            'db_connection' => 'getDbConnectionService',
            'dbal_connection' => 'getDbalConnectionService',
            'debuglogger' => 'getDebugloggerService',
            'dispatcher' => 'getDispatcherService',
            'emotion_device_configuration' => 'getEmotionDeviceConfigurationService',
            'errorsubscriber' => 'getErrorsubscriberService',
            'events' => 'getEventsService',
            'file_system' => 'getFileSystemService',
            'first_run_wizard_plugin_store' => 'getFirstRunWizardPluginStoreService',
            'front' => 'getFrontService',
            'front_factory' => 'getFrontFactoryService',
            'guzzle_http_client_factory' => 'getGuzzleHttpClientFactoryService',
            'hooks' => 'getHooksService',
            'http_cache_warmer' => 'getHttpCacheWarmerService',
            'http_client' => 'getHttpClientService',
            'js_compressor' => 'getJsCompressorService',
            'legacy_event_manager' => 'getLegacyEventManagerService',
            'legacy_struct_converter' => 'getLegacyStructConverterService',
            'loader' => 'getLoaderService',
            'locale' => 'getLocaleService',
            'locale_factory' => 'getLocaleFactoryService',
            'mail' => 'getMailService',
            'mail_factory' => 'getMailFactoryService',
            'mailtransport' => 'getMailtransportService',
            'mailtransport_factory' => 'getMailtransportFactoryService',
            'model_annotations_factory' => 'getModelAnnotationsFactoryService',
            'model_event_manager' => 'getModelEventManagerService',
            'model_factory' => 'getModelFactoryService',
            'modelannotations' => 'getModelannotationsService',
            'modelconfig' => 'getModelconfigService',
            'models' => 'getModelsService',
            'models_metadata_cache' => 'getModelsMetadataCacheService',
            'monolog.formatter.wildfire' => 'getMonolog_Formatter_WildfireService',
            'monolog.handler.chromephp' => 'getMonolog_Handler_ChromephpService',
            'monolog.handler.firephp' => 'getMonolog_Handler_FirephpService',
            'monolog.handler.main' => 'getMonolog_Handler_MainService',
            'monolog.processor.uid' => 'getMonolog_Processor_UidService',
            'multi_edit.product' => 'getMultiEdit_ProductService',
            'multi_edit.product.backup' => 'getMultiEdit_Product_BackupService',
            'multi_edit.product.batch_process' => 'getMultiEdit_Product_BatchProcessService',
            'multi_edit.product.dql_helper' => 'getMultiEdit_Product_DqlHelperService',
            'multi_edit.product.filter' => 'getMultiEdit_Product_FilterService',
            'multi_edit.product.grammar' => 'getMultiEdit_Product_GrammarService',
            'multi_edit.product.queue' => 'getMultiEdit_Product_QueueService',
            'multi_edit.product.value' => 'getMultiEdit_Product_ValueService',
            'oyejorge_compiler' => 'getOyejorgeCompilerService',
            'oyejorge_compiler_lib' => 'getOyejorgeCompilerLibService',
            'passwordencoder' => 'getPasswordencoderService',
            'pluginlogger' => 'getPluginloggerService',
            'plugins' => 'getPluginsService',
            'plugins_factory' => 'getPluginsFactoryService',
            'query_alias_mapper' => 'getQueryAliasMapperService',
            'router' => 'getRouterService',
            'router_factory' => 'getRouterFactoryService',
            'session' => 'getSessionService',
            'session.save_handler' => 'getSession_SaveHandlerService',
            'session_factory' => 'getSessionFactoryService',
            'shop_page_menu' => 'getShopPageMenuService',
            'shopware.api.address' => 'getShopware_Api_AddressService',
            'shopware.api.article' => 'getShopware_Api_ArticleService',
            'shopware.api.cache' => 'getShopware_Api_CacheService',
            'shopware.api.category' => 'getShopware_Api_CategoryService',
            'shopware.api.country' => 'getShopware_Api_CountryService',
            'shopware.api.customer' => 'getShopware_Api_CustomerService',
            'shopware.api.customer_stream' => 'getShopware_Api_CustomerStreamService',
            'shopware.api.customergroup' => 'getShopware_Api_CustomergroupService',
            'shopware.api.emotionpreset' => 'getShopware_Api_EmotionpresetService',
            'shopware.api.manufacturer' => 'getShopware_Api_ManufacturerService',
            'shopware.api.media' => 'getShopware_Api_MediaService',
            'shopware.api.order' => 'getShopware_Api_OrderService',
            'shopware.api.propertygroup' => 'getShopware_Api_PropertygroupService',
            'shopware.api.resource' => 'getShopware_Api_ResourceService',
            'shopware.api.shop' => 'getShopware_Api_ShopService',
            'shopware.api.translation' => 'getShopware_Api_TranslationService',
            'shopware.api.variant' => 'getShopware_Api_VariantService',
            'shopware.cache_manager' => 'getShopware_CacheManagerService',
            'shopware.captcha.default_captcha' => 'getShopware_Captcha_DefaultCaptchaService',
            'shopware.captcha.honeypot_captcha' => 'getShopware_Captcha_HoneypotCaptchaService',
            'shopware.captcha.legacy_captcha' => 'getShopware_Captcha_LegacyCaptchaService',
            'shopware.captcha.no_captcha' => 'getShopware_Captcha_NoCaptchaService',
            'shopware.captcha.repository' => 'getShopware_Captcha_RepositoryService',
            'shopware.captcha.validator' => 'getShopware_Captcha_ValidatorService',
            'shopware.components.last_articles_subscriber' => 'getShopware_Components_LastArticlesSubscriberService',
            'shopware.csrftoken_validator' => 'getShopware_CsrftokenValidatorService',
            'shopware.customer_stream.cookie_subscriber' => 'getShopware_CustomerStream_CookieSubscriberService',
            'shopware.customer_stream.criteria_factory' => 'getShopware_CustomerStream_CriteriaFactoryService',
            'shopware.customer_stream.repository' => 'getShopware_CustomerStream_RepositoryService',
            'shopware.customer_stream.stream_indexer' => 'getShopware_CustomerStream_StreamIndexerService',
            'shopware.emotion.emotion_exporter' => 'getShopware_Emotion_EmotionExporterService',
            'shopware.emotion.emotion_importer' => 'getShopware_Emotion_EmotionImporterService',
            'shopware.emotion.emotion_landingpage_loader' => 'getShopware_Emotion_EmotionLandingpageLoaderService',
            'shopware.emotion.emotion_presetdata_transformer' => 'getShopware_Emotion_EmotionPresetdataTransformerService',
            'shopware.emotion.preset_banner_component_handler' => 'getShopware_Emotion_PresetBannerComponentHandlerService',
            'shopware.emotion.preset_bannerslider_component_handler' => 'getShopware_Emotion_PresetBannersliderComponentHandlerService',
            'shopware.emotion.preset_categoryteaser_component_handler' => 'getShopware_Emotion_PresetCategoryteaserComponentHandlerService',
            'shopware.emotion.preset_data_synchronizer' => 'getShopware_Emotion_PresetDataSynchronizerService',
            'shopware.emotion.preset_html5_video_component_handler' => 'getShopware_Emotion_PresetHtml5VideoComponentHandlerService',
            'shopware.emotion.preset_installer' => 'getShopware_Emotion_PresetInstallerService',
            'shopware.emotion.preset_loader' => 'getShopware_Emotion_PresetLoaderService',
            'shopware.emotion.translation_importer' => 'getShopware_Emotion_TranslationImporterService',
            'shopware.emotion_component_installer' => 'getShopware_EmotionComponentInstallerService',
            'shopware.escaper' => 'getShopware_EscaperService',
            'shopware.form.constraint.exists' => 'getShopware_Form_Constraint_ExistsService',
            'shopware.form.constraint.unique' => 'getShopware_Form_Constraint_UniqueService',
            'shopware.form.extension.enlight' => 'getShopware_Form_Extension_EnlightService',
            'shopware.form.extension.event' => 'getShopware_Form_Extension_EventService',
            'shopware.form.factory' => 'getShopware_Form_FactoryService',
            'shopware.form.string_renderer_service' => 'getShopware_Form_StringRendererServiceService',
            'shopware.holiday_table_updater' => 'getShopware_HolidayTableUpdaterService',
            'shopware.log.fileparser' => 'getShopware_Log_FileparserService',
            'shopware.logaware_reflection_helper' => 'getShopware_LogawareReflectionHelperService',
            'shopware.model.search_builder' => 'getShopware_Model_SearchBuilderService',
            'shopware.number_range_incrementer' => 'getShopware_NumberRangeIncrementerService',
            'shopware.openssl_verificator' => 'getShopware_OpensslVerificatorService',
            'shopware.plugin.cached_config_reader' => 'getShopware_Plugin_CachedConfigReaderService',
            'shopware.plugin.config_reader' => 'getShopware_Plugin_ConfigReaderService',
            'shopware.plugin.config_writer' => 'getShopware_Plugin_ConfigWriterService',
            'shopware.plugin_payment_installer' => 'getShopware_PluginPaymentInstallerService',
            'shopware.plugin_requirement_validator' => 'getShopware_PluginRequirementValidatorService',
            'shopware.plugin_xml_plugin_info_reader' => 'getShopware_PluginXmlPluginInfoReaderService',
            'shopware.requirements' => 'getShopware_RequirementsService',
            'shopware.slug' => 'getShopware_SlugService',
            'shopware.snippet_database_handler' => 'getShopware_SnippetDatabaseHandlerService',
            'shopware.snippet_query_handler' => 'getShopware_SnippetQueryHandlerService',
            'shopware.snippet_validator' => 'getShopware_SnippetValidatorService',
            'shopware.upload_max_size_validator' => 'getShopware_UploadMaxSizeValidatorService',
            'shopware_account.address_service' => 'getShopwareAccount_AddressServiceService',
            'shopware_account.address_validator' => 'getShopwareAccount_AddressValidatorService',
            'shopware_account.constraint.current_password_validator' => 'getShopwareAccount_Constraint_CurrentPasswordValidatorService',
            'shopware_account.constraint.customer_email_validator' => 'getShopwareAccount_Constraint_CustomerEmailValidatorService',
            'shopware_account.constraint.form_email_validator' => 'getShopwareAccount_Constraint_FormEmailValidatorService',
            'shopware_account.constraint.password_validator' => 'getShopwareAccount_Constraint_PasswordValidatorService',
            'shopware_account.customer_service' => 'getShopwareAccount_CustomerServiceService',
            'shopware_account.customer_validator' => 'getShopwareAccount_CustomerValidatorService',
            'shopware_account.form.addressform' => 'getShopwareAccount_Form_AddressformService',
            'shopware_account.form.attributeform' => 'getShopwareAccount_Form_AttributeformService',
            'shopware_account.form.emailupdateform' => 'getShopwareAccount_Form_EmailupdateformService',
            'shopware_account.form.passwordupdateform' => 'getShopwareAccount_Form_PasswordupdateformService',
            'shopware_account.form.personalform' => 'getShopwareAccount_Form_PersonalformService',
            'shopware_account.form.profile_update_form' => 'getShopwareAccount_Form_ProfileUpdateFormService',
            'shopware_account.form.resetpasswordform' => 'getShopwareAccount_Form_ResetpasswordformService',
            'shopware_account.register_service' => 'getShopwareAccount_RegisterServiceService',
            'shopware_account.store_front_greeting_service' => 'getShopwareAccount_StoreFrontGreetingServiceService',
            'shopware_account.type.salutation_type' => 'getShopwareAccount_Type_SalutationTypeService',
            'shopware_attribute.blog_reader' => 'getShopwareAttribute_BlogReaderService',
            'shopware_attribute.blog_repository' => 'getShopwareAttribute_BlogRepositoryService',
            'shopware_attribute.blog_searcher' => 'getShopwareAttribute_BlogSearcherService',
            'shopware_attribute.category_reader' => 'getShopwareAttribute_CategoryReaderService',
            'shopware_attribute.category_repository' => 'getShopwareAttribute_CategoryRepositoryService',
            'shopware_attribute.category_searcher' => 'getShopwareAttribute_CategorySearcherService',
            'shopware_attribute.controller_subscriber' => 'getShopwareAttribute_ControllerSubscriberService',
            'shopware_attribute.crud_service' => 'getShopwareAttribute_CrudServiceService',
            'shopware_attribute.customer_reader' => 'getShopwareAttribute_CustomerReaderService',
            'shopware_attribute.customer_repository' => 'getShopwareAttribute_CustomerRepositoryService',
            'shopware_attribute.customer_searcher' => 'getShopwareAttribute_CustomerSearcherService',
            'shopware_attribute.customer_stream_reader' => 'getShopwareAttribute_CustomerStreamReaderService',
            'shopware_attribute.customer_stream_repository' => 'getShopwareAttribute_CustomerStreamRepositoryService',
            'shopware_attribute.customer_stream_searcher' => 'getShopwareAttribute_CustomerStreamSearcherService',
            'shopware_attribute.data_loader' => 'getShopwareAttribute_DataLoaderService',
            'shopware_attribute.data_persister' => 'getShopwareAttribute_DataPersisterService',
            'shopware_attribute.emotion_reader' => 'getShopwareAttribute_EmotionReaderService',
            'shopware_attribute.emotion_repository' => 'getShopwareAttribute_EmotionRepositoryService',
            'shopware_attribute.emotion_searcher' => 'getShopwareAttribute_EmotionSearcherService',
            'shopware_attribute.media_reader' => 'getShopwareAttribute_MediaReaderService',
            'shopware_attribute.media_repository' => 'getShopwareAttribute_MediaRepositoryService',
            'shopware_attribute.media_searcher' => 'getShopwareAttribute_MediaSearcherService',
            'shopware_attribute.premium_reader' => 'getShopwareAttribute_PremiumReaderService',
            'shopware_attribute.premium_repository' => 'getShopwareAttribute_PremiumRepositoryService',
            'shopware_attribute.premium_searcher' => 'getShopwareAttribute_PremiumSearcherService',
            'shopware_attribute.product_reader' => 'getShopwareAttribute_ProductReaderService',
            'shopware_attribute.product_repository' => 'getShopwareAttribute_ProductRepositoryService',
            'shopware_attribute.product_searcher' => 'getShopwareAttribute_ProductSearcherService',
            'shopware_attribute.property_option_reader' => 'getShopwareAttribute_PropertyOptionReaderService',
            'shopware_attribute.property_option_repository' => 'getShopwareAttribute_PropertyOptionRepositoryService',
            'shopware_attribute.property_option_searcher' => 'getShopwareAttribute_PropertyOptionSearcherService',
            'shopware_attribute.repository_registry' => 'getShopwareAttribute_RepositoryRegistryService',
            'shopware_attribute.schema_operator' => 'getShopwareAttribute_SchemaOperatorService',
            'shopware_attribute.shop_reader' => 'getShopwareAttribute_ShopReaderService',
            'shopware_attribute.shop_repository' => 'getShopwareAttribute_ShopRepositoryService',
            'shopware_attribute.shop_searcher' => 'getShopwareAttribute_ShopSearcherService',
            'shopware_attribute.table_mapping' => 'getShopwareAttribute_TableMappingService',
            'shopware_attribute.type_mapping' => 'getShopwareAttribute_TypeMappingService',
            'shopware_core.license_service_subscriber' => 'getShopwareCore_LicenseServiceSubscriberService',
            'shopware_core.local_license_unpack_service' => 'getShopwareCore_LocalLicenseUnpackServiceService',
            'shopware_customer_search.gateway.address_gateway' => 'getShopwareCustomerSearch_Gateway_AddressGatewayService',
            'shopware_customer_search.gateway.address_hydrator' => 'getShopwareCustomerSearch_Gateway_AddressHydratorService',
            'shopware_customer_search.gateway.customer_gateway' => 'getShopwareCustomerSearch_Gateway_CustomerGatewayService',
            'shopware_customer_search.gateway.customer_hydrator' => 'getShopwareCustomerSearch_Gateway_CustomerHydratorService',
            'shopware_elastic_search.backlog_processor' => 'getShopwareElasticSearch_BacklogProcessorService',
            'shopware_elastic_search.backlog_reader' => 'getShopwareElasticSearch_BacklogReaderService',
            'shopware_elastic_search.client' => 'getShopwareElasticSearch_ClientService',
            'shopware_elastic_search.composite_synchronizer' => 'getShopwareElasticSearch_CompositeSynchronizerService',
            'shopware_elastic_search.composite_synchronizer_factory' => 'getShopwareElasticSearch_CompositeSynchronizerFactoryService',
            'shopware_elastic_search.domain_backlog_subscriber' => 'getShopwareElasticSearch_DomainBacklogSubscriberService',
            'shopware_elastic_search.field_mapping' => 'getShopwareElasticSearch_FieldMappingService',
            'shopware_elastic_search.identifier_selector' => 'getShopwareElasticSearch_IdentifierSelectorService',
            'shopware_elastic_search.index_factory' => 'getShopwareElasticSearch_IndexFactoryService',
            'shopware_elastic_search.orm_backlog_save_subscriber' => 'getShopwareElasticSearch_OrmBacklogSaveSubscriberService',
            'shopware_elastic_search.orm_backlog_subscriber' => 'getShopwareElasticSearch_OrmBacklogSubscriberService',
            'shopware_elastic_search.product_indexer' => 'getShopwareElasticSearch_ProductIndexerService',
            'shopware_elastic_search.product_mapping' => 'getShopwareElasticSearch_ProductMappingService',
            'shopware_elastic_search.product_provider' => 'getShopwareElasticSearch_ProductProviderService',
            'shopware_elastic_search.product_query_factory' => 'getShopwareElasticSearch_ProductQueryFactoryService',
            'shopware_elastic_search.product_synchronizer' => 'getShopwareElasticSearch_ProductSynchronizerService',
            'shopware_elastic_search.property_indexer' => 'getShopwareElasticSearch_PropertyIndexerService',
            'shopware_elastic_search.property_mapping' => 'getShopwareElasticSearch_PropertyMappingService',
            'shopware_elastic_search.property_provider' => 'getShopwareElasticSearch_PropertyProviderService',
            'shopware_elastic_search.property_query_factory' => 'getShopwareElasticSearch_PropertyQueryFactoryService',
            'shopware_elastic_search.property_synchronizer' => 'getShopwareElasticSearch_PropertySynchronizerService',
            'shopware_elastic_search.service_subscriber' => 'getShopwareElasticSearch_ServiceSubscriberService',
            'shopware_elastic_search.shop_analyzer' => 'getShopwareElasticSearch_ShopAnalyzerService',
            'shopware_elastic_search.shop_indexer' => 'getShopwareElasticSearch_ShopIndexerService',
            'shopware_elastic_search.shop_indexer_factory' => 'getShopwareElasticSearch_ShopIndexerFactoryService',
            'shopware_elastic_search.text_mapping' => 'getShopwareElasticSearch_TextMappingService',
            'shopware_emotion.component_handler.article' => 'getShopwareEmotion_ComponentHandler_ArticleService',
            'shopware_emotion.component_handler.article_slider' => 'getShopwareEmotion_ComponentHandler_ArticleSliderService',
            'shopware_emotion.component_handler.banner' => 'getShopwareEmotion_ComponentHandler_BannerService',
            'shopware_emotion.component_handler.banner_slider' => 'getShopwareEmotion_ComponentHandler_BannerSliderService',
            'shopware_emotion.component_handler.blog' => 'getShopwareEmotion_ComponentHandler_BlogService',
            'shopware_emotion.component_handler.category_teaser' => 'getShopwareEmotion_ComponentHandler_CategoryTeaserService',
            'shopware_emotion.component_handler.event_fallback' => 'getShopwareEmotion_ComponentHandler_EventFallbackService',
            'shopware_emotion.component_handler.html5video' => 'getShopwareEmotion_ComponentHandler_Html5videoService',
            'shopware_emotion.component_handler.manufacturer_slider' => 'getShopwareEmotion_ComponentHandler_ManufacturerSliderService',
            'shopware_emotion.data_collection_resolver' => 'getShopwareEmotion_DataCollectionResolverService',
            'shopware_emotion.emotion_element_gateway' => 'getShopwareEmotion_EmotionElementGatewayService',
            'shopware_emotion.emotion_element_hydrator' => 'getShopwareEmotion_EmotionElementHydratorService',
            'shopware_emotion.emotion_element_service' => 'getShopwareEmotion_EmotionElementServiceService',
            'shopware_emotion.emotion_gateway' => 'getShopwareEmotion_EmotionGatewayService',
            'shopware_emotion.emotion_hydrator' => 'getShopwareEmotion_EmotionHydratorService',
            'shopware_emotion.emotion_service' => 'getShopwareEmotion_EmotionServiceService',
            'shopware_emotion.emotion_struct_converter' => 'getShopwareEmotion_EmotionStructConverterService',
            'shopware_emotion.store_front_emotion_device_configuration' => 'getShopwareEmotion_StoreFrontEmotionDeviceConfigurationService',
            'shopware_media.adapter.ftp' => 'getShopwareMedia_Adapter_FtpService',
            'shopware_media.adapter.local' => 'getShopwareMedia_Adapter_LocalService',
            'shopware_media.cdn_optimizer_service' => 'getShopwareMedia_CdnOptimizerServiceService',
            'shopware_media.extension_mapping' => 'getShopwareMedia_ExtensionMappingService',
            'shopware_media.garbage_collector' => 'getShopwareMedia_GarbageCollectorService',
            'shopware_media.garbage_collector_factory' => 'getShopwareMedia_GarbageCollectorFactoryService',
            'shopware_media.media_migration' => 'getShopwareMedia_MediaMigrationService',
            'shopware_media.media_service' => 'getShopwareMedia_MediaServiceService',
            'shopware_media.media_service_factory' => 'getShopwareMedia_MediaServiceFactoryService',
            'shopware_media.optimizer.guetzli' => 'getShopwareMedia_Optimizer_GuetzliService',
            'shopware_media.optimizer.jpegoptim' => 'getShopwareMedia_Optimizer_JpegoptimService',
            'shopware_media.optimizer.jpegtran' => 'getShopwareMedia_Optimizer_JpegtranService',
            'shopware_media.optimizer.optipng' => 'getShopwareMedia_Optimizer_OptipngService',
            'shopware_media.optimizer.pngcrush' => 'getShopwareMedia_Optimizer_PngcrushService',
            'shopware_media.optimizer.pngout' => 'getShopwareMedia_Optimizer_PngoutService',
            'shopware_media.optimizer_service' => 'getShopwareMedia_OptimizerServiceService',
            'shopware_media.replace_service' => 'getShopwareMedia_ReplaceServiceService',
            'shopware_media.service_subscriber' => 'getShopwareMedia_ServiceSubscriberService',
            'shopware_media.strategy' => 'getShopwareMedia_StrategyService',
            'shopware_media.strategy_factory' => 'getShopwareMedia_StrategyFactoryService',
            'shopware_plugininstaller.account_manager_service' => 'getShopwarePlugininstaller_AccountManagerServiceService',
            'shopware_plugininstaller.legacy_plugin_installer' => 'getShopwarePlugininstaller_LegacyPluginInstallerService',
            'shopware_plugininstaller.plugin_download_service' => 'getShopwarePlugininstaller_PluginDownloadServiceService',
            'shopware_plugininstaller.plugin_installer' => 'getShopwarePlugininstaller_PluginInstallerService',
            'shopware_plugininstaller.plugin_installer_struct_hydrator' => 'getShopwarePlugininstaller_PluginInstallerStructHydratorService',
            'shopware_plugininstaller.plugin_licence_service' => 'getShopwarePlugininstaller_PluginLicenceServiceService',
            'shopware_plugininstaller.plugin_manager' => 'getShopwarePlugininstaller_PluginManagerService',
            'shopware_plugininstaller.plugin_service_local' => 'getShopwarePlugininstaller_PluginServiceLocalService',
            'shopware_plugininstaller.plugin_service_store_production' => 'getShopwarePlugininstaller_PluginServiceStoreProductionService',
            'shopware_plugininstaller.plugin_service_view' => 'getShopwarePlugininstaller_PluginServiceViewService',
            'shopware_plugininstaller.store_client' => 'getShopwarePlugininstaller_StoreClientService',
            'shopware_plugininstaller.store_order_service' => 'getShopwarePlugininstaller_StoreOrderServiceService',
            'shopware_plugininstaller.subscription_service' => 'getShopwarePlugininstaller_SubscriptionServiceService',
            'shopware_plugininstaller.unique_id_generator' => 'getShopwarePlugininstaller_UniqueIdGeneratorService',
            'shopware_product_stream.criteria_factory' => 'getShopwareProductStream_CriteriaFactoryService',
            'shopware_product_stream.facet_filter' => 'getShopwareProductStream_FacetFilterService',
            'shopware_product_stream.repository' => 'getShopwareProductStream_RepositoryService',
            'shopware_search.batch_product_number_search' => 'getShopwareSearch_BatchProductNumberSearchService',
            'shopware_search.batch_product_search' => 'getShopwareSearch_BatchProductSearchService',
            'shopware_search.category_tree_facet_result_builder' => 'getShopwareSearch_CategoryTreeFacetResultBuilderService',
            'shopware_search.core_criteria_request_handler' => 'getShopwareSearch_CoreCriteriaRequestHandlerService',
            'shopware_search.custom_facet_criteria_request_handler' => 'getShopwareSearch_CustomFacetCriteriaRequestHandlerService',
            'shopware_search.product_number_search' => 'getShopwareSearch_ProductNumberSearchService',
            'shopware_search.product_search' => 'getShopwareSearch_ProductSearchService',
            'shopware_search.property_criteria_request_handler' => 'getShopwareSearch_PropertyCriteriaRequestHandlerService',
            'shopware_search.search_term_pre_processor' => 'getShopwareSearch_SearchTermPreProcessorService',
            'shopware_search.sorting_criteria_request_handler' => 'getShopwareSearch_SortingCriteriaRequestHandlerService',
            'shopware_search.store_front_criteria_factory' => 'getShopwareSearch_StoreFrontCriteriaFactoryService',
            'shopware_search_es.category_condition_handler' => 'getShopwareSearchEs_CategoryConditionHandlerService',
            'shopware_search_es.category_facet_handler' => 'getShopwareSearchEs_CategoryFacetHandlerService',
            'shopware_search_es.closeout_condition_handler' => 'getShopwareSearchEs_CloseoutConditionHandlerService',
            'shopware_search_es.combined_condition_facet_handler' => 'getShopwareSearchEs_CombinedConditionFacetHandlerService',
            'shopware_search_es.combined_condition_handler' => 'getShopwareSearchEs_CombinedConditionHandlerService',
            'shopware_search_es.combined_condition_query_builder' => 'getShopwareSearchEs_CombinedConditionQueryBuilderService',
            'shopware_search_es.create_date_condition_handler' => 'getShopwareSearchEs_CreateDateConditionHandlerService',
            'shopware_search_es.customer_group_condition_handler' => 'getShopwareSearchEs_CustomerGroupConditionHandlerService',
            'shopware_search_es.handler_collection' => 'getShopwareSearchEs_HandlerCollectionService',
            'shopware_search_es.has_pseudo_price_condtion_handler' => 'getShopwareSearchEs_HasPseudoPriceCondtionHandlerService',
            'shopware_search_es.height_condition_handler' => 'getShopwareSearchEs_HeightConditionHandlerService',
            'shopware_search_es.immediate_delivery_condition_handler' => 'getShopwareSearchEs_ImmediateDeliveryConditionHandlerService',
            'shopware_search_es.immediate_delivery_facet_handler' => 'getShopwareSearchEs_ImmediateDeliveryFacetHandlerService',
            'shopware_search_es.is_available_condition_handler' => 'getShopwareSearchEs_IsAvailableConditionHandlerService',
            'shopware_search_es.is_new_condtion_handler' => 'getShopwareSearchEs_IsNewCondtionHandlerService',
            'shopware_search_es.length_condition_handler' => 'getShopwareSearchEs_LengthConditionHandlerService',
            'shopware_search_es.manufacturer_condition_handler' => 'getShopwareSearchEs_ManufacturerConditionHandlerService',
            'shopware_search_es.manufacturer_facet_handler' => 'getShopwareSearchEs_ManufacturerFacetHandlerService',
            'shopware_search_es.ordernumber_condition_handler' => 'getShopwareSearchEs_OrdernumberConditionHandlerService',
            'shopware_search_es.popularity_sorting_handler' => 'getShopwareSearchEs_PopularitySortingHandlerService',
            'shopware_search_es.price_condition_handler' => 'getShopwareSearchEs_PriceConditionHandlerService',
            'shopware_search_es.price_facet_handler' => 'getShopwareSearchEs_PriceFacetHandlerService',
            'shopware_search_es.price_sorting_handler' => 'getShopwareSearchEs_PriceSortingHandlerService',
            'shopware_search_es.product_attribute_condition_handler' => 'getShopwareSearchEs_ProductAttributeConditionHandlerService',
            'shopware_search_es.product_attribute_facet_handler' => 'getShopwareSearchEs_ProductAttributeFacetHandlerService',
            'shopware_search_es.product_attribute_sorting_handler' => 'getShopwareSearchEs_ProductAttributeSortingHandlerService',
            'shopware_search_es.product_dimensions_facet_handler' => 'getShopwareSearchEs_ProductDimensionsFacetHandlerService',
            'shopware_search_es.product_name_sorting_handler' => 'getShopwareSearchEs_ProductNameSortingHandlerService',
            'shopware_search_es.product_number_search' => 'getShopwareSearchEs_ProductNumberSearchService',
            'shopware_search_es.product_number_search_factory' => 'getShopwareSearchEs_ProductNumberSearchFactoryService',
            'shopware_search_es.property_condition_handler' => 'getShopwareSearchEs_PropertyConditionHandlerService',
            'shopware_search_es.property_facet_handler' => 'getShopwareSearchEs_PropertyFacetHandlerService',
            'shopware_search_es.release_date_condition_handler' => 'getShopwareSearchEs_ReleaseDateConditionHandlerService',
            'shopware_search_es.release_date_sorting_handler' => 'getShopwareSearchEs_ReleaseDateSortingHandlerService',
            'shopware_search_es.sales_condition_handler' => 'getShopwareSearchEs_SalesConditionHandlerService',
            'shopware_search_es.search_random_sorting_handler' => 'getShopwareSearchEs_SearchRandomSortingHandlerService',
            'shopware_search_es.search_ranking_sorting_handler' => 'getShopwareSearchEs_SearchRankingSortingHandlerService',
            'shopware_search_es.search_term_condition_handler' => 'getShopwareSearchEs_SearchTermConditionHandlerService',
            'shopware_search_es.search_term_query_builder' => 'getShopwareSearchEs_SearchTermQueryBuilderService',
            'shopware_search_es.service_subscriber' => 'getShopwareSearchEs_ServiceSubscriberService',
            'shopware_search_es.shipping_free_condition_handler' => 'getShopwareSearchEs_ShippingFreeConditionHandlerService',
            'shopware_search_es.shipping_free_facet_handler' => 'getShopwareSearchEs_ShippingFreeFacetHandlerService',
            'shopware_search_es.similar_product_condition_handler' => 'getShopwareSearchEs_SimilarProductConditionHandlerService',
            'shopware_search_es.struct_hydrator' => 'getShopwareSearchEs_StructHydratorService',
            'shopware_search_es.vote_average_condition_handler' => 'getShopwareSearchEs_VoteAverageConditionHandlerService',
            'shopware_search_es.vote_average_facet_handler' => 'getShopwareSearchEs_VoteAverageFacetHandlerService',
            'shopware_search_es.weight_condition_handler' => 'getShopwareSearchEs_WeightConditionHandlerService',
            'shopware_search_es.width_condition_handler' => 'getShopwareSearchEs_WidthConditionHandlerService',
            'shopware_searchdbal.cache_keyword_finder' => 'getShopwareSearchdbal_CacheKeywordFinderService',
            'shopware_searchdbal.category_condition_handler_dbal' => 'getShopwareSearchdbal_CategoryConditionHandlerDbalService',
            'shopware_searchdbal.category_facet_handler_dbal' => 'getShopwareSearchdbal_CategoryFacetHandlerDbalService',
            'shopware_searchdbal.closeout_condition_handler_dbal' => 'getShopwareSearchdbal_CloseoutConditionHandlerDbalService',
            'shopware_searchdbal.combined_condition_facet_handler_dbal' => 'getShopwareSearchdbal_CombinedConditionFacetHandlerDbalService',
            'shopware_searchdbal.combined_condition_handler_dbal' => 'getShopwareSearchdbal_CombinedConditionHandlerDbalService',
            'shopware_searchdbal.condition_handlers' => 'getShopwareSearchdbal_ConditionHandlersService',
            'shopware_searchdbal.create_date_condition_handler' => 'getShopwareSearchdbal_CreateDateConditionHandlerService',
            'shopware_searchdbal.customer_group_condition_handler_dbal' => 'getShopwareSearchdbal_CustomerGroupConditionHandlerDbalService',
            'shopware_searchdbal.dbal_query_builder_factory' => 'getShopwareSearchdbal_DbalQueryBuilderFactoryService',
            'shopware_searchdbal.facet_handlers' => 'getShopwareSearchdbal_FacetHandlersService',
            'shopware_searchdbal.has_pseudo_price_condition_handler_dbal' => 'getShopwareSearchdbal_HasPseudoPriceConditionHandlerDbalService',
            'shopware_searchdbal.height_condition_handler' => 'getShopwareSearchdbal_HeightConditionHandlerService',
            'shopware_searchdbal.immediate_delivery_condition_handler_dbal' => 'getShopwareSearchdbal_ImmediateDeliveryConditionHandlerDbalService',
            'shopware_searchdbal.immediate_delivery_facet_handler_dbal' => 'getShopwareSearchdbal_ImmediateDeliveryFacetHandlerDbalService',
            'shopware_searchdbal.is_available_condition_handler_dbal' => 'getShopwareSearchdbal_IsAvailableConditionHandlerDbalService',
            'shopware_searchdbal.is_new_condition_handler_dbal' => 'getShopwareSearchdbal_IsNewConditionHandlerDbalService',
            'shopware_searchdbal.keyword_finder_dbal' => 'getShopwareSearchdbal_KeywordFinderDbalService',
            'shopware_searchdbal.length_condition_handler' => 'getShopwareSearchdbal_LengthConditionHandlerService',
            'shopware_searchdbal.listing_price_table' => 'getShopwareSearchdbal_ListingPriceTableService',
            'shopware_searchdbal.manufacturer_condition_handler_dbal' => 'getShopwareSearchdbal_ManufacturerConditionHandlerDbalService',
            'shopware_searchdbal.manufacturer_facet_handler_dbal' => 'getShopwareSearchdbal_ManufacturerFacetHandlerDbalService',
            'shopware_searchdbal.ordernumber_condition_handler_dbal' => 'getShopwareSearchdbal_OrdernumberConditionHandlerDbalService',
            'shopware_searchdbal.popularity_sorting_handler_dbal' => 'getShopwareSearchdbal_PopularitySortingHandlerDbalService',
            'shopware_searchdbal.price_condition_handler_dbal' => 'getShopwareSearchdbal_PriceConditionHandlerDbalService',
            'shopware_searchdbal.price_facet_handler_dbal' => 'getShopwareSearchdbal_PriceFacetHandlerDbalService',
            'shopware_searchdbal.price_sorting_handler_sorting_handler_dbal' => 'getShopwareSearchdbal_PriceSortingHandlerSortingHandlerDbalService',
            'shopware_searchdbal.product_attribute_condition_handler_dbal' => 'getShopwareSearchdbal_ProductAttributeConditionHandlerDbalService',
            'shopware_searchdbal.product_attribute_facet_handler_dbal' => 'getShopwareSearchdbal_ProductAttributeFacetHandlerDbalService',
            'shopware_searchdbal.product_dimensions_facet_handler' => 'getShopwareSearchdbal_ProductDimensionsFacetHandlerService',
            'shopware_searchdbal.product_name_sorting_handler_dbal' => 'getShopwareSearchdbal_ProductNameSortingHandlerDbalService',
            'shopware_searchdbal.property_condition_handler_dbal' => 'getShopwareSearchdbal_PropertyConditionHandlerDbalService',
            'shopware_searchdbal.property_facet_handler_dbal' => 'getShopwareSearchdbal_PropertyFacetHandlerDbalService',
            'shopware_searchdbal.random_sorting_handler_dbal' => 'getShopwareSearchdbal_RandomSortingHandlerDbalService',
            'shopware_searchdbal.release_date_condition_handler' => 'getShopwareSearchdbal_ReleaseDateConditionHandlerService',
            'shopware_searchdbal.release_date_sorting_handler_dbal' => 'getShopwareSearchdbal_ReleaseDateSortingHandlerDbalService',
            'shopware_searchdbal.sales_condition_handler_dbal' => 'getShopwareSearchdbal_SalesConditionHandlerDbalService',
            'shopware_searchdbal.search_condition_handler_dbal' => 'getShopwareSearchdbal_SearchConditionHandlerDbalService',
            'shopware_searchdbal.search_indexer' => 'getShopwareSearchdbal_SearchIndexerService',
            'shopware_searchdbal.search_price_helper_dbal' => 'getShopwareSearchdbal_SearchPriceHelperDbalService',
            'shopware_searchdbal.search_query_builder_dbal' => 'getShopwareSearchdbal_SearchQueryBuilderDbalService',
            'shopware_searchdbal.search_ranking_sorting_handler_dbal' => 'getShopwareSearchdbal_SearchRankingSortingHandlerDbalService',
            'shopware_searchdbal.search_term_helper' => 'getShopwareSearchdbal_SearchTermHelperService',
            'shopware_searchdbal.search_term_logger' => 'getShopwareSearchdbal_SearchTermLoggerService',
            'shopware_searchdbal.shipping_free_condition_handler_dbal' => 'getShopwareSearchdbal_ShippingFreeConditionHandlerDbalService',
            'shopware_searchdbal.shipping_free_facet_handler_dbal' => 'getShopwareSearchdbal_ShippingFreeFacetHandlerDbalService',
            'shopware_searchdbal.shopware_searchdbal.product_attribute_sorting_handler_dbal' => 'getShopwareSearchdbal_ShopwareSearchdbal_ProductAttributeSortingHandlerDbalService',
            'shopware_searchdbal.similar_products_handler_dbal' => 'getShopwareSearchdbal_SimilarProductsHandlerDbalService',
            'shopware_searchdbal.sorting_handlers' => 'getShopwareSearchdbal_SortingHandlersService',
            'shopware_searchdbal.variant_helper' => 'getShopwareSearchdbal_VariantHelperService',
            'shopware_searchdbal.vote_average_condition_handler_dbal' => 'getShopwareSearchdbal_VoteAverageConditionHandlerDbalService',
            'shopware_searchdbal.vote_average_facet_handler_dbal' => 'getShopwareSearchdbal_VoteAverageFacetHandlerDbalService',
            'shopware_searchdbal.weight_condition_handler' => 'getShopwareSearchdbal_WeightConditionHandlerService',
            'shopware_searchdbal.width_condition_handler' => 'getShopwareSearchdbal_WidthConditionHandlerService',
            'shopware_storefront.additional_text_service' => 'getShopwareStorefront_AdditionalTextServiceService',
            'shopware_storefront.attribute_hydrator_dbal' => 'getShopwareStorefront_AttributeHydratorDbalService',
            'shopware_storefront.base_product_factory' => 'getShopwareStorefront_BaseProductFactoryService',
            'shopware_storefront.blog_gateway_dbal' => 'getShopwareStorefront_BlogGatewayDbalService',
            'shopware_storefront.blog_hydrator_dbal' => 'getShopwareStorefront_BlogHydratorDbalService',
            'shopware_storefront.blog_service' => 'getShopwareStorefront_BlogServiceService',
            'shopware_storefront.category_depth_service' => 'getShopwareStorefront_CategoryDepthServiceService',
            'shopware_storefront.category_gateway' => 'getShopwareStorefront_CategoryGatewayService',
            'shopware_storefront.category_hydrator_dbal' => 'getShopwareStorefront_CategoryHydratorDbalService',
            'shopware_storefront.category_service' => 'getShopwareStorefront_CategoryServiceService',
            'shopware_storefront.cheapest_price_gateway' => 'getShopwareStorefront_CheapestPriceGatewayService',
            'shopware_storefront.cheapest_price_service' => 'getShopwareStorefront_CheapestPriceServiceService',
            'shopware_storefront.configurator_gateway' => 'getShopwareStorefront_ConfiguratorGatewayService',
            'shopware_storefront.configurator_hydrator_dbal' => 'getShopwareStorefront_ConfiguratorHydratorDbalService',
            'shopware_storefront.configurator_service' => 'getShopwareStorefront_ConfiguratorServiceService',
            'shopware_storefront.context_service' => 'getShopwareStorefront_ContextServiceService',
            'shopware_storefront.country_gateway' => 'getShopwareStorefront_CountryGatewayService',
            'shopware_storefront.country_hydrator_dbal' => 'getShopwareStorefront_CountryHydratorDbalService',
            'shopware_storefront.currency_gateway_dbal' => 'getShopwareStorefront_CurrencyGatewayDbalService',
            'shopware_storefront.currency_hydrator_dbal' => 'getShopwareStorefront_CurrencyHydratorDbalService',
            'shopware_storefront.custom_facet_gateway' => 'getShopwareStorefront_CustomFacetGatewayService',
            'shopware_storefront.custom_facet_service' => 'getShopwareStorefront_CustomFacetServiceService',
            'shopware_storefront.custom_listing_hydrator' => 'getShopwareStorefront_CustomListingHydratorService',
            'shopware_storefront.custom_sorting_gateway' => 'getShopwareStorefront_CustomSortingGatewayService',
            'shopware_storefront.custom_sorting_service' => 'getShopwareStorefront_CustomSortingServiceService',
            'shopware_storefront.customer_group_gateway' => 'getShopwareStorefront_CustomerGroupGatewayService',
            'shopware_storefront.customer_group_hydrator_dbal' => 'getShopwareStorefront_CustomerGroupHydratorDbalService',
            'shopware_storefront.download_gateway' => 'getShopwareStorefront_DownloadGatewayService',
            'shopware_storefront.download_hydrator_dbal' => 'getShopwareStorefront_DownloadHydratorDbalService',
            'shopware_storefront.esd_hydrator_dbal' => 'getShopwareStorefront_EsdHydratorDbalService',
            'shopware_storefront.field_helper_dbal' => 'getShopwareStorefront_FieldHelperDbalService',
            'shopware_storefront.graduated_prices_gateway' => 'getShopwareStorefront_GraduatedPricesGatewayService',
            'shopware_storefront.graduated_prices_service' => 'getShopwareStorefront_GraduatedPricesServiceService',
            'shopware_storefront.link_gateway' => 'getShopwareStorefront_LinkGatewayService',
            'shopware_storefront.link_hydrator_dbal' => 'getShopwareStorefront_LinkHydratorDbalService',
            'shopware_storefront.list_product_gateway' => 'getShopwareStorefront_ListProductGatewayService',
            'shopware_storefront.list_product_service' => 'getShopwareStorefront_ListProductServiceService',
            'shopware_storefront.locale_hydrator_dbal' => 'getShopwareStorefront_LocaleHydratorDbalService',
            'shopware_storefront.location_service' => 'getShopwareStorefront_LocationServiceService',
            'shopware_storefront.manufacturer_gateway' => 'getShopwareStorefront_ManufacturerGatewayService',
            'shopware_storefront.manufacturer_hydrator_dbal' => 'getShopwareStorefront_ManufacturerHydratorDbalService',
            'shopware_storefront.manufacturer_service' => 'getShopwareStorefront_ManufacturerServiceService',
            'shopware_storefront.marketing_service' => 'getShopwareStorefront_MarketingServiceService',
            'shopware_storefront.media_gateway' => 'getShopwareStorefront_MediaGatewayService',
            'shopware_storefront.media_hydrator_dbal' => 'getShopwareStorefront_MediaHydratorDbalService',
            'shopware_storefront.media_service' => 'getShopwareStorefront_MediaServiceService',
            'shopware_storefront.price_calculation_service' => 'getShopwareStorefront_PriceCalculationServiceService',
            'shopware_storefront.price_calculator' => 'getShopwareStorefront_PriceCalculatorService',
            'shopware_storefront.price_group_discount_gateway' => 'getShopwareStorefront_PriceGroupDiscountGatewayService',
            'shopware_storefront.price_hydrator_dbal' => 'getShopwareStorefront_PriceHydratorDbalService',
            'shopware_storefront.product_configuration_gateway' => 'getShopwareStorefront_ProductConfigurationGatewayService',
            'shopware_storefront.product_download_service' => 'getShopwareStorefront_ProductDownloadServiceService',
            'shopware_storefront.product_hydrator_dbal' => 'getShopwareStorefront_ProductHydratorDbalService',
            'shopware_storefront.product_link_service' => 'getShopwareStorefront_ProductLinkServiceService',
            'shopware_storefront.product_media_gateway' => 'getShopwareStorefront_ProductMediaGatewayService',
            'shopware_storefront.product_number_service' => 'getShopwareStorefront_ProductNumberServiceService',
            'shopware_storefront.product_property_gateway' => 'getShopwareStorefront_ProductPropertyGatewayService',
            'shopware_storefront.product_service' => 'getShopwareStorefront_ProductServiceService',
            'shopware_storefront.product_stream_hydrator_dbal' => 'getShopwareStorefront_ProductStreamHydratorDbalService',
            'shopware_storefront.property_gateway' => 'getShopwareStorefront_PropertyGatewayService',
            'shopware_storefront.property_hydrator_dbal' => 'getShopwareStorefront_PropertyHydratorDbalService',
            'shopware_storefront.property_service' => 'getShopwareStorefront_PropertyServiceService',
            'shopware_storefront.related_product_streams_gateway' => 'getShopwareStorefront_RelatedProductStreamsGatewayService',
            'shopware_storefront.related_product_streams_service' => 'getShopwareStorefront_RelatedProductStreamsServiceService',
            'shopware_storefront.related_products_gateway' => 'getShopwareStorefront_RelatedProductsGatewayService',
            'shopware_storefront.related_products_service' => 'getShopwareStorefront_RelatedProductsServiceService',
            'shopware_storefront.shop_gateway_dbal' => 'getShopwareStorefront_ShopGatewayDbalService',
            'shopware_storefront.shop_hydrator_dbal' => 'getShopwareStorefront_ShopHydratorDbalService',
            'shopware_storefront.shop_page_gateway' => 'getShopwareStorefront_ShopPageGatewayService',
            'shopware_storefront.shop_page_hydrator_dbal' => 'getShopwareStorefront_ShopPageHydratorDbalService',
            'shopware_storefront.shop_page_service' => 'getShopwareStorefront_ShopPageServiceService',
            'shopware_storefront.similar_products_gateway' => 'getShopwareStorefront_SimilarProductsGatewayService',
            'shopware_storefront.similar_products_service' => 'getShopwareStorefront_SimilarProductsServiceService',
            'shopware_storefront.storefront_cache' => 'getShopwareStorefront_StorefrontCacheService',
            'shopware_storefront.tax_gateway' => 'getShopwareStorefront_TaxGatewayService',
            'shopware_storefront.tax_hydrator_dbal' => 'getShopwareStorefront_TaxHydratorDbalService',
            'shopware_storefront.template_hydrator_dbal' => 'getShopwareStorefront_TemplateHydratorDbalService',
            'shopware_storefront.unit_hydrator_dbal' => 'getShopwareStorefront_UnitHydratorDbalService',
            'shopware_storefront.variant_cover_service' => 'getShopwareStorefront_VariantCoverServiceService',
            'shopware_storefront.variant_media_gateway' => 'getShopwareStorefront_VariantMediaGatewayService',
            'shopware_storefront.vote_average_gateway' => 'getShopwareStorefront_VoteAverageGatewayService',
            'shopware_storefront.vote_gateway' => 'getShopwareStorefront_VoteGatewayService',
            'shopware_storefront.vote_hydrator_dbal' => 'getShopwareStorefront_VoteHydratorDbalService',
            'shopware_storefront.vote_service' => 'getShopwareStorefront_VoteServiceService',
            'sitemapxml.repository' => 'getSitemapxml_RepositoryService',
            'snippet_resource' => 'getSnippetResourceService',
            'snippets' => 'getSnippetsService',
            'template' => 'getTemplateService',
            'template_factory' => 'getTemplateFactoryService',
            'templatemail' => 'getTemplatemailService',
            'templatemail_factory' => 'getTemplatemailFactoryService',
            'theme_backend_registration' => 'getThemeBackendRegistrationService',
            'theme_compiler' => 'getThemeCompilerService',
            'theme_config_loader' => 'getThemeConfigLoaderService',
            'theme_config_persister' => 'getThemeConfigPersisterService',
            'theme_configurator' => 'getThemeConfiguratorService',
            'theme_generator' => 'getThemeGeneratorService',
            'theme_inheritance' => 'getThemeInheritanceService',
            'theme_installer' => 'getThemeInstallerService',
            'theme_path_resolver' => 'getThemePathResolverService',
            'theme_service' => 'getThemeServiceService',
            'theme_timestamp_persistor' => 'getThemeTimestampPersistorService',
            'theme_util' => 'getThemeUtilService',
            'thumbnail_generator_basic' => 'getThumbnailGeneratorBasicService',
            'thumbnail_manager' => 'getThumbnailManagerService',
            'translation' => 'getTranslationService',
            'validator' => 'getValidatorService',
            'validator.email' => 'getValidator_EmailService',
        );
        $this->aliases = array(
            'console.command.shopware_bundle_customersearchbundledbal_commands_searchindexpopulatecommand' => 'customer_search.dbal.search_index_populate_command',
            'less_compiler' => 'oyejorge_compiler',
            'plugin_manager' => 'plugins',
            'shopware.db' => 'db',
            'shopware.event_manager' => 'events',
            'shopware.hook_manager' => 'hooks',
            'shopware.loader' => 'loader',
            'shopware.locale' => 'locale',
            'shopware.mail_transport' => 'mailtransport',
            'shopware.model_annotations' => 'modelannotations',
            'shopware.model_config' => 'modelconfig',
            'shopware.model_manager' => 'models',
            'shopware.plugin_manager' => 'shopware_plugininstaller.plugin_manager',
            'shopware_plugininstaller.plugin_service_store' => 'shopware_plugininstaller.plugin_service_store_production',
        );
    }
    public function compile()
    {
        throw new LogicException('You cannot compile a dumped frozen container.');
    }
    public function isFrozen()
    {
        return true;
    }
    protected function getAclService()
    {
        return $this->services['acl'] = new \Shopware_Components_Acl($this->get('models'));
    }
    protected function getApplicationService()
    {
        throw new RuntimeException('You have requested a synthetic service ("application"). The DIC does not know how to construct this service.');
    }
    protected function getAttributesubscriberService()
    {
        return $this->services['attributesubscriber'] = new \Shopware\Components\AttributeSubscriber($this);
    }
    protected function getBasketCleanupCronJobSubscriberService()
    {
        return $this->services['basket_cleanup_cron_job_subscriber'] = new \Shopware\Components\BasketSignature\CleanupSignatureSubscriber($this->get('dbal_connection'));
    }
    protected function getBasketPersisterService()
    {
        return $this->services['basket_persister'] = new \Shopware\Components\BasketSignature\BasketPersister($this->get('dbal_connection'));
    }
    protected function getBasketSignatureGeneratorService()
    {
        return $this->services['basket_signature_generator'] = new \Shopware\Components\BasketSignature\BasketSignatureGenerator();
    }
    protected function getBootstrapService()
    {
        @trigger_error('The "bootstrap" service is deprecated since 5.2 and will be removed in 6.0.', E_USER_DEPRECATED);
        return $this->services['bootstrap'] = new \Shopware_Bootstrap($this);
    }
    protected function getCacheService()
    {
        return $this->services['cache'] = $this->get('cache_factory')->factory('auto', array('automatic_serialization' => true, 'automatic_cleaning_factor' => 0, 'lifetime' => 3600, 'cache_id_prefix' => 'ffa502642a155cd8fcdaeed7a2c5aaaa'), array('hashed_directory_perm' => 493, 'cache_file_perm' => 420, 'hashed_directory_level' => 3, 'cache_dir' => '/var/www/shopware/var/cache/production_201710241020/general', 'file_name_prefix' => 'shopware'));
    }
    protected function getCacheFactoryService()
    {
        return $this->services['cache_factory'] = new \Shopware\Components\DependencyInjection\Bridge\Cache();
    }
    protected function getCategorydenormalizationService()
    {
        return $this->services['categorydenormalization'] = new \Shopware\Components\Model\CategoryDenormalization($this->get('db_connection'));
    }
    protected function getCategoryduplicatorService()
    {
        return $this->services['categoryduplicator'] = new \Shopware\Components\CategoryHandling\CategoryDuplicator($this->get('db_connection'), $this->get('categorydenormalization'), $this->get('shopware_attribute.data_persister'));
    }
    protected function getCategorysubscriberService()
    {
        return $this->services['categorysubscriber'] = new \Shopware\Components\Model\CategorySubscriber($this);
    }
    protected function getConfigService()
    {
        return $this->services['config'] = $this->get('config_factory')->factory($this->get('cache'), $this->get('db', ContainerInterface::NULL_ON_INVALID_REFERENCE), array());
    }
    protected function getConfigFactoryService()
    {
        return $this->services['config_factory'] = new \Shopware\Components\DependencyInjection\Bridge\Config();
    }
    protected function getConfigWriterService()
    {
        return $this->services['config_writer'] = new \Shopware\Components\ConfigWriter($this->get('dbal_connection'));
    }
    protected function getCoreloggerService()
    {
        $this->services['corelogger'] = $instance = new \Shopware\Components\Logger('core');
        $instance->pushHandler($this->get('monolog.handler.main'));
        return $instance;
    }
    protected function getCronService()
    {
        return $this->services['cron'] = new \Enlight_Components_Cron_Manager($this->get('cron_adapter'), $this->get('events'), 'Shopware_Components_Cron_CronJob');
    }
    protected function getCronAdapterService()
    {
        return $this->services['cron_adapter'] = new \Enlight_Components_Cron_Adapter_DBAL($this->get('dbal_connection'));
    }
    protected function getCurrencyService()
    {
        return $this->services['currency'] = $this->get('currency_factory')->factory($this, $this->get('locale'));
    }
    protected function getCurrencyFactoryService()
    {
        return $this->services['currency_factory'] = new \Shopware\Components\DependencyInjection\Bridge\Currency();
    }
    protected function getCustomerSearch_Dbal_Condition_AccountModeHandlerService()
    {
        return $this->services['customer_search.dbal.condition.account_mode_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\ConditionHandler\AccountModeConditionHandler();
    }
    protected function getCustomerSearch_Dbal_Condition_AgeHandlerService()
    {
        return $this->services['customer_search.dbal.condition.age_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\ConditionHandler\AgeConditionHandler();
    }
    protected function getCustomerSearch_Dbal_Condition_AssignedToStreamHandlerService()
    {
        return $this->services['customer_search.dbal.condition.assigned_to_stream_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\ConditionHandler\AssignedToStreamConditionHandler();
    }
    protected function getCustomerSearch_Dbal_Condition_CustomerAttributeHandlerService()
    {
        return $this->services['customer_search.dbal.condition.customer_attribute_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\ConditionHandler\CustomerAttributeConditionHandler();
    }
    protected function getCustomerSearch_Dbal_Condition_HasAddressWithCountryHandlerService()
    {
        return $this->services['customer_search.dbal.condition.has_address_with_country_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\ConditionHandler\HasAddressWithCountryConditionHandler();
    }
    protected function getCustomerSearch_Dbal_Condition_HasCanceledOrdersHandlerService()
    {
        return $this->services['customer_search.dbal.condition.has_canceled_orders_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\ConditionHandler\HasCanceledOrdersConditionHandler();
    }
    protected function getCustomerSearch_Dbal_Condition_HasNewsletterRegistrationService()
    {
        return $this->services['customer_search.dbal.condition.has_newsletter_registration'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\ConditionHandler\HasNewsletterRegistrationConditionHandler();
    }
    protected function getCustomerSearch_Dbal_Condition_HasOrderCountHandlerService()
    {
        return $this->services['customer_search.dbal.condition.has_order_count_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\ConditionHandler\HasOrderCountConditionHandler();
    }
    protected function getCustomerSearch_Dbal_Condition_HasTotalOrderAmountHandlerService()
    {
        return $this->services['customer_search.dbal.condition.has_total_order_amount_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\ConditionHandler\HasTotalOrderAmountConditionHandler();
    }
    protected function getCustomerSearch_Dbal_Condition_IsCustomerSinceHandlerService()
    {
        return $this->services['customer_search.dbal.condition.is_customer_since_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\ConditionHandler\IsCustomerSinceConditionHandler();
    }
    protected function getCustomerSearch_Dbal_Condition_IsInCustomerGroupHandlerService()
    {
        return $this->services['customer_search.dbal.condition.is_in_customer_group_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\ConditionHandler\IsInCustomerGroupConditionHandler();
    }
    protected function getCustomerSearch_Dbal_Condition_OrderedAtWeekdayHandlerService()
    {
        return $this->services['customer_search.dbal.condition.ordered_at_weekday_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\ConditionHandler\OrderedAtWeekdayConditionHandler();
    }
    protected function getCustomerSearch_Dbal_Condition_OrderedInLastDaysHandlerService()
    {
        return $this->services['customer_search.dbal.condition.ordered_in_last_days_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\ConditionHandler\OrderedInLastDaysConditionHandler();
    }
    protected function getCustomerSearch_Dbal_Condition_OrderedInShopHandlerService()
    {
        return $this->services['customer_search.dbal.condition.ordered_in_shop_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\ConditionHandler\OrderedInShopConditionHandler();
    }
    protected function getCustomerSearch_Dbal_Condition_OrderedOnDeviceHandlerService()
    {
        return $this->services['customer_search.dbal.condition.ordered_on_device_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\ConditionHandler\OrderedOnDeviceConditionHandler();
    }
    protected function getCustomerSearch_Dbal_Condition_OrderedProductHandlerService()
    {
        return $this->services['customer_search.dbal.condition.ordered_product_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\ConditionHandler\OrderedProductConditionHandler();
    }
    protected function getCustomerSearch_Dbal_Condition_OrderedProductOfCategoryHandlerService()
    {
        return $this->services['customer_search.dbal.condition.ordered_product_of_category_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\ConditionHandler\OrderedProductOfCategoryConditionHandler();
    }
    protected function getCustomerSearch_Dbal_Condition_OrderedProductOfManufacturerHandlerService()
    {
        return $this->services['customer_search.dbal.condition.ordered_product_of_manufacturer_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\ConditionHandler\OrderedProductOfManufacturerConditionHandler();
    }
    protected function getCustomerSearch_Dbal_Condition_OrderedWithDeliveryHandlerService()
    {
        return $this->services['customer_search.dbal.condition.ordered_with_delivery_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\ConditionHandler\OrderedWithDeliveryConditionHandler();
    }
    protected function getCustomerSearch_Dbal_Condition_OrderedWithPaymentHandlerService()
    {
        return $this->services['customer_search.dbal.condition.ordered_with_payment_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\ConditionHandler\OrderedWithPaymentConditionHandler();
    }
    protected function getCustomerSearch_Dbal_Condition_RegisteredInShopHandlerService()
    {
        return $this->services['customer_search.dbal.condition.registered_in_shop_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\ConditionHandler\RegisteredInShopConditionHandler();
    }
    protected function getCustomerSearch_Dbal_Condition_SalutationHandlerService()
    {
        return $this->services['customer_search.dbal.condition.salutation_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\ConditionHandler\SalutationConditionHandler();
    }
    protected function getCustomerSearch_Dbal_Condition_SearchTermHandlerService()
    {
        return $this->services['customer_search.dbal.condition.search_term_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\ConditionHandler\SearchTermConditionHandler();
    }
    protected function getCustomerSearch_Dbal_Gateway_ServiceService()
    {
        return $this->services['customer_search.dbal.gateway.service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\CustomerService($this->get('shopware_customer_search.gateway.customer_gateway'), $this->get('shopware_customer_search.gateway.address_gateway'));
    }
    protected function getCustomerSearch_Dbal_HandlerRegistryService()
    {
        return $this->services['customer_search.dbal.handler_registry'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\HandlerRegistry(array(0 => $this->get('customer_search.dbal.condition.age_handler'), 1 => $this->get('customer_search.dbal.condition.account_mode_handler'), 2 => $this->get('customer_search.dbal.condition.search_term_handler'), 3 => $this->get('customer_search.dbal.condition.salutation_handler'), 4 => $this->get('customer_search.dbal.condition.registered_in_shop_handler'), 5 => $this->get('customer_search.dbal.condition.ordered_with_payment_handler'), 6 => $this->get('customer_search.dbal.condition.ordered_with_delivery_handler'), 7 => $this->get('customer_search.dbal.condition.ordered_product_of_manufacturer_handler'), 8 => $this->get('customer_search.dbal.condition.ordered_product_of_category_handler'), 9 => $this->get('customer_search.dbal.condition.ordered_product_handler'), 10 => $this->get('customer_search.dbal.condition.ordered_on_device_handler'), 11 => $this->get('customer_search.dbal.condition.ordered_in_shop_handler'), 12 => $this->get('customer_search.dbal.condition.ordered_in_last_days_handler'), 13 => $this->get('customer_search.dbal.condition.ordered_at_weekday_handler'), 14 => $this->get('customer_search.dbal.condition.is_in_customer_group_handler'), 15 => $this->get('customer_search.dbal.condition.is_customer_since_handler'), 16 => $this->get('customer_search.dbal.condition.has_total_order_amount_handler'), 17 => $this->get('customer_search.dbal.condition.has_order_count_handler'), 18 => $this->get('customer_search.dbal.condition.has_newsletter_registration'), 19 => $this->get('customer_search.dbal.condition.has_canceled_orders_handler'), 20 => $this->get('customer_search.dbal.condition.has_address_with_country_handler'), 21 => $this->get('customer_search.dbal.condition.customer_attribute_handler'), 22 => $this->get('customer_search.dbal.condition.assigned_to_stream_handler')), array(0 => $this->get('customer_search.dbal.sorting.age_sorting_handler'), 1 => $this->get('customer_search.dbal.sorting.zip_code_handler'), 2 => $this->get('customer_search.dbal.sorting.total_amount_handler'), 3 => $this->get('customer_search.dbal.sorting.street_name_handler'), 4 => $this->get('customer_search.dbal.sorting.order_count_handler'), 5 => $this->get('customer_search.dbal.sorting.number_handler'), 6 => $this->get('customer_search.dbal.sorting.last_order_handler'), 7 => $this->get('customer_search.dbal.sorting.last_name_handler'), 8 => $this->get('customer_search.dbal.sorting.customer_since_handler'), 9 => $this->get('customer_search.dbal.sorting.customer_group_handler'), 10 => $this->get('customer_search.dbal.sorting.city_handler'), 11 => $this->get('customer_search.dbal.sorting.average_product_amount_handler'), 12 => $this->get('customer_search.dbal.sorting.average_amount_handler')));
    }
    protected function getCustomerSearch_Dbal_Indexing_CronJobSubscriberService()
    {
        return $this->services['customer_search.dbal.indexing.cron_job_subscriber'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\Indexing\CronJobSubscriber($this->get('dbal_connection'), $this->get('customer_search.dbal.indexing.indexer'), $this->get('shopware.customer_stream.stream_indexer'));
    }
    protected function getCustomerSearch_Dbal_Indexing_CustomerOrderHydratorService()
    {
        return $this->services['customer_search.dbal.indexing.customer_order_hydrator'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\Indexing\CustomerOrderHydrator();
    }
    protected function getCustomerSearch_Dbal_Indexing_IndexerService()
    {
        return $this->services['customer_search.dbal.indexing.indexer'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\Indexing\SearchIndexer($this->get('dbal_connection'), $this->get('customer_search.dbal.indexing.provider'));
    }
    protected function getCustomerSearch_Dbal_Indexing_OrderGatewayService()
    {
        return $this->services['customer_search.dbal.indexing.order_gateway'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\Indexing\CustomerOrderGateway($this->get('dbal_connection'), $this->get('customer_search.dbal.indexing.customer_order_hydrator'));
    }
    protected function getCustomerSearch_Dbal_Indexing_ProviderService()
    {
        return $this->services['customer_search.dbal.indexing.provider'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\Indexing\CustomerProvider($this->get('customer_search.dbal.gateway.service'), $this->get('customer_search.dbal.indexing.order_gateway'));
    }
    protected function getCustomerSearch_Dbal_NumberSearchService()
    {
        return $this->services['customer_search.dbal.number_search'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\CustomerNumberSearch($this->get('customer_search.dbal.handler_registry'), $this->get('dbal_connection'));
    }
    protected function getCustomerSearch_Dbal_SearchIndexPopulateCommandService()
    {
        return $this->services['customer_search.dbal.search_index_populate_command'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\Commands\SearchIndexPopulateCommand();
    }
    protected function getCustomerSearch_Dbal_Sorting_AgeSortingHandlerService()
    {
        return $this->services['customer_search.dbal.sorting.age_sorting_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\SortingHandler\AgeSortingHandler();
    }
    protected function getCustomerSearch_Dbal_Sorting_AverageAmountHandlerService()
    {
        return $this->services['customer_search.dbal.sorting.average_amount_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\SortingHandler\AverageAmountSortingHandler();
    }
    protected function getCustomerSearch_Dbal_Sorting_AverageProductAmountHandlerService()
    {
        return $this->services['customer_search.dbal.sorting.average_product_amount_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\SortingHandler\AverageProductAmountSortingHandler();
    }
    protected function getCustomerSearch_Dbal_Sorting_CityHandlerService()
    {
        return $this->services['customer_search.dbal.sorting.city_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\SortingHandler\CitySortingHandler();
    }
    protected function getCustomerSearch_Dbal_Sorting_CustomerGroupHandlerService()
    {
        return $this->services['customer_search.dbal.sorting.customer_group_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\SortingHandler\CustomerGroupSortingHandler();
    }
    protected function getCustomerSearch_Dbal_Sorting_CustomerSinceHandlerService()
    {
        return $this->services['customer_search.dbal.sorting.customer_since_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\SortingHandler\CustomerSinceSortingHandler();
    }
    protected function getCustomerSearch_Dbal_Sorting_LastNameHandlerService()
    {
        return $this->services['customer_search.dbal.sorting.last_name_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\SortingHandler\LastNameSortingHandler();
    }
    protected function getCustomerSearch_Dbal_Sorting_LastOrderHandlerService()
    {
        return $this->services['customer_search.dbal.sorting.last_order_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\SortingHandler\LastOrderSortingHandler();
    }
    protected function getCustomerSearch_Dbal_Sorting_NumberHandlerService()
    {
        return $this->services['customer_search.dbal.sorting.number_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\SortingHandler\NumberSortingHandler();
    }
    protected function getCustomerSearch_Dbal_Sorting_OrderCountHandlerService()
    {
        return $this->services['customer_search.dbal.sorting.order_count_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\SortingHandler\OrderCountSortingHandler();
    }
    protected function getCustomerSearch_Dbal_Sorting_StreetNameHandlerService()
    {
        return $this->services['customer_search.dbal.sorting.street_name_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\SortingHandler\StreetNameSortingHandler();
    }
    protected function getCustomerSearch_Dbal_Sorting_TotalAmountHandlerService()
    {
        return $this->services['customer_search.dbal.sorting.total_amount_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\SortingHandler\TotalAmountSortingHandler();
    }
    protected function getCustomerSearch_Dbal_Sorting_ZipCodeHandlerService()
    {
        return $this->services['customer_search.dbal.sorting.zip_code_handler'] = new \Shopware\Bundle\CustomerSearchBundleDBAL\SortingHandler\ZipCodeSortingHandler();
    }
    protected function getDateService()
    {
        return $this->services['date'] = new \Zend_Date($this->get('locale'));
    }
    protected function getDbService()
    {
        return $this->services['db'] = \Shopware\Components\DependencyInjection\Bridge\Db::createEnlightDbAdapter($this->get('dbal_connection'), array('username' => 'docker', 'password' => 'docker', 'dbname' => 'shopware', 'host' => 'localhost', 'charset' => 'utf8mb4', 'adapter' => 'pdo_mysql', 'port' => '3306'));
    }
    protected function getDbConnectionService()
    {
        throw new RuntimeException('You have requested a synthetic service ("db_connection"). The DIC does not know how to construct this service.');
    }
    protected function getDbalConnectionService()
    {
        return $this->services['dbal_connection'] = \Shopware\Components\DependencyInjection\Bridge\Db::createDbalConnection(array('username' => 'docker', 'password' => 'docker', 'dbname' => 'shopware', 'host' => 'localhost', 'charset' => 'utf8mb4', 'adapter' => 'pdo_mysql', 'port' => '3306'), $this->get('modelconfig'), $this->get('model_event_manager'), $this->get('db_connection'));
    }
    protected function getDebugloggerService()
    {
        return $this->services['debuglogger'] = new \Shopware\Components\Logger('debug');
    }
    protected function getDispatcherService()
    {
        return $this->services['dispatcher'] = new \Enlight_Controller_Dispatcher_Default();
    }
    protected function getEmotionDeviceConfigurationService()
    {
        return $this->services['emotion_device_configuration'] = new \Shopware\Components\Emotion\DeviceConfiguration($this->get('dbal_connection'));
    }
    protected function getErrorsubscriberService()
    {
        return $this->services['errorsubscriber'] = new \Shopware\Components\ErrorSubscriber();
    }
    protected function getEventsService()
    {
        $this->services['events'] = $instance = new \Shopware\Components\ContainerAwareEventManager($this);
        $instance->addListenerService('Enlight_Controller_Front_RouteShutdown', array(0 => 'theme_backend_registration', 1 => 'registerBackendTheme'), 0);
        $instance->addListenerService('Enlight_Controller_Front_RouteStartup', array(0 => 'monolog.handler.chromephp', 1 => 'onRouteStartUp'), 0);
        $instance->addListenerService('Enlight_Controller_Front_RouteStartup', array(0 => 'monolog.handler.firephp', 1 => 'onRouteStartUp'), 0);
        $instance->addSubscriberService('attributesubscriber', 'Shopware\\Components\\AttributeSubscriber');
        $instance->addSubscriberService('errorsubscriber', 'Shopware\\Components\\ErrorSubscriber');
        $instance->addSubscriberService('shopware.upload_max_size_validator', 'Shopware\\Components\\UploadMaxSizeValidator');
        $instance->addSubscriberService('shopware.csrftoken_validator', 'Shopware\\Components\\CSRFTokenValidator');
        $instance->addSubscriberService('shopware_core.license_service_subscriber', 'Shopware\\Components\\License\\Service\\LicenseServiceSubscriber');
        $instance->addSubscriberService('basket_cleanup_cron_job_subscriber', 'Shopware\\Components\\BasketSignature\\CleanupSignatureSubscriber');
        $instance->addSubscriberService('shopware.components.last_articles_subscriber', 'Shopware\\Components\\LastArticlesSubscriber');
        $instance->addSubscriberService('shopware.customer_stream.cookie_subscriber', 'Shopware\\Components\\CustomerStream\\CookieSubscriber');
        $instance->addSubscriberService('theme_config_loader', 'Shopware\\Components\\Theme\\EventListener\\ConfigLoader');
        $instance->addSubscriberService('shopware_elastic_search.service_subscriber', 'Shopware\\Bundle\\ESIndexingBundle\\Subscriber\\ServiceSubscriber');
        $instance->addSubscriberService('shopware_elastic_search.orm_backlog_save_subscriber', 'Shopware\\Bundle\\ESIndexingBundle\\Subscriber\\ORMBacklogSaveSubscriber');
        $instance->addSubscriberService('shopware_elastic_search.domain_backlog_subscriber', 'Shopware\\Bundle\\ESIndexingBundle\\Subscriber\\DomainBacklogSubscriber');
        $instance->addSubscriberService('shopware_media.service_subscriber', 'Shopware\\Bundle\\MediaBundle\\Subscriber\\ServiceSubscriber');
        $instance->addSubscriberService('shopware_attribute.controller_subscriber', 'Shopware\\Bundle\\AttributeBundle\\DependencyInjection\\EventListener\\ControllerSubscriber');
        $instance->addSubscriberService('shopware_search_es.service_subscriber', 'Shopware\\Bundle\\SearchBundleES\\Subscriber\\ServiceSubscriber');
        $instance->addSubscriberService('customer_search.dbal.indexing.cron_job_subscriber', 'Shopware\\Bundle\\CustomerSearchBundleDBAL\\Indexing\\CronJobSubscriber');
        return $instance;
    }
    protected function getFileSystemService()
    {
        return $this->services['file_system'] = new \Symfony\Component\Filesystem\Filesystem();
    }
    protected function getFirstRunWizardPluginStoreService()
    {
        return $this->services['first_run_wizard_plugin_store'] = new \Shopware\Bundle\PluginInstallerBundle\Service\FirstRunWizardPluginStoreService($this->get('shopware_plugininstaller.plugin_installer_struct_hydrator'), $this->get('shopware_plugininstaller.plugin_service_local'), $this->get('shopware_plugininstaller.store_client'));
    }
    protected function getFrontService()
    {
        return $this->services['front'] = $this->get('front_factory')->factory($this, $this->get('events'), array('noErrorHandler' => false, 'throwExceptions' => false, 'disableOutputBuffering' => false, 'showException' => false, 'charset' => 'utf-8'));
    }
    protected function getFrontFactoryService()
    {
        return $this->services['front_factory'] = new \Shopware\Components\DependencyInjection\Bridge\Front();
    }
    protected function getGuzzleHttpClientFactoryService()
    {
        return $this->services['guzzle_http_client_factory'] = new \Shopware\Components\HttpClient\GuzzleFactory();
    }
    protected function getHooksService()
    {
        return $this->services['hooks'] = new \Enlight_Hook_HookManager($this->get('events'), $this->get('loader'), array('proxyDir' => '/var/www/shopware/var/cache/production_201710241020/proxies', 'proxyNamespace' => 'Shopware_Proxies'));
    }
    protected function getHttpCacheWarmerService()
    {
        return $this->services['http_cache_warmer'] = new \Shopware\Components\HttpCache\CacheWarmer($this->get('dbal_connection'), $this->get('corelogger'), $this->get('guzzle_http_client_factory'));
    }
    protected function getHttpClientService()
    {
        return $this->services['http_client'] = new \Shopware\Components\HttpClient\GuzzleHttpClient($this->get('guzzle_http_client_factory'));
    }
    protected function getJsCompressorService()
    {
        return $this->services['js_compressor'] = new \Shopware\Components\Theme\Compressor\Js();
    }
    protected function getLegacyEventManagerService()
    {
        return $this->services['legacy_event_manager'] = new \Shopware\Components\Compatibility\LegacyEventManager($this->get('events'), $this->get('config'), $this->get('shopware_storefront.context_service'));
    }
    protected function getLegacyStructConverterService()
    {
        return $this->services['legacy_struct_converter'] = new \Shopware\Components\Compatibility\LegacyStructConverter($this->get('config'), $this->get('shopware_storefront.context_service'), $this->get('events'), $this->get('shopware_media.media_service'), $this->get('dbal_connection'), $this->get('models'), $this->get('shopware_storefront.category_service'), $this);
    }
    protected function getLoaderService()
    {
        return $this->services['loader'] = new \Enlight_Loader();
    }
    protected function getLocaleService()
    {
        return $this->services['locale'] = $this->get('locale_factory')->factory($this);
    }
    protected function getLocaleFactoryService()
    {
        return $this->services['locale_factory'] = new \Shopware\Components\DependencyInjection\Bridge\Locale();
    }
    protected function getMailService()
    {
        return $this->services['mail'] = $this->get('mail_factory')->factory($this, $this->get('config'), array('charset' => 'utf-8'));
    }
    protected function getMailFactoryService()
    {
        return $this->services['mail_factory'] = new \Shopware\Components\DependencyInjection\Bridge\Mail();
    }
    protected function getMailtransportService()
    {
        return $this->services['mailtransport'] = $this->get('mailtransport_factory')->factory($this->get('loader'), $this->get('config'), array('charset' => 'utf-8'));
    }
    protected function getMailtransportFactoryService()
    {
        return $this->services['mailtransport_factory'] = new \Shopware\Components\DependencyInjection\Bridge\MailTransport();
    }
    protected function getModelAnnotationsFactoryService()
    {
        return $this->services['model_annotations_factory'] = new \Shopware\Components\DependencyInjection\Bridge\ModelAnnotation();
    }
    protected function getModelFactoryService()
    {
        return $this->services['model_factory'] = new \Shopware\Components\DependencyInjection\Bridge\Models();
    }
    protected function getModelannotationsService()
    {
        return $this->services['modelannotations'] = $this->get('model_annotations_factory')->factory($this->get('modelconfig'), '/var/www/shopware/engine/Shopware/Models');
    }
    protected function getModelconfigService()
    {
        return $this->services['modelconfig'] = new \Shopware\Components\Model\Configuration(array('autoGenerateProxyClasses' => false, 'attributeDir' => '/var/www/shopware/var/cache/production_201710241020/doctrine/attributes', 'proxyDir' => '/var/www/shopware/var/cache/production_201710241020/doctrine/proxies', 'proxyNamespace' => 'Shopware\\Proxies', 'cacheProvider' => 'auto', 'cacheNamespace' => NULL), $this->get('cache'), new \Shopware\Components\Model\ProxyAwareRepositoryFactory($this->get('hooks')));
    }
    protected function getModelsService()
    {
        return $this->services['models'] = $this->get('model_factory')->factory($this->get('model_event_manager'), $this->get('modelconfig'), $this->get('loader'), $this->get('dbal_connection'), $this->get('modelannotations'));
    }
    protected function getModelsMetadataCacheService()
    {
        return $this->services['models_metadata_cache'] = $this->get('modelconfig')->getMetadataCacheImpl();
    }
    protected function getMonolog_Formatter_WildfireService()
    {
        return $this->services['monolog.formatter.wildfire'] = new \Shopware\Components\Log\Formatter\WildfireFormatter();
    }
    protected function getMonolog_Handler_ChromephpService()
    {
        return $this->services['monolog.handler.chromephp'] = new \Shopware\Components\Log\Handler\ChromePhpHandler();
    }
    protected function getMonolog_Handler_FirephpService()
    {
        $this->services['monolog.handler.firephp'] = $instance = new \Shopware\Components\Log\Handler\FirePHPHandler();
        $instance->setFormatter($this->get('monolog.formatter.wildfire'));
        return $instance;
    }
    protected function getMonolog_Handler_MainService()
    {
        $a = new \Monolog\Handler\RotatingFileHandler('/var/www/shopware/var/log/core_production.log', 14);
        $a->pushProcessor($this->get('monolog.processor.uid'));
        return $this->services['monolog.handler.main'] = new \Monolog\Handler\FingersCrossedHandler($a, 200);
    }
    protected function getMultiEdit_ProductService()
    {
        return $this->services['multi_edit.product'] = new \Shopware\Components\MultiEdit\Resource\Product($this->get('multi_edit.product.dql_helper'), $this->get('multi_edit.product.grammar'), $this->get('multi_edit.product.value'), $this->get('multi_edit.product.filter'), $this->get('multi_edit.product.batch_process'), $this->get('multi_edit.product.queue'), $this->get('multi_edit.product.backup'));
    }
    protected function getMultiEdit_Product_BackupService()
    {
        return $this->services['multi_edit.product.backup'] = new \Shopware\Components\MultiEdit\Resource\Product\Backup($this->get('multi_edit.product.dql_helper'), $this->get('config'));
    }
    protected function getMultiEdit_Product_BatchProcessService()
    {
        return $this->services['multi_edit.product.batch_process'] = new \Shopware\Components\MultiEdit\Resource\Product\BatchProcess($this->get('multi_edit.product.dql_helper'), $this->get('multi_edit.product.filter'), $this->get('multi_edit.product.queue'), $this->get('config'));
    }
    protected function getMultiEdit_Product_DqlHelperService()
    {
        return $this->services['multi_edit.product.dql_helper'] = new \Shopware\Components\MultiEdit\Resource\Product\DqlHelper($this->get('db'), $this->get('models'), $this->get('events'));
    }
    protected function getMultiEdit_Product_FilterService()
    {
        return $this->services['multi_edit.product.filter'] = new \Shopware\Components\MultiEdit\Resource\Product\Filter($this->get('multi_edit.product.dql_helper'));
    }
    protected function getMultiEdit_Product_GrammarService()
    {
        return $this->services['multi_edit.product.grammar'] = new \Shopware\Components\MultiEdit\Resource\Product\Grammar($this->get('multi_edit.product.dql_helper'), $this->get('events'));
    }
    protected function getMultiEdit_Product_QueueService()
    {
        return $this->services['multi_edit.product.queue'] = new \Shopware\Components\MultiEdit\Resource\Product\Queue($this->get('multi_edit.product.dql_helper'), $this->get('multi_edit.product.filter'), $this->get('multi_edit.product.backup'));
    }
    protected function getMultiEdit_Product_ValueService()
    {
        return $this->services['multi_edit.product.value'] = new \Shopware\Components\MultiEdit\Resource\Product\Value($this->get('multi_edit.product.dql_helper'));
    }
    protected function getOyejorgeCompilerService()
    {
        return $this->services['oyejorge_compiler'] = new \Shopware\Components\Theme\LessCompiler\Oyejorge($this->get('oyejorge_compiler_lib'));
    }
    protected function getOyejorgeCompilerLibService()
    {
        return $this->services['oyejorge_compiler_lib'] = new \Less_Parser();
    }
    protected function getPasswordencoderService()
    {
        throw new RuntimeException('You have requested a synthetic service ("passwordencoder"). The DIC does not know how to construct this service.');
    }
    protected function getPluginloggerService()
    {
        $a = new \Monolog\Handler\RotatingFileHandler('/var/www/shopware/var/log/plugin_production.log', 14);
        $a->pushProcessor($this->get('monolog.processor.uid'));
        $this->services['pluginlogger'] = $instance = new \Shopware\Components\Logger('plugin');
        $instance->pushHandler($a);
        return $instance;
    }
    protected function getPluginsService()
    {
        return $this->services['plugins'] = $this->get('plugins_factory')->factory($this, $this->get('loader'), $this->get('events'), $this->get('application'), array('Default' => '/var/www/shopware/engine/Shopware/Plugins/Default/', 'Local' => '/var/www/shopware/engine/Shopware/Plugins/Local/', 'Community' => '/var/www/shopware/engine/Shopware/Plugins/Community/', 'ShopwarePlugins' => '/var/www/shopware/custom/plugins/'));
    }
    protected function getPluginsFactoryService()
    {
        return $this->services['plugins_factory'] = new \Shopware\Components\DependencyInjection\Bridge\Plugins();
    }
    protected function getQueryAliasMapperService()
    {
        return $this->services['query_alias_mapper'] = \Shopware\Components\QueryAliasMapper::createFromConfig($this->get('config'));
    }
    protected function getRouterService()
    {
        return $this->services['router'] = $this->get('router_factory')->factory($this, $this->get('events'));
    }
    protected function getRouterFactoryService()
    {
        return $this->services['router_factory'] = new \Shopware\Components\DependencyInjection\Bridge\Router();
    }
    protected function getSessionService()
    {
        return $this->services['session'] = $this->get('session_factory')->createSession($this, $this->get('session.save_handler'));
    }
    protected function getSession_SaveHandlerService()
    {
        return $this->services['session.save_handler'] = $this->get('session_factory')->createSaveHandler($this);
    }
    protected function getSessionFactoryService()
    {
        return $this->services['session_factory'] = new \Shopware\Components\DependencyInjection\Bridge\Session();
    }
    protected function getShopPageMenuService()
    {
        return $this->services['shop_page_menu'] = new \Shopware\Components\SitePageMenu($this->get('dbal_connection'), $this->get('router'));
    }
    protected function getShopware_Api_AddressService()
    {
        return new \Shopware\Components\Api\Resource\Address();
    }
    protected function getShopware_Api_ArticleService()
    {
        return new \Shopware\Components\Api\Resource\Article($this->get('translation'));
    }
    protected function getShopware_Api_CacheService()
    {
        return new \Shopware\Components\Api\Resource\Cache();
    }
    protected function getShopware_Api_CategoryService()
    {
        return new \Shopware\Components\Api\Resource\Category();
    }
    protected function getShopware_Api_CountryService()
    {
        return new \Shopware\Components\Api\Resource\Country();
    }
    protected function getShopware_Api_CustomerService()
    {
        return new \Shopware\Components\Api\Resource\Customer();
    }
    protected function getShopware_Api_CustomerStreamService()
    {
        return $this->services['shopware.api.customer_stream'] = new \Shopware\Components\Api\Resource\CustomerStream($this->get('shopware.logaware_reflection_helper'), $this->get('customer_search.dbal.number_search'), $this->get('shopware.customer_stream.repository'), $this->get('models'), $this->get('dbal_connection'), $this->get('customer_search.dbal.indexing.indexer'), $this->get('shopware.customer_stream.stream_indexer'), $this->get('shopware.customer_stream.criteria_factory'));
    }
    protected function getShopware_Api_CustomergroupService()
    {
        return new \Shopware\Components\Api\Resource\CustomerGroup();
    }
    protected function getShopware_Api_EmotionpresetService()
    {
        return new \Shopware\Components\Api\Resource\EmotionPreset($this->get('dbal_connection'), $this->get('models'), $this->get('shopware.slug'));
    }
    protected function getShopware_Api_ManufacturerService()
    {
        return new \Shopware\Components\Api\Resource\Manufacturer();
    }
    protected function getShopware_Api_MediaService()
    {
        return new \Shopware\Components\Api\Resource\Media();
    }
    protected function getShopware_Api_OrderService()
    {
        return new \Shopware\Components\Api\Resource\Order();
    }
    protected function getShopware_Api_PropertygroupService()
    {
        return new \Shopware\Components\Api\Resource\PropertyGroup();
    }
    protected function getShopware_Api_ResourceService()
    {
        return new \Shopware\Components\Api\Resource\Resource();
    }
    protected function getShopware_Api_ShopService()
    {
        return new \Shopware\Components\Api\Resource\Shop();
    }
    protected function getShopware_Api_TranslationService()
    {
        return new \Shopware\Components\Api\Resource\Translation($this->get('translation'));
    }
    protected function getShopware_Api_VariantService()
    {
        return new \Shopware\Components\Api\Resource\Variant();
    }
    protected function getShopware_CacheManagerService()
    {
        return $this->services['shopware.cache_manager'] = new \Shopware\Components\CacheManager($this);
    }
    protected function getShopware_Captcha_DefaultCaptchaService()
    {
        return $this->services['shopware.captcha.default_captcha'] = new \Shopware\Components\Captcha\DefaultCaptcha($this, $this->get('config'), $this->get('template'));
    }
    protected function getShopware_Captcha_HoneypotCaptchaService()
    {
        return $this->services['shopware.captcha.honeypot_captcha'] = new \Shopware\Components\Captcha\HoneypotCaptcha();
    }
    protected function getShopware_Captcha_LegacyCaptchaService()
    {
        return $this->services['shopware.captcha.legacy_captcha'] = new \Shopware\Components\Captcha\LegacyCaptcha($this->get('config'), $this->get('template'));
    }
    protected function getShopware_Captcha_NoCaptchaService()
    {
        return $this->services['shopware.captcha.no_captcha'] = new \Shopware\Components\Captcha\NoCaptcha();
    }
    protected function getShopware_Captcha_RepositoryService()
    {
        return $this->services['shopware.captcha.repository'] = new \Shopware\Components\Captcha\CaptchaRepository(array(0 => $this->get('shopware.captcha.default_captcha'), 1 => $this->get('shopware.captcha.legacy_captcha'), 2 => $this->get('shopware.captcha.no_captcha'), 3 => $this->get('shopware.captcha.honeypot_captcha')), $this->get('config'), $this);
    }
    protected function getShopware_Captcha_ValidatorService()
    {
        return $this->services['shopware.captcha.validator'] = new \Shopware\Components\Captcha\CaptchaValidator($this->get('shopware.captcha.repository'));
    }
    protected function getShopware_Components_LastArticlesSubscriberService()
    {
        return $this->services['shopware.components.last_articles_subscriber'] = new \Shopware\Components\LastArticlesSubscriber($this);
    }
    protected function getShopware_CsrftokenValidatorService()
    {
        return $this->services['shopware.csrftoken_validator'] = new \Shopware\Components\CSRFTokenValidator($this, true, true);
    }
    protected function getShopware_CustomerStream_CookieSubscriberService()
    {
        return $this->services['shopware.customer_stream.cookie_subscriber'] = new \Shopware\Components\CustomerStream\CookieSubscriber($this->get('dbal_connection'), $this);
    }
    protected function getShopware_CustomerStream_CriteriaFactoryService()
    {
        return $this->services['shopware.customer_stream.criteria_factory'] = new \Shopware\Components\CustomerStream\CustomerStreamCriteriaFactory($this->get('dbal_connection'), $this->get('shopware.logaware_reflection_helper'));
    }
    protected function getShopware_CustomerStream_RepositoryService()
    {
        return $this->services['shopware.customer_stream.repository'] = new \Shopware\Models\CustomerStream\CustomerStreamRepository($this->get('dbal_connection'));
    }
    protected function getShopware_CustomerStream_StreamIndexerService()
    {
        return $this->services['shopware.customer_stream.stream_indexer'] = new \Shopware\Components\CustomerStream\StreamIndexer($this->get('shopware.customer_stream.criteria_factory'), $this->get('customer_search.dbal.number_search'), $this->get('dbal_connection'));
    }
    protected function getShopware_Emotion_EmotionExporterService()
    {
        $a = $this->get('dbal_connection');
        $b = $this->get('shopware.slug');
        return $this->services['shopware.emotion.emotion_exporter'] = new \Shopware\Components\Emotion\EmotionExporter($this->get('shopware.emotion.emotion_presetdata_transformer'), $this->get('shopware.emotion.preset_data_synchronizer'), new \Shopware\Components\Api\Resource\EmotionPreset($a, $this->get('models'), $b), $this->get('shopware_media.media_service'), '/var/www/shopware', $a, $b);
    }
    protected function getShopware_Emotion_EmotionImporterService()
    {
        $a = $this->get('dbal_connection');
        return $this->services['shopware.emotion.emotion_importer'] = new \Shopware\Components\Emotion\EmotionImporter(new \Shopware\Components\Api\Resource\EmotionPreset($a, $this->get('models'), $this->get('shopware.slug')), $this->get('file_system'), $a);
    }
    protected function getShopware_Emotion_EmotionLandingpageLoaderService()
    {
        return $this->services['shopware.emotion.emotion_landingpage_loader'] = new \Shopware\Components\Emotion\LandingPageViewLoader($this->get('emotion_device_configuration'), $this->get('translation'));
    }
    protected function getShopware_Emotion_EmotionPresetdataTransformerService()
    {
        return $this->services['shopware.emotion.emotion_presetdata_transformer'] = new \Shopware\Components\Emotion\Preset\EmotionToPresetDataTransformer($this->get('models'));
    }
    protected function getShopware_Emotion_PresetBannerComponentHandlerService()
    {
        return $this->services['shopware.emotion.preset_banner_component_handler'] = new \Shopware\Components\Emotion\Preset\ComponentHandler\BannerComponentHandler($this->get('shopware_media.media_service'), new \Shopware\Components\Api\Resource\Media(), $this);
    }
    protected function getShopware_Emotion_PresetBannersliderComponentHandlerService()
    {
        return $this->services['shopware.emotion.preset_bannerslider_component_handler'] = new \Shopware\Components\Emotion\Preset\ComponentHandler\BannerSliderComponentHandler($this->get('shopware_media.media_service'), new \Shopware\Components\Api\Resource\Media(), $this);
    }
    protected function getShopware_Emotion_PresetCategoryteaserComponentHandlerService()
    {
        return $this->services['shopware.emotion.preset_categoryteaser_component_handler'] = new \Shopware\Components\Emotion\Preset\ComponentHandler\CategoryTeaserComponentHandler($this->get('shopware_media.media_service'), new \Shopware\Components\Api\Resource\Media(), $this);
    }
    protected function getShopware_Emotion_PresetDataSynchronizerService()
    {
        return $this->services['shopware.emotion.preset_data_synchronizer'] = new \Shopware\Components\Emotion\Preset\PresetDataSynchronizer($this->get('models'), $this->get('events'), array(0 => $this->get('shopware.emotion.preset_banner_component_handler'), 1 => $this->get('shopware.emotion.preset_html5_video_component_handler'), 2 => $this->get('shopware.emotion.preset_categoryteaser_component_handler'), 3 => $this->get('shopware.emotion.preset_bannerslider_component_handler')), '/var/www/shopware');
    }
    protected function getShopware_Emotion_PresetHtml5VideoComponentHandlerService()
    {
        return $this->services['shopware.emotion.preset_html5_video_component_handler'] = new \Shopware\Components\Emotion\Preset\ComponentHandler\Html5VideoComponentHandler($this->get('shopware_media.media_service'), new \Shopware\Components\Api\Resource\Media(), $this);
    }
    protected function getShopware_Emotion_PresetInstallerService()
    {
        $a = $this->get('shopware.slug');
        return $this->services['shopware.emotion.preset_installer'] = new \Shopware\Components\Emotion\Preset\PresetInstaller(new \Shopware\Components\Api\Resource\EmotionPreset($this->get('dbal_connection'), $this->get('models'), $a), $a);
    }
    protected function getShopware_Emotion_PresetLoaderService()
    {
        return $this->services['shopware.emotion.preset_loader'] = new \Shopware\Components\Emotion\Preset\PresetLoader($this->get('models'), $this->get('shopware_media.media_service'));
    }
    protected function getShopware_Emotion_TranslationImporterService()
    {
        return $this->services['shopware.emotion.translation_importer'] = new \Shopware\Components\Emotion\EmotionTranslationImporter($this->get('dbal_connection'), $this->get('translation'));
    }
    protected function getShopware_EmotionComponentInstallerService()
    {
        return $this->services['shopware.emotion_component_installer'] = new \Shopware\Components\Emotion\ComponentInstaller($this->get('models'));
    }
    protected function getShopware_EscaperService()
    {
        return $this->services['shopware.escaper'] = new \Shopware\Components\Escaper\Escaper(new \Zend\Escaper\Escaper('utf-8'));
    }
    protected function getShopware_Form_Constraint_ExistsService()
    {
        return $this->services['shopware.form.constraint.exists'] = new \Shopware\Bundle\FormBundle\Constraints\ExistsValidator($this->get('dbal_connection'));
    }
    protected function getShopware_Form_Constraint_UniqueService()
    {
        return $this->services['shopware.form.constraint.unique'] = new \Shopware\Bundle\FormBundle\Constraints\UniqueValidator($this->get('dbal_connection'));
    }
    protected function getShopware_Form_Extension_EnlightService()
    {
        return $this->services['shopware.form.extension.enlight'] = new \Shopware\Bundle\FormBundle\Extension\EnlightRequestExtension();
    }
    protected function getShopware_Form_Extension_EventService()
    {
        return $this->services['shopware.form.extension.event'] = new \Shopware\Bundle\FormBundle\Extension\EventExtension($this->get('events'));
    }
    protected function getShopware_Form_FactoryService()
    {
        return $this->services['shopware.form.factory'] = \Shopware\Bundle\FormBundle\FormFactory::factory($this->get('validator'), new \Symfony\Component\Form\Extension\DependencyInjection\DependencyInjectionExtension($this, array('Shopware\\Bundle\\AccountBundle\\Type\\SalutationType' => 'shopware_account.type.salutation_type', 'Shopware\\Bundle\\AccountBundle\\Form\\Account\\AddressFormType' => 'shopware_account.form.addressform', 'Shopware\\Bundle\\AccountBundle\\Form\\Account\\AttributeFormType' => 'shopware_account.form.attributeform', 'Shopware\\Bundle\\AccountBundle\\Form\\Account\\ProfileUpdateFormType' => 'shopware_account.form.profile_update_form', 'Shopware\\Bundle\\AccountBundle\\Form\\Account\\PersonalFormType' => 'shopware_account.form.personalform', 'Shopware\\Bundle\\AccountBundle\\Form\\Account\\EmailUpdateFormType' => 'shopware_account.form.emailupdateform', 'Shopware\\Bundle\\AccountBundle\\Form\\Account\\PasswordUpdateFormType' => 'shopware_account.form.passwordupdateform', 'Shopware\\Bundle\\AccountBundle\\Form\\Account\\ResetPasswordFormType' => 'shopware_account.form.resetpasswordform'), array('Symfony\\Component\\Form\\Extension\\Core\\Type\\FormType' => array(0 => 'shopware.form.extension.event', 1 => 'shopware.form.extension.enlight')), array()));
    }
    protected function getShopware_Form_StringRendererServiceService()
    {
        return $this->services['shopware.form.string_renderer_service'] = new \Shopware\Bundle\FormBundle\StringRendererService();
    }
    protected function getShopware_HolidayTableUpdaterService()
    {
        return $this->services['shopware.holiday_table_updater'] = new \Shopware\Components\HolidayTableUpdater($this->get('dbal_connection'));
    }
    protected function getShopware_Log_FileparserService()
    {
        return $this->services['shopware.log.fileparser'] = new \Shopware\Components\Log\Parser\LogfileParser();
    }
    protected function getShopware_LogawareReflectionHelperService()
    {
        return $this->services['shopware.logaware_reflection_helper'] = new \Shopware\Components\LogawareReflectionHelper($this->get('corelogger'));
    }
    protected function getShopware_Model_SearchBuilderService()
    {
        return $this->services['shopware.model.search_builder'] = new \Shopware\Components\Model\SearchBuilder($this->get('shopware_searchdbal.search_term_helper'));
    }
    protected function getShopware_NumberRangeIncrementerService()
    {
        return $this->services['shopware.number_range_incrementer'] = new \Shopware\Components\NumberRangeIncrementer($this->get('dbal_connection'));
    }
    protected function getShopware_OpensslVerificatorService()
    {
        return $this->services['shopware.openssl_verificator'] = new \Shopware\Components\OpenSSLVerifier('/var/www/shopware/engine/Shopware/Components/HttpClient/public.key');
    }
    protected function getShopware_Plugin_CachedConfigReaderService()
    {
        return $this->services['shopware.plugin.cached_config_reader'] = new \Shopware\Components\Plugin\CachedConfigReader($this->get('shopware.plugin.config_reader'));
    }
    protected function getShopware_Plugin_ConfigReaderService()
    {
        return $this->services['shopware.plugin.config_reader'] = new \Shopware\Components\Plugin\DBALConfigReader($this->get('dbal_connection'));
    }
    protected function getShopware_Plugin_ConfigWriterService()
    {
        return $this->services['shopware.plugin.config_writer'] = new \Shopware\Components\Plugin\ConfigWriter($this->get('models'));
    }
    protected function getShopware_PluginPaymentInstallerService()
    {
        return $this->services['shopware.plugin_payment_installer'] = new \Shopware\Components\Plugin\PaymentInstaller($this->get('models'));
    }
    protected function getShopware_PluginRequirementValidatorService()
    {
        return $this->services['shopware.plugin_requirement_validator'] = new \Shopware\Components\Plugin\RequirementValidator($this->get('models'), $this->get('shopware.plugin_xml_plugin_info_reader'));
    }
    protected function getShopware_PluginXmlPluginInfoReaderService()
    {
        return $this->services['shopware.plugin_xml_plugin_info_reader'] = new \Shopware\Components\Plugin\XmlPluginInfoReader();
    }
    protected function getShopware_RequirementsService()
    {
        return $this->services['shopware.requirements'] = new \Shopware\Components\Check\Requirements('/var/www/shopware/engine/Shopware/Components/Check/Data/System.xml', $this->get('db_connection'));
    }
    protected function getShopware_SlugService()
    {
        return $this->services['shopware.slug'] = new \Shopware\Components\Slug\CocurSlugifyAdapter(new \Cocur\Slugify\Slugify(array('regexp' => '/([^A-Za-z0-9\\.]|-)+/', 'lowercase' => false)));
    }
    protected function getShopware_SnippetDatabaseHandlerService()
    {
        return $this->services['shopware.snippet_database_handler'] = new \Shopware\Components\Snippet\DatabaseHandler($this->get('models'), $this->get('db'), '/var/www/shopware');
    }
    protected function getShopware_SnippetQueryHandlerService()
    {
        return $this->services['shopware.snippet_query_handler'] = new \Shopware\Components\Snippet\QueryHandler('/var/www/shopware/snippets/');
    }
    protected function getShopware_SnippetValidatorService()
    {
        return $this->services['shopware.snippet_validator'] = new \Shopware\Components\Snippet\SnippetValidator($this->get('dbal_connection'));
    }
    protected function getShopware_UploadMaxSizeValidatorService()
    {
        return $this->services['shopware.upload_max_size_validator'] = new \Shopware\Components\UploadMaxSizeValidator();
    }
    protected function getShopwareAccount_AddressServiceService()
    {
        return $this->services['shopware_account.address_service'] = new \Shopware\Bundle\AccountBundle\Service\AddressService($this->get('models'), $this->get('shopware_account.address_validator'));
    }
    protected function getShopwareAccount_AddressValidatorService()
    {
        return $this->services['shopware_account.address_validator'] = new \Shopware\Bundle\AccountBundle\Service\Validator\AddressValidator($this->get('validator'), $this->get('shopware_storefront.context_service'), $this->get('config'));
    }
    protected function getShopwareAccount_Constraint_CurrentPasswordValidatorService()
    {
        return $this->services['shopware_account.constraint.current_password_validator'] = new \Shopware\Bundle\AccountBundle\Constraint\CurrentPasswordValidator($this->get('session'), $this->get('snippets'), $this->get('passwordencoder'), $this->get('models'));
    }
    protected function getShopwareAccount_Constraint_CustomerEmailValidatorService()
    {
        return $this->services['shopware_account.constraint.customer_email_validator'] = new \Shopware\Bundle\AccountBundle\Constraint\CustomerEmailValidator($this->get('snippets'), $this->get('dbal_connection'), $this->get('validator.email'));
    }
    protected function getShopwareAccount_Constraint_FormEmailValidatorService()
    {
        return $this->services['shopware_account.constraint.form_email_validator'] = new \Shopware\Bundle\AccountBundle\Constraint\FormEmailValidator($this->get('snippets'), $this->get('shopware_account.constraint.customer_email_validator'));
    }
    protected function getShopwareAccount_Constraint_PasswordValidatorService()
    {
        return $this->services['shopware_account.constraint.password_validator'] = new \Shopware\Bundle\AccountBundle\Constraint\PasswordValidator($this->get('snippets'), $this->get('config'));
    }
    protected function getShopwareAccount_CustomerServiceService()
    {
        return $this->services['shopware_account.customer_service'] = new \Shopware\Bundle\AccountBundle\Service\CustomerService($this->get('models'), $this->get('shopware_account.customer_validator'));
    }
    protected function getShopwareAccount_CustomerValidatorService()
    {
        return $this->services['shopware_account.customer_validator'] = new \Shopware\Bundle\AccountBundle\Service\Validator\CustomerValidator($this->get('validator'), $this->get('shopware_storefront.context_service'), $this->get('config'));
    }
    protected function getShopwareAccount_Form_AddressformService()
    {
        return $this->services['shopware_account.form.addressform'] = new \Shopware\Bundle\AccountBundle\Form\Account\AddressFormType($this->get('config'), $this->get('models'));
    }
    protected function getShopwareAccount_Form_AttributeformService()
    {
        return $this->services['shopware_account.form.attributeform'] = new \Shopware\Bundle\AccountBundle\Form\Account\AttributeFormType($this->get('models'), $this->get('shopware_attribute.crud_service'), $this->get('corelogger'));
    }
    protected function getShopwareAccount_Form_EmailupdateformService()
    {
        return $this->services['shopware_account.form.emailupdateform'] = new \Shopware\Bundle\AccountBundle\Form\Account\EmailUpdateFormType($this->get('snippets'), $this->get('config'), $this->get('shopware_storefront.context_service'));
    }
    protected function getShopwareAccount_Form_PasswordupdateformService()
    {
        return $this->services['shopware_account.form.passwordupdateform'] = new \Shopware\Bundle\AccountBundle\Form\Account\PasswordUpdateFormType($this->get('config'));
    }
    protected function getShopwareAccount_Form_PersonalformService()
    {
        return $this->services['shopware_account.form.personalform'] = new \Shopware\Bundle\AccountBundle\Form\Account\PersonalFormType($this->get('snippets'), $this->get('config'), $this->get('shopware_storefront.context_service'));
    }
    protected function getShopwareAccount_Form_ProfileUpdateFormService()
    {
        return $this->services['shopware_account.form.profile_update_form'] = new \Shopware\Bundle\AccountBundle\Form\Account\ProfileUpdateFormType($this->get('snippets'), $this->get('config'), $this->get('shopware_storefront.context_service'));
    }
    protected function getShopwareAccount_Form_ResetpasswordformService()
    {
        return $this->services['shopware_account.form.resetpasswordform'] = new \Shopware\Bundle\AccountBundle\Form\Account\ResetPasswordFormType();
    }
    protected function getShopwareAccount_RegisterServiceService()
    {
        return $this->services['shopware_account.register_service'] = new \Shopware\Bundle\AccountBundle\Service\RegisterService($this->get('models'), $this->get('shopware_account.customer_validator'), $this->get('config'), $this->get('passwordencoder'), $this->get('shopware.number_range_incrementer'), $this->get('dbal_connection'), $this->get('shopware_account.address_service'));
    }
    protected function getShopwareAccount_StoreFrontGreetingServiceService()
    {
        return $this->services['shopware_account.store_front_greeting_service'] = new \Shopware\Bundle\AccountBundle\Service\StoreFrontCustomerGreetingService($this->get('session'), $this->get('dbal_connection'), $this->get('config'));
    }
    protected function getShopwareAccount_Type_SalutationTypeService()
    {
        return $this->services['shopware_account.type.salutation_type'] = new \Shopware\Bundle\AccountBundle\Type\SalutationType($this->get('config'));
    }
    protected function getShopwareAttribute_BlogReaderService()
    {
        return $this->services['shopware_attribute.blog_reader'] = new \Shopware\Bundle\AttributeBundle\Repository\Reader\BlogReader('Shopware\\Models\\Blog\\Blog', $this->get('models'));
    }
    protected function getShopwareAttribute_BlogRepositoryService()
    {
        return $this->services['shopware_attribute.blog_repository'] = new \Shopware\Bundle\AttributeBundle\Repository\GenericRepository('Shopware\\Models\\Blog\\Blog', $this->get('models'), $this->get('shopware_attribute.blog_reader'), $this->get('shopware_attribute.blog_searcher'));
    }
    protected function getShopwareAttribute_BlogSearcherService()
    {
        return $this->services['shopware_attribute.blog_searcher'] = new \Shopware\Bundle\AttributeBundle\Repository\Searcher\GenericSearcher('Shopware\\Models\\Blog\\Blog', $this->get('models'), $this->get('shopware.model.search_builder'));
    }
    protected function getShopwareAttribute_CategoryReaderService()
    {
        return $this->services['shopware_attribute.category_reader'] = new \Shopware\Bundle\AttributeBundle\Repository\Reader\CategoryReader('Shopware\\Models\\Category\\Category', $this->get('models'));
    }
    protected function getShopwareAttribute_CategoryRepositoryService()
    {
        return $this->services['shopware_attribute.category_repository'] = new \Shopware\Bundle\AttributeBundle\Repository\GenericRepository('Shopware\\Models\\Category\\Category', $this->get('models'), $this->get('shopware_attribute.category_reader'), $this->get('shopware_attribute.category_searcher'));
    }
    protected function getShopwareAttribute_CategorySearcherService()
    {
        return $this->services['shopware_attribute.category_searcher'] = new \Shopware\Bundle\AttributeBundle\Repository\Searcher\CategorySearcher('Shopware\\Models\\Category\\Category', $this->get('models'), $this->get('shopware.model.search_builder'));
    }
    protected function getShopwareAttribute_ControllerSubscriberService()
    {
        return $this->services['shopware_attribute.controller_subscriber'] = new \Shopware\Bundle\AttributeBundle\DependencyInjection\EventListener\ControllerSubscriber();
    }
    protected function getShopwareAttribute_CrudServiceService()
    {
        return $this->services['shopware_attribute.crud_service'] = new \Shopware\Bundle\AttributeBundle\Service\CrudService($this->get('models'), $this->get('shopware_attribute.schema_operator'), $this->get('shopware_attribute.table_mapping'), $this->get('shopware_attribute.type_mapping'));
    }
    protected function getShopwareAttribute_CustomerReaderService()
    {
        return $this->services['shopware_attribute.customer_reader'] = new \Shopware\Bundle\AttributeBundle\Repository\Reader\CustomerReader('Shopware\\Models\\Customer\\Customer', $this->get('models'));
    }
    protected function getShopwareAttribute_CustomerRepositoryService()
    {
        return $this->services['shopware_attribute.customer_repository'] = new \Shopware\Bundle\AttributeBundle\Repository\GenericRepository('Shopware\\Models\\Customer\\Customer', $this->get('models'), $this->get('shopware_attribute.customer_reader'), $this->get('shopware_attribute.customer_searcher'));
    }
    protected function getShopwareAttribute_CustomerSearcherService()
    {
        return $this->services['shopware_attribute.customer_searcher'] = new \Shopware\Bundle\AttributeBundle\Repository\Searcher\CustomerSearcher('Shopware\\Models\\Customer\\Customer', $this->get('models'), $this->get('shopware.model.search_builder'));
    }
    protected function getShopwareAttribute_CustomerStreamReaderService()
    {
        return $this->services['shopware_attribute.customer_stream_reader'] = new \Shopware\Bundle\AttributeBundle\Repository\Reader\CustomerStreamReader('Shopware\\Models\\CustomerStream\\CustomerStream', $this->get('models'), $this->get('shopware.customer_stream.repository'));
    }
    protected function getShopwareAttribute_CustomerStreamRepositoryService()
    {
        return $this->services['shopware_attribute.customer_stream_repository'] = new \Shopware\Bundle\AttributeBundle\Repository\GenericRepository('Shopware\\Models\\CustomerStream\\CustomerStream', $this->get('models'), $this->get('shopware_attribute.customer_stream_reader'), $this->get('shopware_attribute.customer_stream_searcher'));
    }
    protected function getShopwareAttribute_CustomerStreamSearcherService()
    {
        return $this->services['shopware_attribute.customer_stream_searcher'] = new \Shopware\Bundle\AttributeBundle\Repository\Searcher\CustomerStreamSearcher('Shopware\\Models\\CustomerStream\\CustomerStream', $this->get('models'), $this->get('shopware.model.search_builder'));
    }
    protected function getShopwareAttribute_DataLoaderService()
    {
        return $this->services['shopware_attribute.data_loader'] = new \Shopware\Bundle\AttributeBundle\Service\DataLoader($this->get('dbal_connection'), $this->get('shopware_attribute.table_mapping'));
    }
    protected function getShopwareAttribute_DataPersisterService()
    {
        return $this->services['shopware_attribute.data_persister'] = new \Shopware\Bundle\AttributeBundle\Service\DataPersister($this->get('dbal_connection'), $this->get('shopware_attribute.table_mapping'), $this->get('shopware_attribute.data_loader'));
    }
    protected function getShopwareAttribute_EmotionReaderService()
    {
        return $this->services['shopware_attribute.emotion_reader'] = new \Shopware\Bundle\AttributeBundle\Repository\Reader\GenericReader('Shopware\\Models\\Emotion\\Emotion', $this->get('models'));
    }
    protected function getShopwareAttribute_EmotionRepositoryService()
    {
        return $this->services['shopware_attribute.emotion_repository'] = new \Shopware\Bundle\AttributeBundle\Repository\GenericRepository('Shopware\\Models\\Emotion\\Emotion', $this->get('models'), $this->get('shopware_attribute.emotion_reader'), $this->get('shopware_attribute.emotion_searcher'));
    }
    protected function getShopwareAttribute_EmotionSearcherService()
    {
        return $this->services['shopware_attribute.emotion_searcher'] = new \Shopware\Bundle\AttributeBundle\Repository\Searcher\EmotionSearcher('Shopware\\Models\\Emotion\\Emotion', $this->get('models'), $this->get('shopware.model.search_builder'));
    }
    protected function getShopwareAttribute_MediaReaderService()
    {
        return $this->services['shopware_attribute.media_reader'] = new \Shopware\Bundle\AttributeBundle\Repository\Reader\MediaReader('Shopware\\Models\\Media\\Media', $this->get('models'), $this->get('shopware_media.media_service'));
    }
    protected function getShopwareAttribute_MediaRepositoryService()
    {
        return $this->services['shopware_attribute.media_repository'] = new \Shopware\Bundle\AttributeBundle\Repository\GenericRepository('Shopware\\Models\\Media\\Media', $this->get('models'), $this->get('shopware_attribute.media_reader'), $this->get('shopware_attribute.media_searcher'));
    }
    protected function getShopwareAttribute_MediaSearcherService()
    {
        return $this->services['shopware_attribute.media_searcher'] = new \Shopware\Bundle\AttributeBundle\Repository\Searcher\GenericSearcher('Shopware\\Models\\Media\\Media', $this->get('models'), $this->get('shopware.model.search_builder'));
    }
    protected function getShopwareAttribute_PremiumReaderService()
    {
        return $this->services['shopware_attribute.premium_reader'] = new \Shopware\Bundle\AttributeBundle\Repository\Reader\PremiumReader('Shopware\\Models\\Premium\\Premium', $this->get('models'));
    }
    protected function getShopwareAttribute_PremiumRepositoryService()
    {
        return $this->services['shopware_attribute.premium_repository'] = new \Shopware\Bundle\AttributeBundle\Repository\GenericRepository('Shopware\\Models\\Premium\\Premium', $this->get('models'), $this->get('shopware_attribute.premium_reader'), $this->get('shopware_attribute.premium_searcher'));
    }
    protected function getShopwareAttribute_PremiumSearcherService()
    {
        return $this->services['shopware_attribute.premium_searcher'] = new \Shopware\Bundle\AttributeBundle\Repository\Searcher\PremiumSearcher('Shopware\\Models\\Premium\\Premium', $this->get('models'), $this->get('shopware.model.search_builder'));
    }
    protected function getShopwareAttribute_ProductReaderService()
    {
        return $this->services['shopware_attribute.product_reader'] = new \Shopware\Bundle\AttributeBundle\Repository\Reader\ProductReader('Shopware\\Models\\Article\\Detail', $this->get('models'), $this->get('shopware_storefront.context_service'), $this->get('shopware_storefront.additional_text_service'));
    }
    protected function getShopwareAttribute_ProductRepositoryService()
    {
        return $this->services['shopware_attribute.product_repository'] = new \Shopware\Bundle\AttributeBundle\Repository\ProductRepository('Shopware\\Models\\Article\\Detail', $this->get('models'), $this->get('shopware_attribute.product_reader'), $this->get('shopware_attribute.product_searcher'));
    }
    protected function getShopwareAttribute_ProductSearcherService()
    {
        return $this->services['shopware_attribute.product_searcher'] = new \Shopware\Bundle\AttributeBundle\Repository\Searcher\ProductSearcher('Shopware\\Models\\Article\\Detail', $this->get('models'), $this->get('shopware.model.search_builder'));
    }
    protected function getShopwareAttribute_PropertyOptionReaderService()
    {
        return $this->services['shopware_attribute.property_option_reader'] = new \Shopware\Bundle\AttributeBundle\Repository\Reader\PropertyOptionReader('Shopware\\Models\\Property\\Value', $this->get('models'));
    }
    protected function getShopwareAttribute_PropertyOptionRepositoryService()
    {
        return $this->services['shopware_attribute.property_option_repository'] = new \Shopware\Bundle\AttributeBundle\Repository\GenericRepository('Shopware\\Models\\Property\\Value', $this->get('models'), $this->get('shopware_attribute.property_option_reader'), $this->get('shopware_attribute.property_option_searcher'));
    }
    protected function getShopwareAttribute_PropertyOptionSearcherService()
    {
        return $this->services['shopware_attribute.property_option_searcher'] = new \Shopware\Bundle\AttributeBundle\Repository\Searcher\PropertyOptionSearcher('Shopware\\Models\\Property\\Value', $this->get('models'), $this->get('shopware.model.search_builder'));
    }
    protected function getShopwareAttribute_RepositoryRegistryService()
    {
        return $this->services['shopware_attribute.repository_registry'] = new \Shopware\Bundle\AttributeBundle\Repository\Registry(array(0 => $this->get('shopware_attribute.media_repository'), 1 => $this->get('shopware_attribute.customer_stream_repository'), 2 => $this->get('shopware_attribute.shop_repository'), 3 => $this->get('shopware_attribute.premium_repository'), 4 => $this->get('shopware_attribute.customer_repository'), 5 => $this->get('shopware_attribute.emotion_repository'), 6 => $this->get('shopware_attribute.property_option_repository'), 7 => $this->get('shopware_attribute.category_repository'), 8 => $this->get('shopware_attribute.product_repository'), 9 => $this->get('shopware_attribute.blog_repository')), $this->get('models'));
    }
    protected function getShopwareAttribute_SchemaOperatorService()
    {
        return $this->services['shopware_attribute.schema_operator'] = new \Shopware\Bundle\AttributeBundle\Service\SchemaOperator($this->get('dbal_connection'), $this->get('shopware_attribute.table_mapping'));
    }
    protected function getShopwareAttribute_ShopReaderService()
    {
        return $this->services['shopware_attribute.shop_reader'] = new \Shopware\Bundle\AttributeBundle\Repository\Reader\ShopReader('Shopware\\Models\\Shop\\Shop', $this->get('models'));
    }
    protected function getShopwareAttribute_ShopRepositoryService()
    {
        return $this->services['shopware_attribute.shop_repository'] = new \Shopware\Bundle\AttributeBundle\Repository\GenericRepository('Shopware\\Models\\Shop\\Shop', $this->get('models'), $this->get('shopware_attribute.shop_reader'), $this->get('shopware_attribute.shop_searcher'));
    }
    protected function getShopwareAttribute_ShopSearcherService()
    {
        return $this->services['shopware_attribute.shop_searcher'] = new \Shopware\Bundle\AttributeBundle\Repository\Searcher\GenericSearcher('Shopware\\Models\\Shop\\Shop', $this->get('models'), $this->get('shopware.model.search_builder'));
    }
    protected function getShopwareAttribute_TableMappingService()
    {
        return $this->services['shopware_attribute.table_mapping'] = new \Shopware\Bundle\AttributeBundle\Service\TableMapping($this->get('dbal_connection'));
    }
    protected function getShopwareAttribute_TypeMappingService()
    {
        return $this->services['shopware_attribute.type_mapping'] = new \Shopware\Bundle\AttributeBundle\Service\TypeMapping($this->get('snippets'));
    }
    protected function getShopwareCore_LicenseServiceSubscriberService()
    {
        return $this->services['shopware_core.license_service_subscriber'] = new \Shopware\Components\License\Service\LicenseServiceSubscriber($this);
    }
    protected function getShopwareCore_LocalLicenseUnpackServiceService()
    {
        return $this->services['shopware_core.local_license_unpack_service'] = new \Shopware\Components\License\Service\LocalLicenseUnpackService();
    }
    protected function getShopwareCustomerSearch_Gateway_AddressGatewayService()
    {
        return $this->services['shopware_customer_search.gateway.address_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\AddressGateway($this->get('dbal_connection'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_customer_search.gateway.address_hydrator'));
    }
    protected function getShopwareCustomerSearch_Gateway_AddressHydratorService()
    {
        return $this->services['shopware_customer_search.gateway.address_hydrator'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\Hydrator\AddressHydrator($this->get('shopware_storefront.country_hydrator_dbal'), $this->get('shopware_storefront.attribute_hydrator_dbal'));
    }
    protected function getShopwareCustomerSearch_Gateway_CustomerGatewayService()
    {
        return $this->services['shopware_customer_search.gateway.customer_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\CustomerGateway($this->get('dbal_connection'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_customer_search.gateway.customer_hydrator'));
    }
    protected function getShopwareCustomerSearch_Gateway_CustomerHydratorService()
    {
        return $this->services['shopware_customer_search.gateway.customer_hydrator'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\Hydrator\CustomerHydrator($this->get('shopware_storefront.attribute_hydrator_dbal'), $this->get('shopware_storefront.customer_group_hydrator_dbal'));
    }
    protected function getShopwareElasticSearch_BacklogProcessorService()
    {
        return $this->services['shopware_elastic_search.backlog_processor'] = new \Shopware\Bundle\ESIndexingBundle\BacklogProcessor($this->get('dbal_connection'), $this->get('shopware_elastic_search.composite_synchronizer'));
    }
    protected function getShopwareElasticSearch_BacklogReaderService()
    {
        return $this->services['shopware_elastic_search.backlog_reader'] = new \Shopware\Bundle\ESIndexingBundle\BacklogReader($this->get('dbal_connection'));
    }
    protected function getShopwareElasticSearch_ClientService()
    {
        return $this->services['shopware_elastic_search.client'] = \Shopware\Bundle\ESIndexingBundle\ClientFactory::createClient(array('hosts' => array(0 => 'localhost:9200')));
    }
    protected function getShopwareElasticSearch_CompositeSynchronizerService()
    {
        return $this->services['shopware_elastic_search.composite_synchronizer'] = $this->get('shopware_elastic_search.composite_synchronizer_factory')->factory($this);
    }
    protected function getShopwareElasticSearch_CompositeSynchronizerFactoryService()
    {
        return $this->services['shopware_elastic_search.composite_synchronizer_factory'] = new \Shopware\Bundle\ESIndexingBundle\DependencyInjection\Factory\CompositeSynchronizerFactory(array(0 => $this->get('shopware_elastic_search.property_synchronizer'), 1 => $this->get('shopware_elastic_search.product_synchronizer')));
    }
    protected function getShopwareElasticSearch_DomainBacklogSubscriberService()
    {
        return $this->services['shopware_elastic_search.domain_backlog_subscriber'] = new \Shopware\Bundle\ESIndexingBundle\Subscriber\DomainBacklogSubscriber($this);
    }
    protected function getShopwareElasticSearch_FieldMappingService()
    {
        return $this->services['shopware_elastic_search.field_mapping'] = new \Shopware\Bundle\ESIndexingBundle\FieldMapping($this->get('shopware_elastic_search.shop_analyzer'), $this->get('shopware_elastic_search.text_mapping'));
    }
    protected function getShopwareElasticSearch_IdentifierSelectorService()
    {
        return $this->services['shopware_elastic_search.identifier_selector'] = new \Shopware\Bundle\ESIndexingBundle\IdentifierSelector($this->get('dbal_connection'), $this->get('shopware_storefront.shop_gateway_dbal'));
    }
    protected function getShopwareElasticSearch_IndexFactoryService()
    {
        return $this->services['shopware_elastic_search.index_factory'] = new \Shopware\Bundle\ESIndexingBundle\IndexFactory('sw_shop', NULL, NULL);
    }
    protected function getShopwareElasticSearch_OrmBacklogSaveSubscriberService()
    {
        return $this->services['shopware_elastic_search.orm_backlog_save_subscriber'] = new \Shopware\Bundle\ESIndexingBundle\Subscriber\ORMBacklogSaveSubscriber($this->get('shopware_elastic_search.orm_backlog_subscriber'), $this);
    }
    protected function getShopwareElasticSearch_ProductIndexerService()
    {
        return $this->services['shopware_elastic_search.product_indexer'] = new \Shopware\Bundle\ESIndexingBundle\Product\ProductIndexer($this->get('shopware_elastic_search.client'), $this->get('shopware_elastic_search.product_provider'), $this->get('shopware_elastic_search.product_query_factory'));
    }
    protected function getShopwareElasticSearch_ProductMappingService()
    {
        return $this->services['shopware_elastic_search.product_mapping'] = new \Shopware\Bundle\ESIndexingBundle\Product\ProductMapping($this->get('shopware_elastic_search.identifier_selector'), $this->get('shopware_elastic_search.field_mapping'), $this->get('shopware_elastic_search.text_mapping'), $this->get('shopware_attribute.crud_service'));
    }
    protected function getShopwareElasticSearch_ProductProviderService()
    {
        return $this->services['shopware_elastic_search.product_provider'] = new \Shopware\Bundle\ESIndexingBundle\Product\ProductProvider($this->get('shopware_storefront.list_product_gateway'), $this->get('shopware_storefront.cheapest_price_service'), $this->get('shopware_storefront.vote_service'), $this->get('shopware_storefront.context_service'), $this->get('dbal_connection'), $this->get('shopware_elastic_search.identifier_selector'), $this->get('shopware_storefront.price_calculation_service'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_storefront.property_hydrator_dbal'));
    }
    protected function getShopwareElasticSearch_ProductQueryFactoryService()
    {
        return $this->services['shopware_elastic_search.product_query_factory'] = new \Shopware\Bundle\ESIndexingBundle\Product\ProductQueryFactory($this->get('dbal_connection'));
    }
    protected function getShopwareElasticSearch_ProductSynchronizerService()
    {
        return $this->services['shopware_elastic_search.product_synchronizer'] = new \Shopware\Bundle\ESIndexingBundle\Product\ProductSynchronizer($this->get('shopware_elastic_search.product_query_factory'), $this->get('shopware_elastic_search.product_indexer'));
    }
    protected function getShopwareElasticSearch_PropertyIndexerService()
    {
        return $this->services['shopware_elastic_search.property_indexer'] = new \Shopware\Bundle\ESIndexingBundle\Property\PropertyIndexer($this->get('shopware_elastic_search.client'), $this->get('shopware_elastic_search.property_query_factory'), $this->get('shopware_elastic_search.property_provider'));
    }
    protected function getShopwareElasticSearch_PropertyMappingService()
    {
        return $this->services['shopware_elastic_search.property_mapping'] = new \Shopware\Bundle\ESIndexingBundle\Property\PropertyMapping($this->get('shopware_elastic_search.field_mapping'));
    }
    protected function getShopwareElasticSearch_PropertyProviderService()
    {
        return $this->services['shopware_elastic_search.property_provider'] = new \Shopware\Bundle\ESIndexingBundle\Property\PropertyProvider($this->get('dbal_connection'), $this->get('shopware_storefront.context_service'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_storefront.property_hydrator_dbal'));
    }
    protected function getShopwareElasticSearch_PropertyQueryFactoryService()
    {
        return $this->services['shopware_elastic_search.property_query_factory'] = new \Shopware\Bundle\ESIndexingBundle\Property\PropertyQueryFactory($this->get('dbal_connection'));
    }
    protected function getShopwareElasticSearch_PropertySynchronizerService()
    {
        return $this->services['shopware_elastic_search.property_synchronizer'] = new \Shopware\Bundle\ESIndexingBundle\Property\PropertySynchronizer($this->get('shopware_elastic_search.property_indexer'));
    }
    protected function getShopwareElasticSearch_ServiceSubscriberService()
    {
        return $this->services['shopware_elastic_search.service_subscriber'] = new \Shopware\Bundle\ESIndexingBundle\Subscriber\ServiceSubscriber();
    }
    protected function getShopwareElasticSearch_ShopAnalyzerService()
    {
        return $this->services['shopware_elastic_search.shop_analyzer'] = new \Shopware\Bundle\ESIndexingBundle\ShopAnalyzer();
    }
    protected function getShopwareElasticSearch_ShopIndexerService()
    {
        return $this->services['shopware_elastic_search.shop_indexer'] = $this->get('shopware_elastic_search.shop_indexer_factory')->factory($this);
    }
    protected function getShopwareElasticSearch_ShopIndexerFactoryService()
    {
        return $this->services['shopware_elastic_search.shop_indexer_factory'] = new \Shopware\Bundle\ESIndexingBundle\DependencyInjection\Factory\ShopIndexerFactory(array(0 => $this->get('shopware_elastic_search.property_indexer'), 1 => $this->get('shopware_elastic_search.product_indexer')), array(0 => $this->get('shopware_elastic_search.property_mapping'), 1 => $this->get('shopware_elastic_search.product_mapping')), array());
    }
    protected function getShopwareElasticSearch_TextMappingService()
    {
        return $this->services['shopware_elastic_search.text_mapping'] = \Shopware\Bundle\ESIndexingBundle\DependencyInjection\Factory\TextMappingFactory::factory($this->get('shopware_elastic_search.client'));
    }
    protected function getShopwareEmotion_ComponentHandler_ArticleService()
    {
        return $this->services['shopware_emotion.component_handler.article'] = new \Shopware\Bundle\EmotionBundle\ComponentHandler\ArticleComponentHandler($this->get('shopware_search.store_front_criteria_factory'), $this->get('config'), $this->get('shopware_storefront.additional_text_service'));
    }
    protected function getShopwareEmotion_ComponentHandler_ArticleSliderService()
    {
        return $this->services['shopware_emotion.component_handler.article_slider'] = new \Shopware\Bundle\EmotionBundle\ComponentHandler\ArticleSliderComponentHandler($this->get('shopware_search.store_front_criteria_factory'), $this->get('shopware_product_stream.repository'), $this->get('config'), $this->get('shopware_storefront.additional_text_service'));
    }
    protected function getShopwareEmotion_ComponentHandler_BannerService()
    {
        return $this->services['shopware_emotion.component_handler.banner'] = new \Shopware\Bundle\EmotionBundle\ComponentHandler\BannerComponentHandler();
    }
    protected function getShopwareEmotion_ComponentHandler_BannerSliderService()
    {
        return $this->services['shopware_emotion.component_handler.banner_slider'] = new \Shopware\Bundle\EmotionBundle\ComponentHandler\BannerSliderComponentHandler($this->get('shopware_media.media_service'));
    }
    protected function getShopwareEmotion_ComponentHandler_BlogService()
    {
        return $this->services['shopware_emotion.component_handler.blog'] = new \Shopware\Bundle\EmotionBundle\ComponentHandler\BlogComponentHandler($this->get('shopware_storefront.blog_service'), $this->get('dbal_connection'));
    }
    protected function getShopwareEmotion_ComponentHandler_CategoryTeaserService()
    {
        return $this->services['shopware_emotion.component_handler.category_teaser'] = new \Shopware\Bundle\EmotionBundle\ComponentHandler\CategoryTeaserComponentHandler($this->get('shopware_search.store_front_criteria_factory'), $this->get('shopware_storefront.category_service'), $this->get('dbal_connection'), $this->get('shopware_storefront.blog_service'));
    }
    protected function getShopwareEmotion_ComponentHandler_EventFallbackService()
    {
        return $this->services['shopware_emotion.component_handler.event_fallback'] = new \Shopware\Bundle\EmotionBundle\ComponentHandler\EventComponentHandler($this->get('events'));
    }
    protected function getShopwareEmotion_ComponentHandler_Html5videoService()
    {
        return $this->services['shopware_emotion.component_handler.html5video'] = new \Shopware\Bundle\EmotionBundle\ComponentHandler\Html5VideoComponentHandler($this->get('shopware_media.media_service'));
    }
    protected function getShopwareEmotion_ComponentHandler_ManufacturerSliderService()
    {
        return $this->services['shopware_emotion.component_handler.manufacturer_slider'] = new \Shopware\Bundle\EmotionBundle\ComponentHandler\ManufacturerSliderComponentHandler($this->get('shopware_storefront.manufacturer_service'), $this->get('dbal_connection'));
    }
    protected function getShopwareEmotion_DataCollectionResolverService()
    {
        return $this->services['shopware_emotion.data_collection_resolver'] = new \Shopware\Bundle\EmotionBundle\Service\DataCollectionResolver($this->get('shopware_search.batch_product_search'), $this->get('dbal_connection'), $this->get('shopware_storefront.media_service'));
    }
    protected function getShopwareEmotion_EmotionElementGatewayService()
    {
        return $this->services['shopware_emotion.emotion_element_gateway'] = new \Shopware\Bundle\EmotionBundle\Service\Gateway\EmotionElementGateway($this->get('shopware_emotion.emotion_element_hydrator'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('dbal_connection'));
    }
    protected function getShopwareEmotion_EmotionElementHydratorService()
    {
        return $this->services['shopware_emotion.emotion_element_hydrator'] = new \Shopware\Bundle\EmotionBundle\Service\Gateway\Hydrator\EmotionElementHydrator();
    }
    protected function getShopwareEmotion_EmotionElementServiceService()
    {
        $a = $this->get('shopware_emotion.component_handler.event_fallback');
        return $this->services['shopware_emotion.emotion_element_service'] = new \Shopware\Bundle\EmotionBundle\Service\EmotionElementService(array(0 => $a, 1 => $this->get('shopware_emotion.component_handler.banner_slider'), 2 => $this->get('shopware_emotion.component_handler.html5video'), 3 => $this->get('shopware_emotion.component_handler.blog'), 4 => $this->get('shopware_emotion.component_handler.manufacturer_slider'), 5 => $this->get('shopware_emotion.component_handler.category_teaser'), 6 => $this->get('shopware_emotion.component_handler.banner'), 7 => $this->get('shopware_emotion.component_handler.article_slider'), 8 => $this->get('shopware_emotion.component_handler.article')), $this->get('shopware_emotion.emotion_element_gateway'), $a, $this->get('shopware_emotion.data_collection_resolver'));
    }
    protected function getShopwareEmotion_EmotionGatewayService()
    {
        return $this->services['shopware_emotion.emotion_gateway'] = new \Shopware\Bundle\EmotionBundle\Service\Gateway\EmotionGateway($this->get('shopware_emotion.emotion_hydrator'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('dbal_connection'));
    }
    protected function getShopwareEmotion_EmotionHydratorService()
    {
        return $this->services['shopware_emotion.emotion_hydrator'] = new \Shopware\Bundle\EmotionBundle\Service\Gateway\Hydrator\EmotionHydrator($this->get('shopware_storefront.attribute_hydrator_dbal'));
    }
    protected function getShopwareEmotion_EmotionServiceService()
    {
        return $this->services['shopware_emotion.emotion_service'] = new \Shopware\Bundle\EmotionBundle\Service\EmotionService($this->get('shopware_emotion.emotion_gateway'), $this->get('shopware_emotion.emotion_element_service'), $this->get('shopware_storefront.shop_gateway_dbal'), $this->get('shopware_storefront.category_service'));
    }
    protected function getShopwareEmotion_EmotionStructConverterService()
    {
        return $this->services['shopware_emotion.emotion_struct_converter'] = new \Shopware\Bundle\EmotionBundle\Service\StructConverter($this->get('legacy_struct_converter'), $this->get('shopware_media.media_service'), $this->get('events'), $this);
    }
    protected function getShopwareEmotion_StoreFrontEmotionDeviceConfigurationService()
    {
        return $this->services['shopware_emotion.store_front_emotion_device_configuration'] = new \Shopware\Bundle\EmotionBundle\Service\StoreFrontEmotionDeviceConfiguration($this->get('emotion_device_configuration'));
    }
    protected function getShopwareMedia_Adapter_FtpService()
    {
        return $this->services['shopware_media.adapter.ftp'] = new \Shopware\Bundle\MediaBundle\Adapters\FtpAdapterFactory();
    }
    protected function getShopwareMedia_Adapter_LocalService()
    {
        return $this->services['shopware_media.adapter.local'] = new \Shopware\Bundle\MediaBundle\Adapters\LocalAdapterFactory();
    }
    protected function getShopwareMedia_CdnOptimizerServiceService()
    {
        return $this->services['shopware_media.cdn_optimizer_service'] = new \Shopware\Bundle\MediaBundle\CdnOptimizerService($this->get('shopware_media.optimizer_service'), $this->get('shopware_media.media_service'));
    }
    protected function getShopwareMedia_ExtensionMappingService()
    {
        return $this->services['shopware_media.extension_mapping'] = new \Shopware\Bundle\MediaBundle\MediaExtensionMappingService();
    }
    protected function getShopwareMedia_GarbageCollectorService()
    {
        return $this->services['shopware_media.garbage_collector'] = $this->get('shopware_media.garbage_collector_factory')->factory();
    }
    protected function getShopwareMedia_GarbageCollectorFactoryService()
    {
        return $this->services['shopware_media.garbage_collector_factory'] = new \Shopware\Bundle\MediaBundle\GarbageCollectorFactory($this->get('events'), $this->get('dbal_connection'), $this->get('shopware_media.media_service'));
    }
    protected function getShopwareMedia_MediaMigrationService()
    {
        return $this->services['shopware_media.media_migration'] = new \Shopware\Bundle\MediaBundle\MediaMigration();
    }
    protected function getShopwareMedia_MediaServiceService()
    {
        return $this->services['shopware_media.media_service'] = $this->get('shopware_media.media_service_factory')->factory('local');
    }
    protected function getShopwareMedia_MediaServiceFactoryService()
    {
        return $this->services['shopware_media.media_service_factory'] = new \Shopware\Bundle\MediaBundle\MediaServiceFactory($this, array(0 => $this->get('shopware_media.adapter.local'), 1 => $this->get('shopware_media.adapter.ftp')), array('backend' => 'local', 'strategy' => 'md5', 'liveMigration' => false, 'adapters' => array('local' => array('type' => 'local', 'mediaUrl' => '', 'permissions' => array('file' => array('public' => 420, 'private' => 384), 'dir' => array('public' => 493, 'private' => 448)), 'path' => '/var/www/shopware'), 'ftp' => array('type' => 'ftp', 'mediaUrl' => '', 'host' => '', 'username' => '', 'password' => '', 'port' => 21, 'root' => '/', 'passive' => true, 'ssl' => false, 'timeout' => 30))));
    }
    protected function getShopwareMedia_Optimizer_GuetzliService()
    {
        return $this->services['shopware_media.optimizer.guetzli'] = new \Shopware\Bundle\MediaBundle\Optimizer\GuetzliOptimizer();
    }
    protected function getShopwareMedia_Optimizer_JpegoptimService()
    {
        return $this->services['shopware_media.optimizer.jpegoptim'] = new \Shopware\Bundle\MediaBundle\Optimizer\JpegoptimOptimizer();
    }
    protected function getShopwareMedia_Optimizer_JpegtranService()
    {
        return $this->services['shopware_media.optimizer.jpegtran'] = new \Shopware\Bundle\MediaBundle\Optimizer\JpegtranOptimizer();
    }
    protected function getShopwareMedia_Optimizer_OptipngService()
    {
        return $this->services['shopware_media.optimizer.optipng'] = new \Shopware\Bundle\MediaBundle\Optimizer\OptipngOptimizer();
    }
    protected function getShopwareMedia_Optimizer_PngcrushService()
    {
        return $this->services['shopware_media.optimizer.pngcrush'] = new \Shopware\Bundle\MediaBundle\Optimizer\PngcrushOptimizer();
    }
    protected function getShopwareMedia_Optimizer_PngoutService()
    {
        return $this->services['shopware_media.optimizer.pngout'] = new \Shopware\Bundle\MediaBundle\Optimizer\PngoutOptimizer();
    }
    protected function getShopwareMedia_OptimizerServiceService()
    {
        return $this->services['shopware_media.optimizer_service'] = new \Shopware\Bundle\MediaBundle\CacheOptimizerService(new \Shopware\Bundle\MediaBundle\OptimizerService(array(0 => $this->get('shopware_media.optimizer.jpegoptim'), 1 => $this->get('shopware_media.optimizer.pngout'), 2 => $this->get('shopware_media.optimizer.jpegtran'), 3 => $this->get('shopware_media.optimizer.optipng'), 4 => $this->get('shopware_media.optimizer.pngcrush'), 5 => $this->get('shopware_media.optimizer.guetzli'))));
    }
    protected function getShopwareMedia_ReplaceServiceService()
    {
        return $this->services['shopware_media.replace_service'] = new \Shopware\Bundle\MediaBundle\MediaReplaceService($this->get('shopware_media.media_service'), $this->get('thumbnail_manager'), $this->get('models'), $this->get('shopware_media.extension_mapping'));
    }
    protected function getShopwareMedia_ServiceSubscriberService()
    {
        return $this->services['shopware_media.service_subscriber'] = new \Shopware\Bundle\MediaBundle\Subscriber\ServiceSubscriber($this);
    }
    protected function getShopwareMedia_StrategyService()
    {
        return $this->services['shopware_media.strategy'] = $this->get('shopware_media.strategy_factory')->factory('md5');
    }
    protected function getShopwareMedia_StrategyFactoryService()
    {
        return $this->services['shopware_media.strategy_factory'] = new \Shopware\Bundle\MediaBundle\Strategy\StrategyFactory(array('backend' => 'local', 'strategy' => 'md5', 'liveMigration' => false, 'adapters' => array('local' => array('type' => 'local', 'mediaUrl' => '', 'permissions' => array('file' => array('public' => 420, 'private' => 384), 'dir' => array('public' => 493, 'private' => 448)), 'path' => '/var/www/shopware'), 'ftp' => array('type' => 'ftp', 'mediaUrl' => '', 'host' => '', 'username' => '', 'password' => '', 'port' => 21, 'root' => '/', 'passive' => true, 'ssl' => false, 'timeout' => 30))));
    }
    protected function getShopwarePlugininstaller_AccountManagerServiceService()
    {
        return $this->services['shopware_plugininstaller.account_manager_service'] = new \Shopware\Bundle\PluginInstallerBundle\Service\AccountManagerService($this->get('shopware_plugininstaller.store_client'), $this->get('shopware_plugininstaller.plugin_installer_struct_hydrator'), $this->get('snippets'), $this->get('models'), $this->get('guzzle_http_client_factory'), 'https://api.shopware.com');
    }
    protected function getShopwarePlugininstaller_LegacyPluginInstallerService()
    {
        return $this->services['shopware_plugininstaller.legacy_plugin_installer'] = new \Shopware\Bundle\PluginInstallerBundle\Service\LegacyPluginInstaller($this->get('models'), $this->get('plugins'), array('Default' => '/var/www/shopware/engine/Shopware/Plugins/Default/', 'Local' => '/var/www/shopware/engine/Shopware/Plugins/Local/', 'Community' => '/var/www/shopware/engine/Shopware/Plugins/Community/', 'ShopwarePlugins' => '/var/www/shopware/custom/plugins/'));
    }
    protected function getShopwarePlugininstaller_PluginDownloadServiceService()
    {
        return $this->services['shopware_plugininstaller.plugin_download_service'] = new \Shopware\Bundle\PluginInstallerBundle\Service\DownloadService('/var/www/shopware', array('Default' => '/var/www/shopware/engine/Shopware/Plugins/Default/', 'Local' => '/var/www/shopware/engine/Shopware/Plugins/Local/', 'Community' => '/var/www/shopware/engine/Shopware/Plugins/Community/', 'ShopwarePlugins' => '/var/www/shopware/custom/plugins/'), $this->get('shopware_plugininstaller.store_client'), $this->get('dbal_connection'));
    }
    protected function getShopwarePlugininstaller_PluginInstallerService()
    {
        return $this->services['shopware_plugininstaller.plugin_installer'] = new \Shopware\Bundle\PluginInstallerBundle\Service\PluginInstaller($this->get('models'), $this->get('shopware.snippet_database_handler'), $this->get('shopware.plugin_requirement_validator'), $this->get('db_connection'), '/var/www/shopware/custom/plugins/');
    }
    protected function getShopwarePlugininstaller_PluginInstallerStructHydratorService()
    {
        return $this->services['shopware_plugininstaller.plugin_installer_struct_hydrator'] = new \Shopware\Bundle\PluginInstallerBundle\Struct\StructHydrator();
    }
    protected function getShopwarePlugininstaller_PluginLicenceServiceService()
    {
        return $this->services['shopware_plugininstaller.plugin_licence_service'] = new \Shopware\Bundle\PluginInstallerBundle\Service\PluginLicenceService($this->get('dbal_connection'), $this->get('shopware_plugininstaller.plugin_manager'), $this->get('shopware_plugininstaller.store_client'), $this->get('shopware_core.local_license_unpack_service'));
    }
    protected function getShopwarePlugininstaller_PluginManagerService()
    {
        return $this->services['shopware_plugininstaller.plugin_manager'] = new \Shopware\Bundle\PluginInstallerBundle\Service\InstallerService($this->get('models'), $this->get('shopware_plugininstaller.plugin_installer'), $this->get('shopware_plugininstaller.legacy_plugin_installer'), $this->get('shopware.plugin.config_writer'), $this->get('shopware.plugin.config_reader'));
    }
    protected function getShopwarePlugininstaller_PluginServiceLocalService()
    {
        return $this->services['shopware_plugininstaller.plugin_service_local'] = new \Shopware\Bundle\PluginInstallerBundle\Service\PluginLocalService($this->get('dbal_connection'), $this->get('shopware_plugininstaller.plugin_installer_struct_hydrator'));
    }
    protected function getShopwarePlugininstaller_PluginServiceStoreProductionService()
    {
        return $this->services['shopware_plugininstaller.plugin_service_store_production'] = new \Shopware\Bundle\PluginInstallerBundle\Service\PluginStoreService($this->get('shopware_plugininstaller.store_client'), $this->get('shopware_plugininstaller.plugin_installer_struct_hydrator'));
    }
    protected function getShopwarePlugininstaller_PluginServiceViewService()
    {
        return $this->services['shopware_plugininstaller.plugin_service_view'] = new \Shopware\Bundle\PluginInstallerBundle\Service\PluginViewService($this->get('shopware_plugininstaller.plugin_service_local'), $this->get('shopware_plugininstaller.plugin_service_store_production'), $this->get('shopware_plugininstaller.plugin_installer_struct_hydrator'));
    }
    protected function getShopwarePlugininstaller_StoreClientService()
    {
        return $this->services['shopware_plugininstaller.store_client'] = new \Shopware\Bundle\PluginInstallerBundle\StoreClient($this->get('http_client'), 'https://api.shopware.com', $this->get('shopware_plugininstaller.plugin_installer_struct_hydrator'), $this->get('shopware.openssl_verificator'), $this->get('shopware_plugininstaller.unique_id_generator'));
    }
    protected function getShopwarePlugininstaller_StoreOrderServiceService()
    {
        return $this->services['shopware_plugininstaller.store_order_service'] = new \Shopware\Bundle\PluginInstallerBundle\Service\StoreOrderService($this->get('shopware_plugininstaller.store_client'), $this->get('shopware_plugininstaller.plugin_installer_struct_hydrator'));
    }
    protected function getShopwarePlugininstaller_SubscriptionServiceService()
    {
        return $this->services['shopware_plugininstaller.subscription_service'] = new \Shopware\Bundle\PluginInstallerBundle\Service\SubscriptionService($this->get('dbal_connection'), $this->get('shopware_plugininstaller.store_client'), $this->get('models'), $this->get('shopware_plugininstaller.plugin_licence_service'));
    }
    protected function getShopwarePlugininstaller_UniqueIdGeneratorService()
    {
        return $this->services['shopware_plugininstaller.unique_id_generator'] = new \Shopware\Bundle\PluginInstallerBundle\Service\UniqueIdGenerator\UniqueIdGenerator($this->get('dbal_connection'));
    }
    protected function getShopwareProductStream_CriteriaFactoryService()
    {
        return $this->services['shopware_product_stream.criteria_factory'] = new \Shopware\Components\ProductStream\CriteriaFactory($this->get('shopware_search.store_front_criteria_factory'));
    }
    protected function getShopwareProductStream_FacetFilterService()
    {
        return $this->services['shopware_product_stream.facet_filter'] = new \Shopware\Components\ProductStream\FacetFilter($this->get('config'), $this->get('shopware_storefront.custom_facet_service'));
    }
    protected function getShopwareProductStream_RepositoryService()
    {
        return $this->services['shopware_product_stream.repository'] = new \Shopware\Components\ProductStream\Repository($this->get('dbal_connection'), $this->get('shopware.logaware_reflection_helper'));
    }
    protected function getShopwareSearch_BatchProductNumberSearchService()
    {
        return $this->services['shopware_search.batch_product_number_search'] = new \Shopware\Bundle\SearchBundle\BatchProductNumberSearch($this->get('shopware_search.product_number_search'), $this->get('shopware_storefront.base_product_factory'));
    }
    protected function getShopwareSearch_BatchProductSearchService()
    {
        return $this->services['shopware_search.batch_product_search'] = new \Shopware\Bundle\SearchBundle\BatchProductSearch($this->get('shopware_search.batch_product_number_search'), $this->get('shopware_storefront.list_product_service'));
    }
    protected function getShopwareSearch_CategoryTreeFacetResultBuilderService()
    {
        return $this->services['shopware_search.category_tree_facet_result_builder'] = new \Shopware\Bundle\SearchBundle\FacetResult\CategoryTreeFacetResultBuilder($this->get('snippets'), $this->get('query_alias_mapper'));
    }
    protected function getShopwareSearch_CoreCriteriaRequestHandlerService()
    {
        return $this->services['shopware_search.core_criteria_request_handler'] = new \Shopware\Bundle\SearchBundle\CriteriaRequestHandler\CoreCriteriaRequestHandler($this->get('config'), $this->get('shopware_search.search_term_pre_processor'));
    }
    protected function getShopwareSearch_CustomFacetCriteriaRequestHandlerService()
    {
        return $this->services['shopware_search.custom_facet_criteria_request_handler'] = new \Shopware\Bundle\SearchBundle\CriteriaRequestHandler\FacetCriteriaRequestHandler($this->get('config'), $this->get('shopware_storefront.custom_facet_service'), $this->get('dbal_connection'));
    }
    protected function getShopwareSearch_ProductNumberSearchService()
    {
        return $this->services['shopware_search.product_number_search'] = new \Shopware\Bundle\SearchBundleDBAL\ProductNumberSearch($this->get('shopware_searchdbal.dbal_query_builder_factory'), $this->get('events'), array(0 => $this->get('shopware_searchdbal.vote_average_facet_handler_dbal'), 1 => $this->get('shopware_searchdbal.product_dimensions_facet_handler'), 2 => $this->get('shopware_searchdbal.combined_condition_facet_handler_dbal'), 3 => $this->get('shopware_searchdbal.price_facet_handler_dbal'), 4 => $this->get('shopware_searchdbal.category_facet_handler_dbal'), 5 => $this->get('shopware_searchdbal.property_facet_handler_dbal'), 6 => $this->get('shopware_searchdbal.manufacturer_facet_handler_dbal'), 7 => $this->get('shopware_searchdbal.immediate_delivery_facet_handler_dbal'), 8 => $this->get('shopware_searchdbal.product_attribute_facet_handler_dbal'), 9 => $this->get('shopware_searchdbal.shipping_free_facet_handler_dbal')), $this);
    }
    protected function getShopwareSearch_ProductSearchService()
    {
        return $this->services['shopware_search.product_search'] = new \Shopware\Bundle\SearchBundle\ProductSearch($this->get('shopware_storefront.list_product_service'), $this->get('shopware_search.product_number_search'));
    }
    protected function getShopwareSearch_PropertyCriteriaRequestHandlerService()
    {
        return $this->services['shopware_search.property_criteria_request_handler'] = new \Shopware\Bundle\SearchBundle\CriteriaRequestHandler\PropertyCriteriaRequestHandler($this->get('dbal_connection'));
    }
    protected function getShopwareSearch_SearchTermPreProcessorService()
    {
        return $this->services['shopware_search.search_term_pre_processor'] = new \Shopware\Bundle\SearchBundle\SearchTermPreProcessor();
    }
    protected function getShopwareSearch_SortingCriteriaRequestHandlerService()
    {
        return $this->services['shopware_search.sorting_criteria_request_handler'] = new \Shopware\Bundle\SearchBundle\CriteriaRequestHandler\SortingCriteriaRequestHandler($this->get('shopware_storefront.custom_sorting_service'));
    }
    protected function getShopwareSearch_StoreFrontCriteriaFactoryService()
    {
        return $this->services['shopware_search.store_front_criteria_factory'] = new \Shopware\Bundle\SearchBundle\StoreFrontCriteriaFactory($this->get('config'), $this->get('events'), array(0 => $this->get('shopware_search.core_criteria_request_handler'), 1 => $this->get('shopware_search.property_criteria_request_handler'), 2 => $this->get('shopware_search.custom_facet_criteria_request_handler'), 3 => $this->get('shopware_search.sorting_criteria_request_handler')));
    }
    protected function getShopwareSearchEs_CategoryConditionHandlerService()
    {
        return $this->services['shopware_search_es.category_condition_handler'] = new \Shopware\Bundle\SearchBundleES\ConditionHandler\CategoryConditionHandler();
    }
    protected function getShopwareSearchEs_CategoryFacetHandlerService()
    {
        return $this->services['shopware_search_es.category_facet_handler'] = new \Shopware\Bundle\SearchBundleES\FacetHandler\CategoryFacetHandler($this->get('shopware_storefront.category_service'), $this->get('shopware_storefront.category_depth_service'), $this->get('config'), $this->get('shopware_search.category_tree_facet_result_builder'));
    }
    protected function getShopwareSearchEs_CloseoutConditionHandlerService()
    {
        return $this->services['shopware_search_es.closeout_condition_handler'] = new \Shopware\Bundle\SearchBundleES\ConditionHandler\CloseoutConditionHandler();
    }
    protected function getShopwareSearchEs_CombinedConditionFacetHandlerService()
    {
        return $this->services['shopware_search_es.combined_condition_facet_handler'] = new \Shopware\Bundle\SearchBundleES\FacetHandler\CombinedConditionFacetHandler($this->get('shopware_search_es.combined_condition_query_builder'));
    }
    protected function getShopwareSearchEs_CombinedConditionHandlerService()
    {
        return $this->services['shopware_search_es.combined_condition_handler'] = new \Shopware\Bundle\SearchBundleES\ConditionHandler\CombinedConditionHandler($this->get('shopware_search_es.combined_condition_query_builder'));
    }
    protected function getShopwareSearchEs_CombinedConditionQueryBuilderService()
    {
        return $this->services['shopware_search_es.combined_condition_query_builder'] = new \Shopware\Bundle\SearchBundleES\CombinedConditionQueryBuilder($this);
    }
    protected function getShopwareSearchEs_CreateDateConditionHandlerService()
    {
        return $this->services['shopware_search_es.create_date_condition_handler'] = new \Shopware\Bundle\SearchBundleES\ConditionHandler\CreateDateConditionHandler();
    }
    protected function getShopwareSearchEs_CustomerGroupConditionHandlerService()
    {
        return $this->services['shopware_search_es.customer_group_condition_handler'] = new \Shopware\Bundle\SearchBundleES\ConditionHandler\CustomerGroupConditionHandler();
    }
    protected function getShopwareSearchEs_HandlerCollectionService()
    {
        return $this->services['shopware_search_es.handler_collection'] = $this->get('shopware_search_es.product_number_search_factory')->registerHandlerCollection($this);
    }
    protected function getShopwareSearchEs_HasPseudoPriceCondtionHandlerService()
    {
        return $this->services['shopware_search_es.has_pseudo_price_condtion_handler'] = new \Shopware\Bundle\SearchBundleES\ConditionHandler\HasPseudoPriceConditionHandler();
    }
    protected function getShopwareSearchEs_HeightConditionHandlerService()
    {
        return $this->services['shopware_search_es.height_condition_handler'] = new \Shopware\Bundle\SearchBundleES\ConditionHandler\HeightConditionHandler();
    }
    protected function getShopwareSearchEs_ImmediateDeliveryConditionHandlerService()
    {
        return $this->services['shopware_search_es.immediate_delivery_condition_handler'] = new \Shopware\Bundle\SearchBundleES\ConditionHandler\ImmediateDeliveryConditionHandler();
    }
    protected function getShopwareSearchEs_ImmediateDeliveryFacetHandlerService()
    {
        return $this->services['shopware_search_es.immediate_delivery_facet_handler'] = new \Shopware\Bundle\SearchBundleES\FacetHandler\ImmediateDeliveryFacetHandler($this->get('snippets'), $this->get('query_alias_mapper'));
    }
    protected function getShopwareSearchEs_IsAvailableConditionHandlerService()
    {
        return $this->services['shopware_search_es.is_available_condition_handler'] = new \Shopware\Bundle\SearchBundleES\ConditionHandler\IsAvailableConditionHandler();
    }
    protected function getShopwareSearchEs_IsNewCondtionHandlerService()
    {
        return $this->services['shopware_search_es.is_new_condtion_handler'] = new \Shopware\Bundle\SearchBundleES\ConditionHandler\IsNewConditionHandler($this->get('config'));
    }
    protected function getShopwareSearchEs_LengthConditionHandlerService()
    {
        return $this->services['shopware_search_es.length_condition_handler'] = new \Shopware\Bundle\SearchBundleES\ConditionHandler\LengthConditionHandler();
    }
    protected function getShopwareSearchEs_ManufacturerConditionHandlerService()
    {
        return $this->services['shopware_search_es.manufacturer_condition_handler'] = new \Shopware\Bundle\SearchBundleES\ConditionHandler\ManufacturerConditionHandler();
    }
    protected function getShopwareSearchEs_ManufacturerFacetHandlerService()
    {
        return $this->services['shopware_search_es.manufacturer_facet_handler'] = new \Shopware\Bundle\SearchBundleES\FacetHandler\ManufacturerFacetHandler($this->get('shopware_storefront.manufacturer_service'), $this->get('snippets'), $this->get('query_alias_mapper'));
    }
    protected function getShopwareSearchEs_OrdernumberConditionHandlerService()
    {
        return $this->services['shopware_search_es.ordernumber_condition_handler'] = new \Shopware\Bundle\SearchBundleES\ConditionHandler\OrdernumberConditionHandler();
    }
    protected function getShopwareSearchEs_PopularitySortingHandlerService()
    {
        return $this->services['shopware_search_es.popularity_sorting_handler'] = new \Shopware\Bundle\SearchBundleES\SortingHandler\PopularitySortingHandler();
    }
    protected function getShopwareSearchEs_PriceConditionHandlerService()
    {
        return $this->services['shopware_search_es.price_condition_handler'] = new \Shopware\Bundle\SearchBundleES\ConditionHandler\PriceConditionHandler($this->get('shopware_elastic_search.field_mapping'));
    }
    protected function getShopwareSearchEs_PriceFacetHandlerService()
    {
        return $this->services['shopware_search_es.price_facet_handler'] = new \Shopware\Bundle\SearchBundleES\FacetHandler\PriceFacetHandler($this->get('snippets'), $this->get('query_alias_mapper'), $this->get('shopware_elastic_search.field_mapping'));
    }
    protected function getShopwareSearchEs_PriceSortingHandlerService()
    {
        return $this->services['shopware_search_es.price_sorting_handler'] = new \Shopware\Bundle\SearchBundleES\SortingHandler\PriceSortingHandler($this->get('shopware_elastic_search.field_mapping'));
    }
    protected function getShopwareSearchEs_ProductAttributeConditionHandlerService()
    {
        return $this->services['shopware_search_es.product_attribute_condition_handler'] = new \Shopware\Bundle\SearchBundleES\ConditionHandler\ProductAttributeConditionHandler($this->get('shopware_attribute.crud_service'));
    }
    protected function getShopwareSearchEs_ProductAttributeFacetHandlerService()
    {
        return $this->services['shopware_search_es.product_attribute_facet_handler'] = new \Shopware\Bundle\SearchBundleES\FacetHandler\ProductAttributeFacetHandler($this->get('shopware_attribute.crud_service'));
    }
    protected function getShopwareSearchEs_ProductAttributeSortingHandlerService()
    {
        return $this->services['shopware_search_es.product_attribute_sorting_handler'] = new \Shopware\Bundle\SearchBundleES\SortingHandler\ProductAttributeSortingHandler();
    }
    protected function getShopwareSearchEs_ProductDimensionsFacetHandlerService()
    {
        return $this->services['shopware_search_es.product_dimensions_facet_handler'] = new \Shopware\Bundle\SearchBundleES\FacetHandler\ProductDimensionsFacetHandler();
    }
    protected function getShopwareSearchEs_ProductNameSortingHandlerService()
    {
        return $this->services['shopware_search_es.product_name_sorting_handler'] = new \Shopware\Bundle\SearchBundleES\SortingHandler\ProductNameSortingHandler();
    }
    protected function getShopwareSearchEs_ProductNumberSearchService()
    {
        return $this->services['shopware_search_es.product_number_search'] = $this->get('shopware_search_es.product_number_search_factory')->factory($this);
    }
    protected function getShopwareSearchEs_ProductNumberSearchFactoryService()
    {
        return $this->services['shopware_search_es.product_number_search_factory'] = new \Shopware\Bundle\SearchBundleES\DependencyInjection\Factory\ProductNumberSearchFactory(array(0 => $this->get('shopware_search_es.category_condition_handler'), 1 => $this->get('shopware_search_es.product_dimensions_facet_handler'), 2 => $this->get('shopware_search_es.weight_condition_handler'), 3 => $this->get('shopware_search_es.length_condition_handler'), 4 => $this->get('shopware_search_es.height_condition_handler'), 5 => $this->get('shopware_search_es.width_condition_handler'), 6 => $this->get('shopware_search_es.combined_condition_handler'), 7 => $this->get('shopware_search_es.combined_condition_facet_handler'), 8 => $this->get('shopware_search_es.search_random_sorting_handler'), 9 => $this->get('shopware_search_es.search_ranking_sorting_handler'), 10 => $this->get('shopware_search_es.release_date_sorting_handler'), 11 => $this->get('shopware_search_es.product_name_sorting_handler'), 12 => $this->get('shopware_search_es.product_attribute_sorting_handler'), 13 => $this->get('shopware_search_es.popularity_sorting_handler'), 14 => $this->get('shopware_search_es.price_sorting_handler'), 15 => $this->get('shopware_search_es.category_facet_handler'), 16 => $this->get('shopware_search_es.product_attribute_facet_handler'), 17 => $this->get('shopware_search_es.vote_average_facet_handler'), 18 => $this->get('shopware_search_es.immediate_delivery_facet_handler'), 19 => $this->get('shopware_search_es.shipping_free_facet_handler'), 20 => $this->get('shopware_search_es.property_facet_handler'), 21 => $this->get('shopware_search_es.manufacturer_facet_handler'), 22 => $this->get('shopware_search_es.price_facet_handler'), 23 => $this->get('shopware_search_es.is_available_condition_handler'), 24 => $this->get('shopware_search_es.sales_condition_handler'), 25 => $this->get('shopware_search_es.vote_average_condition_handler'), 26 => $this->get('shopware_search_es.shipping_free_condition_handler'), 27 => $this->get('shopware_search_es.search_term_condition_handler'), 28 => $this->get('shopware_search_es.property_condition_handler'), 29 => $this->get('shopware_search_es.product_attribute_condition_handler'), 30 => $this->get('shopware_search_es.price_condition_handler'), 31 => $this->get('shopware_search_es.manufacturer_condition_handler'), 32 => $this->get('shopware_search_es.immediate_delivery_condition_handler'), 33 => $this->get('shopware_search_es.release_date_condition_handler'), 34 => $this->get('shopware_search_es.create_date_condition_handler'), 35 => $this->get('shopware_search_es.is_new_condtion_handler'), 36 => $this->get('shopware_search_es.has_pseudo_price_condtion_handler'), 37 => $this->get('shopware_search_es.customer_group_condition_handler'), 38 => $this->get('shopware_search_es.ordernumber_condition_handler'), 39 => $this->get('shopware_search_es.closeout_condition_handler'), 40 => $this->get('shopware_search_es.similar_product_condition_handler')));
    }
    protected function getShopwareSearchEs_PropertyConditionHandlerService()
    {
        return $this->services['shopware_search_es.property_condition_handler'] = new \Shopware\Bundle\SearchBundleES\ConditionHandler\PropertyConditionHandler();
    }
    protected function getShopwareSearchEs_PropertyFacetHandlerService()
    {
        return $this->services['shopware_search_es.property_facet_handler'] = new \Shopware\Bundle\SearchBundleES\FacetHandler\PropertyFacetHandler($this->get('query_alias_mapper'), $this->get('shopware_elastic_search.client'), $this->get('dbal_connection'), $this->get('shopware_search_es.struct_hydrator'), $this->get('shopware_elastic_search.index_factory'));
    }
    protected function getShopwareSearchEs_ReleaseDateConditionHandlerService()
    {
        return $this->services['shopware_search_es.release_date_condition_handler'] = new \Shopware\Bundle\SearchBundleES\ConditionHandler\ReleaseDateConditionHandler();
    }
    protected function getShopwareSearchEs_ReleaseDateSortingHandlerService()
    {
        return $this->services['shopware_search_es.release_date_sorting_handler'] = new \Shopware\Bundle\SearchBundleES\SortingHandler\ReleaseDateSortingHandler();
    }
    protected function getShopwareSearchEs_SalesConditionHandlerService()
    {
        return $this->services['shopware_search_es.sales_condition_handler'] = new \Shopware\Bundle\SearchBundleES\ConditionHandler\SalesConditionHandler();
    }
    protected function getShopwareSearchEs_SearchRandomSortingHandlerService()
    {
        return $this->services['shopware_search_es.search_random_sorting_handler'] = new \Shopware\Bundle\SearchBundleES\SortingHandler\RandomSortingHandler();
    }
    protected function getShopwareSearchEs_SearchRankingSortingHandlerService()
    {
        return $this->services['shopware_search_es.search_ranking_sorting_handler'] = new \Shopware\Bundle\SearchBundleES\SortingHandler\SearchRankingSortingHandler();
    }
    protected function getShopwareSearchEs_SearchTermConditionHandlerService()
    {
        return $this->services['shopware_search_es.search_term_condition_handler'] = new \Shopware\Bundle\SearchBundleES\ConditionHandler\SearchTermConditionHandler($this->get('shopware_search_es.search_term_query_builder'));
    }
    protected function getShopwareSearchEs_SearchTermQueryBuilderService()
    {
        return $this->services['shopware_search_es.search_term_query_builder'] = new \Shopware\Bundle\SearchBundleES\SearchTermQueryBuilder();
    }
    protected function getShopwareSearchEs_ServiceSubscriberService()
    {
        return $this->services['shopware_search_es.service_subscriber'] = new \Shopware\Bundle\SearchBundleES\Subscriber\ServiceSubscriber($this);
    }
    protected function getShopwareSearchEs_ShippingFreeConditionHandlerService()
    {
        return $this->services['shopware_search_es.shipping_free_condition_handler'] = new \Shopware\Bundle\SearchBundleES\ConditionHandler\ShippingFreeConditionHandler();
    }
    protected function getShopwareSearchEs_ShippingFreeFacetHandlerService()
    {
        return $this->services['shopware_search_es.shipping_free_facet_handler'] = new \Shopware\Bundle\SearchBundleES\FacetHandler\ShippingFreeFacetHandler($this->get('snippets'), $this->get('query_alias_mapper'));
    }
    protected function getShopwareSearchEs_SimilarProductConditionHandlerService()
    {
        return $this->services['shopware_search_es.similar_product_condition_handler'] = new \Shopware\Bundle\SearchBundleES\ConditionHandler\SimilarProductConditionHandler($this->get('dbal_connection'));
    }
    protected function getShopwareSearchEs_StructHydratorService()
    {
        return $this->services['shopware_search_es.struct_hydrator'] = new \Shopware\Bundle\SearchBundleES\StructHydrator();
    }
    protected function getShopwareSearchEs_VoteAverageConditionHandlerService()
    {
        return $this->services['shopware_search_es.vote_average_condition_handler'] = new \Shopware\Bundle\SearchBundleES\ConditionHandler\VoteAverageConditionHandler();
    }
    protected function getShopwareSearchEs_VoteAverageFacetHandlerService()
    {
        return $this->services['shopware_search_es.vote_average_facet_handler'] = new \Shopware\Bundle\SearchBundleES\FacetHandler\VoteAverageFacetHandler($this->get('snippets'), $this->get('query_alias_mapper'));
    }
    protected function getShopwareSearchEs_WeightConditionHandlerService()
    {
        return $this->services['shopware_search_es.weight_condition_handler'] = new \Shopware\Bundle\SearchBundleES\ConditionHandler\WeightConditionHandler();
    }
    protected function getShopwareSearchEs_WidthConditionHandlerService()
    {
        return $this->services['shopware_search_es.width_condition_handler'] = new \Shopware\Bundle\SearchBundleES\ConditionHandler\WidthConditionHandler();
    }
    protected function getShopwareSearchdbal_CacheKeywordFinderService()
    {
        return $this->services['shopware_searchdbal.cache_keyword_finder'] = new \Shopware\Bundle\SearchBundleDBAL\SearchTerm\CacheKeywordFinder($this->get('shopware_storefront.storefront_cache'), $this->get('config'), $this->get('shopware_searchdbal.keyword_finder_dbal'));
    }
    protected function getShopwareSearchdbal_CategoryConditionHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.category_condition_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\ConditionHandler\CategoryConditionHandler();
    }
    protected function getShopwareSearchdbal_CategoryFacetHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.category_facet_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\FacetHandler\CategoryFacetHandler($this->get('shopware_storefront.category_service'), $this->get('shopware_searchdbal.dbal_query_builder_factory'), $this->get('config'), $this->get('shopware_storefront.category_depth_service'), $this->get('shopware_search.category_tree_facet_result_builder'));
    }
    protected function getShopwareSearchdbal_CloseoutConditionHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.closeout_condition_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\ConditionHandler\CloseoutConditionHandler();
    }
    protected function getShopwareSearchdbal_CombinedConditionFacetHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.combined_condition_facet_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\FacetHandler\CombinedConditionFacetHandler($this->get('shopware_searchdbal.dbal_query_builder_factory'));
    }
    protected function getShopwareSearchdbal_CombinedConditionHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.combined_condition_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\ConditionHandler\CombinedConditionHandler($this);
    }
    protected function getShopwareSearchdbal_ConditionHandlersService()
    {
        throw new RuntimeException('You have requested a synthetic service ("shopware_searchdbal.condition_handlers"). The DIC does not know how to construct this service.');
    }
    protected function getShopwareSearchdbal_CreateDateConditionHandlerService()
    {
        return $this->services['shopware_searchdbal.create_date_condition_handler'] = new \Shopware\Bundle\SearchBundleDBAL\ConditionHandler\CreateDateConditionHandler();
    }
    protected function getShopwareSearchdbal_CustomerGroupConditionHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.customer_group_condition_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\ConditionHandler\CustomerGroupConditionHandler();
    }
    protected function getShopwareSearchdbal_DbalQueryBuilderFactoryService()
    {
        return $this->services['shopware_searchdbal.dbal_query_builder_factory'] = new \Shopware\Bundle\SearchBundleDBAL\QueryBuilderFactory($this->get('dbal_connection'), $this->get('events'), array(0 => $this->get('shopware_searchdbal.vote_average_condition_handler_dbal'), 1 => $this->get('shopware_searchdbal.weight_condition_handler'), 2 => $this->get('shopware_searchdbal.width_condition_handler'), 3 => $this->get('shopware_searchdbal.length_condition_handler'), 4 => $this->get('shopware_searchdbal.height_condition_handler'), 5 => $this->get('shopware_searchdbal.combined_condition_handler_dbal'), 6 => $this->get('shopware_searchdbal.similar_products_handler_dbal'), 7 => $this->get('shopware_searchdbal.price_condition_handler_dbal'), 8 => $this->get('shopware_searchdbal.sales_condition_handler_dbal'), 9 => $this->get('shopware_searchdbal.shipping_free_condition_handler_dbal'), 10 => $this->get('shopware_searchdbal.property_condition_handler_dbal'), 11 => $this->get('shopware_searchdbal.manufacturer_condition_handler_dbal'), 12 => $this->get('shopware_searchdbal.immediate_delivery_condition_handler_dbal'), 13 => $this->get('shopware_searchdbal.customer_group_condition_handler_dbal'), 14 => $this->get('shopware_searchdbal.product_attribute_condition_handler_dbal'), 15 => $this->get('shopware_searchdbal.ordernumber_condition_handler_dbal'), 16 => $this->get('shopware_searchdbal.category_condition_handler_dbal'), 17 => $this->get('shopware_searchdbal.search_condition_handler_dbal'), 18 => $this->get('shopware_searchdbal.create_date_condition_handler'), 19 => $this->get('shopware_searchdbal.release_date_condition_handler'), 20 => $this->get('shopware_searchdbal.is_new_condition_handler_dbal'), 21 => $this->get('shopware_searchdbal.has_pseudo_price_condition_handler_dbal'), 22 => $this->get('shopware_searchdbal.closeout_condition_handler_dbal'), 23 => $this->get('shopware_searchdbal.is_available_condition_handler_dbal')), array(0 => $this->get('shopware_searchdbal.product_name_sorting_handler_dbal'), 1 => $this->get('shopware_searchdbal.random_sorting_handler_dbal'), 2 => $this->get('shopware_searchdbal.search_ranking_sorting_handler_dbal'), 3 => $this->get('shopware_searchdbal.price_sorting_handler_sorting_handler_dbal'), 4 => $this->get('shopware_searchdbal.release_date_sorting_handler_dbal'), 5 => $this->get('shopware_searchdbal.shopware_searchdbal.product_attribute_sorting_handler_dbal'), 6 => $this->get('shopware_searchdbal.popularity_sorting_handler_dbal')), $this);
    }
    protected function getShopwareSearchdbal_FacetHandlersService()
    {
        throw new RuntimeException('You have requested a synthetic service ("shopware_searchdbal.facet_handlers"). The DIC does not know how to construct this service.');
    }
    protected function getShopwareSearchdbal_HasPseudoPriceConditionHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.has_pseudo_price_condition_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\ConditionHandler\HasPseudoPriceConditionHandler($this->get('shopware_searchdbal.listing_price_table'));
    }
    protected function getShopwareSearchdbal_HeightConditionHandlerService()
    {
        return $this->services['shopware_searchdbal.height_condition_handler'] = new \Shopware\Bundle\SearchBundleDBAL\ConditionHandler\HeightConditionHandler($this->get('shopware_searchdbal.variant_helper'));
    }
    protected function getShopwareSearchdbal_ImmediateDeliveryConditionHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.immediate_delivery_condition_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\ConditionHandler\ImmediateDeliveryConditionHandler($this->get('shopware_searchdbal.variant_helper'));
    }
    protected function getShopwareSearchdbal_ImmediateDeliveryFacetHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.immediate_delivery_facet_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\FacetHandler\ImmediateDeliveryFacetHandler($this->get('shopware_searchdbal.dbal_query_builder_factory'), $this->get('snippets'), $this->get('query_alias_mapper'), $this->get('shopware_searchdbal.variant_helper'));
    }
    protected function getShopwareSearchdbal_IsAvailableConditionHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.is_available_condition_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\ConditionHandler\IsAvailableConditionHandler($this->get('shopware_searchdbal.search_price_helper_dbal'));
    }
    protected function getShopwareSearchdbal_IsNewConditionHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.is_new_condition_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\ConditionHandler\IsNewConditionHandler($this->get('config'));
    }
    protected function getShopwareSearchdbal_KeywordFinderDbalService()
    {
        return $this->services['shopware_searchdbal.keyword_finder_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\SearchTerm\KeywordFinder($this->get('config'), $this->get('dbal_connection'), $this->get('shopware_searchdbal.search_term_helper'));
    }
    protected function getShopwareSearchdbal_LengthConditionHandlerService()
    {
        return $this->services['shopware_searchdbal.length_condition_handler'] = new \Shopware\Bundle\SearchBundleDBAL\ConditionHandler\LengthConditionHandler($this->get('shopware_searchdbal.variant_helper'));
    }
    protected function getShopwareSearchdbal_ListingPriceTableService()
    {
        return $this->services['shopware_searchdbal.listing_price_table'] = new \Shopware\Bundle\SearchBundleDBAL\ListingPriceTable($this->get('dbal_connection'), $this->get('config'));
    }
    protected function getShopwareSearchdbal_ManufacturerConditionHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.manufacturer_condition_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\ConditionHandler\ManufacturerConditionHandler();
    }
    protected function getShopwareSearchdbal_ManufacturerFacetHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.manufacturer_facet_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\FacetHandler\ManufacturerFacetHandler($this->get('shopware_storefront.manufacturer_service'), $this->get('shopware_searchdbal.dbal_query_builder_factory'), $this->get('snippets'), $this->get('query_alias_mapper'));
    }
    protected function getShopwareSearchdbal_OrdernumberConditionHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.ordernumber_condition_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\ConditionHandler\OrdernumberConditionHandler();
    }
    protected function getShopwareSearchdbal_PopularitySortingHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.popularity_sorting_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\SortingHandler\PopularitySortingHandler();
    }
    protected function getShopwareSearchdbal_PriceConditionHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.price_condition_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\ConditionHandler\PriceConditionHandler($this->get('shopware_searchdbal.listing_price_table'));
    }
    protected function getShopwareSearchdbal_PriceFacetHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.price_facet_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\FacetHandler\PriceFacetHandler($this->get('shopware_searchdbal.listing_price_table'), $this->get('shopware_searchdbal.dbal_query_builder_factory'), $this->get('snippets'), $this->get('query_alias_mapper'));
    }
    protected function getShopwareSearchdbal_PriceSortingHandlerSortingHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.price_sorting_handler_sorting_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\SortingHandler\PriceSortingHandler($this->get('shopware_searchdbal.listing_price_table'));
    }
    protected function getShopwareSearchdbal_ProductAttributeConditionHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.product_attribute_condition_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\ConditionHandler\ProductAttributeConditionHandler();
    }
    protected function getShopwareSearchdbal_ProductAttributeFacetHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.product_attribute_facet_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\FacetHandler\ProductAttributeFacetHandler($this->get('shopware_searchdbal.dbal_query_builder_factory'), $this->get('shopware_attribute.crud_service'));
    }
    protected function getShopwareSearchdbal_ProductDimensionsFacetHandlerService()
    {
        return $this->services['shopware_searchdbal.product_dimensions_facet_handler'] = new \Shopware\Bundle\SearchBundleDBAL\FacetHandler\ProductDimensionsFacetHandler($this->get('shopware_searchdbal.dbal_query_builder_factory'), $this->get('snippets'), $this->get('query_alias_mapper'), $this->get('shopware_searchdbal.variant_helper'));
    }
    protected function getShopwareSearchdbal_ProductNameSortingHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.product_name_sorting_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\SortingHandler\ProductNameSortingHandler();
    }
    protected function getShopwareSearchdbal_PropertyConditionHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.property_condition_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\ConditionHandler\PropertyConditionHandler();
    }
    protected function getShopwareSearchdbal_PropertyFacetHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.property_facet_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\FacetHandler\PropertyFacetHandler($this->get('shopware_storefront.property_gateway'), $this->get('shopware_searchdbal.dbal_query_builder_factory'), $this->get('query_alias_mapper'));
    }
    protected function getShopwareSearchdbal_RandomSortingHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.random_sorting_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\SortingHandler\RandomSortingHandler();
    }
    protected function getShopwareSearchdbal_ReleaseDateConditionHandlerService()
    {
        return $this->services['shopware_searchdbal.release_date_condition_handler'] = new \Shopware\Bundle\SearchBundleDBAL\ConditionHandler\ReleaseDateConditionHandler();
    }
    protected function getShopwareSearchdbal_ReleaseDateSortingHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.release_date_sorting_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\SortingHandler\ReleaseDateSortingHandler();
    }
    protected function getShopwareSearchdbal_SalesConditionHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.sales_condition_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\ConditionHandler\SalesConditionHandler();
    }
    protected function getShopwareSearchdbal_SearchConditionHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.search_condition_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\ConditionHandler\SearchTermConditionHandler($this->get('shopware_searchdbal.search_query_builder_dbal'));
    }
    protected function getShopwareSearchdbal_SearchIndexerService()
    {
        return $this->services['shopware_searchdbal.search_indexer'] = new \Shopware\Bundle\SearchBundleDBAL\SearchTerm\SearchIndexer($this->get('config'), $this->get('dbal_connection'), $this->get('shopware_searchdbal.search_term_helper'));
    }
    protected function getShopwareSearchdbal_SearchPriceHelperDbalService()
    {
        return $this->services['shopware_searchdbal.search_price_helper_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\PriceHelper($this->get('config'));
    }
    protected function getShopwareSearchdbal_SearchQueryBuilderDbalService()
    {
        return $this->services['shopware_searchdbal.search_query_builder_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\SearchTerm\SearchTermQueryBuilder($this->get('config'), $this->get('dbal_connection'), $this->get('shopware_searchdbal.cache_keyword_finder'), $this->get('shopware_searchdbal.search_indexer'), $this->get('shopware_searchdbal.search_term_helper'));
    }
    protected function getShopwareSearchdbal_SearchRankingSortingHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.search_ranking_sorting_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\SortingHandler\SearchRankingSortingHandler();
    }
    protected function getShopwareSearchdbal_SearchTermHelperService()
    {
        return $this->services['shopware_searchdbal.search_term_helper'] = new \Shopware\Bundle\SearchBundleDBAL\SearchTerm\TermHelper($this->get('config'));
    }
    protected function getShopwareSearchdbal_SearchTermLoggerService()
    {
        return $this->services['shopware_searchdbal.search_term_logger'] = new \Shopware\Bundle\SearchBundleDBAL\SearchTerm\SearchTermLogger($this->get('dbal_connection'));
    }
    protected function getShopwareSearchdbal_ShippingFreeConditionHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.shipping_free_condition_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\ConditionHandler\ShippingFreeConditionHandler();
    }
    protected function getShopwareSearchdbal_ShippingFreeFacetHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.shipping_free_facet_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\FacetHandler\ShippingFreeFacetHandler($this->get('shopware_searchdbal.dbal_query_builder_factory'), $this->get('snippets'), $this->get('query_alias_mapper'));
    }
    protected function getShopwareSearchdbal_ShopwareSearchdbal_ProductAttributeSortingHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.shopware_searchdbal.product_attribute_sorting_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\SortingHandler\ProductAttributeSortingHandler();
    }
    protected function getShopwareSearchdbal_SimilarProductsHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.similar_products_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\ConditionHandler\SimilarProductConditionHandler();
    }
    protected function getShopwareSearchdbal_SortingHandlersService()
    {
        throw new RuntimeException('You have requested a synthetic service ("shopware_searchdbal.sorting_handlers"). The DIC does not know how to construct this service.');
    }
    protected function getShopwareSearchdbal_VariantHelperService()
    {
        return $this->services['shopware_searchdbal.variant_helper'] = new \Shopware\Bundle\SearchBundleDBAL\VariantHelper();
    }
    protected function getShopwareSearchdbal_VoteAverageConditionHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.vote_average_condition_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\ConditionHandler\VoteAverageConditionHandler($this->get('config'));
    }
    protected function getShopwareSearchdbal_VoteAverageFacetHandlerDbalService()
    {
        return $this->services['shopware_searchdbal.vote_average_facet_handler_dbal'] = new \Shopware\Bundle\SearchBundleDBAL\FacetHandler\VoteAverageFacetHandler($this->get('shopware_searchdbal.dbal_query_builder_factory'), $this->get('snippets'), $this->get('query_alias_mapper'), $this->get('config'));
    }
    protected function getShopwareSearchdbal_WeightConditionHandlerService()
    {
        return $this->services['shopware_searchdbal.weight_condition_handler'] = new \Shopware\Bundle\SearchBundleDBAL\ConditionHandler\WeightConditionHandler($this->get('shopware_searchdbal.variant_helper'));
    }
    protected function getShopwareSearchdbal_WidthConditionHandlerService()
    {
        return $this->services['shopware_searchdbal.width_condition_handler'] = new \Shopware\Bundle\SearchBundleDBAL\ConditionHandler\WidthConditionHandler($this->get('shopware_searchdbal.variant_helper'));
    }
    protected function getShopwareStorefront_AdditionalTextServiceService()
    {
        return $this->services['shopware_storefront.additional_text_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\AdditionalTextService($this->get('shopware_storefront.configurator_service'));
    }
    protected function getShopwareStorefront_AttributeHydratorDbalService()
    {
        return $this->services['shopware_storefront.attribute_hydrator_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\Hydrator\AttributeHydrator($this->get('shopware_storefront.field_helper_dbal'));
    }
    protected function getShopwareStorefront_BaseProductFactoryService()
    {
        return $this->services['shopware_storefront.base_product_factory'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\BaseProductFactoryService($this->get('dbal_connection'));
    }
    protected function getShopwareStorefront_BlogGatewayDbalService()
    {
        return $this->services['shopware_storefront.blog_gateway_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\BlogGateway($this->get('dbal_connection'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_storefront.blog_hydrator_dbal'));
    }
    protected function getShopwareStorefront_BlogHydratorDbalService()
    {
        return $this->services['shopware_storefront.blog_hydrator_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\Hydrator\BlogHydrator($this->get('shopware_storefront.attribute_hydrator_dbal'));
    }
    protected function getShopwareStorefront_BlogServiceService()
    {
        return $this->services['shopware_storefront.blog_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\BlogService($this->get('shopware_storefront.blog_gateway_dbal'), $this->get('shopware_storefront.media_service'));
    }
    protected function getShopwareStorefront_CategoryDepthServiceService()
    {
        return $this->services['shopware_storefront.category_depth_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\CategoryDepthService($this->get('dbal_connection'));
    }
    protected function getShopwareStorefront_CategoryGatewayService()
    {
        return $this->services['shopware_storefront.category_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\CategoryGateway($this->get('dbal_connection'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_storefront.category_hydrator_dbal'));
    }
    protected function getShopwareStorefront_CategoryHydratorDbalService()
    {
        return $this->services['shopware_storefront.category_hydrator_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\Hydrator\CategoryHydrator($this->get('shopware_storefront.attribute_hydrator_dbal'), $this->get('shopware_storefront.media_hydrator_dbal'), $this->get('shopware_storefront.product_stream_hydrator_dbal'));
    }
    protected function getShopwareStorefront_CategoryServiceService()
    {
        return $this->services['shopware_storefront.category_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\CategoryService($this->get('shopware_storefront.category_gateway'));
    }
    protected function getShopwareStorefront_CheapestPriceGatewayService()
    {
        return $this->services['shopware_storefront.cheapest_price_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\CheapestPriceGateway($this->get('dbal_connection'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_storefront.price_hydrator_dbal'), $this->get('config'));
    }
    protected function getShopwareStorefront_CheapestPriceServiceService()
    {
        return $this->services['shopware_storefront.cheapest_price_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\CheapestPriceService($this->get('shopware_storefront.cheapest_price_gateway'), $this->get('config'));
    }
    protected function getShopwareStorefront_ConfiguratorGatewayService()
    {
        return $this->services['shopware_storefront.configurator_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\ConfiguratorGateway($this->get('dbal_connection'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_storefront.configurator_hydrator_dbal'), $this->get('shopware_storefront.media_gateway'));
    }
    protected function getShopwareStorefront_ConfiguratorHydratorDbalService()
    {
        return $this->services['shopware_storefront.configurator_hydrator_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\Hydrator\ConfiguratorHydrator($this->get('shopware_storefront.attribute_hydrator_dbal'));
    }
    protected function getShopwareStorefront_ConfiguratorServiceService()
    {
        return $this->services['shopware_storefront.configurator_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\ConfiguratorService($this->get('shopware_storefront.product_configuration_gateway'), $this->get('shopware_storefront.configurator_gateway'));
    }
    protected function getShopwareStorefront_ContextServiceService()
    {
        return $this->services['shopware_storefront.context_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\ContextService($this, $this->get('shopware_storefront.customer_group_gateway'), $this->get('shopware_storefront.tax_gateway'), $this->get('shopware_storefront.country_gateway'), $this->get('shopware_storefront.price_group_discount_gateway'), $this->get('shopware_storefront.shop_gateway_dbal'), $this->get('shopware_storefront.currency_gateway_dbal'));
    }
    protected function getShopwareStorefront_CountryGatewayService()
    {
        return $this->services['shopware_storefront.country_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\CountryGateway($this->get('dbal_connection'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_storefront.country_hydrator_dbal'));
    }
    protected function getShopwareStorefront_CountryHydratorDbalService()
    {
        return $this->services['shopware_storefront.country_hydrator_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\Hydrator\CountryHydrator($this->get('shopware_storefront.attribute_hydrator_dbal'));
    }
    protected function getShopwareStorefront_CurrencyGatewayDbalService()
    {
        return $this->services['shopware_storefront.currency_gateway_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\CurrencyGateway($this->get('shopware_storefront.currency_hydrator_dbal'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('dbal_connection'));
    }
    protected function getShopwareStorefront_CurrencyHydratorDbalService()
    {
        return $this->services['shopware_storefront.currency_hydrator_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\Hydrator\CurrencyHydrator();
    }
    protected function getShopwareStorefront_CustomFacetGatewayService()
    {
        return $this->services['shopware_storefront.custom_facet_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\CustomFacetGateway($this->get('dbal_connection'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_storefront.custom_listing_hydrator'));
    }
    protected function getShopwareStorefront_CustomFacetServiceService()
    {
        return $this->services['shopware_storefront.custom_facet_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\CustomFacetService($this->get('shopware_storefront.custom_facet_gateway'));
    }
    protected function getShopwareStorefront_CustomListingHydratorService()
    {
        return $this->services['shopware_storefront.custom_listing_hydrator'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\Hydrator\CustomListingHydrator($this->get('shopware.logaware_reflection_helper'));
    }
    protected function getShopwareStorefront_CustomSortingGatewayService()
    {
        return $this->services['shopware_storefront.custom_sorting_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\CustomSortingGateway($this->get('dbal_connection'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_storefront.custom_listing_hydrator'), $this->get('config'));
    }
    protected function getShopwareStorefront_CustomSortingServiceService()
    {
        return $this->services['shopware_storefront.custom_sorting_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\CustomSortingService($this->get('shopware_storefront.custom_sorting_gateway'));
    }
    protected function getShopwareStorefront_CustomerGroupGatewayService()
    {
        return $this->services['shopware_storefront.customer_group_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\CustomerGroupGateway($this->get('dbal_connection'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_storefront.customer_group_hydrator_dbal'));
    }
    protected function getShopwareStorefront_CustomerGroupHydratorDbalService()
    {
        return $this->services['shopware_storefront.customer_group_hydrator_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\Hydrator\CustomerGroupHydrator($this->get('shopware_storefront.attribute_hydrator_dbal'));
    }
    protected function getShopwareStorefront_DownloadGatewayService()
    {
        return $this->services['shopware_storefront.download_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\DownloadGateway($this->get('dbal_connection'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_storefront.download_hydrator_dbal'));
    }
    protected function getShopwareStorefront_DownloadHydratorDbalService()
    {
        return $this->services['shopware_storefront.download_hydrator_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\Hydrator\DownloadHydrator($this->get('shopware_storefront.attribute_hydrator_dbal'));
    }
    protected function getShopwareStorefront_EsdHydratorDbalService()
    {
        return $this->services['shopware_storefront.esd_hydrator_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\Hydrator\EsdHydrator($this->get('shopware_storefront.attribute_hydrator_dbal'));
    }
    protected function getShopwareStorefront_FieldHelperDbalService()
    {
        return $this->services['shopware_storefront.field_helper_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\FieldHelper($this->get('dbal_connection'), $this->get('shopware_storefront.storefront_cache'));
    }
    protected function getShopwareStorefront_GraduatedPricesGatewayService()
    {
        return $this->services['shopware_storefront.graduated_prices_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\GraduatedPricesGateway($this->get('dbal_connection'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_storefront.price_hydrator_dbal'));
    }
    protected function getShopwareStorefront_GraduatedPricesServiceService()
    {
        return $this->services['shopware_storefront.graduated_prices_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\GraduatedPricesService($this->get('shopware_storefront.graduated_prices_gateway'));
    }
    protected function getShopwareStorefront_LinkGatewayService()
    {
        return $this->services['shopware_storefront.link_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\LinkGateway($this->get('dbal_connection'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_storefront.link_hydrator_dbal'));
    }
    protected function getShopwareStorefront_LinkHydratorDbalService()
    {
        return $this->services['shopware_storefront.link_hydrator_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\Hydrator\LinkHydrator($this->get('shopware_storefront.attribute_hydrator_dbal'));
    }
    protected function getShopwareStorefront_ListProductGatewayService()
    {
        return $this->services['shopware_storefront.list_product_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\ListProductGateway($this->get('dbal_connection'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_storefront.product_hydrator_dbal'), $this->get('config'));
    }
    protected function getShopwareStorefront_ListProductServiceService()
    {
        return $this->services['shopware_storefront.list_product_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\ListProductService($this->get('shopware_storefront.list_product_gateway'), $this->get('shopware_storefront.graduated_prices_service'), $this->get('shopware_storefront.cheapest_price_service'), $this->get('shopware_storefront.price_calculation_service'), $this->get('shopware_storefront.media_service'), $this->get('shopware_storefront.marketing_service'), $this->get('shopware_storefront.vote_service'), $this->get('shopware_storefront.category_service'), $this->get('config'));
    }
    protected function getShopwareStorefront_LocaleHydratorDbalService()
    {
        return $this->services['shopware_storefront.locale_hydrator_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\Hydrator\LocaleHydrator();
    }
    protected function getShopwareStorefront_LocationServiceService()
    {
        return $this->services['shopware_storefront.location_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\LocationService($this->get('shopware_storefront.country_gateway'), $this->get('dbal_connection'));
    }
    protected function getShopwareStorefront_ManufacturerGatewayService()
    {
        return $this->services['shopware_storefront.manufacturer_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\ManufacturerGateway($this->get('dbal_connection'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_storefront.manufacturer_hydrator_dbal'));
    }
    protected function getShopwareStorefront_ManufacturerHydratorDbalService()
    {
        return $this->services['shopware_storefront.manufacturer_hydrator_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\Hydrator\ManufacturerHydrator($this->get('shopware_storefront.attribute_hydrator_dbal'), $this->get('shopware_media.media_service'));
    }
    protected function getShopwareStorefront_ManufacturerServiceService()
    {
        return $this->services['shopware_storefront.manufacturer_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\ManufacturerService($this->get('shopware_storefront.manufacturer_gateway'), $this->get('router'));
    }
    protected function getShopwareStorefront_MarketingServiceService()
    {
        return $this->services['shopware_storefront.marketing_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\MarketingService($this->get('config'));
    }
    protected function getShopwareStorefront_MediaGatewayService()
    {
        return $this->services['shopware_storefront.media_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\MediaGateway($this->get('dbal_connection'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_storefront.media_hydrator_dbal'));
    }
    protected function getShopwareStorefront_MediaHydratorDbalService()
    {
        return $this->services['shopware_storefront.media_hydrator_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\Hydrator\MediaHydrator($this->get('shopware_storefront.attribute_hydrator_dbal'), $this->get('thumbnail_manager'), $this->get('shopware_media.media_service'), $this->get('dbal_connection'));
    }
    protected function getShopwareStorefront_MediaServiceService()
    {
        return $this->services['shopware_storefront.media_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\MediaService($this->get('shopware_storefront.media_gateway'), $this->get('shopware_storefront.product_media_gateway'), $this->get('shopware_storefront.variant_media_gateway'), $this->get('config'), $this->get('shopware_storefront.variant_cover_service'));
    }
    protected function getShopwareStorefront_PriceCalculationServiceService()
    {
        return $this->services['shopware_storefront.price_calculation_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\PriceCalculationService($this->get('shopware_storefront.price_calculator'));
    }
    protected function getShopwareStorefront_PriceCalculatorService()
    {
        return $this->services['shopware_storefront.price_calculator'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\PriceCalculator();
    }
    protected function getShopwareStorefront_PriceGroupDiscountGatewayService()
    {
        return $this->services['shopware_storefront.price_group_discount_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\PriceGroupDiscountGateway($this->get('dbal_connection'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_storefront.price_hydrator_dbal'));
    }
    protected function getShopwareStorefront_PriceHydratorDbalService()
    {
        return $this->services['shopware_storefront.price_hydrator_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\Hydrator\PriceHydrator($this->get('shopware_storefront.customer_group_hydrator_dbal'), $this->get('shopware_storefront.unit_hydrator_dbal'), $this->get('shopware_storefront.attribute_hydrator_dbal'), $this->get('shopware_storefront.product_hydrator_dbal'));
    }
    protected function getShopwareStorefront_ProductConfigurationGatewayService()
    {
        return $this->services['shopware_storefront.product_configuration_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\ProductConfigurationGateway($this->get('dbal_connection'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_storefront.configurator_hydrator_dbal'));
    }
    protected function getShopwareStorefront_ProductDownloadServiceService()
    {
        return $this->services['shopware_storefront.product_download_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\ProductDownloadService($this->get('shopware_storefront.download_gateway'));
    }
    protected function getShopwareStorefront_ProductHydratorDbalService()
    {
        return $this->services['shopware_storefront.product_hydrator_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\Hydrator\ProductHydrator($this->get('shopware_storefront.attribute_hydrator_dbal'), $this->get('shopware_storefront.manufacturer_hydrator_dbal'), $this->get('shopware_storefront.tax_hydrator_dbal'), $this->get('shopware_storefront.unit_hydrator_dbal'), $this->get('shopware_storefront.esd_hydrator_dbal'));
    }
    protected function getShopwareStorefront_ProductLinkServiceService()
    {
        return $this->services['shopware_storefront.product_link_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\ProductLinkService($this->get('shopware_storefront.link_gateway'));
    }
    protected function getShopwareStorefront_ProductMediaGatewayService()
    {
        return $this->services['shopware_storefront.product_media_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\ProductMediaGateway($this->get('dbal_connection'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_storefront.media_hydrator_dbal'));
    }
    protected function getShopwareStorefront_ProductNumberServiceService()
    {
        return $this->services['shopware_storefront.product_number_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\ProductNumberService($this->get('dbal_connection'), $this->get('config'));
    }
    protected function getShopwareStorefront_ProductPropertyGatewayService()
    {
        return $this->services['shopware_storefront.product_property_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\ProductPropertyGateway($this->get('dbal_connection'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_storefront.property_hydrator_dbal'));
    }
    protected function getShopwareStorefront_ProductServiceService()
    {
        return $this->services['shopware_storefront.product_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\ProductService($this->get('shopware_storefront.list_product_service'), $this->get('shopware_storefront.vote_service'), $this->get('shopware_storefront.media_service'), $this->get('shopware_storefront.related_products_service'), $this->get('shopware_storefront.related_product_streams_service'), $this->get('shopware_storefront.similar_products_service'), $this->get('shopware_storefront.product_download_service'), $this->get('shopware_storefront.product_link_service'), $this->get('shopware_storefront.property_service'), $this->get('shopware_storefront.configurator_service'), $this->get('events'));
    }
    protected function getShopwareStorefront_ProductStreamHydratorDbalService()
    {
        return $this->services['shopware_storefront.product_stream_hydrator_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\Hydrator\ProductStreamHydrator($this->get('shopware_storefront.attribute_hydrator_dbal'));
    }
    protected function getShopwareStorefront_PropertyGatewayService()
    {
        return $this->services['shopware_storefront.property_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\PropertyGateway($this->get('dbal_connection'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_storefront.property_hydrator_dbal'), $this->get('config'));
    }
    protected function getShopwareStorefront_PropertyHydratorDbalService()
    {
        return $this->services['shopware_storefront.property_hydrator_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\Hydrator\PropertyHydrator($this->get('shopware_storefront.attribute_hydrator_dbal'), $this->get('shopware_storefront.media_hydrator_dbal'));
    }
    protected function getShopwareStorefront_PropertyServiceService()
    {
        return $this->services['shopware_storefront.property_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\PropertyService($this->get('shopware_storefront.product_property_gateway'));
    }
    protected function getShopwareStorefront_RelatedProductStreamsGatewayService()
    {
        return $this->services['shopware_storefront.related_product_streams_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\RelatedProductStreamsGateway($this->get('dbal_connection'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_storefront.product_stream_hydrator_dbal'));
    }
    protected function getShopwareStorefront_RelatedProductStreamsServiceService()
    {
        return $this->services['shopware_storefront.related_product_streams_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\RelatedProductStreamsService($this->get('shopware_storefront.related_product_streams_gateway'));
    }
    protected function getShopwareStorefront_RelatedProductsGatewayService()
    {
        return $this->services['shopware_storefront.related_products_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\RelatedProductsGateway($this->get('dbal_connection'));
    }
    protected function getShopwareStorefront_RelatedProductsServiceService()
    {
        return $this->services['shopware_storefront.related_products_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\RelatedProductsService($this->get('shopware_storefront.related_products_gateway'), $this->get('shopware_storefront.list_product_service'));
    }
    protected function getShopwareStorefront_ShopGatewayDbalService()
    {
        return $this->services['shopware_storefront.shop_gateway_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\ShopGateway($this->get('shopware_storefront.shop_hydrator_dbal'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('dbal_connection'));
    }
    protected function getShopwareStorefront_ShopHydratorDbalService()
    {
        return $this->services['shopware_storefront.shop_hydrator_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\Hydrator\ShopHydrator($this->get('shopware_storefront.template_hydrator_dbal'), $this->get('shopware_storefront.category_hydrator_dbal'), $this->get('shopware_storefront.locale_hydrator_dbal'), $this->get('shopware_storefront.currency_hydrator_dbal'), $this->get('shopware_storefront.customer_group_hydrator_dbal'));
    }
    protected function getShopwareStorefront_ShopPageGatewayService()
    {
        return $this->services['shopware_storefront.shop_page_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\ShopPageGateway($this->get('dbal_connection'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_storefront.shop_page_hydrator_dbal'));
    }
    protected function getShopwareStorefront_ShopPageHydratorDbalService()
    {
        return $this->services['shopware_storefront.shop_page_hydrator_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\Hydrator\ShopPageHydrator($this->get('shopware_storefront.attribute_hydrator_dbal'));
    }
    protected function getShopwareStorefront_ShopPageServiceService()
    {
        return $this->services['shopware_storefront.shop_page_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\ShopPageService($this->get('shopware_storefront.shop_page_gateway'), $this->get('shopware_storefront.shop_gateway_dbal'));
    }
    protected function getShopwareStorefront_SimilarProductsGatewayService()
    {
        return $this->services['shopware_storefront.similar_products_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\SimilarProductsGateway($this->get('dbal_connection'), $this->get('config'));
    }
    protected function getShopwareStorefront_SimilarProductsServiceService()
    {
        return $this->services['shopware_storefront.similar_products_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\SimilarProductsService($this->get('shopware_storefront.similar_products_gateway'), $this->get('shopware_storefront.list_product_service'), $this->get('shopware_search.product_search'), $this->get('shopware_search.store_front_criteria_factory'), $this->get('config'));
    }
    protected function getShopwareStorefront_StorefrontCacheService()
    {
        return $this->services['shopware_storefront.storefront_cache'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\CoreCache($this->get('models_metadata_cache'));
    }
    protected function getShopwareStorefront_TaxGatewayService()
    {
        return $this->services['shopware_storefront.tax_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\TaxGateway($this->get('dbal_connection'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_storefront.tax_hydrator_dbal'));
    }
    protected function getShopwareStorefront_TaxHydratorDbalService()
    {
        return $this->services['shopware_storefront.tax_hydrator_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\Hydrator\TaxHydrator();
    }
    protected function getShopwareStorefront_TemplateHydratorDbalService()
    {
        return $this->services['shopware_storefront.template_hydrator_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\Hydrator\TemplateHydrator();
    }
    protected function getShopwareStorefront_UnitHydratorDbalService()
    {
        return $this->services['shopware_storefront.unit_hydrator_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\Hydrator\UnitHydrator();
    }
    protected function getShopwareStorefront_VariantCoverServiceService()
    {
        return $this->services['shopware_storefront.variant_cover_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\VariantCoverService($this->get('shopware_storefront.product_media_gateway'), $this->get('shopware_storefront.variant_media_gateway'));
    }
    protected function getShopwareStorefront_VariantMediaGatewayService()
    {
        return $this->services['shopware_storefront.variant_media_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\VariantMediaGateway($this->get('dbal_connection'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_storefront.media_hydrator_dbal'));
    }
    protected function getShopwareStorefront_VoteAverageGatewayService()
    {
        return $this->services['shopware_storefront.vote_average_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\VoteAverageGateway($this->get('dbal_connection'), $this->get('shopware_storefront.vote_hydrator_dbal'), $this->get('config'));
    }
    protected function getShopwareStorefront_VoteGatewayService()
    {
        return $this->services['shopware_storefront.vote_gateway'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\VoteGateway($this->get('dbal_connection'), $this->get('shopware_storefront.field_helper_dbal'), $this->get('shopware_storefront.vote_hydrator_dbal'), $this->get('config'));
    }
    protected function getShopwareStorefront_VoteHydratorDbalService()
    {
        return $this->services['shopware_storefront.vote_hydrator_dbal'] = new \Shopware\Bundle\StoreFrontBundle\Gateway\DBAL\Hydrator\VoteHydrator();
    }
    protected function getShopwareStorefront_VoteServiceService()
    {
        return $this->services['shopware_storefront.vote_service'] = new \Shopware\Bundle\StoreFrontBundle\Service\Core\VoteService($this->get('shopware_storefront.vote_gateway'), $this->get('shopware_storefront.vote_average_gateway'));
    }
    protected function getSitemapxml_RepositoryService()
    {
        return $this->services['sitemapxml.repository'] = new \Shopware\Components\SitemapXMLRepository($this->get('shopware_search.product_number_search'), $this->get('shopware_search.store_front_criteria_factory'), $this->get('models'), $this->get('shopware_storefront.context_service'));
    }
    protected function getSnippetResourceService()
    {
        return $this->services['snippet_resource'] = new \Enlight_Components_Snippet_Resource($this->get('snippets'), false);
    }
    protected function getSnippetsService()
    {
        return $this->services['snippets'] = new \Shopware_Components_Snippet_Manager($this->get('models'), array('Default' => '/var/www/shopware/engine/Shopware/Plugins/Default/', 'Local' => '/var/www/shopware/engine/Shopware/Plugins/Local/', 'Community' => '/var/www/shopware/engine/Shopware/Plugins/Community/', 'ShopwarePlugins' => '/var/www/shopware/custom/plugins/'), array('readFromDb' => true, 'writeToDb' => true, 'readFromIni' => false, 'writeToIni' => false, 'showSnippetPlaceholder' => false));
    }
    protected function getTemplateService()
    {
        return $this->services['template'] = $this->get('template_factory')->factory($this->get('events'), $this->get('snippet_resource'), $this->get('shopware.escaper'), array('compileCheck' => true, 'compileLocking' => true, 'useSubDirs' => true, 'forceCompile' => false, 'useIncludePath' => true, 'charset' => 'utf-8', 'forceCache' => false, 'cacheDir' => '/var/www/shopware/var/cache/production_201710241020/templates', 'compileDir' => '/var/www/shopware/var/cache/production_201710241020/templates'), array('enabled' => true, 'php_modifiers' => array(0 => 'abs', 1 => 'acos', 2 => 'acosh', 3 => 'addcslashes', 4 => 'addslashes', 5 => 'array', 6 => 'array_change_key_case', 7 => 'array_chunk', 8 => 'array_column', 9 => 'array_combine', 10 => 'array_count_values', 11 => 'array_diff', 12 => 'array_diff_assoc', 13 => 'array_diff_key', 14 => 'array_diff_uassoc', 15 => 'array_diff_ukey', 16 => 'array_fill', 17 => 'array_fill_keys', 18 => 'array_filter', 19 => 'array_flip', 20 => 'array_intersect', 21 => 'array_intersect_assoc', 22 => 'array_intersect_key', 23 => 'array_intersect_uassoc', 24 => 'array_intersect_ukey', 25 => 'array_key_exists', 26 => 'array_keys', 27 => 'array_map', 28 => 'array_merge', 29 => 'array_merge_recursive', 30 => 'array_multisort', 31 => 'array_pad', 32 => 'array_pop', 33 => 'array_product', 34 => 'array_push', 35 => 'array_rand', 36 => 'array_reduce', 37 => 'array_replace', 38 => 'array_replace_recursive', 39 => 'array_reverse', 40 => 'array_search', 41 => 'array_shift', 42 => 'array_slice', 43 => 'array_splice', 44 => 'array_sum', 45 => 'array_udiff', 46 => 'array_udiff_assoc', 47 => 'array_udiff_uassoc', 48 => 'array_uintersect', 49 => 'array_uintersect_assoc', 50 => 'array_uintersect_uassoc', 51 => 'array_unique', 52 => 'array_unshift', 53 => 'array_values', 54 => 'array_walk', 55 => 'array_walk_recursive', 56 => 'arsort', 57 => 'asin', 58 => 'asinh', 59 => 'asort', 60 => 'atan', 61 => 'atan2', 62 => 'atanh', 63 => 'base64_decode', 64 => 'base64_encode', 65 => 'base_convert', 66 => 'bin2hex', 67 => 'bindec', 68 => 'boolval', 69 => 'cal_days_in_month', 70 => 'cal_from_jd', 71 => 'cal_info', 72 => 'cal_to_jd', 73 => 'ceil', 74 => 'checkdate', 75 => 'chop', 76 => 'chr', 77 => 'chunk_split', 78 => 'compact', 79 => 'constant', 80 => 'convert_cyr_string', 81 => 'convert_uudecode', 82 => 'convert_uuencode', 83 => 'cos', 84 => 'cosh', 85 => 'count', 86 => 'count_chars', 87 => 'crypt', 88 => 'ctype_alnum', 89 => 'ctype_alpha', 90 => 'ctype_cntrl', 91 => 'ctype_digit', 92 => 'ctype_graph', 93 => 'ctype_lower', 94 => 'ctype_print', 95 => 'ctype_punct', 96 => 'ctype_space', 97 => 'ctype_upper', 98 => 'ctype_xdigit', 99 => 'current', 100 => 'date', 101 => 'date_add', 102 => 'date_create', 103 => 'date_create_from_format', 104 => 'date_create_immutable', 105 => 'date_create_immutable_from_format', 106 => 'date_date_set', 107 => 'date_default_timezone_get', 108 => 'date_diff', 109 => 'date_format', 110 => 'date_get_last_errors', 111 => 'date_interval_create_from_date_string', 112 => 'date_interval_format', 113 => 'date_modify', 114 => 'date_offset_get', 115 => 'date_parse', 116 => 'date_parse_from_format', 117 => 'date_sub', 118 => 'date_sun_info', 119 => 'date_sunrise', 120 => 'date_sunset', 121 => 'date_timestamp_get', 122 => 'date_timezone_get', 123 => 'decbin', 124 => 'dechex', 125 => 'decoct', 126 => 'deg2rad', 127 => 'doubleval', 128 => 'each', 129 => 'easter_date', 130 => 'easter_days', 131 => 'end', 132 => 'exp', 133 => 'explode', 134 => 'expm1', 135 => 'empty', 136 => 'filter_has_var', 137 => 'filter_id', 138 => 'filter_input', 139 => 'filter_input_array', 140 => 'filter_list', 141 => 'filter_var', 142 => 'filter_var_array', 143 => 'floatval', 144 => 'floor', 145 => 'fmod', 146 => 'frenchtojd', 147 => 'get_browser', 148 => 'getdate', 149 => 'getrandmax', 150 => 'gettimeofday', 151 => 'gettype', 152 => 'gmdate', 153 => 'gmmktime', 154 => 'gmstrftime', 155 => 'gregoriantojd', 156 => 'hex2bin', 157 => 'hexdec', 158 => 'html_entity_decode', 159 => 'htmlentities', 160 => 'htmlspecialchars', 161 => 'htmlspecialchars_decode', 162 => 'hypot', 163 => 'iconv', 164 => 'iconv_get_encoding', 165 => 'iconv_mime_decode', 166 => 'iconv_mime_decode_headers', 167 => 'iconv_mime_encode', 168 => 'iconv_set_encoding', 169 => 'iconv_strlen', 170 => 'iconv_strpos', 171 => 'iconv_strrpos', 172 => 'iconv_substr', 173 => 'idate', 174 => 'implode', 175 => 'in_array', 176 => 'intdiv', 177 => 'intval', 178 => 'ip2long', 179 => 'is_array', 180 => 'is_a', 181 => 'isset', 182 => 'is_bool', 183 => 'is_double', 184 => 'is_finite', 185 => 'is_float', 186 => 'is_infinite', 187 => 'is_int', 188 => 'is_integer', 189 => 'is_iterable', 190 => 'is_long', 191 => 'is_nan', 192 => 'is_null', 193 => 'is_numeric', 194 => 'is_object', 195 => 'is_string', 196 => 'iterator_apply', 197 => 'iterator_count', 198 => 'iterator_to_array', 199 => 'jddayofweek', 200 => 'jdmonthname', 201 => 'jdtofrench', 202 => 'jdtogregorian', 203 => 'jdtojewish', 204 => 'jdtojulian', 205 => 'jdtounix', 206 => 'jewishtojd', 207 => 'join', 208 => 'json_decode', 209 => 'json_encode', 210 => 'json_last_error', 211 => 'json_last_error_msg', 212 => 'juliantojd', 213 => 'key', 214 => 'key_exists', 215 => 'ksort', 216 => 'lcfirst', 217 => 'levenshtein', 218 => 'localtime', 219 => 'log', 220 => 'log10', 221 => 'log1p', 222 => 'long2ip', 223 => 'ltrim', 224 => 'max', 225 => 'md5', 226 => 'mhash', 227 => 'mhash_count', 228 => 'mhash_get_block_size', 229 => 'mhash_get_hash_name', 230 => 'mhash_keygen_s2k', 231 => 'microtime', 232 => 'min', 233 => 'mktime', 234 => 'money_format', 235 => 'mt_getrandmax', 236 => 'mt_rand', 237 => 'mt_srand', 238 => 'natcasesort', 239 => 'natsort', 240 => 'next', 241 => 'nl2br', 242 => 'number_format', 243 => 'octdec', 244 => 'ord', 245 => 'parse_str', 246 => 'parse_url', 247 => 'php_strip_whitespace', 248 => 'pi', 249 => 'pos', 250 => 'pow', 251 => 'prev', 252 => 'printf', 253 => 'print_r', 254 => 'rad2deg', 255 => 'rand', 256 => 'random_bytes', 257 => 'random_int', 258 => 'range', 259 => 'rawurldecode', 260 => 'rawurlencode', 261 => 'reset', 262 => 'round', 263 => 'rsort', 264 => 'rtrim', 265 => 'serialize', 266 => 'sha1', 267 => 'shuffle', 268 => 'similar_text', 269 => 'sin', 270 => 'sinh', 271 => 'sizeof', 272 => 'sort', 273 => 'soundex', 274 => 'sprintf', 275 => 'sqrt', 276 => 'srand', 277 => 'str_ireplace', 278 => 'str_pad', 279 => 'str_repeat', 280 => 'str_replace', 281 => 'str_rot13', 282 => 'str_shuffle', 283 => 'str_split', 284 => 'str_word_count', 285 => 'strcasecmp', 286 => 'strchr', 287 => 'strcmp', 288 => 'strcoll', 289 => 'strcspn', 290 => 'strftime', 291 => 'strip_tags', 292 => 'stripcslashes', 293 => 'stripos', 294 => 'stripslashes', 295 => 'stristr', 296 => 'strlen', 297 => 'strnatcasecmp', 298 => 'strnatcmp', 299 => 'strncasecmp', 300 => 'strncmp', 301 => 'strpbrk', 302 => 'strpos', 303 => 'strptime', 304 => 'strrchr', 305 => 'strrev', 306 => 'strripos', 307 => 'strrpos', 308 => 'strspn', 309 => 'strstr', 310 => 'strtok', 311 => 'strtolower', 312 => 'strtotime', 313 => 'strtoupper', 314 => 'strtr', 315 => 'strval', 316 => 'substr', 317 => 'substr_compare', 318 => 'substr_count', 319 => 'substr_replace', 320 => 'tan', 321 => 'tanh', 322 => 'time', 323 => 'trim', 324 => 'uasort', 325 => 'ucfirst', 326 => 'ucwords', 327 => 'uksort', 328 => 'uniqid', 329 => 'unixtojd', 330 => 'unserialize', 331 => 'urldecode', 332 => 'urlencode', 333 => 'usort', 334 => 'utf8_decode', 335 => 'utf8_encode', 336 => 'var_dump', 337 => 'version_compare', 338 => 'wordwrap'), 'php_functions' => array(0 => 'abs', 1 => 'acos', 2 => 'acosh', 3 => 'addcslashes', 4 => 'addslashes', 5 => 'array', 6 => 'array_change_key_case', 7 => 'array_chunk', 8 => 'array_column', 9 => 'array_combine', 10 => 'array_count_values', 11 => 'array_diff', 12 => 'array_diff_assoc', 13 => 'array_diff_key', 14 => 'array_diff_uassoc', 15 => 'array_diff_ukey', 16 => 'array_fill', 17 => 'array_fill_keys', 18 => 'array_filter', 19 => 'array_flip', 20 => 'array_intersect', 21 => 'array_intersect_assoc', 22 => 'array_intersect_key', 23 => 'array_intersect_uassoc', 24 => 'array_intersect_ukey', 25 => 'array_key_exists', 26 => 'array_keys', 27 => 'array_map', 28 => 'array_merge', 29 => 'array_merge_recursive', 30 => 'array_multisort', 31 => 'array_pad', 32 => 'array_pop', 33 => 'array_product', 34 => 'array_push', 35 => 'array_rand', 36 => 'array_reduce', 37 => 'array_replace', 38 => 'array_replace_recursive', 39 => 'array_reverse', 40 => 'array_search', 41 => 'array_shift', 42 => 'array_slice', 43 => 'array_splice', 44 => 'array_sum', 45 => 'array_udiff', 46 => 'array_udiff_assoc', 47 => 'array_udiff_uassoc', 48 => 'array_uintersect', 49 => 'array_uintersect_assoc', 50 => 'array_uintersect_uassoc', 51 => 'array_unique', 52 => 'array_unshift', 53 => 'array_values', 54 => 'array_walk', 55 => 'array_walk_recursive', 56 => 'arsort', 57 => 'asin', 58 => 'asinh', 59 => 'asort', 60 => 'atan', 61 => 'atan2', 62 => 'atanh', 63 => 'base64_decode', 64 => 'base64_encode', 65 => 'base_convert', 66 => 'bin2hex', 67 => 'bindec', 68 => 'boolval', 69 => 'cal_days_in_month', 70 => 'cal_from_jd', 71 => 'cal_info', 72 => 'cal_to_jd', 73 => 'ceil', 74 => 'checkdate', 75 => 'chop', 76 => 'chr', 77 => 'chunk_split', 78 => 'compact', 79 => 'constant', 80 => 'convert_cyr_string', 81 => 'convert_uudecode', 82 => 'convert_uuencode', 83 => 'cos', 84 => 'cosh', 85 => 'count', 86 => 'count_chars', 87 => 'crypt', 88 => 'ctype_alnum', 89 => 'ctype_alpha', 90 => 'ctype_cntrl', 91 => 'ctype_digit', 92 => 'ctype_graph', 93 => 'ctype_lower', 94 => 'ctype_print', 95 => 'ctype_punct', 96 => 'ctype_space', 97 => 'ctype_upper', 98 => 'ctype_xdigit', 99 => 'current', 100 => 'date', 101 => 'date_add', 102 => 'date_create', 103 => 'date_create_from_format', 104 => 'date_create_immutable', 105 => 'date_create_immutable_from_format', 106 => 'date_date_set', 107 => 'date_default_timezone_get', 108 => 'date_diff', 109 => 'date_format', 110 => 'date_get_last_errors', 111 => 'date_interval_create_from_date_string', 112 => 'date_interval_format', 113 => 'date_modify', 114 => 'date_offset_get', 115 => 'date_parse', 116 => 'date_parse_from_format', 117 => 'date_sub', 118 => 'date_sun_info', 119 => 'date_sunrise', 120 => 'date_sunset', 121 => 'date_timestamp_get', 122 => 'date_timezone_get', 123 => 'decbin', 124 => 'dechex', 125 => 'decoct', 126 => 'deg2rad', 127 => 'doubleval', 128 => 'each', 129 => 'easter_date', 130 => 'easter_days', 131 => 'end', 132 => 'exp', 133 => 'explode', 134 => 'expm1', 135 => 'empty', 136 => 'filter_has_var', 137 => 'filter_id', 138 => 'filter_input', 139 => 'filter_input_array', 140 => 'filter_list', 141 => 'filter_var', 142 => 'filter_var_array', 143 => 'floatval', 144 => 'floor', 145 => 'fmod', 146 => 'frenchtojd', 147 => 'get_browser', 148 => 'getdate', 149 => 'getrandmax', 150 => 'gettimeofday', 151 => 'gettype', 152 => 'gmdate', 153 => 'gmmktime', 154 => 'gmstrftime', 155 => 'gregoriantojd', 156 => 'hex2bin', 157 => 'hexdec', 158 => 'html_entity_decode', 159 => 'htmlentities', 160 => 'htmlspecialchars', 161 => 'htmlspecialchars_decode', 162 => 'hypot', 163 => 'iconv', 164 => 'iconv_get_encoding', 165 => 'iconv_mime_decode', 166 => 'iconv_mime_decode_headers', 167 => 'iconv_mime_encode', 168 => 'iconv_set_encoding', 169 => 'iconv_strlen', 170 => 'iconv_strpos', 171 => 'iconv_strrpos', 172 => 'iconv_substr', 173 => 'idate', 174 => 'implode', 175 => 'in_array', 176 => 'intdiv', 177 => 'intval', 178 => 'ip2long', 179 => 'is_array', 180 => 'is_a', 181 => 'isset', 182 => 'is_bool', 183 => 'is_double', 184 => 'is_finite', 185 => 'is_float', 186 => 'is_infinite', 187 => 'is_int', 188 => 'is_integer', 189 => 'is_iterable', 190 => 'is_long', 191 => 'is_nan', 192 => 'is_null', 193 => 'is_numeric', 194 => 'is_object', 195 => 'is_string', 196 => 'iterator_apply', 197 => 'iterator_count', 198 => 'iterator_to_array', 199 => 'jddayofweek', 200 => 'jdmonthname', 201 => 'jdtofrench', 202 => 'jdtogregorian', 203 => 'jdtojewish', 204 => 'jdtojulian', 205 => 'jdtounix', 206 => 'jewishtojd', 207 => 'join', 208 => 'json_decode', 209 => 'json_encode', 210 => 'json_last_error', 211 => 'json_last_error_msg', 212 => 'juliantojd', 213 => 'key', 214 => 'key_exists', 215 => 'ksort', 216 => 'lcfirst', 217 => 'levenshtein', 218 => 'localtime', 219 => 'log', 220 => 'log10', 221 => 'log1p', 222 => 'long2ip', 223 => 'ltrim', 224 => 'max', 225 => 'md5', 226 => 'mhash', 227 => 'mhash_count', 228 => 'mhash_get_block_size', 229 => 'mhash_get_hash_name', 230 => 'mhash_keygen_s2k', 231 => 'microtime', 232 => 'min', 233 => 'mktime', 234 => 'money_format', 235 => 'mt_getrandmax', 236 => 'mt_rand', 237 => 'mt_srand', 238 => 'natcasesort', 239 => 'natsort', 240 => 'next', 241 => 'nl2br', 242 => 'number_format', 243 => 'octdec', 244 => 'ord', 245 => 'parse_str', 246 => 'parse_url', 247 => 'php_strip_whitespace', 248 => 'pi', 249 => 'pos', 250 => 'pow', 251 => 'prev', 252 => 'printf', 253 => 'print_r', 254 => 'rad2deg', 255 => 'rand', 256 => 'random_bytes', 257 => 'random_int', 258 => 'range', 259 => 'rawurldecode', 260 => 'rawurlencode', 261 => 'reset', 262 => 'round', 263 => 'rsort', 264 => 'rtrim', 265 => 'serialize', 266 => 'sha1', 267 => 'shuffle', 268 => 'similar_text', 269 => 'sin', 270 => 'sinh', 271 => 'sizeof', 272 => 'sort', 273 => 'soundex', 274 => 'sprintf', 275 => 'sqrt', 276 => 'srand', 277 => 'str_ireplace', 278 => 'str_pad', 279 => 'str_repeat', 280 => 'str_replace', 281 => 'str_rot13', 282 => 'str_shuffle', 283 => 'str_split', 284 => 'str_word_count', 285 => 'strcasecmp', 286 => 'strchr', 287 => 'strcmp', 288 => 'strcoll', 289 => 'strcspn', 290 => 'strftime', 291 => 'strip_tags', 292 => 'stripcslashes', 293 => 'stripos', 294 => 'stripslashes', 295 => 'stristr', 296 => 'strlen', 297 => 'strnatcasecmp', 298 => 'strnatcmp', 299 => 'strncasecmp', 300 => 'strncmp', 301 => 'strpbrk', 302 => 'strpos', 303 => 'strptime', 304 => 'strrchr', 305 => 'strrev', 306 => 'strripos', 307 => 'strrpos', 308 => 'strspn', 309 => 'strstr', 310 => 'strtok', 311 => 'strtolower', 312 => 'strtotime', 313 => 'strtoupper', 314 => 'strtr', 315 => 'strval', 316 => 'substr', 317 => 'substr_compare', 318 => 'substr_count', 319 => 'substr_replace', 320 => 'tan', 321 => 'tanh', 322 => 'time', 323 => 'trim', 324 => 'uasort', 325 => 'ucfirst', 326 => 'ucwords', 327 => 'uksort', 328 => 'uniqid', 329 => 'unixtojd', 330 => 'unserialize', 331 => 'urldecode', 332 => 'urlencode', 333 => 'usort', 334 => 'utf8_decode', 335 => 'utf8_encode', 336 => 'var_dump', 337 => 'version_compare', 338 => 'wordwrap')));
    }
    protected function getTemplateFactoryService()
    {
        return $this->services['template_factory'] = new \Shopware\Components\DependencyInjection\Bridge\Template();
    }
    protected function getTemplatemailService()
    {
        return $this->services['templatemail'] = $this->get('templatemail_factory')->factory($this);
    }
    protected function getTemplatemailFactoryService()
    {
        return $this->services['templatemail_factory'] = new \Shopware\Components\DependencyInjection\Bridge\TemplateMail();
    }
    protected function getThemeBackendRegistrationService()
    {
        return $this->services['theme_backend_registration'] = new \Shopware\Components\Theme\EventListener\BackendTheme($this);
    }
    protected function getThemeCompilerService()
    {
        return $this->services['theme_compiler'] = new \Shopware\Components\Theme\Compiler('/var/www/shopware', $this->get('oyejorge_compiler'), $this->get('theme_path_resolver'), $this->get('theme_inheritance'), $this->get('theme_service'), $this->get('js_compressor'), $this->get('events'), $this->get('theme_timestamp_persistor'));
    }
    protected function getThemeConfigLoaderService()
    {
        return $this->services['theme_config_loader'] = new \Shopware\Components\Theme\EventListener\ConfigLoader($this);
    }
    protected function getThemeConfigPersisterService()
    {
        return $this->services['theme_config_persister'] = new \Shopware\Components\Form\Persister\Theme($this->get('models'));
    }
    protected function getThemeConfiguratorService()
    {
        return $this->services['theme_configurator'] = new \Shopware\Components\Theme\Configurator($this->get('models'), $this->get('theme_util'), $this->get('theme_config_persister'), $this->get('events'));
    }
    protected function getThemeGeneratorService()
    {
        return $this->services['theme_generator'] = new \Shopware\Components\Theme\Generator($this->get('theme_path_resolver'), $this->get('file_system'), $this->get('events'));
    }
    protected function getThemeInheritanceService()
    {
        return $this->services['theme_inheritance'] = new \Shopware\Components\Theme\Inheritance($this->get('models'), $this->get('theme_util'), $this->get('theme_path_resolver'), $this->get('events'), $this->get('shopware_media.media_service'));
    }
    protected function getThemeInstallerService()
    {
        return $this->services['theme_installer'] = new \Shopware\Components\Theme\Installer($this->get('models'), $this->get('theme_configurator'), $this->get('theme_path_resolver'), $this->get('theme_util'), $this->get('shopware.snippet_database_handler'), $this->get('theme_service'), array('readFromDb' => true, 'writeToDb' => true, 'readFromIni' => false, 'writeToIni' => false, 'showSnippetPlaceholder' => false));
    }
    protected function getThemePathResolverService()
    {
        return $this->services['theme_path_resolver'] = new \Shopware\Components\Theme\PathResolver('/var/www/shopware', array('Default' => '/var/www/shopware/engine/Shopware/Plugins/Default/', 'Local' => '/var/www/shopware/engine/Shopware/Plugins/Local/', 'Community' => '/var/www/shopware/engine/Shopware/Plugins/Community/', 'ShopwarePlugins' => '/var/www/shopware/custom/plugins/'), $this->get('template'));
    }
    protected function getThemeServiceService()
    {
        return $this->services['theme_service'] = new \Shopware\Components\Theme\Service($this->get('models'), $this->get('snippets'), $this->get('theme_util'), $this->get('shopware_media.media_service'));
    }
    protected function getThemeTimestampPersistorService()
    {
        return $this->services['theme_timestamp_persistor'] = new \Shopware\Components\Theme\DBALTimestampPersistor($this->get('dbal_connection'));
    }
    protected function getThemeUtilService()
    {
        return $this->services['theme_util'] = new \Shopware\Components\Theme\Util($this->get('models'), $this->get('theme_path_resolver'));
    }
    protected function getThumbnailGeneratorBasicService()
    {
        return $this->services['thumbnail_generator_basic'] = new \Shopware\Components\Thumbnail\Generator\Basic($this->get('config'), $this->get('shopware_media.media_service'), $this->get('shopware_media.optimizer_service'));
    }
    protected function getThumbnailManagerService()
    {
        return $this->services['thumbnail_manager'] = new \Shopware\Components\Thumbnail\Manager($this->get('thumbnail_generator_basic'), '/var/www/shopware', $this->get('events'), $this->get('shopware_media.media_service'));
    }
    protected function getTranslationService()
    {
        return $this->services['translation'] = new \Shopware_Components_Translation($this->get('dbal_connection'));
    }
    protected function getValidatorService()
    {
        return $this->services['validator'] = \Shopware\Components\DependencyInjection\Bridge\Validator::create($this->get('modelconfig'), new \Shopware\Bundle\FormBundle\DependencyInjection\Factory\ConstraintValidatorFactory($this, array('shopware.form.constraint.exists' => 'shopware.form.constraint.exists', 'shopware.form.constraint.unique' => 'shopware.form.constraint.unique', 'CurrentPasswordValidator' => 'shopware_account.constraint.current_password_validator', 'PasswordValidator' => 'shopware_account.constraint.password_validator', 'FormEmailValidator' => 'shopware_account.constraint.form_email_validator', 'CustomerEmailValidator' => 'shopware_account.constraint.customer_email_validator')));
    }
    protected function getValidator_EmailService()
    {
        return $this->services['validator.email'] = new \Shopware\Components\Validator\EmailValidator();
    }
    protected function getModelEventManagerService()
    {
        $this->services['model_event_manager'] = $instance = new \Doctrine\Common\EventManager();
        $instance->addEventSubscriber(new \Shopware\Components\Model\EventSubscriber($this->get('events')));
        $instance->addEventSubscriber(new \Shopware\Models\Order\OrderHistorySubscriber());
        $instance->addEventSubscriber($this->get('categorysubscriber'));
        $instance->addEventSubscriber(new \Shopware\Models\Media\MediaSubscriber($this));
        $instance->addEventSubscriber($this->get('shopware_elastic_search.orm_backlog_subscriber'));
        return $instance;
    }
    protected function getMonolog_Processor_UidService()
    {
        return $this->services['monolog.processor.uid'] = new \Monolog\Processor\UidProcessor();
    }
    protected function getShopwareElasticSearch_OrmBacklogSubscriberService()
    {
        return $this->services['shopware_elastic_search.orm_backlog_subscriber'] = new \Shopware\Bundle\ESIndexingBundle\Subscriber\ORMBacklogSubscriber($this);
    }
    public function getParameter($name)
    {
        $name = strtolower($name);
        if (!(isset($this->parameters[$name]) || array_key_exists($name, $this->parameters))) {
            throw new InvalidArgumentException(sprintf('The parameter "%s" must be defined.', $name));
        }
        return $this->parameters[$name];
    }
    public function hasParameter($name)
    {
        $name = strtolower($name);
        return isset($this->parameters[$name]) || array_key_exists($name, $this->parameters);
    }
    public function setParameter($name, $value)
    {
        throw new LogicException('Impossible to call set() on a frozen ParameterBag.');
    }
    public function getParameterBag()
    {
        if (null === $this->parameterBag) {
            $this->parameterBag = new FrozenParameterBag($this->parameters);
        }
        return $this->parameterBag;
    }
    protected function getDefaultParameters()
    {
        return array(
            'kernel.root_dir' => '/var/www/shopware',
            'kernel.environment' => 'production',
            'kernel.debug' => false,
            'kernel.name' => 'Shopware',
            'kernel.cache_dir' => '/var/www/shopware/var/cache/production_201710241020',
            'kernel.logs_dir' => '/var/www/shopware/var/log',
            'kernel.charset' => 'UTF-8',
            'kernel.container_class' => 'ShopwareProductionda39a3ee5e6b4b0d3255bfef95601890afd80709ProjectContainer',
            'shopware.slug.config' => array(
                'regexp' => '/([^A-Za-z0-9\\.]|-)+/',
                'lowercase' => false,
            ),
            'monolog.logger.constant.critical' => 500,
            'monolog.logger.constant.error' => 400,
            'monolog.logger.constant.info' => 200,
            'shopware.custom' => array(
            ),
            'shopware.trustedproxies' => array(
            ),
            'shopware.cdn' => array(
                'backend' => 'local',
                'strategy' => 'md5',
                'liveMigration' => false,
                'adapters' => array(
                    'local' => array(
                        'type' => 'local',
                        'mediaUrl' => '',
                        'permissions' => array(
                            'file' => array(
                                'public' => 420,
                                'private' => 384,
                            ),
                            'dir' => array(
                                'public' => 493,
                                'private' => 448,
                            ),
                        ),
                        'path' => '/var/www/shopware',
                    ),
                    'ftp' => array(
                        'type' => 'ftp',
                        'mediaUrl' => '',
                        'host' => '',
                        'username' => '',
                        'password' => '',
                        'port' => 21,
                        'root' => '/',
                        'passive' => true,
                        'ssl' => false,
                        'timeout' => 30,
                    ),
                ),
            ),
            'shopware.cdn.backend' => 'local',
            'shopware.cdn.strategy' => 'md5',
            'shopware.cdn.livemigration' => false,
            'shopware.cdn.adapters' => array(
                'local' => array(
                    'type' => 'local',
                    'mediaUrl' => '',
                    'permissions' => array(
                        'file' => array(
                            'public' => 420,
                            'private' => 384,
                        ),
                        'dir' => array(
                            'public' => 493,
                            'private' => 448,
                        ),
                    ),
                    'path' => '/var/www/shopware',
                ),
                'ftp' => array(
                    'type' => 'ftp',
                    'mediaUrl' => '',
                    'host' => '',
                    'username' => '',
                    'password' => '',
                    'port' => 21,
                    'root' => '/',
                    'passive' => true,
                    'ssl' => false,
                    'timeout' => 30,
                ),
            ),
            'shopware.cdn.adapters.local' => array(
                'type' => 'local',
                'mediaUrl' => '',
                'permissions' => array(
                    'file' => array(
                        'public' => 420,
                        'private' => 384,
                    ),
                    'dir' => array(
                        'public' => 493,
                        'private' => 448,
                    ),
                ),
                'path' => '/var/www/shopware',
            ),
            'shopware.cdn.adapters.local.type' => 'local',
            'shopware.cdn.adapters.local.mediaurl' => '',
            'shopware.cdn.adapters.local.permissions' => array(
                'file' => array(
                    'public' => 420,
                    'private' => 384,
                ),
                'dir' => array(
                    'public' => 493,
                    'private' => 448,
                ),
            ),
            'shopware.cdn.adapters.local.permissions.file' => array(
                'public' => 420,
                'private' => 384,
            ),
            'shopware.cdn.adapters.local.permissions.file.public' => 420,
            'shopware.cdn.adapters.local.permissions.file.private' => 384,
            'shopware.cdn.adapters.local.permissions.dir' => array(
                'public' => 493,
                'private' => 448,
            ),
            'shopware.cdn.adapters.local.permissions.dir.public' => 493,
            'shopware.cdn.adapters.local.permissions.dir.private' => 448,
            'shopware.cdn.adapters.local.path' => '/var/www/shopware',
            'shopware.cdn.adapters.ftp' => array(
                'type' => 'ftp',
                'mediaUrl' => '',
                'host' => '',
                'username' => '',
                'password' => '',
                'port' => 21,
                'root' => '/',
                'passive' => true,
                'ssl' => false,
                'timeout' => 30,
            ),
            'shopware.cdn.adapters.ftp.type' => 'ftp',
            'shopware.cdn.adapters.ftp.mediaurl' => '',
            'shopware.cdn.adapters.ftp.host' => '',
            'shopware.cdn.adapters.ftp.username' => '',
            'shopware.cdn.adapters.ftp.password' => '',
            'shopware.cdn.adapters.ftp.port' => 21,
            'shopware.cdn.adapters.ftp.root' => '/',
            'shopware.cdn.adapters.ftp.passive' => true,
            'shopware.cdn.adapters.ftp.ssl' => false,
            'shopware.cdn.adapters.ftp.timeout' => 30,
            'shopware.csrfprotection' => array(
                'frontend' => true,
                'backend' => true,
            ),
            'shopware.csrfprotection.frontend' => true,
            'shopware.csrfprotection.backend' => true,
            'shopware.snippet' => array(
                'readFromDb' => true,
                'writeToDb' => true,
                'readFromIni' => false,
                'writeToIni' => false,
                'showSnippetPlaceholder' => false,
            ),
            'shopware.snippet.readfromdb' => true,
            'shopware.snippet.writetodb' => true,
            'shopware.snippet.readfromini' => false,
            'shopware.snippet.writetoini' => false,
            'shopware.snippet.showsnippetplaceholder' => false,
            'shopware.errorhandler' => array(
                'throwOnRecoverableError' => false,
            ),
            'shopware.errorhandler.throwonrecoverableerror' => false,
            'shopware.db' => array(
                'username' => 'docker',
                'password' => 'docker',
                'dbname' => 'shopware',
                'host' => 'localhost',
                'charset' => 'utf8mb4',
                'adapter' => 'pdo_mysql',
                'port' => '3306',
            ),
            'shopware.db.username' => 'docker',
            'shopware.db.password' => 'docker',
            'shopware.db.dbname' => 'shopware',
            'shopware.db.host' => 'localhost',
            'shopware.db.charset' => 'utf8mb4',
            'shopware.db.adapter' => 'pdo_mysql',
            'shopware.db.port' => '3306',
            'shopware.es' => array(
                'prefix' => 'sw_shop',
                'enabled' => false,
                'write_backlog' => true,
                'number_of_replicas' => NULL,
                'number_of_shards' => NULL,
                'wait_for_status' => 'green',
                'client' => array(
                    'hosts' => array(
                        0 => 'localhost:9200',
                    ),
                ),
            ),
            'shopware.es.prefix' => 'sw_shop',
            'shopware.es.enabled' => false,
            'shopware.es.write_backlog' => true,
            'shopware.es.number_of_replicas' => NULL,
            'shopware.es.number_of_shards' => NULL,
            'shopware.es.wait_for_status' => 'green',
            'shopware.es.client' => array(
                'hosts' => array(
                    0 => 'localhost:9200',
                ),
            ),
            'shopware.es.client.hosts' => array(
                0 => 'localhost:9200',
            ),
            'shopware.es.client.hosts.0' => 'localhost:9200',
            'shopware.front' => array(
                'noErrorHandler' => false,
                'throwExceptions' => false,
                'disableOutputBuffering' => false,
                'showException' => false,
                'charset' => 'utf-8',
            ),
            'shopware.front.noerrorhandler' => false,
            'shopware.front.throwexceptions' => false,
            'shopware.front.disableoutputbuffering' => false,
            'shopware.front.showexception' => false,
            'shopware.front.charset' => 'utf-8',
            'shopware.config' => array(
            ),
            'shopware.store' => array(
                'apiEndpoint' => 'https://api.shopware.com',
            ),
            'shopware.store.apiendpoint' => 'https://api.shopware.com',
            'shopware.plugin_directories' => array(
                'Default' => '/var/www/shopware/engine/Shopware/Plugins/Default/',
                'Local' => '/var/www/shopware/engine/Shopware/Plugins/Local/',
                'Community' => '/var/www/shopware/engine/Shopware/Plugins/Community/',
                'ShopwarePlugins' => '/var/www/shopware/custom/plugins/',
            ),
            'shopware.plugin_directories.default' => '/var/www/shopware/engine/Shopware/Plugins/Default/',
            'shopware.plugin_directories.local' => '/var/www/shopware/engine/Shopware/Plugins/Local/',
            'shopware.plugin_directories.community' => '/var/www/shopware/engine/Shopware/Plugins/Community/',
            'shopware.plugin_directories.shopwareplugins' => '/var/www/shopware/custom/plugins/',
            'shopware.template' => array(
                'compileCheck' => true,
                'compileLocking' => true,
                'useSubDirs' => true,
                'forceCompile' => false,
                'useIncludePath' => true,
                'charset' => 'utf-8',
                'forceCache' => false,
                'cacheDir' => '/var/www/shopware/var/cache/production_201710241020/templates',
                'compileDir' => '/var/www/shopware/var/cache/production_201710241020/templates',
            ),
            'shopware.template.compilecheck' => true,
            'shopware.template.compilelocking' => true,
            'shopware.template.usesubdirs' => true,
            'shopware.template.forcecompile' => false,
            'shopware.template.useincludepath' => true,
            'shopware.template.charset' => 'utf-8',
            'shopware.template.forcecache' => false,
            'shopware.template.cachedir' => '/var/www/shopware/var/cache/production_201710241020/templates',
            'shopware.template.compiledir' => '/var/www/shopware/var/cache/production_201710241020/templates',
            'shopware.mail' => array(
                'charset' => 'utf-8',
            ),
            'shopware.mail.charset' => 'utf-8',
            'shopware.httpcache' => array(
                'enabled' => true,
                'lookup_optimization' => true,
                'debug' => false,
                'default_ttl' => 0,
                'private_headers' => array(
                    0 => 'Authorization',
                    1 => 'Cookie',
                ),
                'allow_reload' => false,
                'allow_revalidate' => false,
                'stale_while_revalidate' => 2,
                'stale_if_error' => false,
                'cache_dir' => '/var/www/shopware/var/cache/production_201710241020/html',
                'cache_cookies' => array(
                    0 => 'shop',
                    1 => 'currency',
                    2 => 'x-cache-context-hash',
                ),
            ),
            'shopware.httpcache.enabled' => true,
            'shopware.httpcache.lookup_optimization' => true,
            'shopware.httpcache.debug' => false,
            'shopware.httpcache.default_ttl' => 0,
            'shopware.httpcache.private_headers' => array(
                0 => 'Authorization',
                1 => 'Cookie',
            ),
            'shopware.httpcache.private_headers.0' => 'Authorization',
            'shopware.httpcache.private_headers.1' => 'Cookie',
            'shopware.httpcache.allow_reload' => false,
            'shopware.httpcache.allow_revalidate' => false,
            'shopware.httpcache.stale_while_revalidate' => 2,
            'shopware.httpcache.stale_if_error' => false,
            'shopware.httpcache.cache_dir' => '/var/www/shopware/var/cache/production_201710241020/html',
            'shopware.httpcache.cache_cookies' => array(
                0 => 'shop',
                1 => 'currency',
                2 => 'x-cache-context-hash',
            ),
            'shopware.httpcache.cache_cookies.0' => 'shop',
            'shopware.httpcache.cache_cookies.1' => 'currency',
            'shopware.httpcache.cache_cookies.2' => 'x-cache-context-hash',
            'shopware.session' => array(
                'cookie_lifetime' => 0,
                'cookie_httponly' => 1,
                'gc_probability' => 1,
                'gc_divisor' => 200,
                'save_handler' => 'db',
                'use_trans_sid' => 0,
                'locking' => true,
            ),
            'shopware.session.cookie_lifetime' => 0,
            'shopware.session.cookie_httponly' => 1,
            'shopware.session.gc_probability' => 1,
            'shopware.session.gc_divisor' => 200,
            'shopware.session.save_handler' => 'db',
            'shopware.session.use_trans_sid' => 0,
            'shopware.session.locking' => true,
            'shopware.phpsettings' => array(
                'error_reporting' => 16383,
                'display_errors' => 0,
                'date.timezone' => 'Europe/Berlin',
            ),
            'shopware.phpsettings.error_reporting' => 16383,
            'shopware.phpsettings.display_errors' => 0,
            'shopware.phpsettings.date.timezone' => 'Europe/Berlin',
            'shopware.cache' => array(
                'frontendOptions' => array(
                    'automatic_serialization' => true,
                    'automatic_cleaning_factor' => 0,
                    'lifetime' => 3600,
                    'cache_id_prefix' => 'ffa502642a155cd8fcdaeed7a2c5aaaa',
                ),
                'backend' => 'auto',
                'backendOptions' => array(
                    'hashed_directory_perm' => 493,
                    'cache_file_perm' => 420,
                    'hashed_directory_level' => 3,
                    'cache_dir' => '/var/www/shopware/var/cache/production_201710241020/general',
                    'file_name_prefix' => 'shopware',
                ),
            ),
            'shopware.cache.frontendoptions' => array(
                'automatic_serialization' => true,
                'automatic_cleaning_factor' => 0,
                'lifetime' => 3600,
                'cache_id_prefix' => 'ffa502642a155cd8fcdaeed7a2c5aaaa',
            ),
            'shopware.cache.frontendoptions.automatic_serialization' => true,
            'shopware.cache.frontendoptions.automatic_cleaning_factor' => 0,
            'shopware.cache.frontendoptions.lifetime' => 3600,
            'shopware.cache.frontendoptions.cache_id_prefix' => 'ffa502642a155cd8fcdaeed7a2c5aaaa',
            'shopware.cache.backend' => 'auto',
            'shopware.cache.backendoptions' => array(
                'hashed_directory_perm' => 493,
                'cache_file_perm' => 420,
                'hashed_directory_level' => 3,
                'cache_dir' => '/var/www/shopware/var/cache/production_201710241020/general',
                'file_name_prefix' => 'shopware',
            ),
            'shopware.cache.backendoptions.hashed_directory_perm' => 493,
            'shopware.cache.backendoptions.cache_file_perm' => 420,
            'shopware.cache.backendoptions.hashed_directory_level' => 3,
            'shopware.cache.backendoptions.cache_dir' => '/var/www/shopware/var/cache/production_201710241020/general',
            'shopware.cache.backendoptions.file_name_prefix' => 'shopware',
            'shopware.hook' => array(
                'proxyDir' => '/var/www/shopware/var/cache/production_201710241020/proxies',
                'proxyNamespace' => 'Shopware_Proxies',
            ),
            'shopware.hook.proxydir' => '/var/www/shopware/var/cache/production_201710241020/proxies',
            'shopware.hook.proxynamespace' => 'Shopware_Proxies',
            'shopware.model' => array(
                'autoGenerateProxyClasses' => false,
                'attributeDir' => '/var/www/shopware/var/cache/production_201710241020/doctrine/attributes',
                'proxyDir' => '/var/www/shopware/var/cache/production_201710241020/doctrine/proxies',
                'proxyNamespace' => 'Shopware\\Proxies',
                'cacheProvider' => 'auto',
                'cacheNamespace' => NULL,
            ),
            'shopware.model.autogenerateproxyclasses' => false,
            'shopware.model.attributedir' => '/var/www/shopware/var/cache/production_201710241020/doctrine/attributes',
            'shopware.model.proxydir' => '/var/www/shopware/var/cache/production_201710241020/doctrine/proxies',
            'shopware.model.proxynamespace' => 'Shopware\\Proxies',
            'shopware.model.cacheprovider' => 'auto',
            'shopware.model.cachenamespace' => NULL,
            'shopware.backendsession' => array(
                'name' => 'SHOPWAREBACKEND',
                'cookie_lifetime' => 0,
                'cookie_httponly' => 1,
                'use_trans_sid' => 0,
                'locking' => false,
            ),
            'shopware.backendsession.name' => 'SHOPWAREBACKEND',
            'shopware.backendsession.cookie_lifetime' => 0,
            'shopware.backendsession.cookie_httponly' => 1,
            'shopware.backendsession.use_trans_sid' => 0,
            'shopware.backendsession.locking' => false,
            'shopware.template_security' => array(
                'enabled' => true,
                'php_modifiers' => array(
                    0 => 'abs',
                    1 => 'acos',
                    2 => 'acosh',
                    3 => 'addcslashes',
                    4 => 'addslashes',
                    5 => 'array',
                    6 => 'array_change_key_case',
                    7 => 'array_chunk',
                    8 => 'array_column',
                    9 => 'array_combine',
                    10 => 'array_count_values',
                    11 => 'array_diff',
                    12 => 'array_diff_assoc',
                    13 => 'array_diff_key',
                    14 => 'array_diff_uassoc',
                    15 => 'array_diff_ukey',
                    16 => 'array_fill',
                    17 => 'array_fill_keys',
                    18 => 'array_filter',
                    19 => 'array_flip',
                    20 => 'array_intersect',
                    21 => 'array_intersect_assoc',
                    22 => 'array_intersect_key',
                    23 => 'array_intersect_uassoc',
                    24 => 'array_intersect_ukey',
                    25 => 'array_key_exists',
                    26 => 'array_keys',
                    27 => 'array_map',
                    28 => 'array_merge',
                    29 => 'array_merge_recursive',
                    30 => 'array_multisort',
                    31 => 'array_pad',
                    32 => 'array_pop',
                    33 => 'array_product',
                    34 => 'array_push',
                    35 => 'array_rand',
                    36 => 'array_reduce',
                    37 => 'array_replace',
                    38 => 'array_replace_recursive',
                    39 => 'array_reverse',
                    40 => 'array_search',
                    41 => 'array_shift',
                    42 => 'array_slice',
                    43 => 'array_splice',
                    44 => 'array_sum',
                    45 => 'array_udiff',
                    46 => 'array_udiff_assoc',
                    47 => 'array_udiff_uassoc',
                    48 => 'array_uintersect',
                    49 => 'array_uintersect_assoc',
                    50 => 'array_uintersect_uassoc',
                    51 => 'array_unique',
                    52 => 'array_unshift',
                    53 => 'array_values',
                    54 => 'array_walk',
                    55 => 'array_walk_recursive',
                    56 => 'arsort',
                    57 => 'asin',
                    58 => 'asinh',
                    59 => 'asort',
                    60 => 'atan',
                    61 => 'atan2',
                    62 => 'atanh',
                    63 => 'base64_decode',
                    64 => 'base64_encode',
                    65 => 'base_convert',
                    66 => 'bin2hex',
                    67 => 'bindec',
                    68 => 'boolval',
                    69 => 'cal_days_in_month',
                    70 => 'cal_from_jd',
                    71 => 'cal_info',
                    72 => 'cal_to_jd',
                    73 => 'ceil',
                    74 => 'checkdate',
                    75 => 'chop',
                    76 => 'chr',
                    77 => 'chunk_split',
                    78 => 'compact',
                    79 => 'constant',
                    80 => 'convert_cyr_string',
                    81 => 'convert_uudecode',
                    82 => 'convert_uuencode',
                    83 => 'cos',
                    84 => 'cosh',
                    85 => 'count',
                    86 => 'count_chars',
                    87 => 'crypt',
                    88 => 'ctype_alnum',
                    89 => 'ctype_alpha',
                    90 => 'ctype_cntrl',
                    91 => 'ctype_digit',
                    92 => 'ctype_graph',
                    93 => 'ctype_lower',
                    94 => 'ctype_print',
                    95 => 'ctype_punct',
                    96 => 'ctype_space',
                    97 => 'ctype_upper',
                    98 => 'ctype_xdigit',
                    99 => 'current',
                    100 => 'date',
                    101 => 'date_add',
                    102 => 'date_create',
                    103 => 'date_create_from_format',
                    104 => 'date_create_immutable',
                    105 => 'date_create_immutable_from_format',
                    106 => 'date_date_set',
                    107 => 'date_default_timezone_get',
                    108 => 'date_diff',
                    109 => 'date_format',
                    110 => 'date_get_last_errors',
                    111 => 'date_interval_create_from_date_string',
                    112 => 'date_interval_format',
                    113 => 'date_modify',
                    114 => 'date_offset_get',
                    115 => 'date_parse',
                    116 => 'date_parse_from_format',
                    117 => 'date_sub',
                    118 => 'date_sun_info',
                    119 => 'date_sunrise',
                    120 => 'date_sunset',
                    121 => 'date_timestamp_get',
                    122 => 'date_timezone_get',
                    123 => 'decbin',
                    124 => 'dechex',
                    125 => 'decoct',
                    126 => 'deg2rad',
                    127 => 'doubleval',
                    128 => 'each',
                    129 => 'easter_date',
                    130 => 'easter_days',
                    131 => 'end',
                    132 => 'exp',
                    133 => 'explode',
                    134 => 'expm1',
                    135 => 'empty',
                    136 => 'filter_has_var',
                    137 => 'filter_id',
                    138 => 'filter_input',
                    139 => 'filter_input_array',
                    140 => 'filter_list',
                    141 => 'filter_var',
                    142 => 'filter_var_array',
                    143 => 'floatval',
                    144 => 'floor',
                    145 => 'fmod',
                    146 => 'frenchtojd',
                    147 => 'get_browser',
                    148 => 'getdate',
                    149 => 'getrandmax',
                    150 => 'gettimeofday',
                    151 => 'gettype',
                    152 => 'gmdate',
                    153 => 'gmmktime',
                    154 => 'gmstrftime',
                    155 => 'gregoriantojd',
                    156 => 'hex2bin',
                    157 => 'hexdec',
                    158 => 'html_entity_decode',
                    159 => 'htmlentities',
                    160 => 'htmlspecialchars',
                    161 => 'htmlspecialchars_decode',
                    162 => 'hypot',
                    163 => 'iconv',
                    164 => 'iconv_get_encoding',
                    165 => 'iconv_mime_decode',
                    166 => 'iconv_mime_decode_headers',
                    167 => 'iconv_mime_encode',
                    168 => 'iconv_set_encoding',
                    169 => 'iconv_strlen',
                    170 => 'iconv_strpos',
                    171 => 'iconv_strrpos',
                    172 => 'iconv_substr',
                    173 => 'idate',
                    174 => 'implode',
                    175 => 'in_array',
                    176 => 'intdiv',
                    177 => 'intval',
                    178 => 'ip2long',
                    179 => 'is_array',
                    180 => 'is_a',
                    181 => 'isset',
                    182 => 'is_bool',
                    183 => 'is_double',
                    184 => 'is_finite',
                    185 => 'is_float',
                    186 => 'is_infinite',
                    187 => 'is_int',
                    188 => 'is_integer',
                    189 => 'is_iterable',
                    190 => 'is_long',
                    191 => 'is_nan',
                    192 => 'is_null',
                    193 => 'is_numeric',
                    194 => 'is_object',
                    195 => 'is_string',
                    196 => 'iterator_apply',
                    197 => 'iterator_count',
                    198 => 'iterator_to_array',
                    199 => 'jddayofweek',
                    200 => 'jdmonthname',
                    201 => 'jdtofrench',
                    202 => 'jdtogregorian',
                    203 => 'jdtojewish',
                    204 => 'jdtojulian',
                    205 => 'jdtounix',
                    206 => 'jewishtojd',
                    207 => 'join',
                    208 => 'json_decode',
                    209 => 'json_encode',
                    210 => 'json_last_error',
                    211 => 'json_last_error_msg',
                    212 => 'juliantojd',
                    213 => 'key',
                    214 => 'key_exists',
                    215 => 'ksort',
                    216 => 'lcfirst',
                    217 => 'levenshtein',
                    218 => 'localtime',
                    219 => 'log',
                    220 => 'log10',
                    221 => 'log1p',
                    222 => 'long2ip',
                    223 => 'ltrim',
                    224 => 'max',
                    225 => 'md5',
                    226 => 'mhash',
                    227 => 'mhash_count',
                    228 => 'mhash_get_block_size',
                    229 => 'mhash_get_hash_name',
                    230 => 'mhash_keygen_s2k',
                    231 => 'microtime',
                    232 => 'min',
                    233 => 'mktime',
                    234 => 'money_format',
                    235 => 'mt_getrandmax',
                    236 => 'mt_rand',
                    237 => 'mt_srand',
                    238 => 'natcasesort',
                    239 => 'natsort',
                    240 => 'next',
                    241 => 'nl2br',
                    242 => 'number_format',
                    243 => 'octdec',
                    244 => 'ord',
                    245 => 'parse_str',
                    246 => 'parse_url',
                    247 => 'php_strip_whitespace',
                    248 => 'pi',
                    249 => 'pos',
                    250 => 'pow',
                    251 => 'prev',
                    252 => 'printf',
                    253 => 'print_r',
                    254 => 'rad2deg',
                    255 => 'rand',
                    256 => 'random_bytes',
                    257 => 'random_int',
                    258 => 'range',
                    259 => 'rawurldecode',
                    260 => 'rawurlencode',
                    261 => 'reset',
                    262 => 'round',
                    263 => 'rsort',
                    264 => 'rtrim',
                    265 => 'serialize',
                    266 => 'sha1',
                    267 => 'shuffle',
                    268 => 'similar_text',
                    269 => 'sin',
                    270 => 'sinh',
                    271 => 'sizeof',
                    272 => 'sort',
                    273 => 'soundex',
                    274 => 'sprintf',
                    275 => 'sqrt',
                    276 => 'srand',
                    277 => 'str_ireplace',
                    278 => 'str_pad',
                    279 => 'str_repeat',
                    280 => 'str_replace',
                    281 => 'str_rot13',
                    282 => 'str_shuffle',
                    283 => 'str_split',
                    284 => 'str_word_count',
                    285 => 'strcasecmp',
                    286 => 'strchr',
                    287 => 'strcmp',
                    288 => 'strcoll',
                    289 => 'strcspn',
                    290 => 'strftime',
                    291 => 'strip_tags',
                    292 => 'stripcslashes',
                    293 => 'stripos',
                    294 => 'stripslashes',
                    295 => 'stristr',
                    296 => 'strlen',
                    297 => 'strnatcasecmp',
                    298 => 'strnatcmp',
                    299 => 'strncasecmp',
                    300 => 'strncmp',
                    301 => 'strpbrk',
                    302 => 'strpos',
                    303 => 'strptime',
                    304 => 'strrchr',
                    305 => 'strrev',
                    306 => 'strripos',
                    307 => 'strrpos',
                    308 => 'strspn',
                    309 => 'strstr',
                    310 => 'strtok',
                    311 => 'strtolower',
                    312 => 'strtotime',
                    313 => 'strtoupper',
                    314 => 'strtr',
                    315 => 'strval',
                    316 => 'substr',
                    317 => 'substr_compare',
                    318 => 'substr_count',
                    319 => 'substr_replace',
                    320 => 'tan',
                    321 => 'tanh',
                    322 => 'time',
                    323 => 'trim',
                    324 => 'uasort',
                    325 => 'ucfirst',
                    326 => 'ucwords',
                    327 => 'uksort',
                    328 => 'uniqid',
                    329 => 'unixtojd',
                    330 => 'unserialize',
                    331 => 'urldecode',
                    332 => 'urlencode',
                    333 => 'usort',
                    334 => 'utf8_decode',
                    335 => 'utf8_encode',
                    336 => 'var_dump',
                    337 => 'version_compare',
                    338 => 'wordwrap',
                ),
                'php_functions' => array(
                    0 => 'abs',
                    1 => 'acos',
                    2 => 'acosh',
                    3 => 'addcslashes',
                    4 => 'addslashes',
                    5 => 'array',
                    6 => 'array_change_key_case',
                    7 => 'array_chunk',
                    8 => 'array_column',
                    9 => 'array_combine',
                    10 => 'array_count_values',
                    11 => 'array_diff',
                    12 => 'array_diff_assoc',
                    13 => 'array_diff_key',
                    14 => 'array_diff_uassoc',
                    15 => 'array_diff_ukey',
                    16 => 'array_fill',
                    17 => 'array_fill_keys',
                    18 => 'array_filter',
                    19 => 'array_flip',
                    20 => 'array_intersect',
                    21 => 'array_intersect_assoc',
                    22 => 'array_intersect_key',
                    23 => 'array_intersect_uassoc',
                    24 => 'array_intersect_ukey',
                    25 => 'array_key_exists',
                    26 => 'array_keys',
                    27 => 'array_map',
                    28 => 'array_merge',
                    29 => 'array_merge_recursive',
                    30 => 'array_multisort',
                    31 => 'array_pad',
                    32 => 'array_pop',
                    33 => 'array_product',
                    34 => 'array_push',
                    35 => 'array_rand',
                    36 => 'array_reduce',
                    37 => 'array_replace',
                    38 => 'array_replace_recursive',
                    39 => 'array_reverse',
                    40 => 'array_search',
                    41 => 'array_shift',
                    42 => 'array_slice',
                    43 => 'array_splice',
                    44 => 'array_sum',
                    45 => 'array_udiff',
                    46 => 'array_udiff_assoc',
                    47 => 'array_udiff_uassoc',
                    48 => 'array_uintersect',
                    49 => 'array_uintersect_assoc',
                    50 => 'array_uintersect_uassoc',
                    51 => 'array_unique',
                    52 => 'array_unshift',
                    53 => 'array_values',
                    54 => 'array_walk',
                    55 => 'array_walk_recursive',
                    56 => 'arsort',
                    57 => 'asin',
                    58 => 'asinh',
                    59 => 'asort',
                    60 => 'atan',
                    61 => 'atan2',
                    62 => 'atanh',
                    63 => 'base64_decode',
                    64 => 'base64_encode',
                    65 => 'base_convert',
                    66 => 'bin2hex',
                    67 => 'bindec',
                    68 => 'boolval',
                    69 => 'cal_days_in_month',
                    70 => 'cal_from_jd',
                    71 => 'cal_info',
                    72 => 'cal_to_jd',
                    73 => 'ceil',
                    74 => 'checkdate',
                    75 => 'chop',
                    76 => 'chr',
                    77 => 'chunk_split',
                    78 => 'compact',
                    79 => 'constant',
                    80 => 'convert_cyr_string',
                    81 => 'convert_uudecode',
                    82 => 'convert_uuencode',
                    83 => 'cos',
                    84 => 'cosh',
                    85 => 'count',
                    86 => 'count_chars',
                    87 => 'crypt',
                    88 => 'ctype_alnum',
                    89 => 'ctype_alpha',
                    90 => 'ctype_cntrl',
                    91 => 'ctype_digit',
                    92 => 'ctype_graph',
                    93 => 'ctype_lower',
                    94 => 'ctype_print',
                    95 => 'ctype_punct',
                    96 => 'ctype_space',
                    97 => 'ctype_upper',
                    98 => 'ctype_xdigit',
                    99 => 'current',
                    100 => 'date',
                    101 => 'date_add',
                    102 => 'date_create',
                    103 => 'date_create_from_format',
                    104 => 'date_create_immutable',
                    105 => 'date_create_immutable_from_format',
                    106 => 'date_date_set',
                    107 => 'date_default_timezone_get',
                    108 => 'date_diff',
                    109 => 'date_format',
                    110 => 'date_get_last_errors',
                    111 => 'date_interval_create_from_date_string',
                    112 => 'date_interval_format',
                    113 => 'date_modify',
                    114 => 'date_offset_get',
                    115 => 'date_parse',
                    116 => 'date_parse_from_format',
                    117 => 'date_sub',
                    118 => 'date_sun_info',
                    119 => 'date_sunrise',
                    120 => 'date_sunset',
                    121 => 'date_timestamp_get',
                    122 => 'date_timezone_get',
                    123 => 'decbin',
                    124 => 'dechex',
                    125 => 'decoct',
                    126 => 'deg2rad',
                    127 => 'doubleval',
                    128 => 'each',
                    129 => 'easter_date',
                    130 => 'easter_days',
                    131 => 'end',
                    132 => 'exp',
                    133 => 'explode',
                    134 => 'expm1',
                    135 => 'empty',
                    136 => 'filter_has_var',
                    137 => 'filter_id',
                    138 => 'filter_input',
                    139 => 'filter_input_array',
                    140 => 'filter_list',
                    141 => 'filter_var',
                    142 => 'filter_var_array',
                    143 => 'floatval',
                    144 => 'floor',
                    145 => 'fmod',
                    146 => 'frenchtojd',
                    147 => 'get_browser',
                    148 => 'getdate',
                    149 => 'getrandmax',
                    150 => 'gettimeofday',
                    151 => 'gettype',
                    152 => 'gmdate',
                    153 => 'gmmktime',
                    154 => 'gmstrftime',
                    155 => 'gregoriantojd',
                    156 => 'hex2bin',
                    157 => 'hexdec',
                    158 => 'html_entity_decode',
                    159 => 'htmlentities',
                    160 => 'htmlspecialchars',
                    161 => 'htmlspecialchars_decode',
                    162 => 'hypot',
                    163 => 'iconv',
                    164 => 'iconv_get_encoding',
                    165 => 'iconv_mime_decode',
                    166 => 'iconv_mime_decode_headers',
                    167 => 'iconv_mime_encode',
                    168 => 'iconv_set_encoding',
                    169 => 'iconv_strlen',
                    170 => 'iconv_strpos',
                    171 => 'iconv_strrpos',
                    172 => 'iconv_substr',
                    173 => 'idate',
                    174 => 'implode',
                    175 => 'in_array',
                    176 => 'intdiv',
                    177 => 'intval',
                    178 => 'ip2long',
                    179 => 'is_array',
                    180 => 'is_a',
                    181 => 'isset',
                    182 => 'is_bool',
                    183 => 'is_double',
                    184 => 'is_finite',
                    185 => 'is_float',
                    186 => 'is_infinite',
                    187 => 'is_int',
                    188 => 'is_integer',
                    189 => 'is_iterable',
                    190 => 'is_long',
                    191 => 'is_nan',
                    192 => 'is_null',
                    193 => 'is_numeric',
                    194 => 'is_object',
                    195 => 'is_string',
                    196 => 'iterator_apply',
                    197 => 'iterator_count',
                    198 => 'iterator_to_array',
                    199 => 'jddayofweek',
                    200 => 'jdmonthname',
                    201 => 'jdtofrench',
                    202 => 'jdtogregorian',
                    203 => 'jdtojewish',
                    204 => 'jdtojulian',
                    205 => 'jdtounix',
                    206 => 'jewishtojd',
                    207 => 'join',
                    208 => 'json_decode',
                    209 => 'json_encode',
                    210 => 'json_last_error',
                    211 => 'json_last_error_msg',
                    212 => 'juliantojd',
                    213 => 'key',
                    214 => 'key_exists',
                    215 => 'ksort',
                    216 => 'lcfirst',
                    217 => 'levenshtein',
                    218 => 'localtime',
                    219 => 'log',
                    220 => 'log10',
                    221 => 'log1p',
                    222 => 'long2ip',
                    223 => 'ltrim',
                    224 => 'max',
                    225 => 'md5',
                    226 => 'mhash',
                    227 => 'mhash_count',
                    228 => 'mhash_get_block_size',
                    229 => 'mhash_get_hash_name',
                    230 => 'mhash_keygen_s2k',
                    231 => 'microtime',
                    232 => 'min',
                    233 => 'mktime',
                    234 => 'money_format',
                    235 => 'mt_getrandmax',
                    236 => 'mt_rand',
                    237 => 'mt_srand',
                    238 => 'natcasesort',
                    239 => 'natsort',
                    240 => 'next',
                    241 => 'nl2br',
                    242 => 'number_format',
                    243 => 'octdec',
                    244 => 'ord',
                    245 => 'parse_str',
                    246 => 'parse_url',
                    247 => 'php_strip_whitespace',
                    248 => 'pi',
                    249 => 'pos',
                    250 => 'pow',
                    251 => 'prev',
                    252 => 'printf',
                    253 => 'print_r',
                    254 => 'rad2deg',
                    255 => 'rand',
                    256 => 'random_bytes',
                    257 => 'random_int',
                    258 => 'range',
                    259 => 'rawurldecode',
                    260 => 'rawurlencode',
                    261 => 'reset',
                    262 => 'round',
                    263 => 'rsort',
                    264 => 'rtrim',
                    265 => 'serialize',
                    266 => 'sha1',
                    267 => 'shuffle',
                    268 => 'similar_text',
                    269 => 'sin',
                    270 => 'sinh',
                    271 => 'sizeof',
                    272 => 'sort',
                    273 => 'soundex',
                    274 => 'sprintf',
                    275 => 'sqrt',
                    276 => 'srand',
                    277 => 'str_ireplace',
                    278 => 'str_pad',
                    279 => 'str_repeat',
                    280 => 'str_replace',
                    281 => 'str_rot13',
                    282 => 'str_shuffle',
                    283 => 'str_split',
                    284 => 'str_word_count',
                    285 => 'strcasecmp',
                    286 => 'strchr',
                    287 => 'strcmp',
                    288 => 'strcoll',
                    289 => 'strcspn',
                    290 => 'strftime',
                    291 => 'strip_tags',
                    292 => 'stripcslashes',
                    293 => 'stripos',
                    294 => 'stripslashes',
                    295 => 'stristr',
                    296 => 'strlen',
                    297 => 'strnatcasecmp',
                    298 => 'strnatcmp',
                    299 => 'strncasecmp',
                    300 => 'strncmp',
                    301 => 'strpbrk',
                    302 => 'strpos',
                    303 => 'strptime',
                    304 => 'strrchr',
                    305 => 'strrev',
                    306 => 'strripos',
                    307 => 'strrpos',
                    308 => 'strspn',
                    309 => 'strstr',
                    310 => 'strtok',
                    311 => 'strtolower',
                    312 => 'strtotime',
                    313 => 'strtoupper',
                    314 => 'strtr',
                    315 => 'strval',
                    316 => 'substr',
                    317 => 'substr_compare',
                    318 => 'substr_count',
                    319 => 'substr_replace',
                    320 => 'tan',
                    321 => 'tanh',
                    322 => 'time',
                    323 => 'trim',
                    324 => 'uasort',
                    325 => 'ucfirst',
                    326 => 'ucwords',
                    327 => 'uksort',
                    328 => 'uniqid',
                    329 => 'unixtojd',
                    330 => 'unserialize',
                    331 => 'urldecode',
                    332 => 'urlencode',
                    333 => 'usort',
                    334 => 'utf8_decode',
                    335 => 'utf8_encode',
                    336 => 'var_dump',
                    337 => 'version_compare',
                    338 => 'wordwrap',
                ),
            ),
            'shopware.template_security.enabled' => true,
            'shopware.template_security.php_modifiers' => array(
                0 => 'abs',
                1 => 'acos',
                2 => 'acosh',
                3 => 'addcslashes',
                4 => 'addslashes',
                5 => 'array',
                6 => 'array_change_key_case',
                7 => 'array_chunk',
                8 => 'array_column',
                9 => 'array_combine',
                10 => 'array_count_values',
                11 => 'array_diff',
                12 => 'array_diff_assoc',
                13 => 'array_diff_key',
                14 => 'array_diff_uassoc',
                15 => 'array_diff_ukey',
                16 => 'array_fill',
                17 => 'array_fill_keys',
                18 => 'array_filter',
                19 => 'array_flip',
                20 => 'array_intersect',
                21 => 'array_intersect_assoc',
                22 => 'array_intersect_key',
                23 => 'array_intersect_uassoc',
                24 => 'array_intersect_ukey',
                25 => 'array_key_exists',
                26 => 'array_keys',
                27 => 'array_map',
                28 => 'array_merge',
                29 => 'array_merge_recursive',
                30 => 'array_multisort',
                31 => 'array_pad',
                32 => 'array_pop',
                33 => 'array_product',
                34 => 'array_push',
                35 => 'array_rand',
                36 => 'array_reduce',
                37 => 'array_replace',
                38 => 'array_replace_recursive',
                39 => 'array_reverse',
                40 => 'array_search',
                41 => 'array_shift',
                42 => 'array_slice',
                43 => 'array_splice',
                44 => 'array_sum',
                45 => 'array_udiff',
                46 => 'array_udiff_assoc',
                47 => 'array_udiff_uassoc',
                48 => 'array_uintersect',
                49 => 'array_uintersect_assoc',
                50 => 'array_uintersect_uassoc',
                51 => 'array_unique',
                52 => 'array_unshift',
                53 => 'array_values',
                54 => 'array_walk',
                55 => 'array_walk_recursive',
                56 => 'arsort',
                57 => 'asin',
                58 => 'asinh',
                59 => 'asort',
                60 => 'atan',
                61 => 'atan2',
                62 => 'atanh',
                63 => 'base64_decode',
                64 => 'base64_encode',
                65 => 'base_convert',
                66 => 'bin2hex',
                67 => 'bindec',
                68 => 'boolval',
                69 => 'cal_days_in_month',
                70 => 'cal_from_jd',
                71 => 'cal_info',
                72 => 'cal_to_jd',
                73 => 'ceil',
                74 => 'checkdate',
                75 => 'chop',
                76 => 'chr',
                77 => 'chunk_split',
                78 => 'compact',
                79 => 'constant',
                80 => 'convert_cyr_string',
                81 => 'convert_uudecode',
                82 => 'convert_uuencode',
                83 => 'cos',
                84 => 'cosh',
                85 => 'count',
                86 => 'count_chars',
                87 => 'crypt',
                88 => 'ctype_alnum',
                89 => 'ctype_alpha',
                90 => 'ctype_cntrl',
                91 => 'ctype_digit',
                92 => 'ctype_graph',
                93 => 'ctype_lower',
                94 => 'ctype_print',
                95 => 'ctype_punct',
                96 => 'ctype_space',
                97 => 'ctype_upper',
                98 => 'ctype_xdigit',
                99 => 'current',
                100 => 'date',
                101 => 'date_add',
                102 => 'date_create',
                103 => 'date_create_from_format',
                104 => 'date_create_immutable',
                105 => 'date_create_immutable_from_format',
                106 => 'date_date_set',
                107 => 'date_default_timezone_get',
                108 => 'date_diff',
                109 => 'date_format',
                110 => 'date_get_last_errors',
                111 => 'date_interval_create_from_date_string',
                112 => 'date_interval_format',
                113 => 'date_modify',
                114 => 'date_offset_get',
                115 => 'date_parse',
                116 => 'date_parse_from_format',
                117 => 'date_sub',
                118 => 'date_sun_info',
                119 => 'date_sunrise',
                120 => 'date_sunset',
                121 => 'date_timestamp_get',
                122 => 'date_timezone_get',
                123 => 'decbin',
                124 => 'dechex',
                125 => 'decoct',
                126 => 'deg2rad',
                127 => 'doubleval',
                128 => 'each',
                129 => 'easter_date',
                130 => 'easter_days',
                131 => 'end',
                132 => 'exp',
                133 => 'explode',
                134 => 'expm1',
                135 => 'empty',
                136 => 'filter_has_var',
                137 => 'filter_id',
                138 => 'filter_input',
                139 => 'filter_input_array',
                140 => 'filter_list',
                141 => 'filter_var',
                142 => 'filter_var_array',
                143 => 'floatval',
                144 => 'floor',
                145 => 'fmod',
                146 => 'frenchtojd',
                147 => 'get_browser',
                148 => 'getdate',
                149 => 'getrandmax',
                150 => 'gettimeofday',
                151 => 'gettype',
                152 => 'gmdate',
                153 => 'gmmktime',
                154 => 'gmstrftime',
                155 => 'gregoriantojd',
                156 => 'hex2bin',
                157 => 'hexdec',
                158 => 'html_entity_decode',
                159 => 'htmlentities',
                160 => 'htmlspecialchars',
                161 => 'htmlspecialchars_decode',
                162 => 'hypot',
                163 => 'iconv',
                164 => 'iconv_get_encoding',
                165 => 'iconv_mime_decode',
                166 => 'iconv_mime_decode_headers',
                167 => 'iconv_mime_encode',
                168 => 'iconv_set_encoding',
                169 => 'iconv_strlen',
                170 => 'iconv_strpos',
                171 => 'iconv_strrpos',
                172 => 'iconv_substr',
                173 => 'idate',
                174 => 'implode',
                175 => 'in_array',
                176 => 'intdiv',
                177 => 'intval',
                178 => 'ip2long',
                179 => 'is_array',
                180 => 'is_a',
                181 => 'isset',
                182 => 'is_bool',
                183 => 'is_double',
                184 => 'is_finite',
                185 => 'is_float',
                186 => 'is_infinite',
                187 => 'is_int',
                188 => 'is_integer',
                189 => 'is_iterable',
                190 => 'is_long',
                191 => 'is_nan',
                192 => 'is_null',
                193 => 'is_numeric',
                194 => 'is_object',
                195 => 'is_string',
                196 => 'iterator_apply',
                197 => 'iterator_count',
                198 => 'iterator_to_array',
                199 => 'jddayofweek',
                200 => 'jdmonthname',
                201 => 'jdtofrench',
                202 => 'jdtogregorian',
                203 => 'jdtojewish',
                204 => 'jdtojulian',
                205 => 'jdtounix',
                206 => 'jewishtojd',
                207 => 'join',
                208 => 'json_decode',
                209 => 'json_encode',
                210 => 'json_last_error',
                211 => 'json_last_error_msg',
                212 => 'juliantojd',
                213 => 'key',
                214 => 'key_exists',
                215 => 'ksort',
                216 => 'lcfirst',
                217 => 'levenshtein',
                218 => 'localtime',
                219 => 'log',
                220 => 'log10',
                221 => 'log1p',
                222 => 'long2ip',
                223 => 'ltrim',
                224 => 'max',
                225 => 'md5',
                226 => 'mhash',
                227 => 'mhash_count',
                228 => 'mhash_get_block_size',
                229 => 'mhash_get_hash_name',
                230 => 'mhash_keygen_s2k',
                231 => 'microtime',
                232 => 'min',
                233 => 'mktime',
                234 => 'money_format',
                235 => 'mt_getrandmax',
                236 => 'mt_rand',
                237 => 'mt_srand',
                238 => 'natcasesort',
                239 => 'natsort',
                240 => 'next',
                241 => 'nl2br',
                242 => 'number_format',
                243 => 'octdec',
                244 => 'ord',
                245 => 'parse_str',
                246 => 'parse_url',
                247 => 'php_strip_whitespace',
                248 => 'pi',
                249 => 'pos',
                250 => 'pow',
                251 => 'prev',
                252 => 'printf',
                253 => 'print_r',
                254 => 'rad2deg',
                255 => 'rand',
                256 => 'random_bytes',
                257 => 'random_int',
                258 => 'range',
                259 => 'rawurldecode',
                260 => 'rawurlencode',
                261 => 'reset',
                262 => 'round',
                263 => 'rsort',
                264 => 'rtrim',
                265 => 'serialize',
                266 => 'sha1',
                267 => 'shuffle',
                268 => 'similar_text',
                269 => 'sin',
                270 => 'sinh',
                271 => 'sizeof',
                272 => 'sort',
                273 => 'soundex',
                274 => 'sprintf',
                275 => 'sqrt',
                276 => 'srand',
                277 => 'str_ireplace',
                278 => 'str_pad',
                279 => 'str_repeat',
                280 => 'str_replace',
                281 => 'str_rot13',
                282 => 'str_shuffle',
                283 => 'str_split',
                284 => 'str_word_count',
                285 => 'strcasecmp',
                286 => 'strchr',
                287 => 'strcmp',
                288 => 'strcoll',
                289 => 'strcspn',
                290 => 'strftime',
                291 => 'strip_tags',
                292 => 'stripcslashes',
                293 => 'stripos',
                294 => 'stripslashes',
                295 => 'stristr',
                296 => 'strlen',
                297 => 'strnatcasecmp',
                298 => 'strnatcmp',
                299 => 'strncasecmp',
                300 => 'strncmp',
                301 => 'strpbrk',
                302 => 'strpos',
                303 => 'strptime',
                304 => 'strrchr',
                305 => 'strrev',
                306 => 'strripos',
                307 => 'strrpos',
                308 => 'strspn',
                309 => 'strstr',
                310 => 'strtok',
                311 => 'strtolower',
                312 => 'strtotime',
                313 => 'strtoupper',
                314 => 'strtr',
                315 => 'strval',
                316 => 'substr',
                317 => 'substr_compare',
                318 => 'substr_count',
                319 => 'substr_replace',
                320 => 'tan',
                321 => 'tanh',
                322 => 'time',
                323 => 'trim',
                324 => 'uasort',
                325 => 'ucfirst',
                326 => 'ucwords',
                327 => 'uksort',
                328 => 'uniqid',
                329 => 'unixtojd',
                330 => 'unserialize',
                331 => 'urldecode',
                332 => 'urlencode',
                333 => 'usort',
                334 => 'utf8_decode',
                335 => 'utf8_encode',
                336 => 'var_dump',
                337 => 'version_compare',
                338 => 'wordwrap',
            ),
            'shopware.template_security.php_modifiers.0' => 'abs',
            'shopware.template_security.php_modifiers.1' => 'acos',
            'shopware.template_security.php_modifiers.2' => 'acosh',
            'shopware.template_security.php_modifiers.3' => 'addcslashes',
            'shopware.template_security.php_modifiers.4' => 'addslashes',
            'shopware.template_security.php_modifiers.5' => 'array',
            'shopware.template_security.php_modifiers.6' => 'array_change_key_case',
            'shopware.template_security.php_modifiers.7' => 'array_chunk',
            'shopware.template_security.php_modifiers.8' => 'array_column',
            'shopware.template_security.php_modifiers.9' => 'array_combine',
            'shopware.template_security.php_modifiers.10' => 'array_count_values',
            'shopware.template_security.php_modifiers.11' => 'array_diff',
            'shopware.template_security.php_modifiers.12' => 'array_diff_assoc',
            'shopware.template_security.php_modifiers.13' => 'array_diff_key',
            'shopware.template_security.php_modifiers.14' => 'array_diff_uassoc',
            'shopware.template_security.php_modifiers.15' => 'array_diff_ukey',
            'shopware.template_security.php_modifiers.16' => 'array_fill',
            'shopware.template_security.php_modifiers.17' => 'array_fill_keys',
            'shopware.template_security.php_modifiers.18' => 'array_filter',
            'shopware.template_security.php_modifiers.19' => 'array_flip',
            'shopware.template_security.php_modifiers.20' => 'array_intersect',
            'shopware.template_security.php_modifiers.21' => 'array_intersect_assoc',
            'shopware.template_security.php_modifiers.22' => 'array_intersect_key',
            'shopware.template_security.php_modifiers.23' => 'array_intersect_uassoc',
            'shopware.template_security.php_modifiers.24' => 'array_intersect_ukey',
            'shopware.template_security.php_modifiers.25' => 'array_key_exists',
            'shopware.template_security.php_modifiers.26' => 'array_keys',
            'shopware.template_security.php_modifiers.27' => 'array_map',
            'shopware.template_security.php_modifiers.28' => 'array_merge',
            'shopware.template_security.php_modifiers.29' => 'array_merge_recursive',
            'shopware.template_security.php_modifiers.30' => 'array_multisort',
            'shopware.template_security.php_modifiers.31' => 'array_pad',
            'shopware.template_security.php_modifiers.32' => 'array_pop',
            'shopware.template_security.php_modifiers.33' => 'array_product',
            'shopware.template_security.php_modifiers.34' => 'array_push',
            'shopware.template_security.php_modifiers.35' => 'array_rand',
            'shopware.template_security.php_modifiers.36' => 'array_reduce',
            'shopware.template_security.php_modifiers.37' => 'array_replace',
            'shopware.template_security.php_modifiers.38' => 'array_replace_recursive',
            'shopware.template_security.php_modifiers.39' => 'array_reverse',
            'shopware.template_security.php_modifiers.40' => 'array_search',
            'shopware.template_security.php_modifiers.41' => 'array_shift',
            'shopware.template_security.php_modifiers.42' => 'array_slice',
            'shopware.template_security.php_modifiers.43' => 'array_splice',
            'shopware.template_security.php_modifiers.44' => 'array_sum',
            'shopware.template_security.php_modifiers.45' => 'array_udiff',
            'shopware.template_security.php_modifiers.46' => 'array_udiff_assoc',
            'shopware.template_security.php_modifiers.47' => 'array_udiff_uassoc',
            'shopware.template_security.php_modifiers.48' => 'array_uintersect',
            'shopware.template_security.php_modifiers.49' => 'array_uintersect_assoc',
            'shopware.template_security.php_modifiers.50' => 'array_uintersect_uassoc',
            'shopware.template_security.php_modifiers.51' => 'array_unique',
            'shopware.template_security.php_modifiers.52' => 'array_unshift',
            'shopware.template_security.php_modifiers.53' => 'array_values',
            'shopware.template_security.php_modifiers.54' => 'array_walk',
            'shopware.template_security.php_modifiers.55' => 'array_walk_recursive',
            'shopware.template_security.php_modifiers.56' => 'arsort',
            'shopware.template_security.php_modifiers.57' => 'asin',
            'shopware.template_security.php_modifiers.58' => 'asinh',
            'shopware.template_security.php_modifiers.59' => 'asort',
            'shopware.template_security.php_modifiers.60' => 'atan',
            'shopware.template_security.php_modifiers.61' => 'atan2',
            'shopware.template_security.php_modifiers.62' => 'atanh',
            'shopware.template_security.php_modifiers.63' => 'base64_decode',
            'shopware.template_security.php_modifiers.64' => 'base64_encode',
            'shopware.template_security.php_modifiers.65' => 'base_convert',
            'shopware.template_security.php_modifiers.66' => 'bin2hex',
            'shopware.template_security.php_modifiers.67' => 'bindec',
            'shopware.template_security.php_modifiers.68' => 'boolval',
            'shopware.template_security.php_modifiers.69' => 'cal_days_in_month',
            'shopware.template_security.php_modifiers.70' => 'cal_from_jd',
            'shopware.template_security.php_modifiers.71' => 'cal_info',
            'shopware.template_security.php_modifiers.72' => 'cal_to_jd',
            'shopware.template_security.php_modifiers.73' => 'ceil',
            'shopware.template_security.php_modifiers.74' => 'checkdate',
            'shopware.template_security.php_modifiers.75' => 'chop',
            'shopware.template_security.php_modifiers.76' => 'chr',
            'shopware.template_security.php_modifiers.77' => 'chunk_split',
            'shopware.template_security.php_modifiers.78' => 'compact',
            'shopware.template_security.php_modifiers.79' => 'constant',
            'shopware.template_security.php_modifiers.80' => 'convert_cyr_string',
            'shopware.template_security.php_modifiers.81' => 'convert_uudecode',
            'shopware.template_security.php_modifiers.82' => 'convert_uuencode',
            'shopware.template_security.php_modifiers.83' => 'cos',
            'shopware.template_security.php_modifiers.84' => 'cosh',
            'shopware.template_security.php_modifiers.85' => 'count',
            'shopware.template_security.php_modifiers.86' => 'count_chars',
            'shopware.template_security.php_modifiers.87' => 'crypt',
            'shopware.template_security.php_modifiers.88' => 'ctype_alnum',
            'shopware.template_security.php_modifiers.89' => 'ctype_alpha',
            'shopware.template_security.php_modifiers.90' => 'ctype_cntrl',
            'shopware.template_security.php_modifiers.91' => 'ctype_digit',
            'shopware.template_security.php_modifiers.92' => 'ctype_graph',
            'shopware.template_security.php_modifiers.93' => 'ctype_lower',
            'shopware.template_security.php_modifiers.94' => 'ctype_print',
            'shopware.template_security.php_modifiers.95' => 'ctype_punct',
            'shopware.template_security.php_modifiers.96' => 'ctype_space',
            'shopware.template_security.php_modifiers.97' => 'ctype_upper',
            'shopware.template_security.php_modifiers.98' => 'ctype_xdigit',
            'shopware.template_security.php_modifiers.99' => 'current',
            'shopware.template_security.php_modifiers.100' => 'date',
            'shopware.template_security.php_modifiers.101' => 'date_add',
            'shopware.template_security.php_modifiers.102' => 'date_create',
            'shopware.template_security.php_modifiers.103' => 'date_create_from_format',
            'shopware.template_security.php_modifiers.104' => 'date_create_immutable',
            'shopware.template_security.php_modifiers.105' => 'date_create_immutable_from_format',
            'shopware.template_security.php_modifiers.106' => 'date_date_set',
            'shopware.template_security.php_modifiers.107' => 'date_default_timezone_get',
            'shopware.template_security.php_modifiers.108' => 'date_diff',
            'shopware.template_security.php_modifiers.109' => 'date_format',
            'shopware.template_security.php_modifiers.110' => 'date_get_last_errors',
            'shopware.template_security.php_modifiers.111' => 'date_interval_create_from_date_string',
            'shopware.template_security.php_modifiers.112' => 'date_interval_format',
            'shopware.template_security.php_modifiers.113' => 'date_modify',
            'shopware.template_security.php_modifiers.114' => 'date_offset_get',
            'shopware.template_security.php_modifiers.115' => 'date_parse',
            'shopware.template_security.php_modifiers.116' => 'date_parse_from_format',
            'shopware.template_security.php_modifiers.117' => 'date_sub',
            'shopware.template_security.php_modifiers.118' => 'date_sun_info',
            'shopware.template_security.php_modifiers.119' => 'date_sunrise',
            'shopware.template_security.php_modifiers.120' => 'date_sunset',
            'shopware.template_security.php_modifiers.121' => 'date_timestamp_get',
            'shopware.template_security.php_modifiers.122' => 'date_timezone_get',
            'shopware.template_security.php_modifiers.123' => 'decbin',
            'shopware.template_security.php_modifiers.124' => 'dechex',
            'shopware.template_security.php_modifiers.125' => 'decoct',
            'shopware.template_security.php_modifiers.126' => 'deg2rad',
            'shopware.template_security.php_modifiers.127' => 'doubleval',
            'shopware.template_security.php_modifiers.128' => 'each',
            'shopware.template_security.php_modifiers.129' => 'easter_date',
            'shopware.template_security.php_modifiers.130' => 'easter_days',
            'shopware.template_security.php_modifiers.131' => 'end',
            'shopware.template_security.php_modifiers.132' => 'exp',
            'shopware.template_security.php_modifiers.133' => 'explode',
            'shopware.template_security.php_modifiers.134' => 'expm1',
            'shopware.template_security.php_modifiers.135' => 'empty',
            'shopware.template_security.php_modifiers.136' => 'filter_has_var',
            'shopware.template_security.php_modifiers.137' => 'filter_id',
            'shopware.template_security.php_modifiers.138' => 'filter_input',
            'shopware.template_security.php_modifiers.139' => 'filter_input_array',
            'shopware.template_security.php_modifiers.140' => 'filter_list',
            'shopware.template_security.php_modifiers.141' => 'filter_var',
            'shopware.template_security.php_modifiers.142' => 'filter_var_array',
            'shopware.template_security.php_modifiers.143' => 'floatval',
            'shopware.template_security.php_modifiers.144' => 'floor',
            'shopware.template_security.php_modifiers.145' => 'fmod',
            'shopware.template_security.php_modifiers.146' => 'frenchtojd',
            'shopware.template_security.php_modifiers.147' => 'get_browser',
            'shopware.template_security.php_modifiers.148' => 'getdate',
            'shopware.template_security.php_modifiers.149' => 'getrandmax',
            'shopware.template_security.php_modifiers.150' => 'gettimeofday',
            'shopware.template_security.php_modifiers.151' => 'gettype',
            'shopware.template_security.php_modifiers.152' => 'gmdate',
            'shopware.template_security.php_modifiers.153' => 'gmmktime',
            'shopware.template_security.php_modifiers.154' => 'gmstrftime',
            'shopware.template_security.php_modifiers.155' => 'gregoriantojd',
            'shopware.template_security.php_modifiers.156' => 'hex2bin',
            'shopware.template_security.php_modifiers.157' => 'hexdec',
            'shopware.template_security.php_modifiers.158' => 'html_entity_decode',
            'shopware.template_security.php_modifiers.159' => 'htmlentities',
            'shopware.template_security.php_modifiers.160' => 'htmlspecialchars',
            'shopware.template_security.php_modifiers.161' => 'htmlspecialchars_decode',
            'shopware.template_security.php_modifiers.162' => 'hypot',
            'shopware.template_security.php_modifiers.163' => 'iconv',
            'shopware.template_security.php_modifiers.164' => 'iconv_get_encoding',
            'shopware.template_security.php_modifiers.165' => 'iconv_mime_decode',
            'shopware.template_security.php_modifiers.166' => 'iconv_mime_decode_headers',
            'shopware.template_security.php_modifiers.167' => 'iconv_mime_encode',
            'shopware.template_security.php_modifiers.168' => 'iconv_set_encoding',
            'shopware.template_security.php_modifiers.169' => 'iconv_strlen',
            'shopware.template_security.php_modifiers.170' => 'iconv_strpos',
            'shopware.template_security.php_modifiers.171' => 'iconv_strrpos',
            'shopware.template_security.php_modifiers.172' => 'iconv_substr',
            'shopware.template_security.php_modifiers.173' => 'idate',
            'shopware.template_security.php_modifiers.174' => 'implode',
            'shopware.template_security.php_modifiers.175' => 'in_array',
            'shopware.template_security.php_modifiers.176' => 'intdiv',
            'shopware.template_security.php_modifiers.177' => 'intval',
            'shopware.template_security.php_modifiers.178' => 'ip2long',
            'shopware.template_security.php_modifiers.179' => 'is_array',
            'shopware.template_security.php_modifiers.180' => 'is_a',
            'shopware.template_security.php_modifiers.181' => 'isset',
            'shopware.template_security.php_modifiers.182' => 'is_bool',
            'shopware.template_security.php_modifiers.183' => 'is_double',
            'shopware.template_security.php_modifiers.184' => 'is_finite',
            'shopware.template_security.php_modifiers.185' => 'is_float',
            'shopware.template_security.php_modifiers.186' => 'is_infinite',
            'shopware.template_security.php_modifiers.187' => 'is_int',
            'shopware.template_security.php_modifiers.188' => 'is_integer',
            'shopware.template_security.php_modifiers.189' => 'is_iterable',
            'shopware.template_security.php_modifiers.190' => 'is_long',
            'shopware.template_security.php_modifiers.191' => 'is_nan',
            'shopware.template_security.php_modifiers.192' => 'is_null',
            'shopware.template_security.php_modifiers.193' => 'is_numeric',
            'shopware.template_security.php_modifiers.194' => 'is_object',
            'shopware.template_security.php_modifiers.195' => 'is_string',
            'shopware.template_security.php_modifiers.196' => 'iterator_apply',
            'shopware.template_security.php_modifiers.197' => 'iterator_count',
            'shopware.template_security.php_modifiers.198' => 'iterator_to_array',
            'shopware.template_security.php_modifiers.199' => 'jddayofweek',
            'shopware.template_security.php_modifiers.200' => 'jdmonthname',
            'shopware.template_security.php_modifiers.201' => 'jdtofrench',
            'shopware.template_security.php_modifiers.202' => 'jdtogregorian',
            'shopware.template_security.php_modifiers.203' => 'jdtojewish',
            'shopware.template_security.php_modifiers.204' => 'jdtojulian',
            'shopware.template_security.php_modifiers.205' => 'jdtounix',
            'shopware.template_security.php_modifiers.206' => 'jewishtojd',
            'shopware.template_security.php_modifiers.207' => 'join',
            'shopware.template_security.php_modifiers.208' => 'json_decode',
            'shopware.template_security.php_modifiers.209' => 'json_encode',
            'shopware.template_security.php_modifiers.210' => 'json_last_error',
            'shopware.template_security.php_modifiers.211' => 'json_last_error_msg',
            'shopware.template_security.php_modifiers.212' => 'juliantojd',
            'shopware.template_security.php_modifiers.213' => 'key',
            'shopware.template_security.php_modifiers.214' => 'key_exists',
            'shopware.template_security.php_modifiers.215' => 'ksort',
            'shopware.template_security.php_modifiers.216' => 'lcfirst',
            'shopware.template_security.php_modifiers.217' => 'levenshtein',
            'shopware.template_security.php_modifiers.218' => 'localtime',
            'shopware.template_security.php_modifiers.219' => 'log',
            'shopware.template_security.php_modifiers.220' => 'log10',
            'shopware.template_security.php_modifiers.221' => 'log1p',
            'shopware.template_security.php_modifiers.222' => 'long2ip',
            'shopware.template_security.php_modifiers.223' => 'ltrim',
            'shopware.template_security.php_modifiers.224' => 'max',
            'shopware.template_security.php_modifiers.225' => 'md5',
            'shopware.template_security.php_modifiers.226' => 'mhash',
            'shopware.template_security.php_modifiers.227' => 'mhash_count',
            'shopware.template_security.php_modifiers.228' => 'mhash_get_block_size',
            'shopware.template_security.php_modifiers.229' => 'mhash_get_hash_name',
            'shopware.template_security.php_modifiers.230' => 'mhash_keygen_s2k',
            'shopware.template_security.php_modifiers.231' => 'microtime',
            'shopware.template_security.php_modifiers.232' => 'min',
            'shopware.template_security.php_modifiers.233' => 'mktime',
            'shopware.template_security.php_modifiers.234' => 'money_format',
            'shopware.template_security.php_modifiers.235' => 'mt_getrandmax',
            'shopware.template_security.php_modifiers.236' => 'mt_rand',
            'shopware.template_security.php_modifiers.237' => 'mt_srand',
            'shopware.template_security.php_modifiers.238' => 'natcasesort',
            'shopware.template_security.php_modifiers.239' => 'natsort',
            'shopware.template_security.php_modifiers.240' => 'next',
            'shopware.template_security.php_modifiers.241' => 'nl2br',
            'shopware.template_security.php_modifiers.242' => 'number_format',
            'shopware.template_security.php_modifiers.243' => 'octdec',
            'shopware.template_security.php_modifiers.244' => 'ord',
            'shopware.template_security.php_modifiers.245' => 'parse_str',
            'shopware.template_security.php_modifiers.246' => 'parse_url',
            'shopware.template_security.php_modifiers.247' => 'php_strip_whitespace',
            'shopware.template_security.php_modifiers.248' => 'pi',
            'shopware.template_security.php_modifiers.249' => 'pos',
            'shopware.template_security.php_modifiers.250' => 'pow',
            'shopware.template_security.php_modifiers.251' => 'prev',
            'shopware.template_security.php_modifiers.252' => 'printf',
            'shopware.template_security.php_modifiers.253' => 'print_r',
            'shopware.template_security.php_modifiers.254' => 'rad2deg',
            'shopware.template_security.php_modifiers.255' => 'rand',
            'shopware.template_security.php_modifiers.256' => 'random_bytes',
            'shopware.template_security.php_modifiers.257' => 'random_int',
            'shopware.template_security.php_modifiers.258' => 'range',
            'shopware.template_security.php_modifiers.259' => 'rawurldecode',
            'shopware.template_security.php_modifiers.260' => 'rawurlencode',
            'shopware.template_security.php_modifiers.261' => 'reset',
            'shopware.template_security.php_modifiers.262' => 'round',
            'shopware.template_security.php_modifiers.263' => 'rsort',
            'shopware.template_security.php_modifiers.264' => 'rtrim',
            'shopware.template_security.php_modifiers.265' => 'serialize',
            'shopware.template_security.php_modifiers.266' => 'sha1',
            'shopware.template_security.php_modifiers.267' => 'shuffle',
            'shopware.template_security.php_modifiers.268' => 'similar_text',
            'shopware.template_security.php_modifiers.269' => 'sin',
            'shopware.template_security.php_modifiers.270' => 'sinh',
            'shopware.template_security.php_modifiers.271' => 'sizeof',
            'shopware.template_security.php_modifiers.272' => 'sort',
            'shopware.template_security.php_modifiers.273' => 'soundex',
            'shopware.template_security.php_modifiers.274' => 'sprintf',
            'shopware.template_security.php_modifiers.275' => 'sqrt',
            'shopware.template_security.php_modifiers.276' => 'srand',
            'shopware.template_security.php_modifiers.277' => 'str_ireplace',
            'shopware.template_security.php_modifiers.278' => 'str_pad',
            'shopware.template_security.php_modifiers.279' => 'str_repeat',
            'shopware.template_security.php_modifiers.280' => 'str_replace',
            'shopware.template_security.php_modifiers.281' => 'str_rot13',
            'shopware.template_security.php_modifiers.282' => 'str_shuffle',
            'shopware.template_security.php_modifiers.283' => 'str_split',
            'shopware.template_security.php_modifiers.284' => 'str_word_count',
            'shopware.template_security.php_modifiers.285' => 'strcasecmp',
            'shopware.template_security.php_modifiers.286' => 'strchr',
            'shopware.template_security.php_modifiers.287' => 'strcmp',
            'shopware.template_security.php_modifiers.288' => 'strcoll',
            'shopware.template_security.php_modifiers.289' => 'strcspn',
            'shopware.template_security.php_modifiers.290' => 'strftime',
            'shopware.template_security.php_modifiers.291' => 'strip_tags',
            'shopware.template_security.php_modifiers.292' => 'stripcslashes',
            'shopware.template_security.php_modifiers.293' => 'stripos',
            'shopware.template_security.php_modifiers.294' => 'stripslashes',
            'shopware.template_security.php_modifiers.295' => 'stristr',
            'shopware.template_security.php_modifiers.296' => 'strlen',
            'shopware.template_security.php_modifiers.297' => 'strnatcasecmp',
            'shopware.template_security.php_modifiers.298' => 'strnatcmp',
            'shopware.template_security.php_modifiers.299' => 'strncasecmp',
            'shopware.template_security.php_modifiers.300' => 'strncmp',
            'shopware.template_security.php_modifiers.301' => 'strpbrk',
            'shopware.template_security.php_modifiers.302' => 'strpos',
            'shopware.template_security.php_modifiers.303' => 'strptime',
            'shopware.template_security.php_modifiers.304' => 'strrchr',
            'shopware.template_security.php_modifiers.305' => 'strrev',
            'shopware.template_security.php_modifiers.306' => 'strripos',
            'shopware.template_security.php_modifiers.307' => 'strrpos',
            'shopware.template_security.php_modifiers.308' => 'strspn',
            'shopware.template_security.php_modifiers.309' => 'strstr',
            'shopware.template_security.php_modifiers.310' => 'strtok',
            'shopware.template_security.php_modifiers.311' => 'strtolower',
            'shopware.template_security.php_modifiers.312' => 'strtotime',
            'shopware.template_security.php_modifiers.313' => 'strtoupper',
            'shopware.template_security.php_modifiers.314' => 'strtr',
            'shopware.template_security.php_modifiers.315' => 'strval',
            'shopware.template_security.php_modifiers.316' => 'substr',
            'shopware.template_security.php_modifiers.317' => 'substr_compare',
            'shopware.template_security.php_modifiers.318' => 'substr_count',
            'shopware.template_security.php_modifiers.319' => 'substr_replace',
            'shopware.template_security.php_modifiers.320' => 'tan',
            'shopware.template_security.php_modifiers.321' => 'tanh',
            'shopware.template_security.php_modifiers.322' => 'time',
            'shopware.template_security.php_modifiers.323' => 'trim',
            'shopware.template_security.php_modifiers.324' => 'uasort',
            'shopware.template_security.php_modifiers.325' => 'ucfirst',
            'shopware.template_security.php_modifiers.326' => 'ucwords',
            'shopware.template_security.php_modifiers.327' => 'uksort',
            'shopware.template_security.php_modifiers.328' => 'uniqid',
            'shopware.template_security.php_modifiers.329' => 'unixtojd',
            'shopware.template_security.php_modifiers.330' => 'unserialize',
            'shopware.template_security.php_modifiers.331' => 'urldecode',
            'shopware.template_security.php_modifiers.332' => 'urlencode',
            'shopware.template_security.php_modifiers.333' => 'usort',
            'shopware.template_security.php_modifiers.334' => 'utf8_decode',
            'shopware.template_security.php_modifiers.335' => 'utf8_encode',
            'shopware.template_security.php_modifiers.336' => 'var_dump',
            'shopware.template_security.php_modifiers.337' => 'version_compare',
            'shopware.template_security.php_modifiers.338' => 'wordwrap',
            'shopware.template_security.php_functions' => array(
                0 => 'abs',
                1 => 'acos',
                2 => 'acosh',
                3 => 'addcslashes',
                4 => 'addslashes',
                5 => 'array',
                6 => 'array_change_key_case',
                7 => 'array_chunk',
                8 => 'array_column',
                9 => 'array_combine',
                10 => 'array_count_values',
                11 => 'array_diff',
                12 => 'array_diff_assoc',
                13 => 'array_diff_key',
                14 => 'array_diff_uassoc',
                15 => 'array_diff_ukey',
                16 => 'array_fill',
                17 => 'array_fill_keys',
                18 => 'array_filter',
                19 => 'array_flip',
                20 => 'array_intersect',
                21 => 'array_intersect_assoc',
                22 => 'array_intersect_key',
                23 => 'array_intersect_uassoc',
                24 => 'array_intersect_ukey',
                25 => 'array_key_exists',
                26 => 'array_keys',
                27 => 'array_map',
                28 => 'array_merge',
                29 => 'array_merge_recursive',
                30 => 'array_multisort',
                31 => 'array_pad',
                32 => 'array_pop',
                33 => 'array_product',
                34 => 'array_push',
                35 => 'array_rand',
                36 => 'array_reduce',
                37 => 'array_replace',
                38 => 'array_replace_recursive',
                39 => 'array_reverse',
                40 => 'array_search',
                41 => 'array_shift',
                42 => 'array_slice',
                43 => 'array_splice',
                44 => 'array_sum',
                45 => 'array_udiff',
                46 => 'array_udiff_assoc',
                47 => 'array_udiff_uassoc',
                48 => 'array_uintersect',
                49 => 'array_uintersect_assoc',
                50 => 'array_uintersect_uassoc',
                51 => 'array_unique',
                52 => 'array_unshift',
                53 => 'array_values',
                54 => 'array_walk',
                55 => 'array_walk_recursive',
                56 => 'arsort',
                57 => 'asin',
                58 => 'asinh',
                59 => 'asort',
                60 => 'atan',
                61 => 'atan2',
                62 => 'atanh',
                63 => 'base64_decode',
                64 => 'base64_encode',
                65 => 'base_convert',
                66 => 'bin2hex',
                67 => 'bindec',
                68 => 'boolval',
                69 => 'cal_days_in_month',
                70 => 'cal_from_jd',
                71 => 'cal_info',
                72 => 'cal_to_jd',
                73 => 'ceil',
                74 => 'checkdate',
                75 => 'chop',
                76 => 'chr',
                77 => 'chunk_split',
                78 => 'compact',
                79 => 'constant',
                80 => 'convert_cyr_string',
                81 => 'convert_uudecode',
                82 => 'convert_uuencode',
                83 => 'cos',
                84 => 'cosh',
                85 => 'count',
                86 => 'count_chars',
                87 => 'crypt',
                88 => 'ctype_alnum',
                89 => 'ctype_alpha',
                90 => 'ctype_cntrl',
                91 => 'ctype_digit',
                92 => 'ctype_graph',
                93 => 'ctype_lower',
                94 => 'ctype_print',
                95 => 'ctype_punct',
                96 => 'ctype_space',
                97 => 'ctype_upper',
                98 => 'ctype_xdigit',
                99 => 'current',
                100 => 'date',
                101 => 'date_add',
                102 => 'date_create',
                103 => 'date_create_from_format',
                104 => 'date_create_immutable',
                105 => 'date_create_immutable_from_format',
                106 => 'date_date_set',
                107 => 'date_default_timezone_get',
                108 => 'date_diff',
                109 => 'date_format',
                110 => 'date_get_last_errors',
                111 => 'date_interval_create_from_date_string',
                112 => 'date_interval_format',
                113 => 'date_modify',
                114 => 'date_offset_get',
                115 => 'date_parse',
                116 => 'date_parse_from_format',
                117 => 'date_sub',
                118 => 'date_sun_info',
                119 => 'date_sunrise',
                120 => 'date_sunset',
                121 => 'date_timestamp_get',
                122 => 'date_timezone_get',
                123 => 'decbin',
                124 => 'dechex',
                125 => 'decoct',
                126 => 'deg2rad',
                127 => 'doubleval',
                128 => 'each',
                129 => 'easter_date',
                130 => 'easter_days',
                131 => 'end',
                132 => 'exp',
                133 => 'explode',
                134 => 'expm1',
                135 => 'empty',
                136 => 'filter_has_var',
                137 => 'filter_id',
                138 => 'filter_input',
                139 => 'filter_input_array',
                140 => 'filter_list',
                141 => 'filter_var',
                142 => 'filter_var_array',
                143 => 'floatval',
                144 => 'floor',
                145 => 'fmod',
                146 => 'frenchtojd',
                147 => 'get_browser',
                148 => 'getdate',
                149 => 'getrandmax',
                150 => 'gettimeofday',
                151 => 'gettype',
                152 => 'gmdate',
                153 => 'gmmktime',
                154 => 'gmstrftime',
                155 => 'gregoriantojd',
                156 => 'hex2bin',
                157 => 'hexdec',
                158 => 'html_entity_decode',
                159 => 'htmlentities',
                160 => 'htmlspecialchars',
                161 => 'htmlspecialchars_decode',
                162 => 'hypot',
                163 => 'iconv',
                164 => 'iconv_get_encoding',
                165 => 'iconv_mime_decode',
                166 => 'iconv_mime_decode_headers',
                167 => 'iconv_mime_encode',
                168 => 'iconv_set_encoding',
                169 => 'iconv_strlen',
                170 => 'iconv_strpos',
                171 => 'iconv_strrpos',
                172 => 'iconv_substr',
                173 => 'idate',
                174 => 'implode',
                175 => 'in_array',
                176 => 'intdiv',
                177 => 'intval',
                178 => 'ip2long',
                179 => 'is_array',
                180 => 'is_a',
                181 => 'isset',
                182 => 'is_bool',
                183 => 'is_double',
                184 => 'is_finite',
                185 => 'is_float',
                186 => 'is_infinite',
                187 => 'is_int',
                188 => 'is_integer',
                189 => 'is_iterable',
                190 => 'is_long',
                191 => 'is_nan',
                192 => 'is_null',
                193 => 'is_numeric',
                194 => 'is_object',
                195 => 'is_string',
                196 => 'iterator_apply',
                197 => 'iterator_count',
                198 => 'iterator_to_array',
                199 => 'jddayofweek',
                200 => 'jdmonthname',
                201 => 'jdtofrench',
                202 => 'jdtogregorian',
                203 => 'jdtojewish',
                204 => 'jdtojulian',
                205 => 'jdtounix',
                206 => 'jewishtojd',
                207 => 'join',
                208 => 'json_decode',
                209 => 'json_encode',
                210 => 'json_last_error',
                211 => 'json_last_error_msg',
                212 => 'juliantojd',
                213 => 'key',
                214 => 'key_exists',
                215 => 'ksort',
                216 => 'lcfirst',
                217 => 'levenshtein',
                218 => 'localtime',
                219 => 'log',
                220 => 'log10',
                221 => 'log1p',
                222 => 'long2ip',
                223 => 'ltrim',
                224 => 'max',
                225 => 'md5',
                226 => 'mhash',
                227 => 'mhash_count',
                228 => 'mhash_get_block_size',
                229 => 'mhash_get_hash_name',
                230 => 'mhash_keygen_s2k',
                231 => 'microtime',
                232 => 'min',
                233 => 'mktime',
                234 => 'money_format',
                235 => 'mt_getrandmax',
                236 => 'mt_rand',
                237 => 'mt_srand',
                238 => 'natcasesort',
                239 => 'natsort',
                240 => 'next',
                241 => 'nl2br',
                242 => 'number_format',
                243 => 'octdec',
                244 => 'ord',
                245 => 'parse_str',
                246 => 'parse_url',
                247 => 'php_strip_whitespace',
                248 => 'pi',
                249 => 'pos',
                250 => 'pow',
                251 => 'prev',
                252 => 'printf',
                253 => 'print_r',
                254 => 'rad2deg',
                255 => 'rand',
                256 => 'random_bytes',
                257 => 'random_int',
                258 => 'range',
                259 => 'rawurldecode',
                260 => 'rawurlencode',
                261 => 'reset',
                262 => 'round',
                263 => 'rsort',
                264 => 'rtrim',
                265 => 'serialize',
                266 => 'sha1',
                267 => 'shuffle',
                268 => 'similar_text',
                269 => 'sin',
                270 => 'sinh',
                271 => 'sizeof',
                272 => 'sort',
                273 => 'soundex',
                274 => 'sprintf',
                275 => 'sqrt',
                276 => 'srand',
                277 => 'str_ireplace',
                278 => 'str_pad',
                279 => 'str_repeat',
                280 => 'str_replace',
                281 => 'str_rot13',
                282 => 'str_shuffle',
                283 => 'str_split',
                284 => 'str_word_count',
                285 => 'strcasecmp',
                286 => 'strchr',
                287 => 'strcmp',
                288 => 'strcoll',
                289 => 'strcspn',
                290 => 'strftime',
                291 => 'strip_tags',
                292 => 'stripcslashes',
                293 => 'stripos',
                294 => 'stripslashes',
                295 => 'stristr',
                296 => 'strlen',
                297 => 'strnatcasecmp',
                298 => 'strnatcmp',
                299 => 'strncasecmp',
                300 => 'strncmp',
                301 => 'strpbrk',
                302 => 'strpos',
                303 => 'strptime',
                304 => 'strrchr',
                305 => 'strrev',
                306 => 'strripos',
                307 => 'strrpos',
                308 => 'strspn',
                309 => 'strstr',
                310 => 'strtok',
                311 => 'strtolower',
                312 => 'strtotime',
                313 => 'strtoupper',
                314 => 'strtr',
                315 => 'strval',
                316 => 'substr',
                317 => 'substr_compare',
                318 => 'substr_count',
                319 => 'substr_replace',
                320 => 'tan',
                321 => 'tanh',
                322 => 'time',
                323 => 'trim',
                324 => 'uasort',
                325 => 'ucfirst',
                326 => 'ucwords',
                327 => 'uksort',
                328 => 'uniqid',
                329 => 'unixtojd',
                330 => 'unserialize',
                331 => 'urldecode',
                332 => 'urlencode',
                333 => 'usort',
                334 => 'utf8_decode',
                335 => 'utf8_encode',
                336 => 'var_dump',
                337 => 'version_compare',
                338 => 'wordwrap',
            ),
            'shopware.template_security.php_functions.0' => 'abs',
            'shopware.template_security.php_functions.1' => 'acos',
            'shopware.template_security.php_functions.2' => 'acosh',
            'shopware.template_security.php_functions.3' => 'addcslashes',
            'shopware.template_security.php_functions.4' => 'addslashes',
            'shopware.template_security.php_functions.5' => 'array',
            'shopware.template_security.php_functions.6' => 'array_change_key_case',
            'shopware.template_security.php_functions.7' => 'array_chunk',
            'shopware.template_security.php_functions.8' => 'array_column',
            'shopware.template_security.php_functions.9' => 'array_combine',
            'shopware.template_security.php_functions.10' => 'array_count_values',
            'shopware.template_security.php_functions.11' => 'array_diff',
            'shopware.template_security.php_functions.12' => 'array_diff_assoc',
            'shopware.template_security.php_functions.13' => 'array_diff_key',
            'shopware.template_security.php_functions.14' => 'array_diff_uassoc',
            'shopware.template_security.php_functions.15' => 'array_diff_ukey',
            'shopware.template_security.php_functions.16' => 'array_fill',
            'shopware.template_security.php_functions.17' => 'array_fill_keys',
            'shopware.template_security.php_functions.18' => 'array_filter',
            'shopware.template_security.php_functions.19' => 'array_flip',
            'shopware.template_security.php_functions.20' => 'array_intersect',
            'shopware.template_security.php_functions.21' => 'array_intersect_assoc',
            'shopware.template_security.php_functions.22' => 'array_intersect_key',
            'shopware.template_security.php_functions.23' => 'array_intersect_uassoc',
            'shopware.template_security.php_functions.24' => 'array_intersect_ukey',
            'shopware.template_security.php_functions.25' => 'array_key_exists',
            'shopware.template_security.php_functions.26' => 'array_keys',
            'shopware.template_security.php_functions.27' => 'array_map',
            'shopware.template_security.php_functions.28' => 'array_merge',
            'shopware.template_security.php_functions.29' => 'array_merge_recursive',
            'shopware.template_security.php_functions.30' => 'array_multisort',
            'shopware.template_security.php_functions.31' => 'array_pad',
            'shopware.template_security.php_functions.32' => 'array_pop',
            'shopware.template_security.php_functions.33' => 'array_product',
            'shopware.template_security.php_functions.34' => 'array_push',
            'shopware.template_security.php_functions.35' => 'array_rand',
            'shopware.template_security.php_functions.36' => 'array_reduce',
            'shopware.template_security.php_functions.37' => 'array_replace',
            'shopware.template_security.php_functions.38' => 'array_replace_recursive',
            'shopware.template_security.php_functions.39' => 'array_reverse',
            'shopware.template_security.php_functions.40' => 'array_search',
            'shopware.template_security.php_functions.41' => 'array_shift',
            'shopware.template_security.php_functions.42' => 'array_slice',
            'shopware.template_security.php_functions.43' => 'array_splice',
            'shopware.template_security.php_functions.44' => 'array_sum',
            'shopware.template_security.php_functions.45' => 'array_udiff',
            'shopware.template_security.php_functions.46' => 'array_udiff_assoc',
            'shopware.template_security.php_functions.47' => 'array_udiff_uassoc',
            'shopware.template_security.php_functions.48' => 'array_uintersect',
            'shopware.template_security.php_functions.49' => 'array_uintersect_assoc',
            'shopware.template_security.php_functions.50' => 'array_uintersect_uassoc',
            'shopware.template_security.php_functions.51' => 'array_unique',
            'shopware.template_security.php_functions.52' => 'array_unshift',
            'shopware.template_security.php_functions.53' => 'array_values',
            'shopware.template_security.php_functions.54' => 'array_walk',
            'shopware.template_security.php_functions.55' => 'array_walk_recursive',
            'shopware.template_security.php_functions.56' => 'arsort',
            'shopware.template_security.php_functions.57' => 'asin',
            'shopware.template_security.php_functions.58' => 'asinh',
            'shopware.template_security.php_functions.59' => 'asort',
            'shopware.template_security.php_functions.60' => 'atan',
            'shopware.template_security.php_functions.61' => 'atan2',
            'shopware.template_security.php_functions.62' => 'atanh',
            'shopware.template_security.php_functions.63' => 'base64_decode',
            'shopware.template_security.php_functions.64' => 'base64_encode',
            'shopware.template_security.php_functions.65' => 'base_convert',
            'shopware.template_security.php_functions.66' => 'bin2hex',
            'shopware.template_security.php_functions.67' => 'bindec',
            'shopware.template_security.php_functions.68' => 'boolval',
            'shopware.template_security.php_functions.69' => 'cal_days_in_month',
            'shopware.template_security.php_functions.70' => 'cal_from_jd',
            'shopware.template_security.php_functions.71' => 'cal_info',
            'shopware.template_security.php_functions.72' => 'cal_to_jd',
            'shopware.template_security.php_functions.73' => 'ceil',
            'shopware.template_security.php_functions.74' => 'checkdate',
            'shopware.template_security.php_functions.75' => 'chop',
            'shopware.template_security.php_functions.76' => 'chr',
            'shopware.template_security.php_functions.77' => 'chunk_split',
            'shopware.template_security.php_functions.78' => 'compact',
            'shopware.template_security.php_functions.79' => 'constant',
            'shopware.template_security.php_functions.80' => 'convert_cyr_string',
            'shopware.template_security.php_functions.81' => 'convert_uudecode',
            'shopware.template_security.php_functions.82' => 'convert_uuencode',
            'shopware.template_security.php_functions.83' => 'cos',
            'shopware.template_security.php_functions.84' => 'cosh',
            'shopware.template_security.php_functions.85' => 'count',
            'shopware.template_security.php_functions.86' => 'count_chars',
            'shopware.template_security.php_functions.87' => 'crypt',
            'shopware.template_security.php_functions.88' => 'ctype_alnum',
            'shopware.template_security.php_functions.89' => 'ctype_alpha',
            'shopware.template_security.php_functions.90' => 'ctype_cntrl',
            'shopware.template_security.php_functions.91' => 'ctype_digit',
            'shopware.template_security.php_functions.92' => 'ctype_graph',
            'shopware.template_security.php_functions.93' => 'ctype_lower',
            'shopware.template_security.php_functions.94' => 'ctype_print',
            'shopware.template_security.php_functions.95' => 'ctype_punct',
            'shopware.template_security.php_functions.96' => 'ctype_space',
            'shopware.template_security.php_functions.97' => 'ctype_upper',
            'shopware.template_security.php_functions.98' => 'ctype_xdigit',
            'shopware.template_security.php_functions.99' => 'current',
            'shopware.template_security.php_functions.100' => 'date',
            'shopware.template_security.php_functions.101' => 'date_add',
            'shopware.template_security.php_functions.102' => 'date_create',
            'shopware.template_security.php_functions.103' => 'date_create_from_format',
            'shopware.template_security.php_functions.104' => 'date_create_immutable',
            'shopware.template_security.php_functions.105' => 'date_create_immutable_from_format',
            'shopware.template_security.php_functions.106' => 'date_date_set',
            'shopware.template_security.php_functions.107' => 'date_default_timezone_get',
            'shopware.template_security.php_functions.108' => 'date_diff',
            'shopware.template_security.php_functions.109' => 'date_format',
            'shopware.template_security.php_functions.110' => 'date_get_last_errors',
            'shopware.template_security.php_functions.111' => 'date_interval_create_from_date_string',
            'shopware.template_security.php_functions.112' => 'date_interval_format',
            'shopware.template_security.php_functions.113' => 'date_modify',
            'shopware.template_security.php_functions.114' => 'date_offset_get',
            'shopware.template_security.php_functions.115' => 'date_parse',
            'shopware.template_security.php_functions.116' => 'date_parse_from_format',
            'shopware.template_security.php_functions.117' => 'date_sub',
            'shopware.template_security.php_functions.118' => 'date_sun_info',
            'shopware.template_security.php_functions.119' => 'date_sunrise',
            'shopware.template_security.php_functions.120' => 'date_sunset',
            'shopware.template_security.php_functions.121' => 'date_timestamp_get',
            'shopware.template_security.php_functions.122' => 'date_timezone_get',
            'shopware.template_security.php_functions.123' => 'decbin',
            'shopware.template_security.php_functions.124' => 'dechex',
            'shopware.template_security.php_functions.125' => 'decoct',
            'shopware.template_security.php_functions.126' => 'deg2rad',
            'shopware.template_security.php_functions.127' => 'doubleval',
            'shopware.template_security.php_functions.128' => 'each',
            'shopware.template_security.php_functions.129' => 'easter_date',
            'shopware.template_security.php_functions.130' => 'easter_days',
            'shopware.template_security.php_functions.131' => 'end',
            'shopware.template_security.php_functions.132' => 'exp',
            'shopware.template_security.php_functions.133' => 'explode',
            'shopware.template_security.php_functions.134' => 'expm1',
            'shopware.template_security.php_functions.135' => 'empty',
            'shopware.template_security.php_functions.136' => 'filter_has_var',
            'shopware.template_security.php_functions.137' => 'filter_id',
            'shopware.template_security.php_functions.138' => 'filter_input',
            'shopware.template_security.php_functions.139' => 'filter_input_array',
            'shopware.template_security.php_functions.140' => 'filter_list',
            'shopware.template_security.php_functions.141' => 'filter_var',
            'shopware.template_security.php_functions.142' => 'filter_var_array',
            'shopware.template_security.php_functions.143' => 'floatval',
            'shopware.template_security.php_functions.144' => 'floor',
            'shopware.template_security.php_functions.145' => 'fmod',
            'shopware.template_security.php_functions.146' => 'frenchtojd',
            'shopware.template_security.php_functions.147' => 'get_browser',
            'shopware.template_security.php_functions.148' => 'getdate',
            'shopware.template_security.php_functions.149' => 'getrandmax',
            'shopware.template_security.php_functions.150' => 'gettimeofday',
            'shopware.template_security.php_functions.151' => 'gettype',
            'shopware.template_security.php_functions.152' => 'gmdate',
            'shopware.template_security.php_functions.153' => 'gmmktime',
            'shopware.template_security.php_functions.154' => 'gmstrftime',
            'shopware.template_security.php_functions.155' => 'gregoriantojd',
            'shopware.template_security.php_functions.156' => 'hex2bin',
            'shopware.template_security.php_functions.157' => 'hexdec',
            'shopware.template_security.php_functions.158' => 'html_entity_decode',
            'shopware.template_security.php_functions.159' => 'htmlentities',
            'shopware.template_security.php_functions.160' => 'htmlspecialchars',
            'shopware.template_security.php_functions.161' => 'htmlspecialchars_decode',
            'shopware.template_security.php_functions.162' => 'hypot',
            'shopware.template_security.php_functions.163' => 'iconv',
            'shopware.template_security.php_functions.164' => 'iconv_get_encoding',
            'shopware.template_security.php_functions.165' => 'iconv_mime_decode',
            'shopware.template_security.php_functions.166' => 'iconv_mime_decode_headers',
            'shopware.template_security.php_functions.167' => 'iconv_mime_encode',
            'shopware.template_security.php_functions.168' => 'iconv_set_encoding',
            'shopware.template_security.php_functions.169' => 'iconv_strlen',
            'shopware.template_security.php_functions.170' => 'iconv_strpos',
            'shopware.template_security.php_functions.171' => 'iconv_strrpos',
            'shopware.template_security.php_functions.172' => 'iconv_substr',
            'shopware.template_security.php_functions.173' => 'idate',
            'shopware.template_security.php_functions.174' => 'implode',
            'shopware.template_security.php_functions.175' => 'in_array',
            'shopware.template_security.php_functions.176' => 'intdiv',
            'shopware.template_security.php_functions.177' => 'intval',
            'shopware.template_security.php_functions.178' => 'ip2long',
            'shopware.template_security.php_functions.179' => 'is_array',
            'shopware.template_security.php_functions.180' => 'is_a',
            'shopware.template_security.php_functions.181' => 'isset',
            'shopware.template_security.php_functions.182' => 'is_bool',
            'shopware.template_security.php_functions.183' => 'is_double',
            'shopware.template_security.php_functions.184' => 'is_finite',
            'shopware.template_security.php_functions.185' => 'is_float',
            'shopware.template_security.php_functions.186' => 'is_infinite',
            'shopware.template_security.php_functions.187' => 'is_int',
            'shopware.template_security.php_functions.188' => 'is_integer',
            'shopware.template_security.php_functions.189' => 'is_iterable',
            'shopware.template_security.php_functions.190' => 'is_long',
            'shopware.template_security.php_functions.191' => 'is_nan',
            'shopware.template_security.php_functions.192' => 'is_null',
            'shopware.template_security.php_functions.193' => 'is_numeric',
            'shopware.template_security.php_functions.194' => 'is_object',
            'shopware.template_security.php_functions.195' => 'is_string',
            'shopware.template_security.php_functions.196' => 'iterator_apply',
            'shopware.template_security.php_functions.197' => 'iterator_count',
            'shopware.template_security.php_functions.198' => 'iterator_to_array',
            'shopware.template_security.php_functions.199' => 'jddayofweek',
            'shopware.template_security.php_functions.200' => 'jdmonthname',
            'shopware.template_security.php_functions.201' => 'jdtofrench',
            'shopware.template_security.php_functions.202' => 'jdtogregorian',
            'shopware.template_security.php_functions.203' => 'jdtojewish',
            'shopware.template_security.php_functions.204' => 'jdtojulian',
            'shopware.template_security.php_functions.205' => 'jdtounix',
            'shopware.template_security.php_functions.206' => 'jewishtojd',
            'shopware.template_security.php_functions.207' => 'join',
            'shopware.template_security.php_functions.208' => 'json_decode',
            'shopware.template_security.php_functions.209' => 'json_encode',
            'shopware.template_security.php_functions.210' => 'json_last_error',
            'shopware.template_security.php_functions.211' => 'json_last_error_msg',
            'shopware.template_security.php_functions.212' => 'juliantojd',
            'shopware.template_security.php_functions.213' => 'key',
            'shopware.template_security.php_functions.214' => 'key_exists',
            'shopware.template_security.php_functions.215' => 'ksort',
            'shopware.template_security.php_functions.216' => 'lcfirst',
            'shopware.template_security.php_functions.217' => 'levenshtein',
            'shopware.template_security.php_functions.218' => 'localtime',
            'shopware.template_security.php_functions.219' => 'log',
            'shopware.template_security.php_functions.220' => 'log10',
            'shopware.template_security.php_functions.221' => 'log1p',
            'shopware.template_security.php_functions.222' => 'long2ip',
            'shopware.template_security.php_functions.223' => 'ltrim',
            'shopware.template_security.php_functions.224' => 'max',
            'shopware.template_security.php_functions.225' => 'md5',
            'shopware.template_security.php_functions.226' => 'mhash',
            'shopware.template_security.php_functions.227' => 'mhash_count',
            'shopware.template_security.php_functions.228' => 'mhash_get_block_size',
            'shopware.template_security.php_functions.229' => 'mhash_get_hash_name',
            'shopware.template_security.php_functions.230' => 'mhash_keygen_s2k',
            'shopware.template_security.php_functions.231' => 'microtime',
            'shopware.template_security.php_functions.232' => 'min',
            'shopware.template_security.php_functions.233' => 'mktime',
            'shopware.template_security.php_functions.234' => 'money_format',
            'shopware.template_security.php_functions.235' => 'mt_getrandmax',
            'shopware.template_security.php_functions.236' => 'mt_rand',
            'shopware.template_security.php_functions.237' => 'mt_srand',
            'shopware.template_security.php_functions.238' => 'natcasesort',
            'shopware.template_security.php_functions.239' => 'natsort',
            'shopware.template_security.php_functions.240' => 'next',
            'shopware.template_security.php_functions.241' => 'nl2br',
            'shopware.template_security.php_functions.242' => 'number_format',
            'shopware.template_security.php_functions.243' => 'octdec',
            'shopware.template_security.php_functions.244' => 'ord',
            'shopware.template_security.php_functions.245' => 'parse_str',
            'shopware.template_security.php_functions.246' => 'parse_url',
            'shopware.template_security.php_functions.247' => 'php_strip_whitespace',
            'shopware.template_security.php_functions.248' => 'pi',
            'shopware.template_security.php_functions.249' => 'pos',
            'shopware.template_security.php_functions.250' => 'pow',
            'shopware.template_security.php_functions.251' => 'prev',
            'shopware.template_security.php_functions.252' => 'printf',
            'shopware.template_security.php_functions.253' => 'print_r',
            'shopware.template_security.php_functions.254' => 'rad2deg',
            'shopware.template_security.php_functions.255' => 'rand',
            'shopware.template_security.php_functions.256' => 'random_bytes',
            'shopware.template_security.php_functions.257' => 'random_int',
            'shopware.template_security.php_functions.258' => 'range',
            'shopware.template_security.php_functions.259' => 'rawurldecode',
            'shopware.template_security.php_functions.260' => 'rawurlencode',
            'shopware.template_security.php_functions.261' => 'reset',
            'shopware.template_security.php_functions.262' => 'round',
            'shopware.template_security.php_functions.263' => 'rsort',
            'shopware.template_security.php_functions.264' => 'rtrim',
            'shopware.template_security.php_functions.265' => 'serialize',
            'shopware.template_security.php_functions.266' => 'sha1',
            'shopware.template_security.php_functions.267' => 'shuffle',
            'shopware.template_security.php_functions.268' => 'similar_text',
            'shopware.template_security.php_functions.269' => 'sin',
            'shopware.template_security.php_functions.270' => 'sinh',
            'shopware.template_security.php_functions.271' => 'sizeof',
            'shopware.template_security.php_functions.272' => 'sort',
            'shopware.template_security.php_functions.273' => 'soundex',
            'shopware.template_security.php_functions.274' => 'sprintf',
            'shopware.template_security.php_functions.275' => 'sqrt',
            'shopware.template_security.php_functions.276' => 'srand',
            'shopware.template_security.php_functions.277' => 'str_ireplace',
            'shopware.template_security.php_functions.278' => 'str_pad',
            'shopware.template_security.php_functions.279' => 'str_repeat',
            'shopware.template_security.php_functions.280' => 'str_replace',
            'shopware.template_security.php_functions.281' => 'str_rot13',
            'shopware.template_security.php_functions.282' => 'str_shuffle',
            'shopware.template_security.php_functions.283' => 'str_split',
            'shopware.template_security.php_functions.284' => 'str_word_count',
            'shopware.template_security.php_functions.285' => 'strcasecmp',
            'shopware.template_security.php_functions.286' => 'strchr',
            'shopware.template_security.php_functions.287' => 'strcmp',
            'shopware.template_security.php_functions.288' => 'strcoll',
            'shopware.template_security.php_functions.289' => 'strcspn',
            'shopware.template_security.php_functions.290' => 'strftime',
            'shopware.template_security.php_functions.291' => 'strip_tags',
            'shopware.template_security.php_functions.292' => 'stripcslashes',
            'shopware.template_security.php_functions.293' => 'stripos',
            'shopware.template_security.php_functions.294' => 'stripslashes',
            'shopware.template_security.php_functions.295' => 'stristr',
            'shopware.template_security.php_functions.296' => 'strlen',
            'shopware.template_security.php_functions.297' => 'strnatcasecmp',
            'shopware.template_security.php_functions.298' => 'strnatcmp',
            'shopware.template_security.php_functions.299' => 'strncasecmp',
            'shopware.template_security.php_functions.300' => 'strncmp',
            'shopware.template_security.php_functions.301' => 'strpbrk',
            'shopware.template_security.php_functions.302' => 'strpos',
            'shopware.template_security.php_functions.303' => 'strptime',
            'shopware.template_security.php_functions.304' => 'strrchr',
            'shopware.template_security.php_functions.305' => 'strrev',
            'shopware.template_security.php_functions.306' => 'strripos',
            'shopware.template_security.php_functions.307' => 'strrpos',
            'shopware.template_security.php_functions.308' => 'strspn',
            'shopware.template_security.php_functions.309' => 'strstr',
            'shopware.template_security.php_functions.310' => 'strtok',
            'shopware.template_security.php_functions.311' => 'strtolower',
            'shopware.template_security.php_functions.312' => 'strtotime',
            'shopware.template_security.php_functions.313' => 'strtoupper',
            'shopware.template_security.php_functions.314' => 'strtr',
            'shopware.template_security.php_functions.315' => 'strval',
            'shopware.template_security.php_functions.316' => 'substr',
            'shopware.template_security.php_functions.317' => 'substr_compare',
            'shopware.template_security.php_functions.318' => 'substr_count',
            'shopware.template_security.php_functions.319' => 'substr_replace',
            'shopware.template_security.php_functions.320' => 'tan',
            'shopware.template_security.php_functions.321' => 'tanh',
            'shopware.template_security.php_functions.322' => 'time',
            'shopware.template_security.php_functions.323' => 'trim',
            'shopware.template_security.php_functions.324' => 'uasort',
            'shopware.template_security.php_functions.325' => 'ucfirst',
            'shopware.template_security.php_functions.326' => 'ucwords',
            'shopware.template_security.php_functions.327' => 'uksort',
            'shopware.template_security.php_functions.328' => 'uniqid',
            'shopware.template_security.php_functions.329' => 'unixtojd',
            'shopware.template_security.php_functions.330' => 'unserialize',
            'shopware.template_security.php_functions.331' => 'urldecode',
            'shopware.template_security.php_functions.332' => 'urlencode',
            'shopware.template_security.php_functions.333' => 'usort',
            'shopware.template_security.php_functions.334' => 'utf8_decode',
            'shopware.template_security.php_functions.335' => 'utf8_encode',
            'shopware.template_security.php_functions.336' => 'var_dump',
            'shopware.template_security.php_functions.337' => 'version_compare',
            'shopware.template_security.php_functions.338' => 'wordwrap',
            'active_plugins' => array(
                'ErrorHandler' => '1',
                'Router' => '1',
                'System' => '1',
                'ViewportForward' => '1',
                'Shop' => '1',
                'PostFilter' => '1',
                'ControllerBase' => '1',
                'RouterRewrite' => '1',
                'Seo' => '1',
                'Statistics' => '1',
                'InputFilter' => '1',
                'Auth' => '1',
                'Menu' => '1',
                'Check' => '1.0.0',
                'Locale' => '1.0.0',
                'RestApi' => '1.0.0',
                'PasswordEncoder' => '1.0.0',
                'MarketingAggregate' => '1.0.0',
                'RebuildIndex' => '1.0.0',
                'PaymentMethods' => '1.0.1',
                'SwagUpdate' => '1.0.0',
                'PluginManager' => '1.0.0',
                'SwagDemoDataDE' => '5.2.0',
                'ViisonPickwareERP' => '3.2.51',
            ),
            'console.command.ids' => array(
                0 => 'customer_search.dbal.search_index_populate_command',
            ),
        );
    }
}
