<?php
declare(strict_types=1);

namespace Comwrap\GraphQlCartPrices\Plugin\Model\Resolver;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Quote\Model\Quote\Item;
use Magento\QuoteGraphQl\Model\Resolver\CartItemPrices;

class CartItemPricesPlugin
{
    /**
     * @param CartItemPrices $subject
     * @param $result
     * @param Field $field
     * @param ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return mixed
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @throws LocalizedException
     */
    public function afterResolve(
        CartItemPrices $subject,
        $result,
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        if (!isset($value['model'])) {
            throw new LocalizedException(__('"model" value should be specified'));
        }
        /** @var Item $cartItem */
        $cartItem = $value['model'];
        $currencyCode = $cartItem->getQuote()->getQuoteCurrencyCode();
        $result['priceIncludingTax'] = [
            'currency' => $currencyCode,
            'value' => $cartItem->getPriceInclTax(),
        ];
        return $result;
    }
}
