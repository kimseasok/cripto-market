<?php

/**
 * AlgorandGetBalance_200_response_assets_inner Model
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
 * AlgorandGetBalance_200_response_assets_inner Model
 */
class AlgorandGetBalance200ResponseAssetsInner extends AbstractModel {

    public const _D = null;
    protected static $_name = "AlgorandGetBalance_200_response_assets_inner";
    protected static $_definition = [
        "amount" => ["amount", "float", null, "getAmount", "setAmount", null, ["r" => 0]], 
        "asset_index" => ["assetIndex", "float", null, "getAssetIndex", "setAssetIndex", null, ["r" => 0]]
    ];

    /**
     * AlgorandGetBalance200ResponseAssetsInner
     *
     * @param mixed[] $data Model data
     */
    public function __construct(array $data = []) {
        foreach(static::$_definition as $k => $v) {
            $this->_data[$k] = isset($data[$k]) ? $data[$k] : $v[5];
        }
    }


    /**
     * Get amount
     *
     * @return float|null
     */
    public function getAmount(): ?float {
        return $this->_data["amount"];
    }

    /**
     * Set amount
     * 
     * @param float|null $amount Balance in asset unit
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setAmount(?float $amount) {
        return $this->_set("amount", $amount);
    }

    /**
     * Get asset_index
     *
     * @return float|null
     */
    public function getAssetIndex(): ?float {
        return $this->_data["asset_index"];
    }

    /**
     * Set asset_index
     * 
     * @param float|null $asset_index Asset Index of ASA
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setAssetIndex(?float $asset_index) {
        return $this->_set("asset_index", $asset_index);
    }
}
