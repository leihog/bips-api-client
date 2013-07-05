<?php

namespace Bips;

class Client
{
	protected $keys;
	protected $basePath = 'https://bips.me/api/v1';

	public function __construct(array $config)
	{
		$required = ['keys'];
		foreach($required as $field) {
			if (empty($config[$field])) {
				throw new \Exception("Required parameter '{$field}' is missing");
			}
		}

		// BIPS uses a seperate key for each API method :/
		if (!is_array($config['keys'])) {
			throw new \Exception("Invalid value for parameter 'keys'.");
		}

		foreach(['invoice', 'balance', 'sendto', 'export'] as $key) {
			if (empty($config['keys'][$key])) {
				$config['keys'][$key] == null;
			}
		}

		$this->keys = $config['keys'];
	}

	public function invoice(Invoice $invoice)
	{
		$payload = $invoice->getPayload();

		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => $this->basePath . '/invoice',
			CURLOPT_USERPWD => $this->keys['invoice'],
			CURLOPT_POSTFIELDS => $payload,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HTTPAUTH => CURLAUTH_BASIC
		));
		$response = curl_exec($ch);
		curl_close($ch);

		return $response;
	}
}
