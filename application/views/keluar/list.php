<!DOCTYPE html>
<html lang="en">
<head>
    <title>Barang Keluar</title>
</head>
<body>
    <h1>Barang Keluar</h1>
    <a href="<?=site_url('keluar/add')?>">tambah</a>
    <a href="<?=base_url()?>">kembali</a>
    <table border="2">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode Keluar</th>
                <th>Jumlah Keluar</th>
                <th>Nama Barang</th>
                <th>Ukuran</th>
                <th>Waktu Keluar</th>
                <th colspan="2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($kel as $j) {?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $j->kode_keluar ?></td>
                <td><?= $j->jumlah_keluar ?></td>
                <td><?= $j->nama_barang ?></td>
                <td><?= $j->ukuran ?></td>
                <td><?= $j->date ?></td>
                <!-- <td><a href="<?=site_url('keluar/edit/'.$j->id_keluar)?>">Edit</a></td> -->
                <td><a href="<?=site_url('keluar/delete/'.$j->id_keluar)?>" onclick="return confirm('Apakah Anda yakin akan menghapus?')">Hapus</a></td>
            </tr><?php } ?>
        </tbody>
    </table>
</body>
</html>