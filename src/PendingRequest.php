<?php

namespace Esensdesign\SnipcartApi;

use Esensdesign\SnipcartApi\Actions\CreateRequestAction;
use Esensdesign\SnipcartApi\Support\Validator;
use Illuminate\Support\Collection;

class PendingRequest
{
    protected $method;
    protected $endpoint;
    protected $acceptedParameters;
    protected $requestedParameters = [];

    public function __construct(string $method, string $endpoint, array $acceptedParameters = [])
    {
        $this->method = $method;
        $this->endpoint = $endpoint;
        $this->acceptedParameters = $acceptedParameters;
    }

    /**
     * The maximum number of items returned by the request.
     *
     * @param int $limit
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function limit(int $limit): self
    {
        $this->setRequestedParameter('limit', $limit);

        return $this;
    }

    /**
     * The number of items that will be skipped.
     *
     * @param int $offset
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function offset(int $offset): self
    {
        $this->setRequestedParameter('offset', $offset);

        return $this;
    }

    /**
     * The product ID defined by the user.
     *
     * @param string $id
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function userDefinedId(string $id): self
    {
        $this->setRequestedParameter('userDefinedId', $id);

        return $this;
    }

    /**
     * The product ID defined by the user.
     *
     * @param string $id
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function productId(string $id): self
    {
        $this->setRequestedParameter('productId', $id);

        return $this;
    }

    /**
     * Filter products to return those that have been bought from specified date.
     *
     * @param string $from
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function from(string $from): self
    {
        $this->setRequestedParameter('from', $from);

        return $this;
    }

    /**
     * Filter products to return those that have been bought until specified date.
     *
     * @param string $to
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function to(string $to): self
    {
        $this->setRequestedParameter('to', $to);

        return $this;
    }

    /**
     * The URL where we will find product details.
     *
     * @param string $url
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function fetchUrl(string $url): self
    {
        $this->setRequestedParameter('fetchUrl', $url);

        return $this;
    }

    /**
     * Specifies how inventory should be tracked for this product.
     * Can be 'Single' or 'Variant.
     * Variant can be used when a product has some dropdown custom fields.
     *
     * @param string $method
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function inventoryManagementMethod(string $method): self
    {
        $this->setRequestedParameter('inventoryManagementMethod', $method);

        return $this;
    }

    /**
     * Allows to set stock per product variant.
     *
     * @param array $variants
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function variants(array $variants): self
    {
        $this->setRequestedParameter('variants', $variants);

        return $this;
    }

    /**
     * The number of items in stock.
     * Will be used when 'inventoryManagementMethod' is 'Single'.
     *
     * @param int $stock
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function stock(int $stock = null): self
    {
        $this->setRequestedParameter('stock', $stock);

        return $this;
    }

    /**
     * If true a customer will be able to buy the product even if it's out of stock.
     * The stock level might be negative.
     * If false it will be impossible to buy the product.
     *
     * @param bool $bool
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function allowOutOfStockPurchases(bool $bool): self
    {
        $this->setRequestedParameter('allowOutOfStockPurchases', $bool);

        return $this;
    }

    /**
     * A status criteria for your order collection.
     * Possible values: InProgress, Processed, Disputed, Shipped, Delivered, Pending, Cancelled
     *
     * @param string $status
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function status(string $status): self
    {
        $this->setRequestedParameter('status', $status);

        return $this;
    }

    /**
     * The order payment status.
     * Possible values: Paid, Deferred, PaidDeferred, ChargedBack, Refunded, Paidout,
     * Failed, Pending, Expired, Cancelled, Open, Authorized.
     *
     * @param string $status
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function paymentStatus(string $status): self
    {
        $this->setRequestedParameter('paymentStatus', $status);

        return $this;
    }

    /**
     * The invoice number of the order to retrieve.
     *
     * @param string $invoiceNumber
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function invoiceNumber(string $invoiceNumber): self
    {
        $this->setRequestedParameter('invoiceNumber', $invoiceNumber);

        return $this;
    }

    /**
     * The name of the person who made the purchase.
     *
     * @param string $name
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function placedBy(string $name): self
    {
        $this->setRequestedParameter('placedBy', $name);

        return $this;
    }

    /**
     * Returns only the orders that are recurring or not.
     *
     * @param bool $bool
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function isRecurringOrder(bool $bool): self
    {
        $this->setRequestedParameter('isRecurringOrder', $bool);

        return $this;
    }

    /**
     * The tracking number associated to the order.
     *
     * @param string $number
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function trackingNumber(string $number): self
    {
        $this->setRequestedParameter('trackingNumber', $number);

        return $this;
    }

    /**
     * The URL where the customer will be able to track its order.
     *
     * @param string $url
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function trackingUrl(string $url): self
    {
        $this->setRequestedParameter('trackingUrl', $url);

        return $this;
    }

    /**
     * A simple array that can hold any data associated to this order.
     *
     * @param array $metadata
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function metadata(array $metadata): self
    {
        $this->setRequestedParameter('metadata', $metadata);

        return $this;
    }

    /**
     * The type of notification.
     * Possible values: Comment, OrderStatusChanged, OrderShipped, TrackingNumber, Invoice
     *
     * @param string $type
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function type(string $type): self
    {
        $this->setRequestedParameter('type', $type);

        return $this;
    }

    /**
     * The delivery method of the notification.
     * Possible values: Email, None
     *
     * @param string $method
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function deliveryMethod(string $method): self
    {
        $this->setRequestedParameter('deliveryMethod', $method);

        return $this;
    }

    /**
     * The message of the notification.
     * Possible values: Email, None
     *
     * @param string $message
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function message(string $message): self
    {
        $this->setRequestedParameter('message', $message);

        return $this;
    }

    /**
     * The amount of the refund.
     *
     * @param string $amount
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function amount(string $amount): self
    {
        $this->setRequestedParameter('amount', $amount);

        return $this;
    }

    /**
     * The reason for the refund.
     *
     * @param string $comment
     * @return $this
     * @throws Exceptions\ValidatorException
     */
    public function comment(string $comment): self
    {
        $this->setRequestedParameter('comment', $comment);

        return $this;
    }

    /**
     * Send the request. This is the final method and has to be called at the end of the method chain.
     *
     * @return Collection
     * @throws Exceptions\SnipcartApiException
     */
    public function send(): Collection
    {
        return resolve(CreateRequestAction::class)->send($this);
    }

    /**
     * Get the method.
     *
     * @return string
     */
    public function method(): string
    {
        return $this->method;
    }

    /**
     * Get the endpoint
     *
     * @return string
     */
    public function endpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * Get the accepted parameters.
     *
     * @return array
     */
    public function acceptedParameters(): array
    {
        return $this->acceptedParameters;
    }

    /**
     * Get the requested parameters.
     *
     * @return array
     */
    public function requestedParameters(): array
    {
        return $this->requestedParameters;
    }

    /**
     * Add the requested parameters to an array.
     *
     * @param string $requestedParameter
     * @param int|string|null $value
     * @throws Exceptions\ValidatorException
     */
    protected function setRequestedParameter(string $requestedParameter, $value): void
    {
        Validator::validateRequestedParameter($requestedParameter, $this->acceptedParameters);

        $this->requestedParameters[$requestedParameter] = $value;
    }
}
