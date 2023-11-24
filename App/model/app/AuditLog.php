<?php

namespace App\model\app;

/**
 *
 * @author ypra
 * Date: 29/9/2018
 * Time: 07:26
 */
trait AuditLog
{

    public function registerEvent($eventCode, $message, $details = "", $user = null, $con = null)
    {
        $event = EventService::instance()->findOneByCode($eventCode);
        if (is_object($event)) {
            if (!is_object($user)) {
                $user = UserControl::user();
            }
            $data = [
                'EventId' => $event->getId(),
                'UserId' => $user->getId(),
                'Message' => $message,
                'Details' => $details,
                'Date' => date('c'),
            ];
            EventUserService::instance()->insertOrUpdate($data, $null, $con);
        }
    }

}