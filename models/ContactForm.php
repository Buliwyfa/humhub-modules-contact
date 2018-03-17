<?php

namespace humhub\modules\contact\models;

use Yii;
use yii\base\Model;
use humhub\modules\content\models\Content;
use humhub\models\Setting;
use humhub\modules\post\models\Post;
use humhub\modules\space\models\Space;
use humhub\modules\user\models\User;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{

    public $name;
    public $occupation;
    public $email;
    public $subject;
    public $body;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'occupation', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
                //['verifyCode', 'captcha', 'captchaAction' => '/contact/default/captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function send()
    {
        if ($this->validate()) {
            // Switch Identity
            $user = User::find()->where(['id' => 1])->one();
            Yii::$app->user->switchIdentity($user);
            $space = Space::find()->where(['name' => 'Communication'])->one();
            // Create a sample post
            $post = new Post();
            $post->message = '<strong>from:</strong> ' . $this->email . '(' . $this->name . ')<br>' . '<strong>subject:</strong> ' . $this->subject . '<br><br>' . $this->body;
            $post->content->container = $space;
            $post->content->visibility = Content::VISIBILITY_PRIVATE;
            $post->save();
            Yii::$app->user->logout();
            return true;
        }
        return false;
    }

}
