<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string|null $author_name
 * @property string|null $text
 * @property string|null $author_ip
 * @property float|null $created_at
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }
}
