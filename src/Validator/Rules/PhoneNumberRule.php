<?php
namespace FormValidator\Validator\Rules;

class PhoneNumberRule extends AbstractRule implements Rule
{
    public function validate($value)
    {
        $phoneNormalized = $this->normalizePhoneNumber($value);

        return $this->hasForbiddenSymbols($phoneNormalized);
    }

    public function normalizePhoneNumber($number)
    {
        return preg_replace("/(\(|\)|\+|-|\s)/", "", $number);
    }

    public function hasForbiddenSymbols($number)
    {
        preg_match('/\D/', $number, $forbiddenSymbolsArray);

        if ($forbiddenSymbolsArray !== [])
            return true;

        return false;
    }
}