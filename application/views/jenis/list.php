<!DOCTYPE html>
<html lang="en">
<head>
    <title>Jenis</title>
</head>
<body>
    <h1>Jenis Barang</h1>
    <a href="<?=site_url('jenis/add')?>">tambah</a>
    
    <a href="<?=base_url()?>">kembali</a>
    <table border="2">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode Jenis</th>
                <th>Nama Jenis</th>
                <th colspan="2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($jen as $j) {?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $j->kode_jenis ?></td>
                <td><?= $j->nama_jenis ?></td>
                <td><a href="<?=site_url('jenis/edit/'.$j->id_jenis)?>">Edit</a></td>
                <td><a href="<?=site_url('jenis/delete/'.$j->id_jenis)?>" onclick="return confirm('Apakah Anda yakin akan menghapus?')">Hapus</a></td>
            </tr><?php } ?>
        </tbody>
    </table>
</body>
</html>