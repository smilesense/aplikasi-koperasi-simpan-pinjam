<form action="" method="POST">
            <div class="form-group">
                <label for="name">Nama Lengkap : </label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $_SESSION["name"];?>" required readonly>
            </div>

            <div class="form-group">
            <label for="nominal">Nominal Pinjaman : </label>
            <input type="number" class="form-control" id="nominal" name="nominal" value="" min="500000" max="10000000" step="100000" onchange="return get_bunga()" placeholder="Masukkan Nominal"required>
            </div>

            <div class="form-group">
            <label for="durasi">Durasi Pinjaman (bulan) : </label>
            <select class="form-control" id="durasi" name="durasi" value="" onchange="return cek_return()" placeholder="Durasi Pinjaman"required>
                <option value="">Silakan Pilih Durasi Pinjaman</option>
                <option value="3">3 Bulan</option>
                <option value="6">6 Bulan</option>
                <option value="9">9 Bulan</option>
                <option value="12">12 Bulan</option>
                <option value="15">15 Bulan</option>
                <option value="18">18 Bulan</option>
                <option value="21">21 Bulan</option>
                <option value="24">24 Bulan</option>
            </select>
            </div>
            <script type="text/javascript">

                function get_bunga(){
                    durasi = document.getElementById("durasi").value;
                    nominal = document.getElementById("nominal").value;

                    document.getElementById("total").value = (nominal*1+((nominal*2.5)/100)*durasi);
                }
                function cek_return(){
                    durasi = document.getElementById("durasi").value;
                    nominal = document.getElementById("nominal").value;

                    var myDate = new Date(new Date().getTime()+((durasi*30)*24*60*60*1000)).toLocaleDateString();

                    document.getElementById("tanggal_return").value = myDate;
                    document.getElementById("total").value = (nominal*1+((nominal*2.5)/100)*durasi);
                }
            </script>

            <div class="form-group">
            <label for="tanggal_return">Tanggal Pengembalian : </label>
            <input type="text" class="form-control" id="tanggal_return" name="tanggal_return" value="" required readonly>
            </div>

            <div class="form-group">
            <label for="total">Total yang harus dikembalkan (termasuk bunga):</label>
            <input type="text" class="form-control" id="total" name="total" value="<?php echo $r['total_harga']?>" readonly>
            </div>

            <div class="form-group">
            <label for="confirm_password">Konfirmasi Password:</label>
            <input type="text" class="form-control" id="confirm_password" name="confirm_password" value="" placeholder="Masukkan Password Anda" readonly>
            </div>
            
            <button type="submit" class="btn btn-primary"><i class="fas fa-money-check-alt"></i> Pinjam</button>
        </form>

<!-- index user -->
<div class="col-sm-6">
                        <div class="card bg-info">
                            <div class="card-body text-white">
                                <h2 class="card-title">Simpanan Saya</h2>
                                <h5 class="card-text">Rp. <?php echo $saldo_simpanan[0]; ?></h5>
                                <a href="#" class="btn btn-primary">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card bg-info">
                            <div class="card-body text-white">
                                <h2 class="card-title">Pinjaman Saya</h2>
                                <h5 class="card-text">Rp. <?php echo $nominal_pinjaman[0]; ?></h5>
                                <a href="/user/list_pinjaman.php" class="btn btn-primary">Lihat Detail</a>
                            </div>
                        </div>
                    </div>