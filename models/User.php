<?php

namespace app\models;

use nodge\eauth\ErrorException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'service_id', 'service_name'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        if (\Yii::$app->getSession()->has('user-'.$id)) {
            return new self(\Yii::$app->getSession()->get('user-'.$id));
        }
        else {
            return static::findOne(['id' => $id]);
        }
    }

    /**
     * @param \nodge\eauth\ServiceBase $service
     * @return User
     * @throws ErrorException
     */
    public static function findByEAuth($service) {
        if (!$service->getIsAuthenticated()) {
            throw new ErrorException('EAuth user should be authenticated before creating identity.');
        }

        $user = self::findOne([
            'service_name' => $service->getServiceName(),
            'service_id' => $service->getId()
        ]);


        $id = $service->getServiceName().'-'.$service->getId();
        $attributes = [
            'username' => $service->getAttribute('name'),
            'service_name' => $service->getServiceName(),
            'service_id' => $service->getId(),
            'auth_key' => md5($id),
        ];

        \Yii::$app->getSession()->set('user-'.$id, $attributes);



        if (!$user) {
            $user = new self($attributes);
            $user->save();
        }

        return ($user) ? $user : new self($attributes);

    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
}
