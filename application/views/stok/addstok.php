<!DOCTYPE html>
<html lang="en">
<head>
    <title>Input</title>
</head>
<body>
    <h1>Input Stok</h1>
    <a href="<?=site_url('stok')?>">Kembali</a>
    <?php
	$kode='';
	$nama='';
    $ukur='';
    $jenis='';

	if(isset($st)) {
		$kode=$st->kode_stok;
		$nama=$st->nama_barang;
        $ukur=$st->ukuran;
        $jenis=$st->nama_jenis;
	}
	?>
    <div>
        <form action="" method="post">
            <div>
                <label for="kode_stok">Kode Barang</label>
                <div>
                    <input type="text" name="kode_stok" value="<?=$kode?>">
                </div>
            </div>
            <div>
                <label for="nama_barang">Nama Barang</label>
                <div>
                    <input type="text" name="nama_barang" value="<?=$nama?>">
                </div>
            </div>
            <div>
                <label for="jenis_barang">Jenis Barang</label>
                <div>
                    <select name="nama_jenis" id="">
                        <option value="">pilih mang</option>
                        <?php foreach ($jen as $j) {?>
                        <option value="<?=$j->nama_jenis?>"<?=$jenis==$j->nama_jenis?>><?=$j->nama_jenis?></option>
                        <?php }?>
                    </select>
                </div>
            </div>
            <div>
                <label for="ukuran_barang">Ukuran Barang</label>
                <div>
                    <input type="text" name="ukuran" value="<?=$ukur?>">
                </div>
            </div>
            <div>
                <input type="hidden" name="jumlah" value="0">
            </div>
            <div>
                <input type="submit" value="Simpan" name="Simpan">
                <input type="reset" value="reset" name="reset">
            </div>
        </form>
    </div>
</body>
</html>