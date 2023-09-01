<?php
include('lib/protect.php');
protect(1);
include("lib/connection.php");
$id = intval($_GET['id']);

try {
    $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    //$user = $stmt->fetch(PDO::FETCH_ASSOC);

    die("<script>location.href=\"index.php?p=gerenciar_cursos\";</script>");
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>