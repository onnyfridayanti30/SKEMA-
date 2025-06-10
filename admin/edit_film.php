<?php
require_once "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_film  = $_POST['id_film'];
    $judul    = $_POST['judul'];
    $sinopsis = $_POST['sinopsis'];
    $duration = $_POST['duration'];
    $actor    = $_POST['actor'];
    $direktor = $_POST['direktor'];

    // File baru?
    $poster  = $_FILES['poster']['name'];
    $banner  = $_FILES['banner']['name'];

    $sql = "UPDATE detail SET judul=?, sinopsis=?, duration=?, actor=?, direktor=?";

    // Upload file jika ada file baru
    if (!empty($poster)) {
        $poster_tmp = $_FILES['poster']['tmp_name'];
        $poster_dest = "../home/uploads/poster/" . basename($poster);
        move_uploaded_file($poster_tmp, $poster_dest);
        $sql .= ", poster='$poster'";
    }

    if (!empty($banner)) {
        $banner_tmp = $_FILES['banner']['tmp_name'];
        $banner_dest = "../home/uploads/banner/" . basename($banner);
        move_uploaded_file($banner_tmp, $banner_dest);
        $sql .= ", gambar='$banner'";
    }

    $sql .= " WHERE id_film=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $judul, $sinopsis, $duration, $actor, $direktor, $id_film);

    if ($stmt->execute()) {
        header("Location: film.php?status=updated");
        exit;
    } else {
        echo "Gagal memperbarui data film.";
    }

    $stmt->close();
    $conn->close();
}
?>
