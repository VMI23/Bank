<?php

namespace App\Models;


class CryptoCurrency
{
    private int $id;
    private string $name;
    private string $symbol;
    private float $price;
    private float $change24h;

    public function __construct(int $id, string $name, string $symbol, float $price, float $change24h)
    {
        $this->id = $id;
        $this->name = $name;
        $this->symbol = $symbol;
        $this->price = $price;
        $this->change24h = $change24h;
    }


    public function getId(): int
    {
        return $this->id;
    }


    public function getName(): string
    {
        return $this->name;
    }


    public function getSymbol(): string
    {
        return $this->symbol;
    }


    public function getPrice(): float
    {
        return $this->price;
    }

    public function getChange24h(): float
    {
        return $this->change24h;
    }


}
