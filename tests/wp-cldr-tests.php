<?php

include_once 'class.wp-cldr.php';

/**
 * Performs unit tests against the wp-cldr plugin.
 *
 */
class WP_CLDR_Tests extends PHPUnit_Framework_TestCase {

	// test basic data queries

	public function setup() {
		// the second parameter, false, tell the class to not use caching which means we can avoid loading wordpress for these tests
		$this->cldr = new WP_CLDR( 'en', false );
	}

	public function test_territory_name() {

		// test country names
		$this->assertEquals( "Allemagne", $this->cldr->territory_name( 'DE' , 'fr_FR' ) );
		$this->assertEquals( "ألمانيا", $this->cldr->territory_name( 'DE' , 'ar_AR' ) );

		// test region names
		$this->assertEquals( "Afrique", $this->cldr->territory_name( '002', 'fr_FR' ) );
		$this->assertEquals( "亚洲", $this->cldr->territory_name( '142', 'zh-cn' ) );
	}

	public function test_currency_name() {

		$this->assertEquals( "dollar des États-Unis", $this->cldr->currency_name( 'USD', 'fr' ) );
		$this->assertEquals( "US Dollar", $this->cldr->currency_name( 'USD', 'en' ) );
	}

	public function test_currency_symbol() {

		$this->assertEquals( "US$", $this->cldr->currency_symbol( 'USD', 'zh' ) );
		$this->assertEquals( "$", $this->cldr->currency_symbol( 'USD', 'en' ) );
	}

	public function test_language_name() {

		$this->assertEquals( "français canadien", $this->cldr->language_name( 'fr-ca', 'fr' ) );
		$this->assertEquals( "Canadian French", $this->cldr->language_name( 'fr-ca' , 'en' ) );
		$this->assertEquals( "Deutsch", $this->cldr->language_name( 'de_DE' , 'de-DE' ) );
		$this->assertEquals( "ベンガル語", $this->cldr->language_name( 'bn_BD' , 'ja_JP' ) );
	}

	public function test_territories_by_locale() {

		$territories_in_english = $this->cldr->territories_by_locale( 'en' );
		$this->assertArrayHasKey('US', $territories_in_english );
		$this->assertEquals( "United States", $territories_in_english['US'] );
	}

	public function test_languages_by_locale() {

		$languages_in_english = $this->cldr->languages_by_locale( 'en' );
		$this->assertArrayHasKey( 'en', $languages_in_english );
		$this->assertEquals( "German", $languages_in_english[ 'de' ] );
	}

	public function test_set_locale() {

		$this->cldr->set_locale( 'fr' );
		$this->assertEquals( "Allemagne", $this->cldr->territory_name( 'DE' ) );
	}

//	need to add this functionality
/*	public function test_short_variant_of_country_names() {

		$this->assertEquals( "Hong Kong", $this->cldr->territory_name( 'HK' ) );
		$this->assertEquals( "Macau", $this->cldr->territory_name( 'MO' ) );
		$this->assertEquals( "Palestine", $this->cldr->territory_name( 'PS' ) );
	} */

