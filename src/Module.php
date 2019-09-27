<?php


namespace NovemBit\i18n;


use NovemBit\i18n\models\Translation;

/**
 * @property  component\Translation translation
 * @property  component\Languages languages
 * @property  component\Request request
 * @property  component\DB db
 * @property  component\Rest rest
 */
class Module extends system\Component
{
    private static $instance;

    public $prefix = 'i18n';

    /**
     *
     * @throws \Exception
     */
    public function init()
    {

    }

    public function commonInit()
    {
        defined('YII_DEBUG') or define('YII_DEBUG', true);
        defined('YII_ENV') or define('YII_ENV', 'dev');

        include __DIR__ . '/../../../yiisoft/yii2/Yii.php';

        parent::commonInit(); // TODO: Change the autogenerated stub
    }

    public function start(){
        $this->rest->start();
        $this->request->start();

    }

    /**
     * @param null $config
     * @return Module
     */
    public static function instance($config = null){

        if(!isset(self::$instance) && $config!=null){
            self::$instance = new self($config);
        }

        return self::$instance;
    }

}