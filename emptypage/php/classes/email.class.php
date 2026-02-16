<?php

class Email
{
    protected $simulateLocalEmails = true;
    protected $simulatedEmailsDirectory = '_emails';
    protected $defaultFromEmail = '';
    protected $defaultFromName = '';
    protected $lineBreak = "\r\n";

    public function __construct($config = [])
    {
        $this->simulateLocalEmails = isset($config['simulate_local_emails']) ? (bool)$config['simulate_local_emails'] : true;
        $this->simulatedEmailsDirectory = isset($config['simulated_emails_directory']) && $config['simulated_emails_directory'] !== '' ? trim($config['simulated_emails_directory']) : '_emails';
        $this->defaultFromEmail = isset($config['default_from_email']) ? trim((string)$config['default_from_email']) : '';
        $this->defaultFromName = isset($config['default_from_name']) ? trim((string)$config['default_from_name']) : '';
    }

    public function send($to, $subject, $message, $options = [])
    {
        $recipients = $this->normalizeRecipients($to);
        if(empty($recipients)) {
            return [
                'status' => false,
                'error' => 'No valid recipients provided.',
            ];
        }

        $subject = trim((string)$subject);
        if($subject === '') {
            return [
                'status' => false,
                'error' => 'Subject cannot be empty.',
            ];
        }

        $isHtml = isset($options['is_html']) ? (bool)$options['is_html'] : true;
        $plainTextMessage = isset($options['plain_text_message']) ? (string)$options['plain_text_message'] : $this->toPlainText($message);

        $fromEmail = isset($options['from_email']) ? trim((string)$options['from_email']) : $this->defaultFromEmail;
        $fromName = isset($options['from_name']) ? trim((string)$options['from_name']) : $this->defaultFromName;
        $replyTo = isset($options['reply_to']) ? trim((string)$options['reply_to']) : '';

        $cc = $this->normalizeRecipients(isset($options['cc']) ? $options['cc'] : []);
        $bcc = $this->normalizeRecipients(isset($options['bcc']) ? $options['bcc'] : []);
        $attachments = isset($options['attachments']) && is_array($options['attachments']) ? $options['attachments'] : [];
        $customHeaders = isset($options['headers']) && is_array($options['headers']) ? $options['headers'] : [];

        $mime = $this->buildMimeMessage($message, $plainTextMessage, $attachments, $isHtml);

        $headers = [
            'MIME-Version: 1.0',
            'Date: ' . date('r'),
            'X-Mailer: Native PHP/' . PHP_VERSION,
            'Content-Type: ' . $mime['content_type'],
        ];

        if($fromEmail !== '' && filter_var($fromEmail, FILTER_VALIDATE_EMAIL)) {
            $headers[] = 'From: ' . $this->formatAddress($fromEmail, $fromName);
        }

        if($replyTo !== '' && filter_var($replyTo, FILTER_VALIDATE_EMAIL)) {
            $headers[] = 'Reply-To: ' . $this->formatAddress($replyTo);
        }

        if(!empty($cc)) {
            $headers[] = 'Cc: ' . implode(', ', $cc);
        }

        if(!empty($bcc)) {
            $headers[] = 'Bcc: ' . implode(', ', $bcc);
        }

        foreach($customHeaders as $header) {
            $header = trim((string)$header);
            if($header !== '') {
                $headers[] = $header;
            }
        }

        $encodedSubject = $this->encodeHeader($subject);

        if($this->shouldSimulateDelivery()) {
            $filepath = $this->writeSimulatedEmail([
                'to' => $recipients,
                'subject' => $subject,
                'headers' => $headers,
                'body' => $mime['body'],
                'meta' => [
                    'is_html' => $isHtml,
                    'attachments' => array_values(array_map(function($attachment) {
                        return [
                            'name' => isset($attachment['name']) ? $attachment['name'] : basename((string)$attachment),
                            'path' => isset($attachment['path']) ? $attachment['path'] : (is_string($attachment) ? $attachment : ''),
                        ];
                    }, $attachments)),
                ],
            ]);

            return [
                'status' => true,
                'simulated' => true,
                'file' => $filepath,
                'recipients' => $recipients,
            ];
        }

        $sent = mail(
            implode(', ', $recipients),
            $encodedSubject,
            $mime['body'],
            implode($this->lineBreak, $headers)
        );

        return [
            'status' => (bool)$sent,
            'simulated' => false,
            'recipients' => $recipients,
        ];
    }

