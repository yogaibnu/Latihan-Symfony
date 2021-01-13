<?php

namespace App\Entity;

use App\Repository\KategoriRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KategoriRepository::class)
 */
class Kategori
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
    public $nama_kategori;

    /**
     * @ORM\OneToMany(targetEntity=Produk::class, mappedBy="Kategori")
     */
    private $Produk;

    //ubah ke string
    public function __toString()
    {
        return $this->nama_kategori;
    }

    public function __construct()
    {
        $this->Produk = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamaKategori(): ?string
    {
        return $this->nama_kategori;
    }

    public function setNamaKategori(string $nama_kategori): self
    {
        $this->nama_kategori = $nama_kategori;

        return $this;
    }

    /**
     * @return Collection|Produk[]
     */
    public function getProduk(): Collection
    {
        return $this->Produk;
    }

    public function addProduk(Produk $produk): self
    {
        if (!$this->Produk->contains($produk)) {
            $this->Produk[] = $produk;
            $produk->setKategori($this);
        }

        return $this;
    }

    public function removeProduk(Produk $produk): self
    {
        if ($this->Produk->removeElement($produk)) {
            // set the owning side to null (unless already changed)
            if ($produk->getKategori() === $this) {
                $produk->setKategori(null);
            }
        }

        return $this;
    }
}
