# lman
Manage translations in Laravel App

Lman is used to manage your translation using web. You can `add new translation` or `edit the translation phrases`  or `delete the translation` of your Laravel App.
 
![Lman](https://i.imgur.com/nfY7xzK.gif)
----------

## Installation

- [Lman on Packagist](https://packagist.org/packages/prabakaran-t/lman)
- [Lman on GitHub](https://github.com/Prabakaran-t/lman)

To get the latest version of Currency simply require it in your `composer.json` file.

~~~
"prabakaran-t/lman": "dev-master"
~~~
or simply from console
~~~
composer require prabakaran-t/lman
~~~
Once Lman is installed you need to register the service provider with the application. Open up `config/app.php` and find the `providers` key.

~~~php
'providers' => [
    Decipher\Lman\LanguageServiceProvider::class,
]
~~~

Lman also ships with a facade which provides the static functions for manage translations. You can register the facade in the `aliases` key of your `config/app.php` file.

~~~php
'aliases' => [

    'Lman' => Decipher\Lman\Lman::class,

]
~~~

and publish  using --tag=translation

~~~
  php artisan vendor:publish --tag=translation
~~~

This will publish the following

- translation view files under `resources/views/translation`
- `config.json` under `resources/lang/en/`
- `translation.php` under `config`  path

`config.json` is must to manage your translation which was used to manage all your translations. 

Note: `vendor:publish --tag=translation` was must to generate config.json file!


You need to create one middleware which is used to maintain the language across the Laravel App.
~~~
php artisan make:middleware Language
~~~

and use the following code inside the handle function
~~~
        //thanks to -> https://mydnic.be/post/laravel-5-and-his-fcking-non-persistent-app-setlocale for non persistent locale problem
        if (\Session::has('locale')) {
            \App::setLocale(\Session::get('locale'));
        }
        else {
            // This is optional as Laravel will automatically set the fallback language if there is none specified
            \App::setLocale(\Config::get('app.fallback_locale'));
        }
        return $next($request);
~~~

and then register the middleware in `kernel.php` after the ` \Illuminate\Session\Middleware\StartSession::class,`
~~~
\App\Http\Middleware\Language::class,
~~~
this will holds the chosen language across the app.

# How to use?

## Rendering Available Translations

By default Lman uses the bootstrap css framework for managing translations. If you want to customize you can find the view files under `resources\view\translation`.

If you want to render available translations in your app
~~~
{!! Lman::TranslationSwitch() !!}
~~~
It will render the following
~~~
<li class="dropdown">
    <a href="#" data-toggle="dropdown" role="button" aria-expanded="true" class="dropdown-toggle">FR<span class="caret"></span></a> 
    <ul role="menu" class="dropdown-menu">
        <li><a href="url('lang/en')"> English</a></li>
        <li><a href="url('translation')">Manage Translation</a></li>
    </ul>
</li>    
~~~
So you can add this in header nav to change the translation if you want!



## Manage Translations

If you want to manage all your translations, navigate to `translation` in your app.

There you can add, edit or delete the translation. 

By default you cannot the edit or remove the `en`.

`translation` routes are being protected with auth middleware.

## Change Log
v.1 20-03-2018 



















