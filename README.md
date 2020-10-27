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


# Architecture

![Architecture ](https://ekiketa.es/wp-content/uploads/2020/10/diagrama-bags-kata.png)

I have used a layer architecture based on Uncle Bob's clean one.
At this moment, I have only implemented the first two layers (Core and Use Cases). For a complete implementation, I would use the following layers (Network, Entry points, etc.)


# Some considerations 🌚

- Conceived with TDD.
- Git setted with git-flow.
- Working with PHP 7.4 with his beautiful typing.
- Factories inspired by Laravel framework.

License
----

Coded with ♥️  by Kike Beltrán
