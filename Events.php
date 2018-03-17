<?php

namespace humhub\modules\contact;

use Yii;
use yii\helpers\Url;

class Events
{

    public static function onTopMenuInit($event)
    {
        $settings = Yii::$app->getModule('contact')->settings;
        $isActive = $settings->get('guestOnly') ? true : false;
        $event->sender->addItem([
            'label' => "Contact",
            'id' => 'contact',
            'icon' => '<i class="fa fa-envelope"></i>',
            'url' => Url::toRoute('/contact/'),
            'sortOrder' => 1000,
            'isActive' => ($isActive && Yii::$app->controller->module && Yii::$app->controller->module->id == 'contact'),
        ]);
    }

}
