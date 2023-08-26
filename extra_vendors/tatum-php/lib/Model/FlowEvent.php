<?php

/**
 * FlowEvent Model
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
 * FlowEvent Model
 */
class FlowEvent extends AbstractModel {

    public const _D = null;
    protected static $_name = "FlowEvent";
    protected static $_definition = [
        "block_id" => ["blockID", "string", null, "getBlockId", "setBlockId", null, ["r" => 0]], 
        "block_height" => ["blockHeight", "float", null, "getBlockHeight", "setBlockHeight", null, ["r" => 0]], 
        "block_timestamp" => ["blockTimestamp", "string", null, "getBlockTimestamp", "setBlockTimestamp", null, ["r" => 0]], 
        "type" => ["type", "string", null, "getType", "setType", null, ["r" => 0]], 
        "transaction_id" => ["transactionId", "string", null, "getTransactionId", "setTransactionId", null, ["r" => 0]], 
        "transaction_index" => ["transactionIndex", "float", null, "getTransactionIndex", "setTransactionIndex", null, ["r" => 0]], 
        "event_index" => ["eventIndex", "float", null, "getEventIndex", "setEventIndex", null, ["r" => 0]], 
        "payload" => ["payload", "\Tatum\Model\FlowEventPayload", null, "getPayload", "setPayload", null, ["r" => 0]]
    ];

    /**
     * FlowEvent
     *
     * @param mixed[] $data Model data
     */
    public function __construct(array $data = []) {
        foreach(static::$_definition as $k => $v) {
            $this->_data[$k] = isset($data[$k]) ? $data[$k] : $v[5];
        }
    }


    /**
     * Get block_id
     *
     * @return string|null
     */
    public function getBlockId(): ?string {
        return $this->_data["block_id"];
    }

    /**
     * Set block_id
     * 
     * @param string|null $block_id block_id
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setBlockId(?string $block_id) {
        return $this->_set("block_id", $block_id);
    }

    /**
     * Get block_height
     *
     * @return float|null
     */
    public function getBlockHeight(): ?float {
        return $this->_data["block_height"];
    }

    /**
     * Set block_height
     * 
     * @param float|null $block_height block_height
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setBlockHeight(?float $block_height) {
        return $this->_set("block_height", $block_height);
    }

    /**
     * Get block_timestamp
     *
     * @return string|null
     */
    public function getBlockTimestamp(): ?string {
        return $this->_data["block_timestamp"];
    }

    /**
     * Set block_timestamp
     * 
     * @param string|null $block_timestamp block_timestamp
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setBlockTimestamp(?string $block_timestamp) {
        return $this->_set("block_timestamp", $block_timestamp);
    }

    /**
     * Get type
     *
     * @return string|null
     */
    public function getType(): ?string {
        return $this->_data["type"];
    }

    /**
     * Set type
     * 
     * @param string|null $type type
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setType(?string $type) {
        return $this->_set("type", $type);
    }

    /**
     * Get transaction_id
     *
     * @return string|null
     */
    public function getTransactionId(): ?string {
        return $this->_data["transaction_id"];
    }

    /**
     * Set transaction_id
     * 
     * @param string|null $transaction_id transaction_id
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setTransactionId(?string $transaction_id) {
        return $this->_set("transaction_id", $transaction_id);
    }

    /**
     * Get transaction_index
     *
     * @return float|null
     */
    public function getTransactionIndex(): ?float {
        return $this->_data["transaction_index"];
    }

    /**
     * Set transaction_index
     * 
     * @param float|null $transaction_index transaction_index
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setTransactionIndex(?float $transaction_index) {
        return $this->_set("transaction_index", $transaction_index);
    }

    /**
     * Get event_index
     *
     * @return float|null
     */
    public function getEventIndex(): ?float {
        return $this->_data["event_index"];
    }

    /**
     * Set event_index
     * 
     * @param float|null $event_index event_index
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setEventIndex(?float $event_index) {
        return $this->_set("event_index", $event_index);
    }

    /**
     * Get payload
     *
     * @return \Tatum\Model\FlowEventPayload|null
     */
    public function getPayload(): ?\Tatum\Model\FlowEventPayload {
        return $this->_data["payload"];
    }

    /**
     * Set payload
     * 
     * @param \Tatum\Model\FlowEventPayload|null $payload payload
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setPayload(?\Tatum\Model\FlowEventPayload $payload) {
        return $this->_set("payload", $payload);
    }
}
