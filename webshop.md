# WebShop

## Models

### User

#### Properties
    - username
    - email
    - password
    - role

#### Authorities

##### Role = user
    - see its profile
    - change its profile information
    - save to favorites
    - delete its account
    - edit the cart
    - send order

##### Role = admin
    - delete user
    - handle orders -> shipped removes quantities
    - create products
    - delete products
    - create product groups
    - edit product groups
    - edit product properties: name, description, properties
    - create acquisitions -> adds to quantity

### Products

#### Properties
    - name
    - description
    - images
    - quantity on stock
    - min. ordering quantity
    - unit_price
    - foreign id: category_id
    - other properties which may be null
    - weight

### Product group

#### Properties
    - name
    - description
    - relationship to products: has many
    - image
    
### Orders

#### Properties
    - array of Order Items
    - status: type enum of not yet processed, collecting, shipped

### Order Item

#### Properties
    - foreign id: product
    - quantity
    - belongs to discount
    - belongs to order

### Discount

#### Properties
    - belongs to Product Group ? nullable
    - belongs to Product ?
    - type: enum -> percentage or amount
    - expiration
    - start
