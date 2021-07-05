# To-do list REST Server

Uma aplicação de gestão de tarefas desenvolvido com framework Lumen 8 e PostgreSQL 10.

-------------------------------------------------------------------------

## API Documentação

### Diagrama de Entidade Relacionamento
![alt tag](https://github.com/jonatasferreira/tasklist/blob/main/docs/tasklist.png)

### GET /user

```
GET /user
Content-Type: "application/json"
```
##### Returns:

```
200 Ok
Content-Type: "application/json"

{
    "sucesso": "Operação realiza com sucesso.",
    "data": [
        {
            "id": 1,
            "name": "Mollie Padberg PhD",
            "email": "lweimann@example.org"
        },
        {
            "id": 19,
            "name": "Felipe",
            "email": "felipe@gmail.com"
        },
    ]
}
```

### GET /user/{id}

```
GET /user/{id}
Content-Type: "application/json"
```

Attribute | Description
----------| -----------
**id**    | User id

#### Returns

```
200 Ok
Content-Type: "application/json"

{
    "sucesso": "Operação realiza com sucesso.",
    "data": [
        {
            "id": 1,
            "name": "Mollie Padberg PhD",
            "email": "lweimann@example.org"
        }
    ]
}
```

### POST /user

```
POST /user
Content-Type: "application/json"

{
    "name": "Jonatas",
    "email": "jonatas@mail.com.br",
    "password": "12345678"
}
```
##### Returns:

```
201 Created
Content-Type: "application/json"

{
    "sucesso": "Usuário salvo com sucesso."
}
```

### PUT /user/{id}

```
PUT /user/{id}
Content-Type: "application/json"
```

Attribute | Description
----------| -----------
**id**    | User id

#### Returns

```
201 Ok
Content-Type: "application/json"

{
    "sucesso": "Usuário atualizado com sucesso."
}
```

### DELETE /user/{id}

```
PUT /user/{id}
Content-Type: "application/json"
```

Attribute | Description
----------| -----------
**id**    | User id

#### Returns

```
201 Ok
Content-Type: "application/json"

{
    "sucesso": "Usuário removido com sucesso."
}
```

### GET user/{id}/task

```
GET user/{id}/task
Content-Type: "application/json"
```

Attribute | Description
----------| -----------
**id**    | User id

#### Returns

```
200 Ok
Content-Type: "application/json"

{
    "sucesso": "Operação realiza com sucesso.",
    "data": [
        {
            "id": 13,
            "title": "Mrs.",
            "description": "Dolore id animi illo officia itaque non. Aut occaecati quo ratione sed aut iusto laborum. Inventore voluptas unde molestias facere temporibus voluptas facilis.",
            "priority": 2,
            "status": "DONE",
            "user_id": 4,
            "created_at": "2021-07-03T19:33:06.000000Z",
            "updated_at": "2021-07-03T19:33:06.000000Z"
        },
        {
            "id": 14,
            "title": "Mr.",
            "description": "Ex et in corporis distinctio. Reprehenderit quia at nemo illum aliquam autem et. Velit voluptatum aliquam ut veritatis tempora ab dignissimos.",
            "priority": 4,
            "status": "DOING",
            "user_id": 4,
            "created_at": "2021-07-03T19:33:06.000000Z",
            "updated_at": "2021-07-03T19:33:06.000000Z"
        },
        {
            "id": 15,
            "title": "Miss",
            "description": "Quidem labore nisi sint nihil iste doloremque dolores. Qui ex ratione dolores dolor autem alias qui.",
            "priority": 1,
            "status": "TODO",
            "user_id": 4,
            "created_at": "2021-07-03T19:33:06.000000Z",
            "updated_at": "2021-07-03T19:33:06.000000Z"
        }
    ]
}
```

### GET /task

```
GET /user
Content-Type: "application/json"
```
##### Returns:

```
200 Ok
Content-Type: "application/json"

{
    "sucesso": "Operação realiza com sucesso.",
    "data": [
        {
            "id": 1,
            "title": "Mr.",
            "description": "Dolore ratione beatae corrupti omnis. Sed qui ab aut consequatur sint. Ipsa perspiciatis saepe aut.",
            "priority": 5,
            "status": "TODO",
            "user_id": 1,
            "created_at": "2021-07-03T19:28:34.000000Z",
            "updated_at": "2021-07-03T19:28:34.000000Z"
        },
        {
            "id": 15,
            "title": "Miss",
            "description": "Quidem labore nisi sint nihil iste doloremque dolores. Qui ex ratione dolores dolor autem alias qui.",
            "priority": 1,
            "status": "DOING",
            "user_id": 4,
            "created_at": "2021-07-03T19:33:06.000000Z",
            "updated_at": "2021-07-03T19:33:06.000000Z"
        },
        {
            "id": 5,
            "title": "Miss",
            "description": "Placeat inventore ut dolorem. Ab quam doloribus aliquid omnis. Culpa omnis quidem et dicta porro ipsa quo.",
            "priority": 3,
            "status": "DONE",
            "user_id": 1,
            "created_at": "2021-07-03T19:28:34.000000Z",
            "updated_at": "2021-07-03T19:28:34.000000Z"
        },
    ]
}
```
-------------------------------------------------------------------------

## Os seguintes endponts também estão implementados

### GET /task/{id}

### POST /task

### PUT /task/{id}

### DELETE /task/{id}
