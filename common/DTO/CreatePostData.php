<?php

namespace common\DTO;

class CreatePostData
{
    private ?string $authorName = null;
    private ?string $text = null;
    private ?string $authorIp = null;
    private ?string $captcha = null;

    /**
     * @param $request
     *
     * @return CreatePostData
     */
    public function loadFromRequest($request): self
    {
        $postData = $request->post('Post');

        $this->authorName = $postData['author_name'];
        $this->text = $postData['text'];
        $this->authorIp = $request->getUserIP();
        $this->captcha = $postData['verifyCode'];

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCaptcha(): ?string
    {
        return $this->captcha;
    }

    /**
     * @return string|null
     */
    public function getAuthorName(): ?string
    {
        return $this->authorName;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @return string|null
     */
    public function getAuthorIp(): ?string
    {
        return $this->authorIp;
    }


}