	public function test_wpcom_homepage_locales() {

		// test the wpcom homepage locales as of Feb 2016
		$this->assertEquals( "ألمانيا", $this->cldr->territory_name( 'DE', 'ar' ) );
		$this->assertEquals( "Almaniya", $this->cldr->territory_name( 'DE', 'az' ) );
		$this->assertEquals( "Deutschland", $this->cldr->territory_name( 'DE', 'de' ) );
		$this->assertEquals( "Γερμανία", $this->cldr->territory_name( 'DE', 'el' ) );
		$this->assertEquals( "Germany", $this->cldr->territory_name( 'DE', 'en' ) );
		$this->assertEquals( "Alemania", $this->cldr->territory_name( 'DE', 'es' ) );
		$this->assertEquals( "آلمان", $this->cldr->territory_name( 'DE', 'fa' ) );
		$this->assertEquals( "Saksa", $this->cldr->territory_name( 'DE', 'fi' ) );
		$this->assertEquals( "Allemagne", $this->cldr->territory_name( 'DE', 'fr' ) );
		$this->assertEquals( "Allemagne", $this->cldr->territory_name( 'DE', 'fr-ca' ) );
		$this->assertEquals( "Saksa", $this->cldr->territory_name( 'DE', 'fi' ) );
		$this->assertEquals( "גרמניה", $this->cldr->territory_name( 'DE', 'he' ) );
		$this->assertEquals( "Jerman", $this->cldr->territory_name( 'DE', 'id' ) );
		$this->assertEquals( "Germania", $this->cldr->territory_name( 'DE', 'it' ) );
		$this->assertEquals( "ドイツ", $this->cldr->territory_name( 'DE', 'ja' ) );
		$this->assertEquals( "독일", $this->cldr->territory_name( 'DE', 'ko' ) );
		$this->assertEquals( "Duitsland", $this->cldr->territory_name( 'DE', 'nl' ) );
		$this->assertEquals( "Niemcy", $this->cldr->territory_name( 'DE', 'pl' ) );
		$this->assertEquals( "Alemanha", $this->cldr->territory_name( 'DE', 'pt-br' ) );
		$this->assertEquals( "Germania", $this->cldr->territory_name( 'DE', 'ro' ) );
		$this->assertEquals( "Германия", $this->cldr->territory_name( 'DE', 'ru' ) );
		$this->assertEquals( "Tyskland", $this->cldr->territory_name( 'DE', 'sv' ) );
		$this->assertEquals( "เยอรมนี", $this->cldr->territory_name( 'DE', 'th' ) );
		$this->assertEquals( "Almanya", $this->cldr->territory_name( 'DE', 'tr' ) );
//		this needs fixing
//		$this->assertEquals( "Німеччина", $this->cldr->territory_name( 'DE', 'uk' ) );
		$this->assertEquals( "德国", $this->cldr->territory_name( 'DE', 'zh-cn' ) );
		$this->assertEquals( "德國", $this->cldr->territory_name( 'DE', 'zh-tw' ) );
	}

	public function test_partial_locale_code() {

		$this->assertEquals( "Afrique", $this->cldr->territory_name( '002', 'fr' ) );
	}

	public function test_full_locale_code() {

		$this->assertEquals( "Afrique", $this->cldr->territory_name( '002', 'fr_FR' ) );
	}

	public function test_wpcom_to_cldr_locale_mapping() {

		// portuguese
		$this->assertEquals( "pt-PT", $this->cldr->get_cldr_locale( 'pt' ) );

		// brazilian portuguese
		$this->assertEquals( "pt-BR", $this->cldr->get_cldr_locale( 'pt-br' ) );
		$this->assertEquals( "pt-BR", $this->cldr->get_cldr_locale( 'pt-BR' ) );
		$this->assertEquals( "pt-BR", $this->cldr->get_cldr_locale( 'pt_br' ) );
		$this->assertEquals( "pt-BR", $this->cldr->get_cldr_locale( 'pt_BR' ) );

		// chinese variants
		$this->assertEquals( "zh-Hans", $this->cldr->get_cldr_locale( 'zh-cn' ) );
		$this->assertEquals( "zh-Hant", $this->cldr->get_cldr_locale( 'zh-tw' ) );

	}

