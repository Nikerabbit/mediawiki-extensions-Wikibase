<?php

/**
 * Aliases for the special pages of the Wikibase Repository extension.
 *
 * @license GPL-2.0+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */

$specialPageAliases = [];

/** English (English) */
$specialPageAliases['en'] = [
	'AvailableBadges' => [ 'AvailableBadges' ],
	'DispatchStats' => [ 'DispatchStats' ],
	'EntitiesWithoutDescription' => [ 'EntitiesWithoutDescription' ],
	'EntitiesWithoutLabel' => [ 'EntitiesWithoutLabel' ],
	'EntityData' => [ 'EntityData' ],
	'EntityPage' => [ 'EntityPage' ],
	'GoToLinkedPage' => [ 'GoToLinkedPage' ],
	'ItemByTitle' => [ 'ItemByTitle' ],
	'ItemDisambiguation' => [ 'ItemDisambiguation' ],
	'ItemsWithoutSitelinks' => [ 'ItemsWithoutSitelinks' ],
	'ListDatatypes' => [ 'ListDatatypes' ],
	'ListProperties' => [ 'ListProperties' ],
	'MergeItems' => [ 'MergeItems', 'MergeItem' ],
	'MyLanguageFallbackChain' => [ 'MyLanguageFallbackChain' ],
	'NewItem' => [ 'NewItem', 'CreateItem' ],
	'NewProperty' => [ 'NewProperty', 'CreateProperty' ],
	'RedirectEntity' => [ 'RedirectEntity', 'EntityRedirect', 'ItemRedirect', 'RedirectItem' ],
	'SetAliases' => [ 'SetAliases' ],
	'SetDescription' => [ 'SetDescription' ],
	'SetLabel' => [ 'SetLabel' ],
	'SetLabelDescriptionAliases' => [ 'SetLabelDescriptionAliases' ],
	'SetSiteLink' => [ 'SetSiteLink' ],
];

/** Arabic (العربية) */
$specialPageAliases['ar'] = [
	'DispatchStats' => [ 'إحصاءات_الوصول' ],
	'EntitiesWithoutDescription' => [ 'الكيانات_بدون_وصف' ],
	'EntitiesWithoutLabel' => [ 'الكيانات_بدون_علامة' ],
	'EntityData' => [ 'بيانات_الكيانات' ],
	'GoToLinkedPage' => [ 'الذهاب_للصفحة_الموصولة' ],
	'ItemByTitle' => [ 'المدخلات_بالعنوان' ],
	'ItemDisambiguation' => [ 'المدخلات_بالعلامة' ],
	'ItemsWithoutSitelinks' => [ 'المدخلات_بدون_وصلات_موقع' ],
	'ListDatatypes' => [ 'عرض_أنواع_البيانات' ],
	'MergeItems' => [ 'دمج_المدخلات' ],
	'MyLanguageFallbackChain' => [ 'سلسلة_رجوع_لغتي' ],
	'NewItem' => [ 'إنشاء_مدخلة' ],
	'NewProperty' => [ 'خاصية_جديدة' ],
	'RedirectEntity' => [ 'كينونة_تحويل', 'مدخلة_تحويل' ],
	'SetAliases' => [ 'ضبط_الكنى' ],
	'SetDescription' => [ 'ضبط_الوصف' ],
	'SetLabel' => [ 'ضبط_العلامة' ],
	'SetLabelDescriptionAliases' => [ 'ضبط_كنى_وصف_العلامات' ],
	'SetSiteLink' => [ 'ضبط_وصلة_الموقع' ],
];

/** Aramaic (ܐܪܡܝܐ) */
$specialPageAliases['arc'] = [
	'NewProperty' => [ 'ܕܝܠܝܘ̈ܬܐ_ܚܕ̈ܬܬܐ' ],
];

