<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "paragraph".
 *
 * @property integer $id
 * @property integer $portfolio_id
 * @property integer $user_id
 * @property string $content
 *
 * @property Portfolio $portfolio
 * @property User $user
 */
class Paragraph extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'paragraph';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['portfolio_id', 'user_id'], 'integer'],
            [['user_id', 'content'], 'required'],
            [['content'], 'string', 'max' => 255],
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
            'content' => Yii::t('app', 'LABEL_CONTENT'),
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
