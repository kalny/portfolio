<?php

namespace app\models;

use Yii;

class BaseModel extends \yii\db\ActiveRecord
{
    protected function deleteImage($imageName)
    {
        if (! empty($imageName)) {
            $file = \Yii::getAlias('@webroot') . '/public/' . $imageName;

            if (file_exists($file)) {
                unlink($file);
            }
        }
    }
}
