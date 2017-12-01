<?php
namespace Puja\I18n;
class I18n implements I18nInterface
{
    protected $locale;
    protected static $instances;
    protected static $dict = array();
    protected static $debug;
    protected static $missingKeys;

    public function setDebug($debug = false)
    {
        static::$debug = $debug;
        return $this;
    }

    public function getMissingKeys()
    {
        if (empty(static::$missingKeys[$this->locale])) {
            return array();
        }

        return static::$missingKeys[$this->locale];
    }

    public function getDict()
    {
        if (empty(static::$dict[$this->locale])) {
            return array();
        }
        
        return static::$dict[$this->locale];
    }

    /**
     * Get instance
     * @param string $locale
     * @return static
     */
    public static function getInstance($locale = 'default')
    {
        if (empty(self::$instances[$locale])) {
            self::$instances[$locale] = new static($locale);
        }

        return self::$instances[$locale];
    }

    protected function __construct($locale)
    {
        $this->locale = $locale;
        if (empty(static::$dict[$locale])) {
            static::$dict[$locale] = array();
            static::$missingKeys[$locale] = array();
        }
    }

    /**
     * @param $file
     * @return $this
     */
    public function importTranslationFile($file)
    {
        $fp = new \Puja\Stdlib\File\File($file, 'r');
        if ($fp->isReadable()) {
            static::$dict[$this->locale] = include $file;
        }

        return $this;
    }

    public function getLocale()
    {
        return $this->locale;
    }


    public function translate($message, $params = array(), $plural = false)
    {
        return static::executeTranslate($message, $params, $plural, $this->locale);
    }

    public static function t($message, $params = array(), $plural = false, $locale = null)
    {
        return static::executeTranslate($message, $params, $plural, $locale);
    }

    protected static function executeTranslate($message, $params = array(), $plural = false, $locale = null)
    {
        if (empty(static::$dict)) {
            return $message;
        }

        if (empty($locale)) {
            $locale = key(static::$dict);
        }

        $translatedMessage = $message;
        if (key_exists($message, static::$dict[$locale])) {
            $translatedMessage = static::$dict[$locale][$message];
        } elseif (static::$debug) {
            static::$missingKeys[$locale][$message] = true;
        }

        return $translatedMessage;
    }
    
}