<!DOCTYPE html>
<html lang="en">
<head>
    <title>Stok</title>
</head>
<body>
    <h1>Stok Barang</h1>
    <a href="<?=site_url('stok/add')?>"><button>Tambah Stok</button></a>
    
    <a href="<?=base_url()?>"><button>KEMBALI</button></a>
    <br>
    <table border="1">
        <thead>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Ukuran</th>
            <th>Jenis</th>
            <th>Jumlah</th>
            <th colspan="2">Aksi</th>
        </thead>
        <tbody>
            <?php $no =1; foreach ($set as $s) {?>
                <tr>
                    <td><?=$no++?></td>
                    <td><?=$s->kode_stok?></td>
                    <td><?=$s->nama_barang?></td>
                    <td><?=$s->ukuran?></td>
                    <td><?=$s->nama_jenis?></td>
                    <td><?=$s->jumlah?></td>
                    <td><a href="<?=site_url('stok/edit/'.$s->id_stok)?>">Edit</a></td>
                    <td><a href="<?=site_url('stok/delete/'.$s->id_stok)?>" onclick="return confirm('Apakah Anda yakin akan menghapus?')">Hapus</a></td>
                </tr>
            <?php }?>
        </tbody>
    </table>
</body>
</html>