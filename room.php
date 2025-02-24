<?php
include_once('blogic.php');
$rooms = (getAllRooms());
echo '<select name=room>';
foreach($rooms as $room)
{
    echo '<option value={$room[room_id]}>{$room["name"]}</option>';
}
?>