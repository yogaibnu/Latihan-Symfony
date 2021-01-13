<?php

namespace App\Entity;

use App\Repository\ProdukRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProdukRepository::class)
 */
class Produk
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $nama_produk;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $qty;

    /**
     * @ORM\ManyToOne(targetEntity=Kategori::class, inversedBy="Produk")
     */
    private $Kategori;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamaProduk(): ?string
    {
        return $this->nama_produk;
    }

    public function setNamaProduk(string $nama_produk): self
    {
        $this->nama_produk = $nama_produk;

        return $this;
    }

    public function getQty(): ?string
    {
        return $this->qty;
    }

    public function setQty(string $qty): self
    {
        $this->qty = $qty;

        return $this;
    }

    public function getKategori(): ?Kategori
    {
        return $this->Kategori;
    }

    public function setKategori(?Kategori $Kategori): self
    {
        $this->Kategori = $Kategori;

        return $this;
    }
}
