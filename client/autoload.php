<?php
// This file is generated by build/generateAutoload.php, do not adjust manually
// phpcs:disable Generic.Files.LineLength
global $wgAutoloadClasses;

$wgAutoloadClasses += [
	'Wikibase\\ClientHooks' => __DIR__ . '/ClientHooks.php',
	'Wikibase\\Client\\Api\\ApiClientInfo' => __DIR__ . '/includes/Api/ApiClientInfo.php',
	'Wikibase\\Client\\Api\\ApiListEntityUsage' => __DIR__ . '/includes/Api/ApiListEntityUsage.php',
	'Wikibase\\Client\\Api\\ApiPropsEntityUsage' => __DIR__ . '/includes/Api/ApiPropsEntityUsage.php',
	'Wikibase\\Client\\Api\\Description' => __DIR__ . '/includes/Api/Description.php',
	'Wikibase\\Client\\Api\\PageTerms' => __DIR__ . '/includes/Api/PageTerms.php',
	'Wikibase\\Client\\CachingOtherProjectsSitesProvider' => __DIR__ . '/includes/CachingOtherProjectsSitesProvider.php',
	'Wikibase\\Client\\ChangeNotificationJob' => __DIR__ . '/includes/ChangeNotificationJob.php',
	'Wikibase\\Client\\Changes\\AffectedPagesFinder' => __DIR__ . '/includes/Changes/AffectedPagesFinder.php',
	'Wikibase\\Client\\Changes\\ChangeHandler' => __DIR__ . '/includes/Changes/ChangeHandler.php',
	'Wikibase\\Client\\Changes\\ChangeRunCoalescer' => __DIR__ . '/includes/Changes/ChangeRunCoalescer.php',
	'Wikibase\\Client\\Changes\\InjectRCRecordsJob' => __DIR__ . '/includes/Changes/InjectRCRecordsJob.php',
	'Wikibase\\Client\\Changes\\PageUpdater' => __DIR__ . '/includes/Changes/PageUpdater.php',
	'Wikibase\\Client\\Changes\\WikiPageUpdater' => __DIR__ . '/includes/Changes/WikiPageUpdater.php',
	'Wikibase\\Client\\DataAccess\\ClientSiteLinkTitleLookup' => __DIR__ . '/includes/DataAccess/ClientSiteLinkTitleLookup.php',
	'Wikibase\\Client\\DataAccess\\DataAccessSnakFormatterFactory' => __DIR__ . '/includes/DataAccess/DataAccessSnakFormatterFactory.php',
	'Wikibase\\Client\\DataAccess\\ParserFunctions\\LanguageAwareRenderer' => __DIR__ . '/includes/DataAccess/ParserFunctions/LanguageAwareRenderer.php',
	'Wikibase\\Client\\DataAccess\\ParserFunctions\\Runner' => __DIR__ . '/includes/DataAccess/ParserFunctions/Runner.php',
	'Wikibase\\Client\\DataAccess\\ParserFunctions\\StatementGroupRenderer' => __DIR__ . '/includes/DataAccess/ParserFunctions/StatementGroupRenderer.php',
	'Wikibase\\Client\\DataAccess\\ParserFunctions\\StatementGroupRendererFactory' => __DIR__ . '/includes/DataAccess/ParserFunctions/StatementGroupRendererFactory.php',
	'Wikibase\\Client\\DataAccess\\ParserFunctions\\VariantsAwareRenderer' => __DIR__ . '/includes/DataAccess/ParserFunctions/VariantsAwareRenderer.php',
	'Wikibase\\Client\\DataAccess\\PropertyIdResolver' => __DIR__ . '/includes/DataAccess/PropertyIdResolver.php',
	'Wikibase\\Client\\DataAccess\\Scribunto\\EntityAccessor' => __DIR__ . '/includes/DataAccess/Scribunto/EntityAccessor.php',
	'Wikibase\\Client\\DataAccess\\Scribunto\\Scribunto_LuaWikibaseEntityLibrary' => __DIR__ . '/includes/DataAccess/Scribunto/Scribunto_LuaWikibaseEntityLibrary.php',
	'Wikibase\\Client\\DataAccess\\Scribunto\\Scribunto_LuaWikibaseLibrary' => __DIR__ . '/includes/DataAccess/Scribunto/Scribunto_LuaWikibaseLibrary.php',
	'Wikibase\\Client\\DataAccess\\Scribunto\\SnakSerializationRenderer' => __DIR__ . '/includes/DataAccess/Scribunto/SnakSerializationRenderer.php',
	'Wikibase\\Client\\DataAccess\\Scribunto\\WikibaseLanguageDependentLuaBindings' => __DIR__ . '/includes/DataAccess/Scribunto/WikibaseLanguageDependentLuaBindings.php',
	'Wikibase\\Client\\DataAccess\\Scribunto\\WikibaseLanguageIndependentLuaBindings' => __DIR__ . '/includes/DataAccess/Scribunto/WikibaseLanguageIndependentLuaBindings.php',
	'Wikibase\\Client\\DataAccess\\Scribunto\\WikibaseLuaEntityBindings' => __DIR__ . '/includes/DataAccess/Scribunto/WikibaseLuaEntityBindings.php',
	'Wikibase\\Client\\DataAccess\\SnaksFinder' => __DIR__ . '/includes/DataAccess/SnaksFinder.php',
	'Wikibase\\Client\\DataAccess\\StatementTransclusionInteractor' => __DIR__ . '/includes/DataAccess/StatementTransclusionInteractor.php',
	'Wikibase\\Client\\Hooks\\BaseTemplateAfterPortletHandler' => __DIR__ . '/includes/Hooks/BaseTemplateAfterPortletHandler.php',
	'Wikibase\\Client\\Hooks\\BeforePageDisplayHandler' => __DIR__ . '/includes/Hooks/BeforePageDisplayHandler.php',
	'Wikibase\\Client\\Hooks\\ChangesListLinesHandler' => __DIR__ . '/includes/Hooks/ChangesListLinesHandler.php',
	'Wikibase\\Client\\Hooks\\ChangesListSpecialPageHookHandlers' => __DIR__ . '/includes/Hooks/ChangesListSpecialPageHookHandlers.php',
	'Wikibase\\Client\\Hooks\\DataUpdateHookHandlers' => __DIR__ . '/includes/Hooks/DataUpdateHookHandlers.php',
	'Wikibase\\Client\\Hooks\\DeletePageNoticeCreator' => __DIR__ . '/includes/Hooks/DeletePageNoticeCreator.php',
	'Wikibase\\Client\\Hooks\\EchoNotificationsHandlers' => __DIR__ . '/includes/Hooks/EchoNotificationsHandlers.php',
	'Wikibase\\Client\\Hooks\\EchoSetupHookHandlers' => __DIR__ . '/includes/Hooks/EchoSetupHookHandlers.php',
	'Wikibase\\Client\\Hooks\\EditActionHookHandler' => __DIR__ . '/includes/Hooks/EditActionHookHandler.php',
	'Wikibase\\Client\\Hooks\\InfoActionHookHandler' => __DIR__ . '/includes/Hooks/InfoActionHookHandler.php',
	'Wikibase\\Client\\Hooks\\LanguageLinkBadgeDisplay' => __DIR__ . '/includes/Hooks/LanguageLinkBadgeDisplay.php',
	'Wikibase\\Client\\Hooks\\MagicWordHookHandlers' => __DIR__ . '/includes/Hooks/MagicWordHookHandlers.php',
	'Wikibase\\Client\\Hooks\\MovePageNotice' => __DIR__ . '/includes/Hooks/MovePageNotice.php',
	'Wikibase\\Client\\Hooks\\NoLangLinkHandler' => __DIR__ . '/includes/Hooks/NoLangLinkHandler.php',
	'Wikibase\\Client\\Hooks\\OtherProjectsSidebarGenerator' => __DIR__ . '/includes/Hooks/OtherProjectsSidebarGenerator.php',
	'Wikibase\\Client\\Hooks\\OtherProjectsSidebarGeneratorFactory' => __DIR__ . '/includes/Hooks/OtherProjectsSidebarGeneratorFactory.php',
	'Wikibase\\Client\\Hooks\\ParserClearStateHookHandler' => __DIR__ . '/includes/Hooks/ParserClearStateHookHandler.php',
	'Wikibase\\Client\\Hooks\\ParserFunctionRegistrant' => __DIR__ . '/includes/Hooks/ParserFunctionRegistrant.php',
	'Wikibase\\Client\\Hooks\\ParserLimitReportPrepareHookHandler' => __DIR__ . '/includes/Hooks/ParserLimitReportPrepareHookHandler.php',
	'Wikibase\\Client\\Hooks\\ParserOutputUpdateHookHandlers' => __DIR__ . '/includes/Hooks/ParserOutputUpdateHookHandlers.php',
	'Wikibase\\Client\\Hooks\\ShortDescHandler' => __DIR__ . '/includes/Hooks/ShortDescHandler.php',
	'Wikibase\\Client\\Hooks\\SidebarHookHandlers' => __DIR__ . '/includes/Hooks/SidebarHookHandlers.php',
	'Wikibase\\Client\\Hooks\\SidebarLinkBadgeDisplay' => __DIR__ . '/includes/Hooks/SidebarLinkBadgeDisplay.php',
	'Wikibase\\Client\\Hooks\\SkinAfterBottomScriptsHandler' => __DIR__ . '/includes/Hooks/SkinAfterBottomScriptsHandler.php',
	'Wikibase\\Client\\Hooks\\SkinTemplateOutputPageBeforeExecHandler' => __DIR__ . '/includes/Hooks/SkinTemplateOutputPageBeforeExecHandler.php',
	'Wikibase\\Client\\Hooks\\UpdateRepoHookHandlers' => __DIR__ . '/includes/Hooks/UpdateRepoHookHandlers.php',
	'Wikibase\\Client\\LangLinkHandler' => __DIR__ . '/includes/LangLinkHandler.php',
	'Wikibase\\Client\\Modules\\SiteModule' => __DIR__ . '/includes/Modules/SiteModule.php',
	'Wikibase\\Client\\MoreLikeWikibase' => __DIR__ . '/includes/MoreLikeWikibase.php',
	'Wikibase\\Client\\NamespaceChecker' => __DIR__ . '/includes/NamespaceChecker.php',
	'Wikibase\\Client\\Notifications\\PageConnectionPresentationModel' => __DIR__ . '/includes/Notifications/PageConnectionPresentationModel.php',
	'Wikibase\\Client\\OtherProjectsSitesGenerator' => __DIR__ . '/includes/OtherProjectsSitesGenerator.php',
	'Wikibase\\Client\\OtherProjectsSitesProvider' => __DIR__ . '/includes/OtherProjectsSitesProvider.php',
	'Wikibase\\Client\\ParserOutput\\ClientParserOutputDataUpdater' => __DIR__ . '/includes/ParserOutput/ClientParserOutputDataUpdater.php',
	'Wikibase\\Client\\PropertyLabelNotResolvedException' => __DIR__ . '/includes/PropertyLabelNotResolvedException.php',
	'Wikibase\\Client\\RecentChanges\\ChangeLineFormatter' => __DIR__ . '/includes/RecentChanges/ChangeLineFormatter.php',
	'Wikibase\\Client\\RecentChanges\\ExternalChange' => __DIR__ . '/includes/RecentChanges/ExternalChange.php',
	'Wikibase\\Client\\RecentChanges\\ExternalChangeFactory' => __DIR__ . '/includes/RecentChanges/ExternalChangeFactory.php',
	'Wikibase\\Client\\RecentChanges\\RecentChangeFactory' => __DIR__ . '/includes/RecentChanges/RecentChangeFactory.php',
	'Wikibase\\Client\\RecentChanges\\RecentChangesDuplicateDetector' => __DIR__ . '/includes/RecentChanges/RecentChangesDuplicateDetector.php',
	'Wikibase\\Client\\RecentChanges\\RevisionData' => __DIR__ . '/includes/RecentChanges/RevisionData.php',
	'Wikibase\\Client\\RecentChanges\\SiteLinkCommentCreator' => __DIR__ . '/includes/RecentChanges/SiteLinkCommentCreator.php',
	'Wikibase\\Client\\RepoItemLinkGenerator' => __DIR__ . '/includes/RepoItemLinkGenerator.php',
	'Wikibase\\Client\\RepoLinker' => __DIR__ . '/includes/RepoLinker.php',
	'Wikibase\\Client\\Serializer\\ClientEntitySerializer' => __DIR__ . '/includes/Serializer/ClientEntitySerializer.php',
	'Wikibase\\Client\\Serializer\\ClientSerializer' => __DIR__ . '/includes/Serializer/ClientSerializer.php',
	'Wikibase\\Client\\Serializer\\ClientStatementListSerializer' => __DIR__ . '/includes/Serializer/ClientStatementListSerializer.php',
	'Wikibase\\Client\\Specials\\SpecialEntityUsage' => __DIR__ . '/includes/Specials/SpecialEntityUsage.php',
	'Wikibase\\Client\\Specials\\SpecialPagesWithBadges' => __DIR__ . '/includes/Specials/SpecialPagesWithBadges.php',
	'Wikibase\\Client\\Specials\\SpecialUnconnectedPages' => __DIR__ . '/includes/Specials/SpecialUnconnectedPages.php',
	'Wikibase\\Client\\Store\\AddUsagesForPageJob' => __DIR__ . '/includes/Store/AddUsagesForPageJob.php',
	'Wikibase\\Client\\Store\\ClientStore' => __DIR__ . '/includes/Store/ClientStore.php',
	'Wikibase\\Client\\Store\\DescriptionLookup' => __DIR__ . '/includes/Store/DescriptionLookup.php',
	'Wikibase\\Client\\Store\\Sql\\BulkSubscriptionUpdater' => __DIR__ . '/includes/Store/Sql/BulkSubscriptionUpdater.php',
	'Wikibase\\Client\\Store\\Sql\\DirectSqlStore' => __DIR__ . '/includes/Store/Sql/DirectSqlStore.php',
	'Wikibase\\Client\\Store\\Sql\\PageRandomLookup' => __DIR__ . '/includes/Store/Sql/PageRandomLookup.php',
	'Wikibase\\Client\\Store\\Sql\\PagePropsEntityIdLookup' => __DIR__ . '/includes/Store/Sql/PagePropsEntityIdLookup.php',
	'Wikibase\\Client\\Store\\TitleFactory' => __DIR__ . '/includes/Store/TitleFactory.php',
	'Wikibase\\Client\\Store\\UsageUpdater' => __DIR__ . '/includes/Store/UsageUpdater.php',
	'Wikibase\\Client\\Tests\\Changes\\MockPageUpdater' => __DIR__ . '/tests/phpunit/includes/Changes/MockPageUpdater.php',
	'Wikibase\\Client\\Tests\\DataAccess\\Scribunto\\Scribunto_LuaWikibaseLibraryTestCase' => __DIR__ . '/tests/phpunit/includes/DataAccess/Scribunto/Scribunto_LuaWikibaseLibraryTestCase.php',
	'Wikibase\\Client\\Tests\\DataAccess\\WikibaseDataAccessTestItemSetUpHelper' => __DIR__ . '/tests/phpunit/includes/DataAccess/WikibaseDataAccessTestItemSetUpHelper.php',
	'Wikibase\\Client\\Tests\\Usage\\UsageAccumulatorContractTester' => __DIR__ . '/tests/phpunit/includes/Usage/UsageAccumulatorContractTester.php',
	'Wikibase\\Client\\Tests\\Usage\\UsageLookupContractTester' => __DIR__ . '/tests/phpunit/includes/Usage/UsageLookupContractTester.php',
	'Wikibase\\Client\\Tests\\Usage\\UsageTrackerContractTester' => __DIR__ . '/tests/phpunit/includes/Usage/UsageTrackerContractTester.php',
	'Wikibase\\Client\\UpdateRepo\\UpdateRepo' => __DIR__ . '/includes/UpdateRepo/UpdateRepo.php',
	'Wikibase\\Client\\UpdateRepo\\UpdateRepoOnDelete' => __DIR__ . '/includes/UpdateRepo/UpdateRepoOnDelete.php',
	'Wikibase\\Client\\UpdateRepo\\UpdateRepoOnMove' => __DIR__ . '/includes/UpdateRepo/UpdateRepoOnMove.php',
	'Wikibase\\Client\\Usage\\EntityUsage' => __DIR__ . '/includes/Usage/EntityUsage.php',
	'Wikibase\\Client\\Usage\\HashUsageAccumulator' => __DIR__ . '/includes/Usage/HashUsageAccumulator.php',
	'Wikibase\\Client\\Usage\\NullSubscriptionManager' => __DIR__ . '/includes/Usage/NullSubscriptionManager.php',
	'Wikibase\\Client\\Usage\\NullUsageTracker' => __DIR__ . '/includes/Usage/NullUsageTracker.php',
	'Wikibase\\Client\\Usage\\PageEntityUsages' => __DIR__ . '/includes/Usage/PageEntityUsages.php',
	'Wikibase\\Client\\Usage\\ParserOutputUsageAccumulator' => __DIR__ . '/includes/Usage/ParserOutputUsageAccumulator.php',
	'Wikibase\\Client\\Usage\\SiteLinkUsageLookup' => __DIR__ . '/includes/Usage/SiteLinkUsageLookup.php',
	'Wikibase\\Client\\Usage\\Sql\\EntityUsageTable' => __DIR__ . '/includes/Usage/Sql/EntityUsageTable.php',
	'Wikibase\\Client\\Usage\\Sql\\EntityUsageTableBuilder' => __DIR__ . '/includes/Usage/Sql/EntityUsageTableBuilder.php',
	'Wikibase\\Client\\Usage\\Sql\\SqlSubscriptionManager' => __DIR__ . '/includes/Usage/Sql/SqlSubscriptionManager.php',
	'Wikibase\\Client\\Usage\\Sql\\SqlUsageTracker' => __DIR__ . '/includes/Usage/Sql/SqlUsageTracker.php',
	'Wikibase\\Client\\Usage\\Sql\\SqlUsageTrackerSchemaUpdater' => __DIR__ . '/includes/Usage/Sql/SqlUsageTrackerSchemaUpdater.php',
	'Wikibase\\Client\\Usage\\SubscriptionManager' => __DIR__ . '/includes/Usage/SubscriptionManager.php',
	'Wikibase\\Client\\Usage\\UsageAccumulator' => __DIR__ . '/includes/Usage/UsageAccumulator.php',
	'Wikibase\\Client\\Usage\\UsageAspectTransformer' => __DIR__ . '/includes/Usage/UsageAspectTransformer.php',
	'Wikibase\\Client\\Usage\\UsageDeduplicator' => __DIR__ . '/includes/Usage/UsageDeduplicator.php',
	'Wikibase\\Client\\Usage\\UsageLookup' => __DIR__ . '/includes/Usage/UsageLookup.php',
	'Wikibase\\Client\\Usage\\UsageTracker' => __DIR__ . '/includes/Usage/UsageTracker.php',
	'Wikibase\\Client\\Usage\\UsageTrackerException' => __DIR__ . '/includes/Usage/UsageTrackerException.php',
	'Wikibase\\Client\\Usage\\UsageTrackingLanguageFallbackLabelDescriptionLookup' => __DIR__ . '/includes/Usage/UsageTrackingLanguageFallbackLabelDescriptionLookup.php',
	'Wikibase\\Client\\Usage\\UsageTrackingSnakFormatter' => __DIR__ . '/includes/Usage/UsageTrackingSnakFormatter.php',
	'Wikibase\\Client\\WikibaseClient' => __DIR__ . '/includes/WikibaseClient.php',
	'Wikibase\\Client\\PageSplitTester' => __DIR__ . '/includes/PageSplitTester.php',
	'Wikibase\\PopulateEntityUsage' => __DIR__ . '/maintenance/populateEntityUsage.php',
	'Wikibase\\PopulateInterwiki' => __DIR__ . '/maintenance/populateInterwiki.php',
	'Wikibase\\Test\\MockClientStore' => __DIR__ . '/tests/phpunit/MockClientStore.php',
	'Wikibase\\UpdateSubscriptions' => __DIR__ . '/maintenance/updateSubscriptions.php',
];
