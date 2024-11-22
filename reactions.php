<?php
include("config.php");

class Reactions
{
    // Save a reaction to the database
    static function setReaction($name, $email, $message)
    {
        global $con;

        $query = $con->prepare("INSERT INTO reactions (name, email, message) VALUES (?, ?, ?)");
        $query->bind_param("sss", $name, $email, $message);

        return $query->execute();
    }

    // Fetch all reactions from the database
    static function getReactions()
    {
        global $con;

        $result = $con->query("SELECT name, email, message FROM reactions ORDER BY id DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
