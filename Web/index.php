<?php
/*
This is a super basic example script showing the bitwise logic behind the access
controls. It spits JSON to ESP or similar IoT nodes in order to configure access
to infrastructure defined by the constants below.
*/

const RESERVED_LOCKOUT = 1;     // 0000000000000001
const RESERVED_UNLOCK = 2;      // 0000000000000010
const DOOR_FRONT = 4;           // 0000000000000100
const DOOR_STORES = 8;          // 0000000000001000
const DOOR_ADMIN = 16;          // 0000000000010000
const SAFETY_BASIC = 32;        // 0000000000100000
const SAFETY_LASER = 64;        // 0000000001000000
const SAFETY_MACHINING = 128;   // 0000000010000000
const TOOL_LASER = 256;         // 0000000100000000
const TOOL_FDMPRINTER = 512;    // 0000001000000000
const TOOL_MILL = 1024;         // 0000010000000000
const TOOL_LATHE = 2048;        // 0000100000000000

// Config Flags
const CONFIG_LATCH_ON = 1;
const CONFIG_LOG_USAGE = 2;
const CONFIG_MESH_NETWORK = 4;

const PSK = "SOME RANDOM CHARS";
// Basically a salt to allow the node to verify that we're genuine.

require_once('users.php');
require_once('nodes.php');

// We'll just use some multi-dimensional arrays instead of a db for testing
$lists = [
    'users' => $users,

    // Work in progress, nodes can ask for config updates. Need more nodes
    // so I can develop this more properly
    'nodes' => $nodes,
];

// Default users list
$list = 'users';

if( isset($_REQUEST['list']) && array_key_exists($_REQUEST['list'], $lists)) {
        $list = $_REQUEST['list'];
}

$lines = [];

$data['data'] = json_encode($lists[$list]);
$data['hash'] = sha1($data['data'] . PSK);

echo json_encode($data);
