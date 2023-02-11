<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
<p align="center"><a href="https://vuejs.org" target="_blank" rel="noopener noreferrer"><img width="100" src="https://vuejs.org/images/logo.png" alt="Vue logo"></a></p>

## Description
It is a demo project with Laravel backend and Vue.js frontend.

## Configure
1. ```console
    docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
    ```
2. ``` cp .env.example .env``` and configue .env
3. ``` sail up -d ```
4. ``` npm i ```
5. ``` sail artisian key:generate ```
6. ``` sail artisian migrate ```
7. ``` sail artisian serve ```
8. ``` npm run dev ```

## Autentication based on
https://techvblogs.com/blog/spa-authentication-laravel-9-sanctum-vue3-vite

## License

[MIT](https://opensource.org/licenses/MIT)