/** Egyptian Arabic (مصرى) */
$specialPageAliases['arz'] = [
	'DispatchStats' => [ 'احصاءات_الوصول' ],
	'EntitiesWithoutDescription' => [ 'الكيانات_من_غير_وصف' ],
	'EntitiesWithoutLabel' => [ 'الكيانات_من_غير_علامه' ],
	'EntityData' => [ 'بيانات_الكيانات' ],
	'ItemByTitle' => [ 'المدخلات_بالعنوان' ],
	'ItemDisambiguation' => [ 'المدخلات_بالعلامه' ],
	'ItemsWithoutSitelinks' => [ 'المدخلات_من_غير_وصلات_موقع' ],
	'ListDatatypes' => [ 'عرض_انواع_البيانات' ],
	'MergeItems' => [ 'دمج_مدخلات' ],
	'MyLanguageFallbackChain' => [ 'سلسله_رجوع_اللغه_بتاعتى' ],
	'NewItem' => [ 'عمل_مدخله' ],
	'NewProperty' => [ 'خاصيه_جديده' ],
	'SetAliases' => [ 'ضبط_الالياس' ],
	'SetDescription' => [ 'ضبط_الوصف' ],
	'SetLabel' => [ 'ضبط_العلامه' ],
	'SetSiteLink' => [ 'ضبط-وصله_الموقع' ],
];

/** Bengali (বাংলা) */
$specialPageAliases['bn'] = [
	'DispatchStats' => [ 'ডিসপ্যাচ_পরিসংখ্যান' ],
	'EntitiesWithoutDescription' => [ 'বিবরণহীন_সত্তা' ],
	'EntitiesWithoutLabel' => [ 'লেভেলহীন_সত্তা' ],
	'EntityData' => [ 'সত্তার_উপাত্ত' ],
	'GoToLinkedPage' => [ 'সংযুক্ত_পাতায়_যান' ],
	'ItemByTitle' => [ 'শিরোনাম_অনুযায়ী_আইটেম' ],
	'ItemDisambiguation' => [ 'আইটেম_দ্ব্যর্থতা_নিরসন' ],
	'ItemsWithoutSitelinks' => [ 'সাইট_সংযোগহীন_আইটেম' ],
	'ListDatatypes' => [ 'উপাত্তের_ধরনের_তালিকা' ],
	'ListProperties' => [ 'বৈশিষ্ট্যের_তালিকা' ],
	'MergeItems' => [ 'আইটেম_একত্রীকরণ', 'আইটেমসমূহ_একত্রীকরণ' ],
	'MyLanguageFallbackChain' => [ 'আমার_ভাষার_পশ্চাদপসরণ_চেইন' ],
	'NewItem' => [ 'নতুন_আইটেম', 'আইটেম_তৈরি' ],
	'NewProperty' => [ 'নতুন_বৈশিষ্ট্য', 'বৈশিষ্ট্য_তৈরি' ],
	'RedirectEntity' => [ 'সত্তা_পুনর্নির্দেশ', 'পুনর্নির্দেশ_সত্তা', 'আইটেম_পুনর্নির্দেশ', 'পুনর্নির্দেশ_আইটেম' ],
	'SetAliases' => [ 'উপনাম_নির্ধারণ' ],
	'SetDescription' => [ 'বিবরণ_নির্ধারণ' ],
	'SetLabel' => [ 'লেভেল_নির্ধারণ' ],
	'SetLabelDescriptionAliases' => [ 'লেভেল_বিবরণ_উপনাম_নির্ধারণ' ],
	'SetSiteLink' => [ 'সাইট_সংযোগ_নির্ধারণ' ],
];

/** буряад (буряад) */
$specialPageAliases['bxr'] = [
	'ItemByTitle' => [ 'Нэрээр_жагсааха' ],
	'ItemDisambiguation' => [ 'Дэлгэрэнгы_нэрэ' ],
	'NewItem' => [ 'Зүйл_үүсхэхэ' ],
	'NewProperty' => [ 'Шэнэ_шэнжэ_шанар' ],
];

