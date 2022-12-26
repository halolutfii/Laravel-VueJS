<?php

trait Hewan{
    public $nama;
    public $darah = 50;
    public $jumlahkaki;
    public $keahlian;

    public function atraksi(){
        echo "{$this->nama} Menggunakan Keahlian {$this->keahlian}";
    }
}

abstract class Fight{
    use Hewan;
    public $attackPower;
    public $deffencePower;

    public function serang($hewan){
        echo "{$this->nama} sedang menyerang {$hewan->nama} & ";

        $hewan->diserang($this);
    }

    public function diserang($hewan){
        echo "{$this->nama} sedang diserang {$hewan->nama}";

        $this->darah = $this->darah - ($hewan->attackPower / $this->deffencePower);
    }

    protected function getInfo(){
        echo "<br>";
        echo "Nama : {$this->nama}";
        echo "<br>";
        echo "Jumlah Kaki : {$this->jumlahkaki}";
        echo "<br>";
        echo "Darah : {$this->darah}";
        echo "<br>";
        echo "Keahlian : {$this->keahlian}";
        echo "<br>";
        echo "Attack Power : {$this->attackPower}";
        echo "<br>";
        echo "Deffence Power : {$this->deffencePower}";
        echo "<br>";

        $this->atraksi();
    }
    abstract public function getInfoHewan();
}

class Elang extends Fight {
    public function __construct($nama)
    {
        $this->nama = $nama;
        $this->jumlahkaki = 2;
        $this->keahlian = "Terbang Tinggi";
        $this->attackPower = 10;
        $this->deffencePower = 5;
    }

    public function getInfoHewan()
    {
        echo "Jenis Hewan : Elang";
        $this->getInfo();
    }
}

class Spasi{
    public static function tampilkan(){
        echo "<br>";
        echo "================================";
        echo "<br>";
    }
}

class Harimau extends Fight {
    public function __construct($nama)
    {
        $this->nama = $nama;
        $this->jumlahkaki = 4;
        $this->keahlian = "Lari Cepat";
        $this->attackPower = 7;
        $this->deffencePower = 8;
    }

    public function getInfoHewan()
    {
        echo "Jenis Hewan : Harimau";
        $this->getInfo();
    }
}

$elang = new Elang("Elang");
$elang->getInfoHewan();
Spasi::tampilkan();
$harimau = new Harimau("Harimau");
$harimau->getInfoHewan();
Spasi::tampilkan();
$elang->serang($harimau);
Spasi::tampilkan();
$harimau->getInfoHewan();
Spasi::tampilkan();
$harimau->serang($elang);
Spasi::tampilkan();
$elang->getInfoHewan();
?>