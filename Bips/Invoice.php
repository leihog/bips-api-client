<?php

namespace Bips;

class Invoice
{
	protected $currency;
	protected $item;
	protected $price;
	protected $custom;

	public function __construct()
	{
		$this->custom = [];
	}

	public function addCustom($key, $value)
	{
		$this->custom[$key] = $value;
	}

	public function getPayload()
	{
		$payload = [];
		foreach(['price', 'currency', 'item'] as $field) {
			$payload[$field] = $this->$field;
		}

		$payload['custom'] = json_encode($this->custom);
		return $payload;
	}

	public function setCurrency($currency)
	{
		$this->currency = $currency;
	}

	public function setItem($item)
	{
		$this->item = $item;
	}

	public function setPrice($price)
	{
		$this->price = $price;
	}

}
