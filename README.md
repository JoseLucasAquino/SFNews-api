# Space Flight News Test Api
## _API que contém informações de notícias disponíveis na web sobre vôos espaciais_

Space Flight News Test Api é um projeto baseado em [Space Flight News Api](https://www.spaceflightnewsapi.net/).

## Tecnologias Utilizadas

- PHP7
- Laravel 9
- Docker
- Postgres
- Heroku

# Acesso ao projeto

- Crie um diretório para baixar o código
- Abra um termianl/prompt e acesse o diretório criado para o projeto
```
cd /path/to/project 
```
- Execute o comando abaixo para baixar o código do projeto
```
git clone git@github.com:JoseLucasAquino/SFNews-api.git
```

- Caso já utilize containers, tenha certeza que a porta 8188 esteja livre
ou altere o atributo ports no arquivo doccker-compose.yml
```
ports:
    -8188:80
```

- Para rodar o projeto, execute o comando
```
docker compose up -d
```

- Após terminar, acesse o container para gerar a chave de app, que o Laravel utiliza para encriptações (Essa chave é obrigatória)
```
docker-exec -it sfnews /bin/sh
php artisan key:generate
```

- Para conectar a aplicação ao seu banco de dados, acesse o arquivo .env, que também é gerado pelo comando anterior, e forneça os dados de acesso do banco de dados
```
DB_CONNECTION=pgsql
DB_HOST=HOSTNAME
DB_PORT=5432
DB_DATABASE=YOUR_DATABASE
DB_USERNAME=YOUR_USERNAME
DB_PASSWORD=YOUR_SECRET
```

- Por fim, execute as mirgrations, que vão construir a estrutura inicial do banco de dados.
```
php artisan migrate
```

# Acesso a api
- Acesse a url, conforme a porta escolhida no arquivo docker-compose.yml, no caso default a prota 8188
```
http//localhost:8188/api/
```

- Nesse ponto, você deve ver a mensagem "Back-end Challenge 2021 - Space Flight News"
- Assim você já poderá acessar a documentação da api, para saber mais sobre a utilização do projeto.
```
http//localhost:8188/api/documentation
```

# Link de Apresentação
[Apresentação do Projeto](http://google.com)

> This is a challenge by [Coodesh](https://coodesh.com)

