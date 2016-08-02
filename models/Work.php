<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "work".
 *
 * @property integer $id
 * @property integer $portfolio_id
 * @property integer $user_id
 * @property string $title
 * @property string $description
 * @property string $link
 * @property string $image
 *
 * @property Portfolio $portfolio
 * @property User $user
 */
class Work extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'work';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['portfolio_id', 'user_id'], 'integer'],
            [['user_id', 'title', 'description'], 'required'],
            [['title', 'description', 'link'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 128],
            [['portfolio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Portfolio::className(), 'targetAttribute' => ['portfolio_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'LABEL_ID'),
            'portfolio_id' => Yii::t('app', 'LABEL_PORTFOLIO_ID'),
            'user_id' => Yii::t('app', 'LABEL_USER_ID'),
            'title' => Yii::t('app', 'LABEL_TITLE'),
            'description' => Yii::t('app', 'LABEL_DESCRIPTION'),
            'link' => Yii::t('app', 'LABEL_LINK'),
            'image' => Yii::t('app', 'LABEL_IMAGE'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortfolio()
    {
        return $this->hasOne(Portfolio::className(), ['id' => 'portfolio_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