/** Min Dong Chinese (Mìng-dĕ̤ng-ngṳ̄) */
$specialPageAliases['cdo'] = [
	'DispatchStats' => [ '特派統計' ],
	'EntitiesWithoutLabel' => [ '無標籤其條目' ],
	'EntityData' => [ '條目數據' ],
	'ItemByTitle' => [ '標題其單單' ],
	'ItemDisambiguation' => [ '消除歧義其單單' ],
	'ItemsWithoutSitelinks' => [ '無站點鏈接其條目' ],
	'ListDatatypes' => [ '數據類型其單單' ],
	'MyLanguageFallbackChain' => [ '我其語言鏈' ],
	'NewItem' => [ '新其單單', '創建單單' ],
	'NewProperty' => [ '新其屬性', '創建屬性' ],
	'SetAliases' => [ '設置同義詞' ],
	'SetDescription' => [ '設置描述' ],
	'SetLabel' => [ '設置標籤' ],
	'SetSiteLink' => [ '設置站點鏈接' ],
];

/** Czech (česky) */
$specialPageAliases['cs'] = [
	'DispatchStats' => [ 'Statistiky_distribuce' ],
	'EntitiesWithoutDescription' => [ 'Entity_bez_popisku' ],
	'EntitiesWithoutLabel' => [ 'Entity_bez_štítku' ],
	'EntityData' => [ 'Data_entity' ],
	'GoToLinkedPage' => [ 'Jít_na_odkazovanou_stránku' ],
	'ItemByTitle' => [ 'Položka_podle_názvu' ],
	'ItemDisambiguation' => [ 'Rozcestník_položek' ],
	'ItemsWithoutSitelinks' => [ 'Položky_bez_odkazů' ],
	'ListDatatypes' => [ 'Seznam_datových_typů' ],
	'ListProperties' => [ 'Seznam_vlastností' ],
	'MergeItems' => [ 'Sloučit_položky' ],
	'MyLanguageFallbackChain' => [ 'Můj_řetězec_záložních_jazkyů' ],
	'NewItem' => [ 'Vytvořit_položku', 'Nová_položka' ],
	'NewProperty' => [ 'Vytvořit_vlastnost', 'Nová_vlastnost' ],
	'RedirectEntity' => [ 'Přesměrovat_entitu' ],
	'SetAliases' => [ 'Nastavit_aliasy', 'Přidat_aliasy' ],
	'SetDescription' => [ 'Nastavit_popisek', 'Přidat_popisek' ],
	'SetLabel' => [ 'Nastavit_štítek', 'Přidat_štítek' ],
	'SetLabelDescriptionAliases' => [ 'Nastavit_štítek_popisek_nebo_aliasy' ],
	'SetSiteLink' => [ 'Nastavit_odkaz_na_článek', 'Přidat_odkaz_na_článek' ],
];

/** German (Deutsch) */
$specialPageAliases['de'] = [
	'DispatchStats' => [ 'Abfertigungsstatistiken' ],
	'EntitiesWithoutDescription' => [ 'Objekte_ohne_Beschreibung' ],
	'EntitiesWithoutLabel' => [ 'Objekte_ohne_Bezeichnung' ],
	'EntityData' => [ 'Objektdaten' ],
	'GoToLinkedPage' => [ 'Gehe_zur_verlinkten_Seite' ],
	'ItemByTitle' => [ 'Datenelement_nach_Name' ],
	'ItemDisambiguation' => [ 'Begriffsklärung_zu_Datenelement' ],
	'ItemsWithoutSitelinks' => [ 'Objekte_ohne_Websitelinks' ],
	'ListDatatypes' => [ 'Datentypen_auflisten' ],
	'MergeItems' => [ 'Objekte_zusammenführen' ],
	'MyLanguageFallbackChain' => [ 'Meine_Alternativsprachenabfolge' ],
	'NewItem' => [ 'Neues_Datenelement_erstellen' ],
	'NewProperty' => [ 'Neues_Attribut_erstellen' ],
	'SetAliases' => [ 'Aliasse_festlegen' ],
	'SetDescription' => [ 'Beschreibung_festlegen' ],
	'SetLabel' => [ 'Bezeichnung_festlegen' ],
	'SetLabelDescriptionAliases' => [ 'Bezeichnung_Beschreibung_oder_Aliasse_festlegen' ],
	'SetSiteLink' => [ 'Websitelink_festlegen' ],
];

