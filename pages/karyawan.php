<?php
if(isset($_GET['id'])){
    insert("delete from karyawan where id='$_GET[id]'");
    echo "<script>location.href='?pages=karyawan';</script>";
}
if(isset($_GET['action'])){
    insert("truncate table karyawan");
    echo "<script>location.href='?pages=karyawan';</script>";
}
$vw = query("SELECT * FROM karyawan");
?>
<div class="col-md-12 justify-content-center panel mb-2">
    
    <div class="table-responsive">
    <div class="mb-5 flex items-center justify-between">
    <h5 class="text-lg font-semibold">Data Karyawan<a
            class="btn btn-info"
            href="?pages=add-data"
        >Add Data
        </a></h5>
        
        <a
            class="btn btn-info"
            href="?pages=karyawan&action=clear"
        >Kosongkan
        </a>
    </div>
    <table class="table table-hover table-striped mb-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <?php
                         $kriterias = query("select * from kriteria");
                         foreach($kriterias as $k){
                            ?>
                            <th><?php echo $k['nama']?></th>
                            <?php
                         }
                    ?>
                    
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $no=1;
                foreach ($vw as $data) : ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td><?=$data['nama']; ?></td>
                        <?php
                        foreach($kriterias as $k){
                            ?>
                            <td><?php echo $data[$k['ket']]?></td>
                        <?php
                         }
                        ?>
                        <td>
                            <a href="?pages=update-karyawan&id=<?=$data["id"]?>" class="btn btn-info btn-sm">Update</a>
                            <a href="?pages=karyawan&id=<?=$data["id"]?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want delete data?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>