<?php
$pembobotan = query("select * from pembobotan");
$arrBobot = array();
foreach ($pembobotan as $row) {
    $arrBobot[$row['selisih']] = $row["bobot"];
}
$penduduk = query("SELECT * FROM karyawan");
$vwpenduduk = query("SELECT * FROM karyawan");
$std = query("SELECT sk.kriteria_id,sk.nilai,sk.nama FROM profil_standar2 ps left join sub_kriteria sk on sk.id=ps.subkriteria_id ");
$vcf = query("select * from kriteria where jenis='cf'");
$vsf = query("select * from kriteria where jenis='sf'");
$kriterias = query("select * from kriteria");
?>

<div class="col-md-12 justify-content-center panel mb-2">
    <div class="table-responsive">
    <h1 class="text-lg font-semibold">karyawan</h1>
    <table class="table table-hover table-striped mb-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <?php  
                         foreach($kriterias as $k){
                            ?>
                            <th><?php echo $k['nama']?></th>
                            <?php
                         }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $no=1;
                foreach ($vwpenduduk as $data) : ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td><?= $data['nama']; ?></td>
                        <?php
                        foreach($kriterias as $k){
                            ?>
                            <td><?php echo $data[$k['ket']]?></td>
                        <?php
                         }
                        ?>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="2"><b>Yang diharapkan</b></td>
                    <?php foreach ($std as $row) : ?>
                        <td><?= $row['nama']; ?></td>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-12 justify-content-center panel">
    <div class="table-responsive">
        <div x-data="modal" class="mb-8">
            
            <div class="flex items-right justify-end">
                <button type="button" class="btn btn-primary" @click="toggle">Kriteria</button>
            </div>
            <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
                <div class="flex items-start justify-center min-h-screen px-4" @click.self="open = false">
                    <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden my-8 w-full max-w-lg">
                        <?php
                    $kriteria = query("SELECT k.nama,sk.nama as sub,sk.nilai FROM kriteria k LEFT JOIN sub_kriteria sk ON k.id = sk.kriteria_id");
                    ?>
                    <table class="table table-striped">
                        <thead>
                            <th>Kriteria</th>
                            <th>Sub-Kriteria</th>
                            <th>Bobot</th>
                        </thead>
                        <tbody>
                            <?php
                             foreach ($kriteria as $row) :
                            ?>
                            <tr>
                                <td><?php echo $row['nama'] ?></td>
                                <td><?php echo $row['sub'] ?></td>
                                <td><?php echo $row['nilai'] ?></td>
                            </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                        <div class="p-5">
                            <div class="flex justify-end items-center mt-8">
                                            <button type="button" class="btn btn-primary ltr:ml-4 rtl:mr-4" @click="toggle">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h1 class="text-lg font-semibold">Score</h1>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <?php  
                         foreach($kriterias as $k){
                            ?>
                            <th><?php echo $k['nama']?></th>
                            <?php
                         }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $no=1;
                foreach ($penduduk as $data) : ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td><?= $data['nama']; ?></td>
                        <?php
                        foreach($kriterias as $k){
                            ?>
                            <td><?php echo $data[$k['ket']]?></td>
                        <?php
                         }
                        ?>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="2"><b>Yang diharapkan</b></td>
                    <?php foreach ($std as $row) : ?>
                        <td><?= $row['nilai']; ?></td>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
        
    </div>
</div>

<div class="col-md-12 justify-content-center panel mt-2">
    <div class="table-responsive">
    <h1 class="text-lg font-semibold">Pemetaan Gap</h1>
    <table class="table table-hover table-striped mb-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <?php  
                         foreach($kriterias as $k){
                            ?>
                            <th><?php echo $k['nama']?> -  Harap</th>
                            <?php
                         }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $no=1;
                    mysqli_query($conn,"truncate table gap");
                foreach ($penduduk as $data) : 
                    $var=[];
                    $val=[];
                    foreach($kriterias as $k){
                        $h=$data[$k['ket']]-getNilaiStandar($k['id']);
                        $val[]=$arrBobot[$h];
                        $var[]=$k['ket'];
                    }
                $sql ="insert into gap(nama,".implode($var,',').") 
                    values('".$data['nama']."',".implode($val,',').")";
                    insert($sql);
                ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td><?= $data['nama']; ?></td>
                        <?php
                             foreach($kriterias as $k){
                        ?>
                        <td><?= $data[$k['ket']]; ?>-<?=getNilaiStandar($k['id'])?>=<?=$data[$k['ket']]-getNilaiStandar($k['id'])?></td>
                        <?php
                             }
                        ?>
                        
                <?php endforeach; ?> 
            </tbody>
        </table>
    </div>
