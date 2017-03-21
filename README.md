# beefACL
Self Updating RFID Access Control System using ESP8266 &amp; MFC522

## Libraries
* ~~[WiFiManager](http://platformio.org/lib/show/567/WifiManager)~~ (Coming soon)
* [MFRC522](http://platformio.org/lib/show/63/MFRC522)


## Bitwise ACL
The astute among you will notice that the numbers are doubling every line,
from the binary representations you can see that we are actually just shifting
the 1 along the bits. If we decide that each bit represents an action that
requires permission, we may define the access permissions for a user by using
just one integer. If a bit is a 1, they can do that thing, if it's 0, they can't.

Still not making sense? That's ok, keep following along, it's not rocket surgery
but it's also not immediately intuitive if you haven't dealt in binary before.

Say we have a user Joe, we decide that he allowed to open the door (DOOR_FRONT)
and use the laser cutter (TOOL_LASER). So the bits need to look like:

            Door access
                 v
    0000000000100100
              ^
        Laser cutter


Which is the binary representation of 36, in other words 4 + 32.
Simple maffs, innit?

In code this could be represented simply as

    $joesAccess = DOOR_FRONT + TOOL_LASER;

Joe can access the front door and the laser cutter. Tidy, huh?
This will work fine for adding bits if you are careful, however when defining
access you'll probably want to use the special bitwise OR operator | (a single
pipe). This is just in case you accidentally add the same bit twice. For example

    $joesAccess = DOOR_FRONT + TOOL_LASER + TOOL_LASER;

        -alternatively-

    $joesAccess = DOOR_FRONT + TOOL_LASER;
    $joesAccess += TOOL_LASER;

We'll get 68 which is

            Door access
                 v
    0000000001000100
             ^
        TOOL_FDMPRINTER

Which is obviously not right. Joe has no access to the laser and now he has
access to the 3D Printer. If we do the following however:

    $joesAccess = DOOR_FRONT | TOOL_LASER | TOOL_LASER;

        -alternatively-

    $joesAccess = DOOR_FRONT | TOOL_LASER;
    $joesAccess |= TOOL_LASER;

It will still give 36 as expected. This is also useful when you want to safely
group permissions and hand them around in variables.

So why use bitwise in the first place? why not manage this stuff instead of a
has-many relationship in a database? In a word, RESOURCES. You can store
multiple settings in a single integer variable. You're also talking on the
computers terms - in binary. This is the fastest kind of operation the computer
can do. This makes it very lightweight and perfect for interacting with IoT
nodes which may have both limited horsepower and restricted connectivity.
