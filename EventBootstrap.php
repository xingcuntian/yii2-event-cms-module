<?php
/**
 * EventBootstrap class file
 * @copyright Copyright (c) 2014 Bariew
 * @license http://www.yiiframework.com/license/
 */

namespace bariew\eventModule;

use yii\base\BootstrapInterface;
use Yii;
use \bariew\eventModule\models\Item;
use bariew\eventManager\EventBootstrap as EventManagerBootstrap;

/**
 * Bootstrap class initiates config check.
 * 
 * @author Pavel Bariev <bariew@yandex.ru>
 */
class EventBootstrap implements BootstrapInterface
{
    /**
     * @var EventManager EventManager memory storage for getEventManager method
     */
    protected static $_eventManager;
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        if (!Module::isEnabled()) {
            return true;
        }
        $events = (Yii::$app->db->getTableSchema(Item::tableName()))
            ? (new Item())->moduleEventList() : [];
        EventManagerBootstrap::getEventManager($app)->attachEvents($events);
        return $this;
    }
}