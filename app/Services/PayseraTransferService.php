<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PayseraTransferService
{
    protected $baseUrl;
    protected $macId;
    protected $macSecret;

    public function __construct()
    {
        $this->baseUrl = 'https://wallet.paysera.com/transfer/rest/v1/';
        $this->macId = env('PAYSERA_MAC_ID');
        $this->macSecret = env('PAYSERA_MAC_SECRET');
    }

    protected function getHeaders()
    {
        $nonce = uniqid();
        $timestamp = time();
        $signatureString = $this->macId . $nonce . $timestamp;
        $signature = hash_hmac('sha256', $signatureString, $this->macSecret);

        return [
            'Authorization' => 'MAC id="' . $this->macId . '", ts="' . $timestamp . '", nonce="' . $nonce . '", mac="' . $signature . '"',
            'Content-Type' => 'application/json'
        ];
    }

    public function createTransfer($total_amount)
    {
        $transferData = [
            'amount' => $total_amount,
            'beneficiary' => [],
            'payer' => [],
            'finalBeneficiary' => null,
            'performAt' => now()->toDateTimeString(),
            'chargeType' => 'OUR',
            'urgency' => 'STANDARD',
            'notifications' => [],
            'purpose' => 'Order Payment',
            'password' => null,
            'cancelable' => false,
            'autoCurrencyConvert' => true,
            'autoChargeRelatedCard' => false,
            'autoProcessToDone' => true,
            'reserveUntil' => null,
            'callback' => null,
        ];
        $response = Http::withHeaders($this->getHeaders())
            ->post($this->baseUrl . 'transfers', $transferData);

        return $response;
    }

    public function signTransfer($id, $convertCurrency, $userIp)
    {
        $transferRegistrationParameters = [
            'convert_currency' => $convertCurrency,
            'user_ip' => $userIp,
        ];

        $response = Http::withHeaders($this->getHeaders())
            ->post($this->baseUrl . 'transfers/' . $id . '/sign', $transferRegistrationParameters);

        return $response->json();
    }
}
