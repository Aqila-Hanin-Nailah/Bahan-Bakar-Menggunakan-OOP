<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bahan Bakar</title>
</head>
<body>
    <?php
    class Shell {
        public $harga;
        public $jumlah;
        public $jenis;
        public $ppn;

        public function __construct($harga, $jumlah, $jenis) {
            $this->harga = $harga;
            $this->jumlah = $jumlah;
            $this->jenis = $jenis;
            $this->ppn = $harga * 0.10;
        }

        public function total() {
            return $this->harga * $this->jumlah + $this->ppn;
        }
    }

    class Beli extends Shell {
        public function buktiTransaksi() {
            echo "<center>--------------------------------------------</center>";
            echo "<center>Anda membeli bahan bakar minyak tipe {$this->jenis}<br>Dengan jumlah : {$this->jumlah} Liter<br>Total yang harus anda bayar : Rp. " . number_format($this->total(), 2, ',', '.') . "</center>";
            echo "<center>--------------------------------------------</center>";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $liter = floatval($_POST["liter"]);
        $fuel_type = $_POST["fuel_type"];

        switch ($fuel_type) {
            case "ShellSuper":
                $harga = 15420;
                break;
            case "SVPowerDiesel":
                $harga = 16130;
                break;
            case "ShellVPowerDiesel":
                $harga = 18310;
                break;
            case "ShellVPowerNitro":
                $harga = 16510;
                break;
            default:
                $harga = 0;
        }

        $pembelian = new Beli($harga, $liter, $fuel_type);
        echo $pembelian->buktiTransaksi();
    }
    ?>
    <center>
    <form action="" method="post">
        <label for="liter">Masukkan Jumlah Liter:</label>
        <input type="number" step="0.01" id="liter" name="liter" required>
        <br><br>
        <label for="fuel_type">Pilih Tipe Bahan Bakar:</label>
        <select id="fuel_type" name="fuel_type" required>
            <option value="ShellSuper">Shell Super</option>
            <option value="SVPowerDiesel">Shell V-Power</option>
            <option value="ShellVPowerDiesel">Shell V-Power Diesel</option>
            <option value="ShellVPowerNitro">Shell V-Power Nitro</option>
        </select>
        <br><br>
        <label for="payment_method">Pilih Metode Pembayaran:</label>
        <select id="payment_method" name="payment_method" required>
            <option value="tunai">Tunai</option>
            <option value="nontunai">Non-Tunai</option>
        </select>
        <br><br>
        <input type="submit" value="Beli">
    </form>
    </center>
</body>
</html>