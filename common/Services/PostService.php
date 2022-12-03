<?php

namespace common\Services;

use common\DTO\CreatePostData;
use common\models\Post;
use Exception;
use Yii;

class PostService
{
    /**
     * @param CreatePostData $createPostData
     *
     * @return void
     *
     * @throws Exception
     */
    public function create(CreatePostData $createPostData)
    {
        if (!$this->beforeCreate($createPostData->getAuthorIp())) {
            throw new Exception(Yii::t('post', 'Many requests per minute'));
        }

        $model = Post::make(
            $createPostData->getAuthorName(),
            $createPostData->getAuthorIp(),
            $createPostData->getText()
        );

        $model->verifyCode = $createPostData->getCaptcha();

        $model->save();
    }

    /**
     * @param string $userIp
     *
     * @return bool
     */
    private function beforeCreate(string $userIp): bool
    {
        $lastPost = \common\models\search\Post::find()
            ->where(['author_ip' => $userIp])
            ->orderBy(['created_at' => SORT_DESC])
            ->one();

        if (!empty($lastPost)) {
            $dateDiff = $lastPost->getDateDiff($lastPost->created_at);

            if (0 === $dateDiff->h && 0 >= $dateDiff->i) {
                return false;
            }
        }

        return true;
    }
}
