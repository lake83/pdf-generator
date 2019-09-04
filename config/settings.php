<?php
namespace app\config;

use Yii;
use yii\base\BootstrapInterface;
use yii\helpers\ArrayHelper;

class settings implements BootstrapInterface 
{
    /**
    * Bootstrap method to be called during application bootstrap stage.
    * Loads all the settings into the Yii::$app->params array
    * @param Application $app the application currently running
    */
    public function bootstrap($app)
    {
        $app->params = Yii::$app->cache->getOrSet('settings', function () use ($app) {
            return ArrayHelper::map($app->db->createCommand("SELECT name, value FROM settings")->queryAll(), 'name', 'value');
        }, 0, new \yii\caching\TagDependency(['tags' => 'settings']));
        
        if (!$app instanceof \yii\console\Application) {
            // Установка темы в админке
            Yii::$container->set('dmstr\web\AdminLteAsset', ['skin' => $app->params['skin']]);
        }
    }
}