/** Zazaki (Zazaki) */
$specialPageAliases['diq'] = [
	'ItemByTitle' => [ 'SernuşteyêLeteyi' ],
	'ItemDisambiguation' => [ 'EtiketêLeteyi' ],
	'ListDatatypes' => [ 'ListaBabetanêMelumati' ],
	'NewItem' => [ 'LeteVırazên' ],
	'NewProperty' => [ 'XısusiyetêNeweyi' ],
	'SetLabel' => [ 'SazêEtiketan' ],
];

/** Esperanto (Esperanto) */
$specialPageAliases['eo'] = [
	'ItemByTitle' => [ 'Eroj_laŭ_titolo' ],
	'NewItem' => [ 'Nova_ero' ],
	'NewProperty' => [ 'Nova_eco' ],
];

/** Spanish (español) */
$specialPageAliases['es'] = [
	'EntitiesWithoutDescription' => [ 'EntidadesSinDescripción' ],
	'EntitiesWithoutLabel' => [ 'EntidadesSinEtiqueta' ],
	'EntityData' => [ 'DatosDeEntidad' ],
	'ItemByTitle' => [ 'ElementoPorTítulo' ],
	'ItemDisambiguation' => [ 'DesambiguaciónDeElementos' ],
	'ItemsWithoutSitelinks' => [ 'ElementosSinEnlaces' ],
	'ListDatatypes' => [ 'ListarTiposDeDatos' ],
	'MergeItems' => [ 'CombinarElementos' ],
	'NewItem' => [ 'CrearElemento' ],
	'NewProperty' => [ 'NuevaPropiedad' ],
	'SetAliases' => [ 'DefinirAlias' ],
	'SetDescription' => [ 'DefinirDescripción' ],
	'SetLabel' => [ 'AsignarEtiqueta' ],
	'SetSiteLink' => [ 'DefinirEnlaceSitio' ],
];

/** Finnish (suomi) */
$specialPageAliases['fi'] = [
	'EntitiesWithoutDescription' => [ 'Aiheet_ilman_kuvausta' ],
	'EntitiesWithoutLabel' => [ 'Aiheet_ilman_nimeä' ],
	'ItemByTitle' => [ 'Hae_kohdetta_otsikolla' ],
	'ItemDisambiguation' => [ 'Kohteet_samalla_nimellä' ],
	'ItemsWithoutSitelinks' => [ 'Kohteet_ilman_sivustolinkkejä' ],
	'MergeItems' => [ 'Yhdistä_kohteita' ],
	'NewItem' => [ 'Uusi_kohde' ],
	'NewProperty' => [ 'Uusi_ominaisuus' ],
	'SetAliases' => [ 'Aseta_aliakset' ],
	'SetDescription' => [ 'Aseta_kuvaus' ],
	'SetLabel' => [ 'Aseta_nimi' ],
	'SetSiteLink' => [ 'Aseta_sivustolinkki' ],
];

/** Icelandic (íslenska) */
$specialPageAliases['is'] = [
	'EntitiesWithoutLabel' => [ 'Færslur_án_merkimiða' ],
	'ItemByTitle' => [ 'Hlutur_eftir_nafni' ],
	'ItemDisambiguation' => [ 'Hlutur_eftir_merkimiða' ],
	'ListDatatypes' => [ 'Gagnagerðir' ],
	'NewItem' => [ 'Búa_til_hlut' ],
	'NewProperty' => [ 'Ný_staðhæfing' ],
	'SetLabel' => [ 'Setja_merkimiða' ],
];

