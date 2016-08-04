<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 04.08.16
 * Time: 13:49
 */

namespace app\helpers;


class Translator
{
    public static function getTranslate($count)
    {
        $transVoted = 'TRANS_VOTED';

        $strVal = '0' . strval($count);

        $res = substr($strVal, strlen($strVal)-2, 2);

        if ((substr($res, 1, 1) === '1') && ($res !== '11')) {
            $transVoted = 'TRANS_VOTED_ONE';
        }

        return \Yii::t('app', $transVoted);
    }
}