    public function sendBulk($mails, $baseDelayMs = 0, $delayGrowthFactor = 1.35, $maxDelayMs = 30000)
    {
        $results = [];
        $delayMs = max(0, (int)$baseDelayMs);
        $delayGrowthFactor = max(1, (float)$delayGrowthFactor);
        $maxDelayMs = max(0, (int)$maxDelayMs);

        foreach($mails as $index => $mailData) {
            if($delayMs > 0 && $index > 0) {
                usleep($delayMs * 1000);
                $delayMs = min($maxDelayMs, (int)round($delayMs * $delayGrowthFactor));
            }

            $results[] = $this->send(
                isset($mailData['to']) ? $mailData['to'] : [],
                isset($mailData['subject']) ? $mailData['subject'] : '',
                isset($mailData['message']) ? $mailData['message'] : '',
                isset($mailData['options']) ? $mailData['options'] : []
            );
        }

        return [
            'status' => !in_array(false, array_map(function($result) {
                return (bool)$result['status'];
            }, $results), true),
            'total' => count($results),
            'successful' => count(array_filter($results, function($result) {
                return !empty($result['status']);
            })),
            'failed' => count(array_filter($results, function($result) {
                return empty($result['status']);
            })),
            'results' => $results,
        ];
    }

    protected function buildMimeMessage($htmlMessage, $plainTextMessage, $attachments = [], $isHtml = true)
    {
        $hasAttachments = !empty($attachments);
        $boundaryMixed = 'mixed_' . md5(uniqid((string)mt_rand(), true));
        $boundaryAlternative = 'alt_' . md5(uniqid((string)mt_rand(), true));

        if(!$isHtml && !$hasAttachments) {
            return [
                'content_type' => 'text/plain; charset=UTF-8',
                'body' => $plainTextMessage,
            ];
        }

        $parts = [];
        $textPart = $this->buildTextPart($plainTextMessage, 'plain');
        $htmlPart = $this->buildTextPart((string)$htmlMessage, 'html');

        if($isHtml) {
            $alternativeBody = '--' . $boundaryAlternative . $this->lineBreak;
            $alternativeBody .= $textPart . $this->lineBreak;
            $alternativeBody .= '--' . $boundaryAlternative . $this->lineBreak;
            $alternativeBody .= $htmlPart . $this->lineBreak;
            $alternativeBody .= '--' . $boundaryAlternative . '--';

            $parts[] = 'Content-Type: multipart/alternative; boundary="' . $boundaryAlternative . '"' . $this->lineBreak . $this->lineBreak . $alternativeBody;
        } else {
            $parts[] = $textPart;
        }

        foreach($attachments as $attachment) {
            $attachmentData = $this->prepareAttachment($attachment);
            if($attachmentData !== null) {
                $parts[] = $attachmentData;
            }
        }

        if(!$hasAttachments) {
            if($isHtml) {
                return [
                    'content_type' => 'multipart/alternative; boundary="' . $boundaryAlternative . '"',
                    'body' => $alternativeBody,
                ];
            }

            return [
                'content_type' => 'text/plain; charset=UTF-8',
                'body' => $plainTextMessage,
            ];
        }

        $body = '';
        foreach($parts as $part) {
            $body .= '--' . $boundaryMixed . $this->lineBreak;
            $body .= $part . $this->lineBreak;
        }
        $body .= '--' . $boundaryMixed . '--';

        return [
            'content_type' => 'multipart/mixed; boundary="' . $boundaryMixed . '"',
            'body' => $body,
        ];
    }

    protected function buildTextPart($content, $type = 'plain')
    {
        return 'Content-Type: text/' . $type . '; charset=UTF-8' . $this->lineBreak
            . 'Content-Transfer-Encoding: base64' . $this->lineBreak . $this->lineBreak
            . chunk_split(base64_encode((string)$content));
    }

