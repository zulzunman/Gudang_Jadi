<!DOCTYPE html>
<html lang="en">
<head>
    <title>Barang Masuk</title>
</head>
<body>
    <h1>Barang Masuk</h1>
    <a href="<?=site_url('masuk/add')?>">tambah</a>
    <a href="<?=base_url()?>">kembali</a>
    <table border="2">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode Masuk</th>
                <th>Jumlah Masuk</th>
                <th>Nama Barang</th>
                <th>Ukuran</th>
                <th>Waktu Masuk</th>
                <th colspan="2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($mas as $j) {?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $j->kode_masuk ?></td>
                <td><?= $j->jumlah_masuk ?></td>
                <td><?= $j->nama_barang ?></td>
                <td><?= $j->ukuran ?></td>
                <td><?= $j->date ?></td>
                <!-- <td><a href="<?=site_url('masuk/edit/'.$j->id_masuk)?>">Edit</a></td> -->
                <td><a href="<?=site_url('masuk/delete/'.$j->id_masuk)?>" onclick="return confirm('Apakah Anda yakin akan menghapus?')">Hapus</a></td>
            </tr><?php } ?>
        </tbody>
    </table>
</body>
</html>