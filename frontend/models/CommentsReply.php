<?php

namespace frontend\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "comments_reply".
 *
 * @property int $id
 * @property int $user_id
 * @property int $comment_id
 * @property int $tour_id
 * @property string $comment
 */
class CommentsReply extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments_reply';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['comment', 'required'],
            ['comment_id', 'trim'],
            ['comment', 'trim'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'comment' => 'Ваш ответ',
        ];
    }
}
