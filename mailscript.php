<?php
/**
 * Created by PhpStorm.
 * User: coolone
 * Date: 12.04.19
 * Time: 20:00
 */

require_once './vendor/autoload.php';

DB::$user = 'a0231165_megabot_base';
DB::$password = 'megabotiscool';
DB::$dbName = 'a0231165_messages_data';
DB::$encoding = 'utf8';

use Ddeboer\Imap\Message\AttachmentInterface;
use Ddeboer\Imap\Server;

$server = new Server('mail.cometbot.ru', '993', 'ssl/novalidate-cert');

// $connection is instance of \Ddeboer\Imap\Connection
$connection = $server->authenticate('megabot@cometbot.ru', 'megabotiscool');

$mailbox = $connection->getMailbox('INBOX');

$messages = $mailbox->getMessages();

foreach ($messages as $message) {
    // $message is instance of \Ddeboer\Imap\Message

    DB::insert('messages', [
        'subject' => $message->getSubject(),
        'sender' => $message->getFrom()->getFullAddress(),
        'body' => $message->getBodyText(),
        'timestamp' => $message->getDate()->getTimestamp(),
        'attachments' => json_encode(array_map(function (AttachmentInterface $i) use ($message) {
            $path_parts = pathinfo($i->getFilename());
            $path = '/home/a0231165/domains/cometbot.ru/attachments/' . $path_parts['filename']
                . '_' . $message->getDate()->format('m-d-Y_H-i-s')
                . '.' . $path_parts['extension'];
            file_put_contents(
                $path,
                $i->getDecodedContent()
            );
            return $path;
        }, $message->getAttachments())),
    ]);

    $message->delete();
}

$connection->expunge();

exec('~/anaconda/bin/python ~/domains/cometbot.ru/pyscript/bot.py');
