<pre>
<?php
include '../vendor/autoload.php';
$i18n = \Puja\I18n\I18n::getInstance('en')->importTranslationFile(__DIR__ . '/messages/en.php')->setDebug(true);
echo $i18n->translate('HOMEPAGE') . PHP_EOL;
echo \Puja\I18n\I18n::t('PRODUCT') . PHP_EOL;
echo $i18n->translate('KEY1_NON_EXISTS') . PHP_EOL;
echo \Puja\I18n\I18n::t('KEY2_NON_EXISTS') . PHP_EOL;

$missingKeys = $i18n->getMissingKeys();
print_r($missingKeys);exit;

?>
</pre>
