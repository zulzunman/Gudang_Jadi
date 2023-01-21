<!DOCTYPE html>
<html lang="en">
<head>
    <title>Barang Masuk</title>
</head>
<body>
    <h1>Tambah Barang Masuk</h1>
    <a href="<?=site_url('masuk')?>">Kembali</a>
    
	<?php
	$kode='';
	$jumlah='';
    $ukur='';
    $nama='';

	if(isset($ma)) {
		$kode=$ma->kode_masuk;
		$jumlah=$ma->jumlah_masuk;
		$nama=$ma->id_stok;
		$ukur=$ma->id_stok;
	}
	?>
    <div>
        <form action="" method="post">
            <div>
                <label for="">Kode Masuk</label>
                <div>
                    <input type="text" name="kode_masuk" value="<?=$kode?>">
                </div>
            </div>
            <div>
                <label for="jenis_barang">Nama Barang</label>
                <div>
                    <select name="id_stok" id="">
                        <option value="">pilih mang</option>
                        <?php foreach ($set as $j) {?>
                        <option value="<?=$j->id_stok?>"<?=$nama==$j->id_stok?>><?=$j->nama_barang?></option>
                        <?php }?>
                    </select>
                </div>
            </div>
            <div>
                <label for="jenis_barang">Ukuran</label>
                <div>
                    <select name="id_stok" id="">
                        <option value="">pilih mang</option>
                        <?php foreach ($set as $j) {?>
                        <option value="<?=$j->id_stok?>"<?=$ukur==$j->id_stok?>><?=$j->ukuran?></option>
                        <?php }?>
                    </select>
                </div>
            </div>
            <div>
                <label for="">Jumlah Barang</label>
                <div><input type="text" name="jumlah_masuk" value="<?=$jumlah?>" required></div>
            </div>
            <div>
                <input type="submit" value="Simpan" name="Simpan">
                <input type="reset" value="Reset" name="Reset">
            </div>
        </form>
    </div>
    
</body>
</html>