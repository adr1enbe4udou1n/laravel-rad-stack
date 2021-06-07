# Laravel Inertia TS Stack

![logo](public/logo.png)

## About This Stack

This minimal featured modern monolith web starter kit boilerplate aims to have ready-to-go dev stack with high enterprise quality standing requirements.

### Technologies involved

- **Laravel 8** and **PHP 8.0** as minimum requirement. It allows usage of **PHP attributes** which notably is perfect for routes definition inside controllers as Symfony does.
- Usage of **[Vite](https://vitejs.dev/)** as main frontend tooling for instant start and HMR development thanks to modern [esbuild bundler](https://github.com/evanw/esbuild) with proper Laravel manifest management for dev and production.
- **[Windi CSS](https://windicss.org/)** as main CSS framework for both front and admin parts.
- Front is ready to go for full **blade + livewire + AlpineJS** integration. Perfect for SEO based websites. It's configured with Windi CSS but you can easily switch to another framework.
- Basic admin UI fully build with **[Inertia](https://inertiajs.com/) + Windi CSS + Vue 3 Typescript with composition API**. Thanks to Inertia for get rid of Vue Router boilerplate to typescript for instant IDE feedbacks !

#### Why Windi CSS ?

It's fully written in Typescript and 100% compatible with Tailwind 2.x API. It has perfect integration with Vite + Typescript combo. Besides it's JIT from the ground up, which is ideal for HMR development. If you come from Tailwind, don't worry, nothing will really change for you and yes, it has dedicated plugin for [VSCode](https://windicss.org/editors/vscode.html).

### Features

Only simple basic features :

- Empty and easily removable front part, prepared with livewire and AlpineJS.
- Admin UI Layout with all **basic auth pages** (login / register / reset password / profile) and **users management with impersonation**. All credits goes to [Laravel Jetstream](https://jetstream.laravel.com) and [Ping CRM](https://github.com/inertiajs/pingcrm).
- Clear separation between front and admin parts, with dedicated folders for controllers and resources and separated Vite configs. It's really simple to remove front part if you need only admin for CRM based application. **CSS purge and CSS build** is properly configured for each front and admin part.
- Admin RAD mini framework similar to [React Admin](https://marmelab.com/react-admin/) with ready to use **crud pages**, **data table**, **fields** and **form inputs**. **Quick aside panel** view/edit with real inertia routing context is also supported and actually used for users management in this boilerplate !
- Extensible **DataTable** component with **paging**, **sorting**, **global search**, **by column filter**, **template columns**, **customizable row actions**, **excel export** features. All that with efficient nice dev API !
- Backend is fully tested project by using [Pest](https://pestphp.com/) testing framework with **100% code coverage**, which gives you a perfect starting dev point if you want to go with **TDD** in mind.

### Backend Packages

- [Laravel Fortify](https://github.com/laravel/fortify) for ready to used backend authentication endpoints.
- [Spatie Route Attributes](https://github.com/spatie/laravel-route-attributes) for direct routes definition inside controllers. No more heavy routes files !
- [Ziggy](https://github.com/tighten/ziggy) for Laravel routes names definitions accessible from client side.
- [Matice](https://github.com/GENL/matice) for nice Laravel translations integration within client side.
- [Laravel Excel](https://laravel-excel.com/) as perfect solution for data table Excel export.
- [Spatie Laravel Enum](https://github.com/spatie/laravel-enum) for proper enum support.
- [Spatie Query Builder](https://github.com/spatie/laravel-query-builder) as nice Eloquent builder for API REST resources browsing, totally bridged inside above **DataTable** component.

### Advanced dev tools for high quality standard

#### Backend dev tools

- [Clockwork](https://github.com/itsgoingd/clockwork) for advanced profiling with debugbar and frontend metrics enabled. Can show N+1 query problems.
- [Laravel IDE Helper](https://github.com/barryvdh/laravel-ide-helper) for proper autocompletion, compatible with PHPStorm and VSCode Intelephense
- [PHP CS Fixer 3](friendsofphp/php-cs-fixer) configured for Laravel default styling. Use it with this [VSCode plugin](https://github.com/junstyle/vscode-php-cs-fixer) for proper formatting on save.
- [Larastan](https://github.com/nunomaduro/larastan) for static PHP code analysis.
- [Pest](https://pestphp.com/) as enjoyable testing API.

#### Frontend dev tools

- **Prettier** for opinionated code formatting and **Eslint** for typescript linting
- Full **Vue template typescript support** thanks to Johnson Chu's incredible work via his [Volar plugin](https://github.com/johnsoncodehk/volar). You finally now have typescript lint everywhere as angular does !
- Usage of **[Vite auto component register](https://github.com/antfu/vite-plugin-components)** while keeping typescript props inferring functional !
- **[Jest](https://jestjs.io/)** ready to use for client side component / typescript unit testing (not as unlike to backend there is no unit test provided to this boilerplate).

## Usage

Keep in mind as you must have **PHP 8.0** as minimum requirement.

```sh
composer install
# Prepare database and environment variables
php artisan migrate:fresh --seed
php artisan serve

# Finally launch frontend Vite HMR dev server
yarn && yarn dev
```

Both front and admin dev HMR server will be started in parallel into different ports.

Front is empty, access to admin in <http://localhost:8000/admin> and login as `admin@example.com` / `password`

### VSCode configuration

The essential plugins :

- [PHP Intelephense](https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client)
- [PHP CS Fixer](https://marketplace.visualstudio.com/items?itemName=junstyle.php-cs-fixer) > Don't forget to add `.php-cs-fixer.dist.php` file as config file.
- [EditorConfig](https://marketplace.visualstudio.com/items?itemName=EditorConfig.EditorConfig)
- [Eslint](https://marketplace.visualstudio.com/items?itemName=dbaeumer.vscode-eslint)
- [WindiCSS IntelliSense](https://marketplace.visualstudio.com/items?itemName=voorjaar.windicss-intellisense)
- [Volar](https://marketplace.visualstudio.com/items?itemName=johnsoncodehk.volar) for realtime typescript feedback inside your templates > You should disable vetur in order to avoid conflicts.
- [Error Lens](https://marketplace.visualstudio.com/items?itemName=usernamehw.errorlens) for inlined errors.

### Fullstack RAD development

This stack is intended for RAD development while keeping high quality delivery. If not pure UI development, you can almost avoid to use browser by using PHP static analysis as well as realtime tests on backend side and by using vue typescript instant feedbacks on frontend side. Say 🛑 to spending time on debugging !

And for UI development you still benefits from instant Vite HMR and WindiCSS realtime classes scan. Fullstack RAD development on every stage !

#### Available QA scripts

```sh
composer format # PHP CS format
composer analyse # PHP static analysis

# Use custom env.testing file if needed for next line
composer test # Launch tests suite with console coverage report, and fail if less than 90% (adapt for your own needs)

yarn lint --fix # TS & Vue files auto format
yarn vue-tsc --noEmit # Full TS & Vue templates compiling
yarn test:unit # For client side unit testing with jest, note that client side tests are not included for this boilerplate
```

#### TDD ready

This project has 100% code coverage and is ready to use within [Spatie PHPUnit Watcher](https://github.com/spatie/phpunit-watcher), which is ideal for TDD :

```sh
# Install watcher globally 
composer global require spatie/phpunit-watcher

# Launch phpunit watcher and enjoy live development testing
phpunit-watcher watch
```

## Documentation

TODO (or not to do ?).

## License

This project is open-sourced software licensed under the [MIT license](https://adr1enbe4udou1n.mit-license.org).
