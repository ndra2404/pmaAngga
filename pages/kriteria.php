<?php
$kriterias = query("SELECT * FROM kriteria");
if($_POST){

    $sql = "insert into kriteria(nama,jenis,ket) values('".$_POST['newvar']."','".$_POST['jenis']."','".str_replace(' ','_',$_POST['newvar'])."')";
    $id = insert($sql);

    

    $sql = "alter table karyawan add ".str_replace(' ','_',$_POST['newvar'])." double";
    insert($sql);
    $sql = "alter table gap add ".str_replace(' ','_',$_POST['newvar'])." double";
    insert($sql);

    $sql = "INSERT INTO `sub_kriteria` (`kriteria_id`, `nama`, `nilai`) VALUES
    ($id, 'Baik Sekali', '5'),
    ($id, 'Baik', '4'),
    ($id, 'Sedang', '3'),
    ($id, 'Kurang', '2'),
    ($id, 'Kurang sekali', '1')";
    $index = insert($sql);
    echo $index;
    echo "insert into profil_standar2(kriteria_id,subkriteria_id)values($id,$index)";
    insert("insert into profil_standar2(kriteria_id,subkriteria_id)values($id,$index)");
    echo "<script>
    swal({
        icon: 'success',
                title: 'Awesome!',
                text: 'Data berhasil ditambah',
                padding: '2em',
            }).then(function() {
                window.location ='?pages=kriteria';
            });
    </script> ";
}
if(isset($_GET['id'])){
    insert("delete from profil_standar2 where kriteria_id = ".$_GET['index']);
    insert("delete from sub_kriteria where kriteria_id = ".$_GET['index']);
    insert("delete from kriteria where ket='".$_GET['id']."'");
    insert("alter table karyawan drop ".$_GET['id']."");
    insert("alter table gap drop ".$_GET['id']."");
    echo "<script>location.href='?pages=kriteria';</script>";
}
?>
<div class="col-md-12 justify-content-center panel">
<div x-data="modal" class="mb-5">
                                    <div class="flex">
                                        <button type="button" class="btn btn-primary" @click="toggle">Input Kriteria</button>
                                    </div>
                                    <div class="fixed inset-0 z-[999] hidden overflow-y-auto bg-[black]/60" :class="open && '!block'">
                                        <div class="flex min-h-screen items-start justify-center px-4" @click.self="open = false">
                                            <div
                                                x-show="open"
                                                x-transition
                                                x-transition.duration.300
                                                class="panel my-8 w-full max-w-lg overflow-hidden rounded-lg border-0 p-0"
                                            >
                                                <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                                                    <div class="text-lg font-bold">Modal Title</div>
                                                    <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="24px"
                                                            height="24px"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="h-6 w-6"
                                                        >
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="p-5">
                                                    <form action="index.php?pages=kriteria" method="post">
                                                    <div class="text-base font-medium text-[#1f2937] dark:text-white-dark/70">
                                                        Kriteria
                                                        <input type="text" name="newvar" placeholder="Some Text..." class="form-input" required />
                                                        Jenis
                                                        <select name="jenis" class="form-select form-select-lg text-white-dark">
                                                        <option>Jenis</option>
                                                        <option value='cf'>CF</option>
                                                        <option value='sf'>SF</option>
                                                    </select>
                                                    </div>
                                                    <div class="mt-8 flex items-center justify-end">
                                                        <button type="button" class="btn btn-outline-danger" @click="toggle">Discard</button>
                                                        <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4">Save</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    <div class="table-responsive">
        <table class="table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kriteria</th>
                    <th>Jenis</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no=1;
                foreach($kriterias as $kriteria) : 
                  
                ?>
                    <tr>
                        <td class="whitespace-nowrap"><?php echo $no++?></td>
                        <td ><?php echo $kriteria['nama']?></td>
                        <td ><?php echo $kriteria['jenis']=='cf'?'Core Factor':'Secondary Factor'?></td>
                        <td ><?php echo $kriteria['ket']?></td>
                        <td>
                            <a href="?pages=kriteria&id=<?=$kriteria["ket"]?>&index=<?=$kriteria["id"]?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>