/** Italian (italiano) */
$specialPageAliases['it'] = [
	'DispatchStats' => [ 'StatistichePropagazione' ],
	'EntitiesWithoutDescription' => [ 'EntitàSenzaDescrizione' ],
	'EntitiesWithoutLabel' => [ 'EntitàSenzaEtichetta' ],
	'EntityData' => [ 'DatiEntità' ],
	'ItemByTitle' => [ 'ElementiPerTitolo' ],
	'ItemDisambiguation' => [ 'ElementiDisambigui' ],
	'ItemsWithoutSitelinks' => [ 'ElementiSenzaSitelinks' ],
	'ListDatatypes' => [ 'ElencaTipiDati' ],
	'MergeItems' => [ 'UnisciElementi' ],
	'NewItem' => [ 'CreaElemento', 'NuovoElemento' ],
	'NewProperty' => [ 'NuovaProprietà' ],
	'SetAliases' => [ 'ImpostaAlias' ],
	'SetDescription' => [ 'ImpostaDescrizione' ],
	'SetLabel' => [ 'ImpostaEtichetta' ],
	'SetSiteLink' => [ 'ImpostaSitelink' ],
];

/** Japanese (日本語) */
$specialPageAliases['ja'] = [
	'DispatchStats' => [ '発送統計' ],
	'EntitiesWithoutDescription' => [ '説明のない実体', '説明のないエンティティ' ],
	'EntitiesWithoutLabel' => [ 'ラベルのない実体', 'ラベルのないエンティティ' ],
	'EntityData' => [ '実体データ', 'エンティティデータ' ],
	'ItemByTitle' => [ 'タイトルから項目を探す' ],
	'ItemDisambiguation' => [ '項目の曖昧さ回避' ],
	'ItemsWithoutSitelinks' => [ 'サイトリンクのない項目' ],
	'ListDatatypes' => [ 'データ型一覧' ],
	'NewItem' => [ '新規項目' ],
	'NewProperty' => [ '新規プロパティ', '新規特性' ],
	'SetAliases' => [ '別名の設定' ],
	'SetDescription' => [ '説明の設定' ],
	'SetLabel' => [ 'ラベルの設定' ],
	'SetSiteLink' => [ 'サイトリンクの設定' ],
];

/** Korean (한국어) */
$specialPageAliases['ko'] = [
	'DispatchStats' => [ '전송통계' ],
	'EntitiesWithoutDescription' => [ '설명없는개체' ],
	'EntitiesWithoutLabel' => [ '레이블없는개체' ],
	'EntityData' => [ '개체데이터' ],
	'GoToLinkedPage' => [ '링크된문서로가기', '링크된문서로이동' ],
	'ItemByTitle' => [ '제목별항목' ],
	'ItemDisambiguation' => [ '레이블별항목', '라벨별항목' ],
	'ItemsWithoutSitelinks' => [ '사이트링크없는개체' ],
	'ListDatatypes' => [ '데이터유형목록' ],
	'MergeItems' => [ '항목병합' ],
	'MyLanguageFallbackChain' => [ '내언어폴백체인' ],
	'NewItem' => [ '새항목', '항목만들기' ],
	'NewProperty' => [ '새속성', '속성만들기' ],
	'SetAliases' => [ '별칭설정' ],
	'SetDescription' => [ '설명설정' ],
	'SetLabel' => [ '레이블설정' ],
	'SetSiteLink' => [ '사이트링크설정' ],
];

