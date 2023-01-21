<!DOCTYPE html>
<html lang="en">
<head>
    <title>Stok</title>
</head>
<body>
    <h1>Tambah Stok</h1>
    <a href="<?=site_url('jenis')?>">Kembali</a>
    
	<?php
	$kode='';
	$nama='';

	if(isset($je)) {
		$kode=$je->kode_jenis;
		$nama=$je->nama_jenis;
	}
	?>
    <div>
        <form action="" method="post">
            <div>
                <label for="">Kode Jenis</label>
                <div>
                    <input type="text" name="kode_jenis" value="<?=$kode?>">
                </div>
            </div>
            <div>
                <label for="">Nama Jenis</label>
                <div><input type="text" name="nama_jenis" value="<?=$nama?>"></div>
            </div>
            <div>
                <input type="submit" value="Simpan" name="Simpan">
                <input type="reset" value="Reset" name="Reset">
            </div>
        </form>
    </div>
    
</body>
</html>