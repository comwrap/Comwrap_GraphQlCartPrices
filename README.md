# Comwrap_GraphQlCartPrices
Add Price Including tax for Magento's "cart" GraphQl query

## Query will looks like following: 

```
items {
      id
      __typename
      quantity
      prices {
        price {
          currency
          value
        },
        priceIncludingTax {
          currency
          value
        }
      }
    }
```

Where 
```
priceIncludingTax {
    currency
    value
}
```

will return price including tax.
