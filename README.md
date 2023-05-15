## Simple CMS Project

Please run these commands `composer install`, `artisan:migrate` and `db:seed` 
to install dependencies, create the tables and seed some dummy data.

Admin username: `admin` Admin password: `password` \
Operator username: `operator` operator password: `password`

Login to generate a new token using username and password \
`POST /api/auth/login`

Logout to delete user tokens
`POST /api/auth/logout`


### Admin Role

**Entity Routes** \
Get a single entity: `GET /api/admin/entity/{id}` \
Get all entities: `POST /api/admin/entity/getAll` \
Create a new entity: `POST /api/admin/entity/create` \
Update an existing entity: `POST /api/admin/entity/update` \
Delete a single entity: `POST /api/admin/entity/delete` \
Create a custom attribute and assign it to an entity:  
`POST /api/admin/entity/{entityId}/assignAttribute` \
Assign an entity to another entity: `POST /api/admin/entity/assignEntity`

**Operator Routes** \
Get a single operator: `GET /api/admin/operator/{id}` \
Get all operators: `POST /api/admin/operator/getAll` \
Create a new operator: `POST /api/admin/operator/create` \
Update an existing operator: `POST /api/admin/operator/update` \
Delete a single operator: `POST /api/admin/operator/delete`

### Operator Role

**Entity Routes** \
Get a single entity: `GET /api/operator/entity/{id}` \
Get all entities: `POST /api/operator/entity/getAll` \
Update an existing entity: `POST /api/operator/entity/update` \
Create a custom attribute and assign it to an entity:  
`POST /api/operator/entity/{entityId}/assignAttribute`


