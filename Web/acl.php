<?php
$users = [
        [
            'card_uid' => '04073812524680',
            'name' => 'Jim',
            'access' => DOOR_FRONT | SAFETY_BASIC | SAFETY_LASER | TOOL_LASER
        ],
        [
            'card_uid' => 'C41103C5',
            'name' => 'Marcel',
            'access' => DOOR_FRONT | DOOR_ADMIN | SAFETY_BASIC | TOOL_FDMPRINTER
        ],
        [
            'card_uid' => '7427C14D',
            'name' => 'Adrian',
            'access' => DOOR_FRONT | DOOR_STORES | SAFETY_BASIC | SAFETY_MACHINING | TOOL_LATHE | TOOL_FDMPRINTER
        ],
        [
            'card_uid' => '565FCE93',
            'name' => 'MAINTENANCE LOCKOUT',
            'access' => RESERVED_LOCKOUT
        ],
        [
            'card_uid' => '34CEC34D',
            'name' => 'MAINTENANCE UNLOCK',
            'access' => RESERVED_UNLOCK
        ],
    ];
