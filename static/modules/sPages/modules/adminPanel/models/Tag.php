<?php

namespace app\modules\sPages\modules\adminPanel\models;
use Yii;

class Tag extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    
    public static function tableName(){
        return '{{tag}}';
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    
    public function getId()
    {
        return $this->id;   
    }
    
    public static function findIdentityByAccessToken($token, $type = null)
    {
    
    }

    public function getAuthKey()
    {
        
    }

    public function validateAuthKey($authKey)
    {
        
    }

    public function create()
    {
        return $this->save(false);
    }

}
