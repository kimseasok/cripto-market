<?php

/**
 * XrpTx_meta_AffectedNodes_inner_ModifiedNode_PreviousFields Model
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
 * XrpTx_meta_AffectedNodes_inner_ModifiedNode_PreviousFields Model
 */
class XrpTxMetaAffectedNodesInnerModifiedNodePreviousFields extends AbstractModel {

    public const _D = null;
    protected static $_name = "XrpTx_meta_AffectedNodes_inner_ModifiedNode_PreviousFields";
    protected static $_definition = [
        "balance" => ["Balance", "string", null, "getBalance", "setBalance", null, ["r" => 1]], 
        "sequence" => ["Sequence", "float", null, "getSequence", "setSequence", null, ["r" => 1]]
    ];

    /**
     * XrpTxMetaAffectedNodesInnerModifiedNodePreviousFields
     *
     * @param mixed[] $data Model data
     */
    public function __construct(array $data = []) {
        foreach(static::$_definition as $k => $v) {
            $this->_data[$k] = isset($data[$k]) ? $data[$k] : $v[5];
        }
    }


    /**
     * Get balance
     *
     * @return string
     */
    public function getBalance(): string {
        return $this->_data["balance"];
    }

    /**
     * Set balance
     * 
     * @param string $balance balance
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setBalance(string $balance) {
        return $this->_set("balance", $balance);
    }

    /**
     * Get sequence
     *
     * @return float
     */
    public function getSequence(): float {
        return $this->_data["sequence"];
    }

    /**
     * Set sequence
     * 
     * @param float $sequence sequence
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setSequence(float $sequence) {
        return $this->_set("sequence", $sequence);
    }
}