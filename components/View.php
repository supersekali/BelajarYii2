<?php
namespace app\components;

use Yii;
use yii\helpers\ArrayHelper;

class View extends \yii\web\View
{
	/**
     * @var string tempat menyimpan theme yang dirender dihalaman menjadi tema
     */
	private static $_themeApplied = false;
	public function beforeRender($viewFile, $params)
    {
        if(parent::beforeRender($viewFile, $params)) {
            if (!self::$_themeApplied && !$this->theme) {
                self::$_themeApplied = true;
                $this->setTheme($this);
            }
        }
        return true;
    }	

	public function setTheme($context): void
    {
        if($context != null && $context->context->hasProperty('themeName')){
			$themeName = $context->context->themeName;
		} else {
			$themeName = Yii::$app->params['theme'];
		}
			

        $this->theme = new \yii\base\Theme([
            'basePath'    => sprintf('@app/themes/%s', $themeName),
            'baseUrl'      => '@web',
            'pathMap'      => [
                '@app/views'        => sprintf('@app/themes/%s', $themeName),
                '@app/modules'    => sprintf('@app/themes/%s/modules', $themeName),
            ],
        ]);
    }
}