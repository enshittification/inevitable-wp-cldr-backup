# wp-cldr

WordPress plugin to access localized territory and language names, currency names/symbols, and other localization info. Source is the [reference JSON files] (http://cldr.unicode.org/index/cldr-spec/json) of the [Unicode Common Locale Data Repository (CLDR)] (http://cldr.unicode.org/).

##

## Examples:
### The default locale is English
```
$cldr = new WP_CLDR();
$territories_in_english = $cldr->territories_by_locale( 'en' );
```

### You can override the default locale per-call by passing in a language slug in the second parameter.
```$germany_in_arabic = $cldr->_territory( 'DE' , 'ar' );```

### use a convenience parameter during instantiation to change the default locale
```
$cldr = new WP_CLDR( 'fr' );
$germany_in_french = $cldr->_territory( 'DE' );
$us_dollar_in_french = $cldr->_currency_name( 'USD' );
$canadian_french_in_french = $cldr->_language( 'fr-ca' );
$canadian_french_in_english = $cldr->_language( 'fr-ca' , 'en' );
$us_dollar_symbol_in_simplified_chinese = $cldr->_currency_symbol( 'USD', 'zh' );
$africa_in_french = $cldr->_territory( '002' );
```

### switch locales after the object has been created
```
$cldr->set_locale('en')
$us_dollar_in_english = $cldr->_currency( 'USD' );
```

## Links:
* http://cldr.unicode.org/
* http://cldr.unicode.org/index/cldr-spec/json
