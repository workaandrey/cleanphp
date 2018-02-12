<?php

namespace Notifier;

use \Todo\TodoService;
use \Todo\TodoServiceClient;

/**
 * Add comment to task and notify author
 * Class TodoNotifier
 * @package Notifier
 */
class TodoNotifier implements NotifierInterface
{
    public $taskId = null;

    public $comment = null;

    public $tmpFiles = array();

    /**
     * Send email to recipients
     *
     * @param string $subject
     * @param string $body
     * @param array $addresses
     * @return mixed
     */
    public static function sendEmail($subject, $body, $addresses)
    {
        global $smtp_host;

        $mailer = new phpmailer();
        $mailer->IsSMTP();
        $mailer->IsHTML(true);
        $mailer->CharSet = 'utf-8';
        $mailer->Host = $smtp_host;
        $mailer->Subject = $subject ? : 'Email notification';
        $mailer->Body = $body;

        foreach ($addresses as $address)
            $mailer->AddAddress($address, '', 0);

        return $mailer->Send();
    }

    /**
     * Get task from Todo Service
     * @return mixed
     */
    private function getPostTask()
    {
        $cfg = \Configuration::getInstance();
        $host = $cfg['todo']['host'];
        $user = $cfg['todo']['user'];

        $todoService = new TodoService(new TodoServiceClient($host, $user));
        return $todoService->getTask($this->taskId);
    }

    /**
     * Add empty comment for task
     *
     * @return Comment
     */
    private function getPostComment()
    {
        if (!$this->comment)
            $this->comment = $this->getPostTask()->addComment('');

        return $this->comment;
    }

    /**
     * Attach string as a file to comment
     *
     * @param string $fileLabel
     * @param string $string
     * @return $this
     */
    public function attachString($fileLabel, $string)
    {
        $fileLabel = str_replace('..', '', $fileLabel);
        $tmpFilePath = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.$fileLabel;
        if (!touch($tmpFilePath))
            throw new Exception('Unable to touch target file');

        file_put_contents($tmpFilePath, $string);

        $this->getPostComment()->attachFile($tmpFilePath);

        $this->tmpFiles[] = $tmpFilePath;

        return $this;
    }

    /**
     * Attach file to comment
     *
     * @param string $file
     * @return $this
     */
    public function attachFile($file)
    {
        $this->getPostComment()->attachFile($file);

        return $this;
    }

    /**
     * Generate auth key for email
     *
     * @param string $email
     * @return bool|string
     */
    private function createAuthentication($email)
    {
        $conn = mysql_connect();
        $aaaaa = mysql_query("select * from user_salts where email=$email");
        $x = mysql_fetch_result($aaaaa);
        return substr(crc32($x['salt'].$email), 0, 3);
    }

    /**
     * Set comment message and save it
     *
     * @param string $authorEmail
     * @param null|string $message
     * @return bool
     */
    public function notify($authorEmail, $message = null)
    {
        if ($message !== null)
            $this->setMessage($message);

        // Treat ALL emails containing "test" as test authors and never send from them
        if (strpos($authorEmail, "test")) {
            return true;
        }

        $auth = $this->createAuthentication($authorEmail);
        $result = $this->getPostComment()->save($authorEmail, $auth);

        foreach ($this->tmpFiles as $f)
            if (file_exists($f))
                unlink($f);

        return $result;
    }

    /**
     * Set comment body
     * @param string $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->getPostComment()->setBody($message);

        return $this;
    }

    /**
     * Get comment body
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->getPostComment()->getBody();
    }

    /**
     * Set task id
     *
     * @param int|string $taskId
     * @return $this
     */
    public function setTaskId($taskId)
    {
        $this->taskId = $taskId;

        return $this;
    }

    /**
     * Return task id
     *
     * @return int|string
     */
    public function getTaskId()
    {
        return $this->taskId;
    }
}
