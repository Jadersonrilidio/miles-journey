<?php

namespace App\ValueObjects;

use App\Enums\Currency;

class Price implements ValueObject
{
    /**
     * 
     */
    public readonly string $formatted;

    /**
     * 
     */
    private function __construct(
        public readonly int $amount,
        public readonly Currency $currency
    ) {
        $this->formatted = $this->formattedValue();
    }

    /**
     * Make a Price value object in BRL currency.
     *
     * @param int $amount Amount value in cents.
     *
     * @return Price
     */
    public static function BRL(int $amount): static
    {
        return new static($amount, Currency::BRL);
    }

    /**
     * Make a Price value object in USD currency.
     *
     * @param int $amount Amount value in cents.
     *
     * @return Price
     */
    public static function USD(int $amount): static
    {
        return new static($amount, Currency::USD);
    }

    /**
     * Make a Price value object in EUR currency.
     *
     * @param int $amount Amount value in cents.
     *
     * @return Price
     */
    public static function EUR(int $amount): static
    {
        return new static($amount, Currency::EUR);
    }

    /**
     * 
     */
    private function formattedValue(): string
    {
        return $this->currencySymbol() . $this->numberFormatPerCurrency();
    }

    /**
     * 
     */
    private function numberFormatPerCurrency(): string
    {
        $amount = $this->amount / 100;

        return match ($this->currency->value) {
            'BRL' => number_format($amount, 2, ',', '.'),
            'USD' => number_format($amount, 2),
            'EUR' => number_format($amount, 2),
        };
    }

    /**
     * 
     */
    private function currencySymbol(): string
    {
        return match ($this->currency->value) {
            'BRL' => 'R$',
            'USD' => '$',
            'EUR' => '€',
        };
    }

    /**
     * 
     */
    public function jsonSerialize(): mixed
    {
        return $this->formatted;
    }

    /**
     * 
     */
    public function __toString(): string
    {
        return $this->formatted;
    }
}
