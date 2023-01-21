<!DOCTYPE html>
<html lang="en">
<head>
    <title>Barang Keluar</title>
</head>
<body>
    <h1>Tambah Barang Keluar</h1>
    <a href="<?=site_url('keluar')?>">Kembali</a>
    
	<?php
	$kode='';
	$jumlah='';
    $nama='';
    $ukur='';

	if(isset($ke)) {
		$kode=$ke->kode_keluar;
        $nama=$ke->id_stok;
        $ukur=$ke->id_stok;
		$jumlah=$ke->jumlah_keluar;
	}
	?>
    <div>
        <form action="" method="post">
            <div>
                <label for="">Kode Keluar</label>
                <div>
                    <input type="text" name="kode_keluar" value="<?=$kode?>">
                </div>
            </div>
            <div>
                <label for="nama_barang">Nama Barang</label>
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
                <label for="nama_barang">Ukuran</label>
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
                <div><input type="text" name="jumlah_keluar" value="<?=$jumlah?>" required></div>
            </div>
            <div>
                <input type="submit" value="Simpan" name="Simpan">
                <input type="reset" value="Reset" name="Reset">
            </div>
        </form>
    </div>
    
</body>
</html>