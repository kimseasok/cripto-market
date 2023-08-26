<?php

/**
 * ChainDeployErc20KMS Model
 *
 * @copyright (c) 2022-2023 tatum.io
 * @license   MIT
 * @package   Tatum
 * @author    Mark Jivko
 * @link      https://tatum.io/
 *
 * NOTE: This class is auto-generated by tatum.io
 * Do not edit this file manually!
 */

namespace Tatum\Model;
!defined("TATUM-SDK") && exit();

/**
 * ChainDeployErc20KMS Model
 */
class ChainDeployErc20KMS extends AbstractModel {

    public const _D = null;
    public const CHAIN_ETH = 'ETH';
    public const CHAIN_BSC = 'BSC';
    public const CHAIN_MATIC = 'MATIC';
    public const CHAIN_KLAY = 'KLAY';
    public const CHAIN_XDC = 'XDC';
    public const CHAIN_ONE = 'ONE';
    protected static $_name = "ChainDeployErc20KMS";
    protected static $_definition = [
        "chain" => ["chain", "string", null, "getChain", "setChain", null, ["r" => 1, "e" => 1]], 
        "symbol" => ["symbol", "string", null, "getSymbol", "setSymbol", null, ["r" => 1, "nl" => 1, "xl" => 30]], 
        "name" => ["name", "string", null, "getName", "setName", null, ["r" => 1, "p" => "/^[a-zA-Z0-9_]+$/", "nl" => 1, "xl" => 100]], 
        "total_cap" => ["totalCap", "string", null, "getTotalCap", "setTotalCap", null, ["r" => 0, "p" => "/^[+]?((\\d+(\\.\\d*)?)|(\\.\\d+))$/", "xl" => 38]], 
        "supply" => ["supply", "string", null, "getSupply", "setSupply", null, ["r" => 1, "p" => "/^[+]?((\\d+(\\.\\d*)?)|(\\.\\d+))$/", "xl" => 38]], 
        "digits" => ["digits", "float", null, "getDigits", "setDigits", null, ["r" => 1, "n" => [1], "x" => [30]]], 
        "address" => ["address", "string", null, "getAddress", "setAddress", null, ["r" => 1, "nl" => 42, "xl" => 43]], 
        "signature_id" => ["signatureId", "string", 'uuid', "getSignatureId", "setSignatureId", null, ["r" => 1]], 
        "nonce" => ["nonce", "float", null, "getNonce", "setNonce", null, ["r" => 0, "n" => [0]]], 
        "fee" => ["fee", "\Tatum\Model\CustomFee", null, "getFee", "setFee", null, ["r" => 0]]
    ];

    /**
     * ChainDeployErc20KMS
     *
     * @param mixed[] $data Model data
     */
    public function __construct(array $data = []) {
        foreach(static::$_definition as $k => $v) {
            $this->_data[$k] = isset($data[$k]) ? $data[$k] : $v[5];
        }
    }

    /**
     * Get allowable values
     *
     * @return string[]
     */
    public function getChainAllowableValues(): array {
        return [
            self::CHAIN_ETH,
            self::CHAIN_BSC,
            self::CHAIN_MATIC,
            self::CHAIN_KLAY,
            self::CHAIN_XDC,
            self::CHAIN_ONE,
        ];
    }

    /**
     * Get chain
     *
     * @return string
     */
    public function getChain(): string {
        return $this->_data["chain"];
    }

    /**
     * Set chain
     * 
     * @param string $chain The blockchain to work with
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setChain(string $chain) {
        return $this->_set("chain", $chain);
    }

    /**
     * Get symbol
     *
     * @return string
     */
    public function getSymbol(): string {
        return $this->_data["symbol"];
    }

    /**
     * Set symbol
     * 
     * @param string $symbol Symbol of the ERC20 token
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setSymbol(string $symbol) {
        return $this->_set("symbol", $symbol);
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string {
        return $this->_data["name"];
    }

    /**
     * Set name
     * 
     * @param string $name Name of the ERC20 token
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setName(string $name) {
        return $this->_set("name", $name);
    }

    /**
     * Get total_cap
     *
     * @return string|null
     */
    public function getTotalCap(): ?string {
        return $this->_data["total_cap"];
    }

    /**
     * Set total_cap
     * 
     * @param string|null $total_cap Max supply of ERC20 token.
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setTotalCap(?string $total_cap) {
        return $this->_set("total_cap", $total_cap);
    }

    /**
     * Get supply
     *
     * @return string
     */
    public function getSupply(): string {
        return $this->_data["supply"];
    }

    /**
     * Set supply
     * 
     * @param string $supply Max supply of ERC20 token.
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setSupply(string $supply) {
        return $this->_set("supply", $supply);
    }

    /**
     * Get digits
     *
     * @return float
     */
    public function getDigits(): float {
        return $this->_data["digits"];
    }

    /**
     * Set digits
     * 
     * @param float $digits Number of decimal points
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setDigits(float $digits) {
        return $this->_set("digits", $digits);
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress(): string {
        return $this->_data["address"];
    }

    /**
     * Set address
     * 
     * @param string $address Address on Ethereum blockchain, where all created ERC20 tokens will be transferred.
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setAddress(string $address) {
        return $this->_set("address", $address);
    }

    /**
     * Get signature_id
     *
     * @return string
     */
    public function getSignatureId(): string {
        return $this->_data["signature_id"];
    }

    /**
     * Set signature_id
     * 
     * @param string $signature_id Identifier of the private key associated in signing application. Private key, or signature Id must be present.
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setSignatureId(string $signature_id) {
        return $this->_set("signature_id", $signature_id);
    }

    /**
     * Get nonce
     *
     * @return float|null
     */
    public function getNonce(): ?float {
        return $this->_data["nonce"];
    }

    /**
     * Set nonce
     * 
     * @param float|null $nonce The nonce to be set to the transaction; if not present, the last known nonce will be used
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setNonce(?float $nonce) {
        return $this->_set("nonce", $nonce);
    }

    /**
     * Get fee
     *
     * @return \Tatum\Model\CustomFee|null
     */
    public function getFee(): ?\Tatum\Model\CustomFee {
        return $this->_data["fee"];
    }

    /**
     * Set fee
     * 
     * @param \Tatum\Model\CustomFee|null $fee fee
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setFee(?\Tatum\Model\CustomFee $fee) {
        return $this->_set("fee", $fee);
    }
}