</div>

<div class="col-md-12 justify-content-center panel mt-2">
    <div class="table-responsive">
    <h1 class="text-lg font-semibold">Konversi Nilai Ke Bobot</h1>
    <table class="table table-hover table-striped mb-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <?php  
                         foreach($kriterias as $k){
                            ?>
                            <th><?php echo $k['nama']?></th>
                            <?php
                         }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no=1;
                $penduduk = query("select * from gap");
                foreach ($penduduk as $data) : 
                    
                ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td><?= $data['nama']; ?></td>
                        <?php
                            foreach($kriterias as $k){
                        ?>
                        <td><?= $data[$k['ket']]; ?></td>
                        <?php
                            }
                        ?>
                      
                    </tr>
                <?php endforeach; ?> 
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-12 justify-content-center panel mt-2">
    <div class="table-responsive">
    <span class="text-lg font-semibold">
    <?php
        echo "NCF : ";
        foreach($vcf as $r):
            echo $r['nama'].",";
        endforeach;
        echo "<br>";
        echo "NSF : ";
        foreach($vsf as $r):
            echo $r['nama'].",";
        endforeach;
    ?>
    </span>
    <table class="table table-border mb-2">
            <thead>
                <tr>
                    <th rowspan="2">#</th>
                    <th rowspan="2">Nama</th>
                    <th colspan="<?=count($vcf)+1?>" style="text-align: center;">NCF</th>
                    <th colspan="<?=count($vsf)+1?>" style="text-align: center;">NSF</th>
                    <th rowspan="2">63%*NCF+37%*NSF</th>
                </tr>
                    <?php
                        foreach($vcf as $r):
                            echo "<th>".$r['nama']."</th>";
                        endforeach;
                        echo "<th>Total</th>";
                        foreach($vsf as $r):
                            echo "<th>".$r['nama']."</th>";
                        endforeach;
                        echo "<th>Total</th>";
                    ?>
                <tr>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no=1;
                $penduduk = query("select * from gap");
                mysqli_query($conn,"truncate table hasil");
                foreach ($penduduk as $data) : 
                    $cf = 0;
                    $sf = 0;
                ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td><?= $data['nama']; ?></td>
                        <?php
                            foreach($vcf as $r):
                                $cf=$cf+$data[$r['ket']];
                                echo "<td>".$data[$r['ket']]."</td>";
                            endforeach;
                            $tcf = round($cf/count($vcf),2);
                        ?>
                        <td><?= $cf."/".count($vcf)." = ".$tcf ?></td>
                        <?php
                            foreach($vsf as $r):
                                $sf=$sf+$data[$r['ket']];
                                echo "<td>".$data[$r['ket']]."</td>";
                            endforeach;
                            $tsf = round($sf/count($vsf),2);

                            $ttlas = round(($tcf*0.63)+($tsf*0.37),2);

                            insert("insert into hasil(nama,hasil) values ('".$data['nama']."',".$ttlas.")");
                        ?>
                        <td><?= $sf."/".count($vsf)." = ".($tsf) ?></td>
                        <td><?=$ttlas?></td>
                    </tr>
                <?php endforeach; ?> 
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-12 justify-content-center panel mt-2">
    <div class="table-responsive">
    <h1 class="text-lg font-semibold">Calon karyawan yang mendapatkan kenaikan jabatan</h1>
    <table class="table table-hover table-striped mb-2">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $no=1;
                    $vwpenduduk = query("select * from hasil");
                foreach ($vwpenduduk as $data) : ?>
                    <tr>
                        <td><?= $data['nama']; ?></td>
                        <td><?= ($data['hasil']>4.00)?'Layak ':'Tidak Layak'?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-12 justify-content-center panel mt-2">
    <div class="table-responsive">
    <h1 class="text-lg font-semibold">Calon karyawan yang mendapatkan kenaikan jabatan</h1>
    <table class="table table-hover table-striped mb-2">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Urutan dari layak ke tidak layak</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $no=1;
                    $vwpenduduk = query("select * from hasil order by hasil desc");
                foreach ($vwpenduduk as $data) : ?>
                    <tr>
                        <td><?= $data['nama']; ?></td>
                        <td><?=$no++?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("modal", (initialOpenState = false) => ({
                open: initialOpenState,
    
                toggle() {
                    this.open = !this.open;
                },
            }));
        });
    </script>