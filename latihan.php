<?php

interface MetodePembayaran {
    public function prosesBayar(float $jumlah, string $keterangan): bool;
    public function getNamaMetode(): string;
}

// Class TransferBank
class TransferBank implements MetodePembayaran {
    private $nomorRekening;

    public function __construct(string $nomorRekening) {
        $this->nomorRekening = $nomorRekening;
    }

    public function getNamaMetode(): string {
        return "Transfer Bank";
    }

    public function prosesBayar(float $jumlah, string $keterangan): bool {
        $admin = 0;
        $total = $jumlah + $admin;

        echo "<h3>PEMBAYARAN TRANSFER BANK</h3>";
        echo "Nomor Rekening: " . htmlspecialchars($this->nomorRekening) . "<br>";
        echo "Keterangan: " . htmlspecialchars($keterangan) . "<br>";
        echo "Jumlah Pembayaran: " . $this->formatRupiah($jumlah) . "<br>";
        echo "Biaya Admin (0%): " . $this->formatRupiah($admin) . "<br>";
        echo "Total Pembayaran: " . $this->formatRupiah($total) . "<br><br>";

        return true;
    }

    private function formatRupiah(float $jumlah): string {
        return "Rp " . number_format($jumlah, 0, ',', '.');
    }
}

// Class QRIS
class QRIS implements MetodePembayaran {

    public function getNamaMetode(): string {
        return "QRIS";
    }

    public function prosesBayar(float $jumlah, string $keterangan): bool {
        $admin = $jumlah * 0.007;
        $total = $jumlah + $admin;

        echo "<h3>PEMBAYARAN QRIS</h3>";
        echo "Keterangan: " . htmlspecialchars($keterangan) . "<br>";
        echo "Jumlah Pembayaran: " . $this->formatRupiah($jumlah) . "<br>";
        echo "Biaya Admin (0,7%): " . $this->formatRupiah($admin) . "<br>";
        echo "Total Pembayaran: " . $this->formatRupiah($total) . "<br><br>";

        return true;
    }

    private function formatRupiah(float $jumlah): string {
        return "Rp " . number_format($jumlah, 0, ',', '.');
    }
}

// Class KartuKredit
class KartuKredit implements MetodePembayaran {
    private $nomorKartu;

    public function __construct(string $nomorKartu) {
        $this->nomorKartu = $nomorKartu;
    }

    public function getNamaMetode(): string {
        return "Kartu Kredit";
    }

    public function prosesBayar(float $jumlah, string $keterangan): bool {
        $admin = $jumlah * 0.025;
        $total = $jumlah + $admin;

        $empatDigit = substr($this->nomorKartu, -4);

        echo "<h3>PEMBAYARAN KARTU KREDIT</h3>";
        echo "Nomor Kartu: **** **** **** " .
             htmlspecialchars($empatDigit) . "<br>";
        echo "Keterangan: " . htmlspecialchars($keterangan) . "<br>";
        echo "Jumlah Pembayaran: " . $this->formatRupiah($jumlah) . "<br>";
        echo "Biaya Admin (2,5%): " . $this->formatRupiah($admin) . "<br>";
        echo "Total Pembayaran: " . $this->formatRupiah($total) . "<br><br>";

        return true;
    }

    private function formatRupiah(float $jumlah): string {
        return "Rp " . number_format($jumlah, 0, ',', '.');
    }
}

// Contoh penggunaan
echo "<h2>SISTEM PEMBAYARAN</h2>";

$transfer = new TransferBank("1234567890");
$transfer->prosesBayar(500000, "Pembelian barang");

$qris = new QRIS();
$qris->prosesBayar(500000, "Pembelian barang");

$kartu = new KartuKredit("1234567812345678");
$kartu->prosesBayar(500000, "Pembelian barang");

?>