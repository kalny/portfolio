<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "portfolio".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $description
 * @property string $avatar
 * @property integer $rating
 *
 * @property Email[] $emails
 * @property Link[] $links
 * @property Paragraph[] $paragraphs
 * @property Phone[] $phones
 * @property User $user
 * @property Voting[] $votings
 * @property User[] $users
 * @property Work[] $works
 */
class Portfolio extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'portfolio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name'], 'required'],
            [['user_id', 'rating'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
            [['avatar'], 'string', 'max' => 128],
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
            'user_id' => Yii::t('app', 'LABEL_USER_ID'),
            'name' => Yii::t('app', 'LABEL_NAME'),
            'description' => Yii::t('app', 'LABEL_DESCRIPTION'),
            'avatar' => Yii::t('app', 'LABEL_AVATAR'),
            'rating' => Yii::t('app', 'LABEL_RATING'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmails()
    {
        return $this->hasMany(Email::className(), ['portfolio_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinks()
    {
        return $this->hasMany(Link::className(), ['portfolio_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParagraphs()
    {
        return $this->hasMany(Paragraph::className(), ['portfolio_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhones()
    {
        return $this->hasMany(Phone::className(), ['portfolio_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVotings()
    {
        return $this->hasMany(Voting::className(), ['portfolio_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('voting', ['portfolio_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorks()
    {
        return $this->hasMany(Work::className(), ['portfolio_id' => 'id']);
    }

    public function delete()
    {
        $avatar = $this->avatar;
        
        $this->deleteImage($avatar);
        
        foreach ($this->works as $work) {
            $work->delete();
        }

        return parent::delete();
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if (parent::save($runValidation, $attributeNames)) {

            $this->refreshLinks();

            $this->refreshEmails();

            $this->refreshPhones();

            return true;
        }
        return false;
    }

    private function refreshLinks()
    {
        $links = Link::findAll([
            'user_id' => $this->user_id,
            'portfolio_id' => NULL
        ]);

        foreach ($links as $link) {
            $link->portfolio_id = $this->id;
            $link->save();
        }
    }

    private function refreshEmails()
    {
        $emails = Email::findAll([
            'user_id' => $this->user_id,
            'portfolio_id' => NULL
        ]);

        foreach ($emails as $email) {
            $email->portfolio_id = $this->id;
            $email->save();
        }
    }

    private function refreshPhones()
    {
        $phones = Phone::findAll([
            'user_id' => $this->user_id,
            'portfolio_id' => NULL
        ]);

        foreach ($phones as $phone) {
            $phone->portfolio_id = $this->id;
            $phone->save();
        }
    }
}
