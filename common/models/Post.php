<?php

namespace common\models;

use DateInterval;
use DateTimeImmutable;
use Yii;

class Post extends base\Post
{
    public $verifyCode;

    /**
     * @param string $authorName
     * @param string $authorIp
     * @param string $text
     *
     * @return Post
     */
    public static function make(string $authorName, string $authorIp, string $text): self
    {
        $entity = new static();

        $entity->author_name = $authorName;
        $entity->author_ip = $authorIp;
        $entity->text = $text;
        $entity->created_at = time();

        return $entity;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'string', 'min' => 30 , 'max' => 1000],
            [['created_at'], 'safe'],
            [['author_name'], 'string', 'min' => 2 , 'max' => 15],
            [['author_ip'], 'string'],
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('post', 'ID'),
            'author_name' => Yii::t('post', 'Author Name'),
            'text' => Yii::t('post', 'Text'),
            'author_ip' => Yii::t('post', 'Author Ip'),
            'created_at' => Yii::t('post', 'Created At'),
            'verifyCode' => Yii::t('post', 'Verify Code'),
        ];
    }

    /**
     * @param int $unixtime
     *
     * @return DateInterval
     */
    public function getDateDiff(int $unixtime): DateInterval
    {
        $now = new DateTimeImmutable();
        $createdAt = (new DateTimeImmutable())->setTimestamp($unixtime);

        return $now->diff($createdAt);
    }

    /**
     * @return string
     */
    public function getRealTime(): string
    {
        $dateDiff = $this->getDateDiff($this->created_at);

        return $dateDiff->h . ' часов ' . $dateDiff->i  . ' минут назад';

    }

    /**
     * @return string
     */
    public function getMaskedIp(): string
    {
        $separator = stripos($this->author_ip, '.') === false ? ':' : '.';
        $ipInArr = explode($separator, $this->author_ip);
        $divide = count($ipInArr) / 2 - 1;

        foreach ($ipInArr as $key => &$value) {
            if ($key <= $divide) {
                continue;
            }

            $value = '*';
        }

        return implode($separator, $ipInArr);
    }
}