/** Luxembourgish (Lëtzebuergesch) */
$specialPageAliases['lb'] = [
	'DispatchStats' => [ 'Statistike_verbreeden' ],
	'EntitiesWithoutDescription' => [ 'Elementer_ouni_Beschreiwung' ],
	'EntitiesWithoutLabel' => [ 'Elementer_ouni_Etiquette' ],
	'ItemByTitle' => [ 'Element_nom_Titel' ],
	'ItemDisambiguation' => [ 'Homonymie_vun_engem_Element' ],
	'ItemsWithoutSitelinks' => [ 'Elementer_ouni_Weblinken' ],
	'ListDatatypes' => [ 'Lëscht_vun_Datentypen' ],
	'MergeItems' => [ 'Elementer_fusionéieren' ],
	'MyLanguageFallbackChain' => [ 'Meng_Ersatzsproochketten' ],
	'NewItem' => [ 'Neit_Element', 'Element_uleeën' ],
	'NewProperty' => [ 'Eegeschaft_uleeën' ],
	'SetAliases' => [ 'Aliase_festleeën' ],
	'SetDescription' => [ 'Beschreiwung_festleeën' ],
	'SetLabel' => [ 'Etiquette_festleeën' ],
];

/** Northern Luri (لۊری شومالی) */
$specialPageAliases['lrc'] = [
	'EntitiesWithoutDescription' => [ 'چیایی_کە_توضی_نارئن' ],
	'EntitiesWithoutLabel' => [ 'چیایی_کە_ریتئراز_نارئن' ],
	'ItemsWithoutSitelinks' => [ 'چیایی_کئ_ھوم_پئیڤأند_دیارگە_نارئن' ],
	'ListDatatypes' => [ 'میزوٙنکاری_جوٙر_دادە_یا' ],
	'MergeItems' => [ 'سأریأک_سازی_چیا' ],
	'MyLanguageFallbackChain' => [ 'زأنجیرە_دئماکاری_زوٙن_مئ' ],
	'SetAliases' => [ 'میزوٙنکاری_ھوم_قأطاریا' ],
	'SetDescription' => [ 'میزوٙنکاری_توضی' ],
	'SetLabel' => [ 'میزوٙنکاری_ریتئراز' ],
	'SetLabelDescriptionAliases' => [ 'میزوٙنکاری_نیائن_ریتئراز_توضی_سی_ھوم_قأطاریا' ],
	'SetSiteLink' => [ 'میزوٙنکاری_ھوم_پئیڤأند_دیارگھ' ],
];

/** Macedonian (македонски) */
$specialPageAliases['mk'] = [
	'DispatchStats' => [ 'СтатистикиСпроведување' ],
	'EntitiesWithoutDescription' => [ 'ЕдинициБезОпис' ],
	'EntitiesWithoutLabel' => [ 'ЕдинициБезНатпис' ],
	'EntityData' => [ 'ЕдиницаПодатоци' ],
	'GoToLinkedPage' => [ 'ОдиНаСврзанаСтраница' ],
	'ItemByTitle' => [ 'ПредметПоНаслов' ],
	'ItemDisambiguation' => [ 'ПојаснувањеНаПредмет' ],
	'ItemsWithoutSitelinks' => [ 'ПредметиБезВикиврски' ],
	'ListDatatypes' => [ 'СписокПодаточниТипови' ],
	'MergeItems' => [ 'СпојПредмети' ],
	'MyLanguageFallbackChain' => [ 'МојЛанецНаРезервниЈазици' ],
	'NewItem' => [ 'СоздајПредмет' ],
	'NewProperty' => [ 'НовоСвојство' ],
	'SetAliases' => [ 'ЗадајАлијаси' ],
	'SetDescription' => [ 'ЗадајОпис' ],
	'SetLabel' => [ 'ЗадајНатпис' ],
	'SetLabelDescriptionAliases' => [ 'ЗадајАлијасиОписНатпис' ],
	'SetSiteLink' => [ 'ЗадајВикиврска' ],
];

