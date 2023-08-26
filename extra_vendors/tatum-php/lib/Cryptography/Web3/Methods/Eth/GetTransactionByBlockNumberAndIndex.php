<?php

/**
 * This file is part of web3.php package.
 * @author Peter Lai
 * @license MIT
 */

namespace Tatum\Cryptography\Web3\Methods\Eth;
!defined("TATUM-SDK") && exit();

use InvalidArgumentException;
use Tatum\Cryptography\Web3\Methods\EthMethod;
use Tatum\Cryptography\Web3\Validators\TagValidator;
use Tatum\Cryptography\Web3\Validators\QuantityValidator;
use Tatum\Cryptography\Web3\Formatters\OptionalQuantityFormatter;
use Tatum\Cryptography\Web3\Formatters\QuantityFormatter;

class GetTransactionByBlockNumberAndIndex extends EthMethod {
    /**
     * validators
     *
     * @var array
     */
    protected $validators = [[TagValidator::class, QuantityValidator::class], QuantityValidator::class];

    /**
     * inputFormatters
     *
     * @var array
     */
    protected $inputFormatters = [OptionalQuantityFormatter::class, QuantityFormatter::class];

    /**
     * outputFormatters
     *
     * @var array
     */
    protected $outputFormatters = [];

    /**
     * defaultValues
     *
     * @var array
     */
    protected $defaultValues = [];

    /**
     * construct
     *
     * @param string $method
     * @param array $arguments
     * @return void
     */
    // public function __construct($method='', $arguments=[])
    // {
    //     parent::__construct($method, $arguments);
    // }
}