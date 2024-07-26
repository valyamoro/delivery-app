Инструкция по установке:<br>

1) Развернуть у себя проект через git clone https://github.com/valyamoro/delivery-app<br><br>
2) Перейдя в корень проекта ввести следующие команды:<br>
docker-composer up --build<br>
docker-compose exec app php artisan migrate<br>
docker-compose exec app php artisan db:seed --class=UserSeeder<br><br>
3) Проект готов.