/** Dutch (Nederlands) */
$specialPageAliases['nl'] = [
	'DispatchStats' => [ 'Verwerkingsstatistieken' ],
	'EntitiesWithoutDescription' => [ 'EntiteitenZonderBeschrijving' ],
	'EntitiesWithoutLabel' => [ 'EntiteitenZonderLabel' ],
	'EntityData' => [ 'Entiteitsgegevens' ],
	'GoToLinkedPage' => [ 'NaarGekoppeldePaginaGaan' ],
	'ItemByTitle' => [ 'ItemPerTitel' ],
	'ItemDisambiguation' => [ 'ItemPerLabel' ],
	'ItemsWithoutSitelinks' => [ 'ItemsZonderSitekoppelingen' ],
	'ListDatatypes' => [ 'GegevenstypenWeergeven' ],
	'ListProperties' => [ 'EigenschappenWeergeven' ],
	'MergeItems' => [ 'ItemsSamenvoegen' ],
	'NewItem' => [ 'ItemAanmaken' ],
	'NewProperty' => [ 'NieuweEigenschap' ],
	'RedirectEntity' => [ 'EntiteitDoorverwijzen', 'ItemDoorverwijzen' ],
	'SetAliases' => [ 'AliassenInstellen' ],
	'SetDescription' => [ 'BeschrijvingInstellen' ],
	'SetLabel' => [ 'LabelInstellen' ],
	'SetLabelDescriptionAliases' => [ 'LabelbeschrijvingsaliassenInstellen' ],
	'SetSiteLink' => [ 'SitekoppelingInstellen' ],
];

/** Polish (polski) */
$specialPageAliases['pl'] = [
	'EntitiesWithoutDescription' => [ 'Encje_bez_opisu' ],
	'EntitiesWithoutLabel' => [ 'Encje_bez_etykiety' ],
];

/** Sicilian (sicilianu) */
$specialPageAliases['scn'] = [
	'EntitiesWithoutLabel' => [ 'EntitàSenzaEtichetta' ],
	'EntityData' => [ 'DatiEntità' ],
	'ItemByTitle' => [ 'ElementiPerTitolo' ],
	'ItemDisambiguation' => [ 'ElementiDisambigui' ],
	'ListDatatypes' => [ 'ElencaTipiDati' ],
	'NewItem' => [ 'CreaElemento' ],
	'NewProperty' => [ 'NuovaProprietà' ],
	'SetLabel' => [ 'ImpostaEtichetta' ],
];

/** Swedish (svenska) */
$specialPageAliases['sv'] = [
	'EntitiesWithoutDescription' => [ 'Objekt_utan_beskrivning' ],
	'EntitiesWithoutLabel' => [ 'Objekt_utan_etikett' ],
	'EntityData' => [ 'Objektdata' ],
	'ItemByTitle' => [ 'Objekt_efter_titel' ],
	'ItemDisambiguation' => [ 'Objektsärskiljning' ],
	'ItemsWithoutSitelinks' => [ 'Objekt_utan_webbplatslänk' ],
	'ListDatatypes' => [ 'Lista_datatyper' ],
	'MergeItems' => [ 'Slå_ihop_objekt' ],
	'MyLanguageFallbackChain' => [ 'Min_språkåterfallskedja' ],
	'NewItem' => [ 'Nytt_objekt', 'Skapa_objekt' ],
	'NewProperty' => [ 'Ny_egenskap', 'Skapa_egenskap' ],
	'SetAliases' => [ 'Ange_alias' ],
	'SetDescription' => [ 'Ange_beskrivning' ],
	'SetLabel' => [ 'Ange_etikett' ],
	'SetSiteLink' => [ 'Ange_webbplatslänk' ],
];

