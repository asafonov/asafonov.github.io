<?php

function get_part($inbox, $email_number, $part, $part_num) {
    $data = $part_num ? imap_fetchbody($inbox, $email_number, $part_num) : imap_body($inbox, $email_number);
    if ($part->encoding == 4) {
        $data = quoted_printable_decode($data);
    } elseif ($part->encoding == 3) {
        $data = base64_decode($data);
    }

    $params = [];
    if ($part->parameters)
        foreach ($part->parameters as $x)
            $params[strtolower($x->attribute)] = $x->value;
    if ($part->dparameters)
        foreach ($part->dparameters as $x)
            $params[strtolower($x->attribute)] = $x->value;

    $attachments = [];
    if ($params['filename'] || $params['name']) {
        $filename = $params['filename'] ? $params['filename'] : $params['name'];
        $attachments[$filename] = $data;
    }

    if ($part->type==0 && $data) {
        if (strtolower($part->subtype)=='plain')
            $plainmsg = trim($data);
        else
            $htmlmsg = $data;
    }

    $ret = [];
    if (!empty($attachments)) {
        $ret['attachments'] = $attachments;
    }
    if (isset($plainmsg)) {
        $ret['plain'] = $plainmsg;
    }
    if (isset($htmlmsg)) {
        $ret['html'] = $htmlmsg;
    }

    return $ret;
}

function get_emails($hostname, $login, $password) {
    $inbox = imap_open($hostname, $login, $password);
    $emails = imap_search($inbox, 'UnSeen');
    $records = [];
    if($emails) {
        foreach($emails as $email_number) {
            $record = [];
            $overview = imap_fetch_overview($inbox, $email_number, 0);
            $record['title'] = $overview[0]->subject;
            $record['date'] = $overview[0]->date;
            $structure = imap_fetchstructure($inbox, $email_number);
            if ($structure->parts) {
                foreach ($structure->parts as $part_num => $part) {
                    $record = array_merge_recursive($record, get_part($inbox, $email_number, $part, $part_num + 1));
                }
                if (is_array($record['plain'])) $record['plain'] = $record['plain'][0]; // fuck this shit
            } else {
                $record = array_merge_recursive($record, get_part($inbox, $email_number, $structure, 0));
            }
            $records[] = $record;
        }
    }
    return $records;
}

function save_records($records) {
    $existed = file_exists('./blog.json') ? json_decode(file_get_contents('./blog.json')) : [];
    $existed = array_merge($existed, $records);
    file_put_contents('./blog.json', json_encode($existed));
}

$config = require_once('./config/config.php');
$records = get_emails($config['mail_host'], $config['mail_login'], $config['mail_password']);

if (!empty($records)) {
    foreach ($records as &$record) {
        if (!empty($record['attachments'])) {
            $record['files'] = [];
            $dir = './files/' . md5($record['date']);
            mkdir($dir);
            foreach ($record['attachments'] as $filename => $data) {
                $record['files'][] = $dir . '/' . $filename;
                $f = fopen($dir . '/' . $filename, 'w');
                fwrite($f, $data);
                fclose($f);
                unset($f);
            }
            unset($record['attachments']);
        }
    }
}

save_records($records);
