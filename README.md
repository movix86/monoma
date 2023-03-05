
<p><strong>Endpoints:</strong></p><br>
<p>In postman: Content-Type: application/json</p><br>
<p>*Token Login: https://monoma.juanwebdeveloper.com/api/auth/login</p>
<br>
<p><strong>Credential:</strong></p>
<p><strong>manager:</strong> Ellen</p>
<p>
{
    "username": "Ellen",
    "password": "password"
}
</p>
<br>
<p><strong>Agent:</strong> Jaren</p>
<p>
{
    "username": "Jaren",
    "password": "password"
}
</p>
<br>
<br>
<p>*Create candidate: https://monoma.juanwebdeveloper.com/api/auth/candidate/lead</p><br>
<p>
{
    "name": "Alonso",
    "source": "///",
    "owner": 1
}
</p><br>
<strong>You need to login to view the record(Debe loguearse para ver registros):</strong><br>
<p>*Find candidate: https://monoma.juanwebdeveloper.com/api/auth/candidate/lead/{id?}</p>
<p>*All candidates: https://monoma.juanwebdeveloper.com/api/auth/candidate/leads</p>
<br>
<p><strong>Endpoint extra New User for Login:</strong></p>
<p>RegisterToken User: https://monoma.juanwebdeveloper.com/api/register
<br>
{
    "username": "Jairo",
    "password": "12345678",
    "is_active": "true",
    "role": "agent"
}
</p>
<br>
<p>
<strong>Factorys:</strong><br>
#1 exec first: <br>
php artisan db:seed --class=UserTableSeeder <br>
#2 exec second: <br>
php artisan db:seed --class=CandidateTableSeeder
</p>
