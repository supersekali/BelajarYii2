<?php
namespace app\themes\backend\assets;

//use yii\base\Exception;
//use yii\web\AssetBundle as BaseMaterialAsset;
//use yii\web\AssetBundle;
/**
 * Material AssetBundle
 * @since 0.1
 */
class BackendAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@app/themes/backend';


    public $css = [
       // 'css/msdropdown/dd.css',
        'css/msdropdown/flags.css',
        'css/custom-backend.css',
    ];

    public $js = [
		//'js/msdropdown/jquery.dd.min.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
	public $publishOptions = [
        'forceCopy' => YII_DEBUG? true: false,
        'except' => [
            'assets/',
            'components/',
            'layouts/',
        ],
    ];
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }
}
