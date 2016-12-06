<?php

namespace intellibots\Messages;


/**
 * Class Message
 *
 * @package intellibots\Messages
 */
class Message
{
    /**
     * @var null|string
     */
    protected $recipient = null;

    /**
     * @var null|string
     */
    protected $text = null;

    /**
     * Message constructor.
     *
     * @param string $recipient
     * @param string $text
     */
    public function __construct($recipient, $text)
    {
        $this->recipient = $recipient;
        $this->text = $text;

    }

    /**
     * Get message data
     *
     * @return array
     */
    public function getData()
    {
        return [
            'recipient' =>  [
                'id' => $this->recipient
            ],
            'message' => [
                'text' => $this->text
            ]
        ];
    }

    /**
     * @param string $filename
     * @param string $contentType
     * @param string $postname
     * @return \CURLFile|string
     */
    protected function getCurlValue($filename, $contentType, $postname)
    {
        // PHP 5.5 introduced a CurlFile object that deprecates the old @filename syntax
        // See: https://wiki.php.net/rfc/curl-file-upload
        if (function_exists('curl_file_create')) {
            return curl_file_create($filename, $contentType, $postname);
        }

        // Use the old style if using an older version of PHP
        $value = "@{$this->filename};filename=" . $postname;
        if ($contentType) {
            $value .= ';type=' . $contentType;
        }

        return $value;
    }
}