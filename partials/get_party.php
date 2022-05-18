<h3>My Parties:</h3>
<?php
if (!is_logged_in()) {
    die();
}

$db = getDB();
$query = "SELECT Party.id, Party.party_name, Party.party_id, Party.creator_id, Party.is_settled, PartyUsers.user_id, PartyUsers.is_creator ";
$query .= "FROM PartyUsers JOIN Party WHERE `user_id` = :user_id AND Party.id = PartyUsers.party_id";
$params = array(":user_id" => get_user_id());
$stmt = $db->prepare($query);
$r = $stmt->execute($params);
$e = $stmt->errorInfo();
if ($e[0] == "00000") {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<ul>
    <?php foreach ($result as $r) : ?>
        <a href="view_party.php?id=<?php echo $r["id"]; ?>">
            <div>
                <li>
                    <h3><?php echo $r["party_name"]; ?></h3>
                    <h5><?php echo $r["party_id"]; ?></h5>
                </li>
            </div>
        </a>
    <?php endforeach; ?>
</ul>