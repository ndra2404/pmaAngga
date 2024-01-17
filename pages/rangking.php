<div class="col-md-12 justify-content-center panel mt-2">
    <div class="table-responsive">
    <h1>Hasil Akhir</h1>
    <table class="table table-hover table-striped mb-4 mt-2">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Urutan dari layak ke tidak layak</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $no=1;
                    $vwpenduduk = query("select * from hasil");
                foreach ($vwpenduduk as $data) : ?>
                    <tr>
                        <td><?= $data['nama']; ?></td>
                        <td><?=($data['hasil']>4.00)?'Layak ':'Tidak Layak'?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <hr style="margin-top:50px">
        <h1>Diurutkan dari layak sampai tidak layak</h1>
        <table class="table table-hover table-striped mb-2 mt-2">
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