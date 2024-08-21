<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Http;
use SimpleXMLElement;

class NamecheapService
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.namecheap.sandbox_api_url');
    }

    public function getDomainPrice(string $userName, string $apiKey, string $domainName): float|array|null
    {
        $response = Http::get($this->apiUrl, [
            'ApiUser' => $userName,
            'ApiKey' => $apiKey,
            'UserName' => $userName,
            'Command' => 'namecheap.users.getPricing',
            'ClientIp' => request()->ip(),
            'ProductType' => 'DOMAIN',
            'ProductCategory' => 'REGISTER',
            'ActionName' => 'REGISTER',
            'ProductName' => $this->getTld($domainName),
        ]);

        $xml = simplexml_load_string($response->body());
        if ($xml->Errors->Error) {
            $errorMessage = (string)$xml->Errors->Error;
            return ['error' => true, 'message' => trans('validation.' . $errorMessage, [], 'ru')];
        }

        if ($xml->CommandResponse->UserGetPricingResult->ProductType->ProductCategory) {
            $pricing = $xml->CommandResponse->UserGetPricingResult->ProductType->ProductCategory->Product->Price;
            $price = $pricing->attributes();

            return (float)$price->RegularPrice;
        }

        return null;
    }

    private function getTld(string $domainName): string
    {
        return substr($domainName, strrpos($domainName, '.') + 1);
    }

    public function getDomainInfo(string $userName, string $apiKey, string $domainName): SimpleXMLElement|null
    {
        $response = Http::get($this->apiUrl, [
            'ApiUser' => $userName,
            'ApiKey' => $apiKey,
            'UserName' => $userName,
            'Command' => 'namecheap.domains.check',
            'ClientIp' => request()->ip(),
            'DomainList' => $domainName,
        ]);

        $xml = simplexml_load_string($response->body());
        if ($xml->CommandResponse) {
            $domainInfo = $xml->CommandResponse->DomainCheckResult;

            return $domainInfo;
        }

        return null;
    }

    public function getBalance(string $userName, string $apiKey): ?string
    {
        $response = Http::get($this->apiUrl, [
            'ApiUser' => $userName,
            'ApiKey' => $apiKey,
            'UserName' => $userName,
            'Command' => 'namecheap.users.getBalances',
            'ClientIp' => request()->ip(),
        ]);

        $xml = simplexml_load_string($response->body());
        if ($xml->CommandResponse) {
            $balance = (string)$xml->CommandResponse->UserGetBalancesResult['AccountBalance'];

            return $balance;
        }

        return null;
    }

    public function changePassword(string $userName, string $apiKey, string $oldPassword, string $newPassword): array|string|null
    {
        $response = Http::get($this->apiUrl, [
            'ApiUser' => $userName,
            'ApiKey' => $apiKey,
            'UserName' => $userName,
            'ClientIp' => request()->ip(),
            'Command' => 'namecheap.users.changePassword',
            'OldPassword' => $oldPassword,
            'NewPassword' => $newPassword,
        ]);

        $xml = simplexml_load_string($response->body());
        if ($xml->Errors->Error) {
            $errorMessage = (string)$xml->Errors->Error;
            return ['error' => true, 'message' => trans('validation.' . $errorMessage, [], 'ru')];
        }

        if ($xml->CommandResponse) {
            $contacts = (string)$xml->CommandResponse->UserGetContactsResult;

            return $contacts;
        }

        return null;
    }

    public function getDomainList(string $userName, string $apiKey): ?array
    {
        $response = Http::get($this->apiUrl, [
            'ApiUser' => $userName,
            'ApiKey' => $apiKey,
            'UserName' => $userName,
            'Command' => 'namecheap.domains.getList',
            'ClientIp' => request()->ip(),
        ]);

        $xml = simplexml_load_string($response->body());

        if ($xml->Errors->Error) {
            return null;
        }
        $domains = [];
        foreach ($xml->CommandResponse->DomainGetListResult->Domain as $domain) {
            $domains[] = [
                'name' => (string)$domain['Name'],
                'created' => (string)$domain['Created'],
                'expires' => (string)$domain['Expires'],
                'price' => (float)$this->getDomainPrice($userName, $apiKey, (string)$domain['Name']),
            ];
        }

        return $domains;
    }

    public function purchaseDomain(string $userName, string $apiKey, array $data): ?string
    {
        $postData = [
            'ApiUser' => $userName,
            'ApiKey' => $apiKey,
            'UserName' => $userName,
            'Command' => 'namecheap.domains.create',
            'ClientIp' => request()->ip(),
            'DomainName' => $data['domain'],
            'Years' => 1,
            'AuxBillingFirstName' => $data['firstname'],
            'AuxBillingLastName' => $data['surname'],
            'AuxBillingAddress1' => $this->transliterate($data['address']),
            'AuxBillingStateProvince' => $this->transliterate($data['state']),
            'AuxBillingPostalCode' => $data['postal_code'],
            'AuxBillingCountry' => $data['country'],
            'AuxBillingPhone' => $this->formatPhoneNumber($data['phone']),
            'AuxBillingEmailAddress' => $data['email'],
            'AuxBillingCity' => $this->transliterate($data['city']),
            'TechFirstName' => $data['firstname'],
            'TechLastName' => $data['surname'],
            'TechAddress1' => $this->transliterate($data['address']),
            'TechStateProvince' => $this->transliterate($data['state']),
            'TechPostalCode' => $data['postal_code'],
            'TechCountry' => $data['country'],
            'TechPhone' => $this->formatPhoneNumber($data['phone']),
            'TechEmailAddress' => $data['email'],
            'TechCity' => $this->transliterate($data['city']),
            'AdminFirstName' => $data['firstname'],
            'AdminLastName' => $data['surname'],
            'AdminAddress1' => $this->transliterate($data['address']),
            'AdminStateProvince' => $this->transliterate($data['state']),
            'AdminPostalCode' => $data['postal_code'],
            'AdminCountry' => $data['country'],
            'AdminPhone' => $this->formatPhoneNumber($data['phone']),
            'AdminEmailAddress' => $data['email'],
            'AdminCity' => $this->transliterate($data['city']),
            'RegistrantFirstName' => $data['firstname'],
            'RegistrantLastName' => $data['surname'],
            'RegistrantAddress1' => $this->transliterate($data['address']),
            'RegistrantStateProvince' => $this->transliterate($data['state']),
            'RegistrantPostalCode' => $data['postal_code'],
            'RegistrantCountry' => $data['country'],
            'RegistrantPhone' => $this->formatPhoneNumber($data['phone']),
            'RegistrantEmailAddress' => $data['email'],
            'RegistrantCity' => $this->transliterate($data['city']),
            'AddFreeWhoisguard' => 'no',
            'WGEnabled' => 'no',
            'GenerateAdminOrderRefId' => 'False',
            'IsPremiumDomain' => 'False',
            'PremiumPrice' => '200.00',
            'EapFee' => '0'
        ];
        $response = Http::asForm()->post($this->apiUrl, $postData);

        $xml = simplexml_load_string($response->body());
        if ($xml->CommandResponse) {
            $contacts = (string)$xml->CommandResponse->DomainCreateResult;

            return $contacts;
        }

        return null;
    }

    private function transliterate($text): string
    {
        return iconv('UTF-8', 'ASCII//TRANSLIT', $text);
    }

    private function formatPhoneNumber($phoneNumber): string
    {
        $phoneNumber = str_replace(['+', '-', ' '], '', $phoneNumber);
        return '+7.' . substr($phoneNumber, 1);
    }
}
