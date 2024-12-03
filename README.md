## Описание функционала

### Контроллеры

1. **ArticleAddController**:
   - Обрабатывает запросы для добавления статей. При отправке POST-запроса на `http://localhost:8000/article/add` добавляются новые статьи с помощью сервиса `ArticleServiceInterface`. Статьи можно добавить ччерез миграцию: test-task/src/Infrastructure/Persistence/Doctrine/Migrations/Version20241128092934.php, либо прописать в файле: test-task/src/Controller/ArticleAddController.php
   
2. **ArticleDetailController**:
   - Отображает подробную информацию о статье по заданному `slug`. Запрос на `http://localhost:8000/article/{slug}` отображает страницу с деталями статьи.

3. **ArticleListController**:
   - Отображает список всех статей. Запрос на `/http://localhost:8000/article` выводит все доступные статьи.

### Сервис

- **ArticleServiceInterface**:
   - Интерфейс, используемый для взаимодействия с данными статей.
   
### Репозиторий

- **ArticleRepository**:
   - Репозиторий для получения данных о статьях из базы данных.


1. **Запуск проекта**:

    ```bash
    make init
    ```