    protected function prepareAttachment($attachment)
    {
        $path = '';
        $name = '';
        $mime = 'application/octet-stream';
        $content = null;

        if(is_string($attachment)) {
            $path = $attachment;
            $name = basename($attachment);
        } elseif(is_array($attachment)) {
            $path = isset($attachment['path']) ? (string)$attachment['path'] : '';
            $name = isset($attachment['name']) ? (string)$attachment['name'] : ($path !== '' ? basename($path) : 'attachment.bin');
            $mime = isset($attachment['mime']) ? (string)$attachment['mime'] : $mime;
            if(isset($attachment['content'])) {
                $content = (string)$attachment['content'];
            }
        }

        if($content === null) {
            if($path === '' || !is_file($path) || !is_readable($path)) {
                return null;
            }
            $content = file_get_contents($path);
            if($content === false) {
                return null;
            }
            if(function_exists('mime_content_type')) {
                $detected = mime_content_type($path);
                if(is_string($detected) && $detected !== '') {
                    $mime = $detected;
                }
            }
        }

        return 'Content-Type: ' . $mime . '; name="' . $this->encodeHeader($name) . '"' . $this->lineBreak
            . 'Content-Transfer-Encoding: base64' . $this->lineBreak
            . 'Content-Disposition: attachment; filename="' . $this->encodeHeader($name) . '"' . $this->lineBreak . $this->lineBreak
            . chunk_split(base64_encode($content));
    }

    protected function formatAddress($email, $name = '')
    {
        if($name === '') {
            return $email;
        }
        return $this->encodeHeader($name) . ' <' . $email . '>';
    }

    protected function normalizeRecipients($input)
    {
        if(is_string($input)) {
            $input = preg_split('/[,;]+/', $input);
        }

        if(!is_array($input)) {
            return [];
        }

        $output = [];
        foreach($input as $item) {
            $email = trim((string)$item);
            if($email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $output[] = $email;
            }
        }

        return array_values(array_unique($output));
    }

    protected function encodeHeader($value)
    {
        $value = (string)$value;
        if($value === '') {
            return '';
        }

        if(function_exists('mb_encode_mimeheader')) {
            return mb_encode_mimeheader($value, 'UTF-8', 'B', $this->lineBreak);
        }

        return '=?UTF-8?B?' . base64_encode($value) . '?=';
    }

    protected function toPlainText($html)
    {
        $text = html_entity_decode(strip_tags((string)$html), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        return trim(preg_replace('/\s+/', ' ', $text));
    }

    protected function shouldSimulateDelivery()
    {
        if(!$this->simulateLocalEmails) {
            return false;
        }

        $hosts = [
            isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '',
            isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '',
            isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : '',
            isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '',
        ];

        foreach($hosts as $host) {
            $host = strtolower(trim((string)$host));
            $host = preg_replace('/:\d+$/', '', $host);
            if(in_array($host, ['localhost', '127.0.0.1', '::1'], true)) {
                return true;
            }
        }

        return false;
    }

    protected function writeSimulatedEmail($payload)
    {
        $directory = rtrim($this->resolveProjectRoot(), '/\\') . DIRECTORY_SEPARATOR . trim($this->simulatedEmailsDirectory, '/\\') . DIRECTORY_SEPARATOR;
        if(!is_dir($directory)) {
            mkdir($directory, 0775, true);
        }

        $timestamp = date('Y-m-d_H-i-s');
        $unique = substr(md5(uniqid((string)mt_rand(), true)), 0, 6);
        $filename = $timestamp . '_' . $unique . '.txt';
        $filepath = $directory . $filename;

        $content = 'TO: ' . implode(', ', $payload['to']) . $this->lineBreak;
        $content .= 'SUBJECT: ' . $payload['subject'] . $this->lineBreak;
        $content .= 'DATE: ' . date('c') . $this->lineBreak;
        $content .= 'HEADERS:' . $this->lineBreak . implode($this->lineBreak, $payload['headers']) . $this->lineBreak . $this->lineBreak;
        $content .= 'META:' . $this->lineBreak . json_encode($payload['meta'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . $this->lineBreak . $this->lineBreak;
        $content .= 'BODY:' . $this->lineBreak . $payload['body'] . $this->lineBreak;

        file_put_contents($filepath, $content);

        return $filepath;
    }

    protected function resolveProjectRoot()
    {
        if(defined('DIR_PROJECT')) {
            return DIR_PROJECT;
        }

        return dirname(__DIR__, 2) . DIRECTORY_SEPARATOR;
    }
}
