<h2>Daftar Buku</h2>
<?php
  foreach ($produk as $row) {
?>
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="kotak">
              <form method="post" action="<?php echo base_url();?>pengguna/pinjam/tambah" method="post" accept-charset="utf-8">
                <a href="#"><img class="img-thumbnail" style="height: 200px" src="<?php echo base_url() . 'assets/images/'.$row['gambar']; ?>"/></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#"><?php echo $row['nama_buku'];?></a>
                  </h4>
                  <p class="card-text"><?php echo $row['deskripsi'];?></p>
                </div>
                <div class="card-footer">
                  
                  <input type="hidden" name="id" value="<?php echo $row['id_buku']; ?>" />
                  <input type="hidden" name="nama" value="<?php echo $row['nama_buku']; ?>" />
                  <input type="hidden" name="harga" value="<?php echo $row['harga']; ?>" />
                  <input type="hidden" name="gambar" value="<?php echo $row['gambar']; ?>" />
                  <input type="hidden" name="qty" value="1" />
                  <button type="submit" class="btn btn-sm btn-success btn-block"><i class="glyphicon glyphicon-shopping-cart"></i> Keranjang</button>
                </div>
                </form>
              </div>
            </div>
<?php
  }
?>