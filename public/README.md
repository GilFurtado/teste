#API Teste Serasa
###Version 0.0.2

todos os fontes disponiveis na raiz, incluindo o sql.

#### Resource URL
/api/v1

#### POST /users
Insere usuário na base.
'name': "Nome",
'email': "email@email.com",
'password': "123455",
'status': 1 

#### PUT /users
Insere usuário na base.
'id': 1
'name': "Nome",
'email': "email@email.com",
'password': "123455",
'status': 1 

#### DELETE /users/{id}
Exclui usuário na base por Id.

#### GET /users
Retorna todos os usuários disponiveis na base em formato Json

#### GET /users/{id}
Retorna o usuário disponiveil na base em formato Json.





#### Format
Apenas JSON 

#Considerações finais
Este é meu primeiro contato com o Silex, ainda quero implantar alguns porviders, 
estou estudando o doctrine.
Desenvolvi o que pude no tempo hábil que tive.