	public function test_all_WordPress_locales() {

		// from wpcom as of Feb 2016
		$wpcom_locales = array( "af", "als", "am", "ar", "arc", "as", "ast", "av", "ay", "az", "ba", "be", "bg", "bm",
			"bn", "bo", "br", "bs", "ca", "ce", "ckb", "cs", "csb", "cv", "cy", "da", "de", "dv", "dz", "el", "el-po", "en", "en-gb", "eo",
			"es", "et", "eu", "fa", "fi", "fil", "fo", "fr", "fr-be", "fr-ca", "fr-ch", "fur", "fy", "ga", "gd", "gl", "gn", "gu", "he", "hi", "hr", "hu", "hy",
			"ia", "id", "ii", "ilo", "is", "it", "ja", "ka", "km", "kn", "ko", "kk", "ks", "ku", "kv", "ky", "la", "li", "lo", "lv",
			"lt", "mk", "ml", 'mwl', 'mn', 'mr', "ms", "mya", "nah", "nap", "ne", "nds", "nl", "nn", "no", "non", "nv", "oc", "or", "os",
			"pa", "pl", "ps", "pt", "pt-br","qu", "ro", "ru", "rup", "sc", "sd", "si", "sk", "sl", "so", "sq", "sr", "su",
			"sv", "ta", "te", "th", "tl", "tir", "tr", "tt", "ty", "udm", "ug", "uk", "ur", "uz", "vec", "vi", "wa", "xal",
			"yi", "yo", "za", "zh-cn", "zh-tw" );

		// from wporg locales.php as of Feb 2016
		$wporg_locales = array( 'aa', 'ae', 'af', 'ak', 'am', 'an', 'ar', 'arq', 'ary', 'as', 'ast', 'av', 'ay', 'az',
			'azb', 'az_TR', 'ba', 'bal', 'bcc', 'bel', 'bg_BG', 'bh', 'bi', 'bm', 'bn_BD', 'bo', 'bre', 'bs_BA', 'ca',
			'ce','ceb', 'ch', 'ckb', 'co', 'cr', 'cs_CZ', 'csb', 'cu', 'cv', 'cy', 'da_DK', 'de_DE', 'de_CH', 'dv', 'dzo',
			'ee', 'el-po', 'el', 'art_xemoji', 'en_US', 'en_AU', 'en_CA', 'en_GB', 'en_NZ', 'en_ZA', 'eo', 'es_ES', 'es_AR',
			'es_CL', 'es_CO', 'es_GT', 'es_MX', 'es_PE', 'es_PR', 'es_VE', 'et', 'eu', 'fa_IR', 'fa_AF', 'fuc', 'fi', 'fj',
			'fo', 'fr_FR', 'fr_BE', 'fr_CA', 'fr-ch', 'frp', 'fur', 'fy', 'ga', 'gd', 'gl_ES', 'gn', 'gsw', 'gu', 'ha',
			'haw_US', 'haz', 'he_IL', 'hi_IN', 'hr', 'hu_HU', 'hy', 'ia', 'id_ID', 'ido', 'ike', 'ilo', 'is_IS', 'it_IT',
			'ja', 'jv_ID', 'ka_GE', 'kab', 'kal', 'kin', 'kk', 'km', 'kmr', 'kn', 'ko_KR', 'ks', 'ky_KY', 'la', 'lb_LU',
			'li', 'lin', 'lo', 'lt_LT', 'lv', 'me_ME', 'mg_MG', 'mhr', 'mk_MK', 'ml_IN', 'mn', 'mr', 'mri', 'mrj', 'ms_MY',
			'mwl', 'my_MM', 'ne_NP', 'nb_NO', 'nl_NL', 'nl_BE', 'nn_NO', 'no', 'oci', 'orm', 'ory', 'os', 'pa_IN', 'pl_PL',
			'pt_BR', 'pt_PT', 'ps', 'rhg', 'ro_RO', 'roh', 'ru_RU', 'rue', 'rup_MK', 'sah', 'sa_IN', 'si_LK', 'sk_SK',
			'sl_SI', 'snd', 'so_SO', 'sq', 'sr_RS', 'srd', 'su_ID', 'sv_SE', 'sw', 'szl', 'ta_IN', 'ta_LK', 'tah', 'te', 'tg',
			'th', 'tir', 'tlh', 'tl', 'tr_TR', 'tt_RU', 'tuk', 'twd', 'tzm', 'udm', 'ug_CN', 'uk', 'ur', 'uz_UZ', 'vec', 'vi',
			'wa', 'xmf', 'yi', 'yor', 'zh_CN', 'zh_HK', 'zh-sg', 'zh_TW', 'zh' );

		$wp_locales = array_unique ( array_merge( $wpcom_locales, $wporg_locales ) );

		foreach ( $wp_locales as $wp_locale ) {
			$this->assertNotEmpty( $this->cldr->get_cldr_locale( $wp_locale ) );
		}

	}

	public function test_telephone_code() {

		$this->assertEquals( "1", $this->cldr->telephone_code( 'US' ) );
		$this->assertEquals( "55", $this->cldr->telephone_code( 'BR' ) );
	}

	public function test_first_day_of_week() {

		$this->assertEquals( "sun", $this->cldr->first_day_of_week( 'US' ) );
		$this->assertEquals( "sat", $this->cldr->first_day_of_week( 'QA' ) );
	}
}