/** Vietnamese (Tiếng Việt) */
$specialPageAliases['vi'] = [
	'DispatchStats' => [ 'Thống_kê_truyền_bá' ],
	'EntitiesWithoutDescription' => [ 'Thực_thể_không_miêu_tả', 'Thực_thể_không_mô_tả' ],
	'EntitiesWithoutLabel' => [ 'Thực_thể_không_nhãn' ],
	'EntityData' => [ 'Dữ_liệu_thực_thể' ],
	'GoToLinkedPage' => [ 'Đi_đến_trang_liên_kết' ],
	'ItemByTitle' => [ 'Khoản_mục_theo_tên' ],
	'ItemDisambiguation' => [ 'Định_hướng_khoản_mục' ],
	'ItemsWithoutSitelinks' => [ 'Khoản_mục_không_có_liên_kết_dịch_vụ', 'Khoản_mục_không_có_liên_kết_site' ],
	'ListDatatypes' => [ 'Danh_sách_kiểu_dữ_liệu' ],
	'MergeItems' => [ 'Hợp_nhất_khoản_mục', 'Gộp_khoản_mục' ],
	'MyLanguageFallbackChain' => [ 'Chuỗi_ngôn_ngữ_thay_thế_của_tôi' ],
	'NewItem' => [ 'Tạo_khoản_mục' ],
	'NewProperty' => [ 'Thuộc_tính_mới' ],
	'SetAliases' => [ 'Đặt_tên_khác' ],
	'SetDescription' => [ 'Đặt_miêu_tả', 'Đặt_mô_tả' ],
	'SetLabel' => [ 'Đặt_nhãn' ],
	'SetSiteLink' => [ 'Đặt_liên_kết_dịch_vụ' ],
];

/** Simplified Chinese (中文（简体）‎) */
$specialPageAliases['zh-hans'] = [
	'DispatchStats' => [ '发送统计' ],
	'EntitiesWithoutDescription' => [ '无说明实体' ],
	'EntitiesWithoutLabel' => [ '无标签实体' ],
	'EntityData' => [ '实体数据' ],
	'GoToLinkedPage' => [ '前往已链接页面' ],
	'ItemByTitle' => [ '项按标题' ],
	'ItemDisambiguation' => [ '项消歧义' ],
	'ItemsWithoutSitelinks' => [ '无网站链接项' ],
	'ListDatatypes' => [ '数据类型列表' ],
	'MergeItems' => [ '合并项' ],
	'MyLanguageFallbackChain' => [ '我的语言备选链' ],
	'NewItem' => [ '创建项' ],
	'NewProperty' => [ '新属性' ],
	'SetAliases' => [ '设置别名' ],
	'SetDescription' => [ '设置说明' ],
	'SetLabel' => [ '设置标签' ],
	'SetLabelDescriptionAliases' => [ '设置标签说明和别名' ],
	'SetSiteLink' => [ '设置网站链接' ],
];

/** Traditional Chinese (中文（繁體）‎) */
$specialPageAliases['zh-hant'] = [
	'DispatchStats' => [ '發佈統計' ],
	'EntitiesWithoutDescription' => [ '無類型實體' ],
	'EntitiesWithoutLabel' => [ '無標籤實體' ],
	'EntityData' => [ '實體資料' ],
	'GoToLinkedPage' => [ '前往已連結頁面' ],
	'ItemByTitle' => [ '依標題搜尋項目' ],
	'ItemDisambiguation' => [ '項目消歧義' ],
	'ItemsWithoutSitelinks' => [ '無網站連結項目' ],
	'ListDatatypes' => [ '資料型態清單' ],
	'MergeItems' => [ '合併項目' ],
	'MyLanguageFallbackChain' => [ '我的備用語言鏈' ],
	'NewItem' => [ '建立項目' ],
	'NewProperty' => [ '新增屬性', '添加屬性' ],
	'SetAliases' => [ '設定別名' ],
	'SetDescription' => [ '設定描述' ],
	'SetLabel' => [ '設定標籤' ],
	'SetLabelDescriptionAliases' => [ '設定標籤說明和別名' ],
	'SetSiteLink' => [ '設定網站連結' ],
];

/** Chinese (Taiwan) (中文（台灣）‎) */
$specialPageAliases['zh-tw'] = [
	'NewItem' => [ '建立項目' ],
	'NewProperty' => [ '新增屬性' ],
];
