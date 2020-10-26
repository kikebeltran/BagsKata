# Bags Kata 🎒

From [https://katalyst.codurance.com/bags](https://katalyst.codurance.com/bags)

# How to install 🚀

After git clone execute **Docker** installation:

```sh
$ docker-compose up -d 
```
Install php dependencies with **PHP composer**:
```sh
$ composer install
```
If we don't have in our machine the right php version (7.4) execute composer with follow flag:
```sh
composer install --ignore-platform-reqs
```

We can also install dependencies with:
```sh
docker exec -it bagskata composer install
```

To run tests:
```sh
$ docker-compose run phpunit tests
```


# Some considerations 🌚

- Git setted with git-flow.
- Working with PHP 7.4 with his beautiful typing


License
----

Coded with ♥️ by Kike Beltrán