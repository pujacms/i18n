<?php
namespace Puja\I18n;
interface I18nInterface
{
    /**
     * Set on/off debug, if debug is true, its will log all missing keys
     * @param bool $debug
     * @return mixed
     */
    public function setDebug($debug = false);

    /**
     * Get missing keys
     * @return array
     */
    public function getMissingKeys();

    /**
     * Load dict for specific local, if locale not set, locale will be default
     * @param $file
     * @return mixed
     */
    public function importTranslationFile($file);

    /**
     * Get current location
     * @return string
     */
    public function getLocale();

    /**
     * Get dictionary (key => value) with current locale
     * @return array
     */
    public function getDict();

    /**
     * Translate message with current locale
     * @param $message
     * @param array $params
     * @param bool $plural
     * @return mixed
     */
    public function translate($message, $params = array(), $plural = false);

    /**
     * Translate message with specific locale
     * @param $message
     * @param array $params
     * @param bool $plural
     * @param string $locale
     * @return mixed
     */
    public static function t($message, $params = array(), $plural = false, $locale = 'default');
    

}