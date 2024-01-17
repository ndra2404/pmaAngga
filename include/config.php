<?php
$conn = mysqli_connect('localhost', 'root', '', 'db_pma_angga_3');

function query($query)
{
    global $conn;

    $res = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $rows[] = $row;
    }

    return $rows;
}
function insert($sql){
    global $conn;
    mysqli_query($conn,$sql);
    return mysqli_insert_id($conn);
}
function getNilaiStandar($id){
    $std = query("SELECT sk.kriteria_id,sk.nilai,sk.nama FROM profil_standar2 ps left join sub_kriteria sk on sk.id=ps.subkriteria_id where sk.kriteria_id = $id");
    return $std[0]['nilai'];
}
?>