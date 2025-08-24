# Documentation

## Table of Contents

| Method | Description |
|--------|-------------|
| [*Colors*](#Colors) | ANSI color codes for console output. |
| [*ConnectionFactory*](#ConnectionFactory) | Factory for creating Doctrine DBAL Connection instances. |
| [**ConnectionFactory**::__construct](#ConnectionFactory__construct) |  |
| [**ConnectionFactory**::create](#ConnectionFactorycreate) | Create a new Doctrine DBAL Connection. |
| [*ConsoleException*](#ConsoleException) | Custom exception for console application errors. |
| [**ConsoleException**::__construct](#ConsoleException__construct) |  |
| [*Container*](#Container) | Simple service container implementing PSR-11 ContainerInterface. |
| [**Container**::add](#Containeradd) | Registers a service definition or instance in the container. |
| [**Container**::get](#Containerget) | Retrieves the service by its identifier. |
| [**Container**::has](#Containerhas) | Checks if the container has a service with the given identifier. |
| [*ContainerException*](#ContainerException) | Exception thrown when a container-related error occurs. |
| [**ContainerException**::__construct](#ContainerException__construct) |  |
| [*DatabaseFreshCommand*](#DatabaseFreshCommand) | Database fresh command handler. |
| [**DatabaseFreshCommand**::__construct](#DatabaseFreshCommand__construct) |  |
| [**DatabaseFreshCommand**::execute](#DatabaseFreshCommandexecute) | Execute the command. |
| [*DatabaseMigrateCommand*](#DatabaseMigrateCommand) | Database migration command handler. |
| [**DatabaseMigrateCommand**::__construct](#DatabaseMigrateCommand__construct) |  |
| [**DatabaseMigrateCommand**::execute](#DatabaseMigrateCommandexecute) | Execute the migration command. |
| [*DatabaseRollbackCommand*](#DatabaseRollbackCommand) | Database rollback command handler. |
| [**DatabaseRollbackCommand**::__construct](#DatabaseRollbackCommand__construct) |  |
| [**DatabaseRollbackCommand**::execute](#DatabaseRollbackCommandexecute) | Execute the rollback command. |
| [*DatabaseWipeCommand*](#DatabaseWipeCommand) | Database wipe command handler. |
| [**DatabaseWipeCommand**::__construct](#DatabaseWipeCommand__construct) |  |
| [**DatabaseWipeCommand**::execute](#DatabaseWipeCommandexecute) | Execute the wipe command. |
| [*EventDispatcher*](#EventDispatcher) | PSR-14 compliant event dispatcher implementation. |
| [**EventDispatcher**::dispatch](#EventDispatcherdispatch) | Dispatch an event to all registered listeners. |
| [**EventDispatcher**::addListener](#EventDispatcheraddListener) | Add a listener for a specific event. |
| [**EventDispatcher**::getListenersForEvent](#EventDispatchergetListenersForEvent) | Get all listeners for a given event. |
| [*HttpException*](#HttpException) | Base HTTP exception class. |
| [**HttpException**::handle](#HttpExceptionhandle) | Handle the exception by returning an HTTP response. |
| [*InjectRouteMiddlewares*](#InjectRouteMiddlewares) | Middleware for injecting route-specific middlewares into the request handler. |
| [**InjectRouteMiddlewares**::process](#InjectRouteMiddlewaresprocess) | Process the HTTP request by routing it and injecting route-specific middlewares. |
| [*Kernel*](#Kernel) | Console application kernel. |
| [**Kernel**::__construct](#Kernel__construct) |  |
| [**Kernel**::handle](#Kernelhandle) | Handle the console command execution. |
| [*Kernel*](#Kernel) | Application kernel. |
| [**Kernel**::__construct](#Kernel__construct) | Creates a new Kernel instance. |
| [**Kernel**::handle](#Kernelhandle) | Handles an HTTP request and returns a response. |
| [**Kernel**::terminate](#Kernelterminate) |  |
| [*MakeControllerCommand*](#MakeControllerCommand) |  |
| [**MakeControllerCommand**::__construct](#MakeControllerCommand__construct) |  |
| [**MakeControllerCommand**::execute](#MakeControllerCommandexecute) | Execute the command. |
| [*MakeEntityCommand*](#MakeEntityCommand) |  |
| [**MakeEntityCommand**::__construct](#MakeEntityCommand__construct) |  |
| [**MakeEntityCommand**::execute](#MakeEntityCommandexecute) | Execute the command. |
| [*MakeMigrationCommand*](#MakeMigrationCommand) | Command to create new database migrations. |
| [**MakeMigrationCommand**::execute](#MakeMigrationCommandexecute) | Execute the migration creation command. |
| [*MakeRepositoryCommand*](#MakeRepositoryCommand) |  |
| [**MakeRepositoryCommand**::__construct](#MakeRepositoryCommand__construct) |  |
| [**MakeRepositoryCommand**::execute](#MakeRepositoryCommandexecute) | Execute the command. |
| [*MethodNotAllowedException*](#MethodNotAllowedException) | Exception thrown when the HTTP method used in the requestis not allowed for the targeted route. |
| [**MethodNotAllowedException**::handle](#MethodNotAllowedExceptionhandle) | Handles the exception by returning an HTTP 405 response. |
| [*Request*](#Request) | Immutable HTTP request object. |
| [**Request**::__construct](#Request__construct) |  |
| [**Request**::createFromGlobals](#RequestcreateFromGlobals) | Create a Request instance from PHP superglobals. |
| [**Request**::getMethod](#RequestgetMethod) | Returns the HTTP method of the request. |
| [**Request**::getUri](#RequestgetUri) | Returns the request URI. |
| [**Request**::getPath](#RequestgetPath) | Returns the request path without query string. |
| [**Request**::getQueryParams](#RequestgetQueryParams) | Returns the GET query parameters. |
| [**Request**::getPostParams](#RequestgetPostParams) | Returns the POST parameters. |
| [**Request**::getHeader](#RequestgetHeader) | Returns a specific HTTP header by name. |
| [**Request**::getHeaders](#RequestgetHeaders) | Returns all HTTP headers as an associative array. |
| [**Request**::setSession](#RequestsetSession) | Set the session instance. |
| [**Request**::session](#Requestsession) | Get the session instance. |
| [**Request**::routeVars](#RequestrouteVars) | Get route variables extracted from the URI. |
| [**Request**::setRouteVars](#RequestsetRouteVars) | Set route variables extracted from the URI. |
| [**Request**::routeHandler](#RequestrouteHandler) | Get the route handler callable. |
| [**Request**::setRouteHandler](#RequestsetRouteHandler) | Set the route handler callable. |
| [*RequestHandler*](#RequestHandler) | Request handler implementation for processing middleware pipelines. |
| [**RequestHandler**::__construct](#RequestHandler__construct) | Constructor. |
| [**RequestHandler**::handle](#RequestHandlerhandle) | Handle an incoming HTTP request through the middleware pipeline. |
| [**RequestHandler**::injectMiddleware](#RequestHandlerinjectMiddleware) | Inject middleware into the pipeline. |
| [**RequestHandler**::addMiddleware](#RequestHandleraddMiddleware) | Add middleware to the end of the pipeline. |
| [**RequestHandler**::setMiddleware](#RequestHandlersetMiddleware) | Set the entire middleware stack. |
| [**RequestHandler**::getMiddleware](#RequestHandlergetMiddleware) | Get the current middleware stack. |
| [**RequestHandler**::clearMiddleware](#RequestHandlerclearMiddleware) | Clear the middleware stack. |
| [**RequestHandler**::isEmpty](#RequestHandlerisEmpty) | Check if middleware stack is empty. |
| [**RequestHandler**::count](#RequestHandlercount) | Get the number of middleware in the stack. |
| [*Response*](#Response) | Represents an HTTP response. |
| [**Response**::__construct](#Response__construct) |  |
| [**Response**::setStatusCode](#ResponsesetStatusCode) | Sets the HTTP status code. |
| [**Response**::setHeader](#ResponsesetHeader) | Sets or replaces a header. |
| [**Response**::setHeaders](#ResponsesetHeaders) | Sets multiple headers at once. |
| [**Response**::setContent](#ResponsesetContent) | Sets the response body content. |
| [**Response**::send](#Responsesend) | Sends the HTTP response to the client. |
| [*Route*](#Route) | Static factory class for creating HTTP routes. |
| [**Route**::get](#Routeget) | Create a GET route. |
| [**Route**::post](#Routepost) | Create a POST route. |
| [**Route**::put](#Routeput) | Create a PUT route. |
| [**Route**::delete](#Routedelete) | Create a DELETE route. |
| [**Route**::patch](#Routepatch) | Create a PATCH route. |
| [**Route**::any](#Routeany) | Create a route that matches any HTTP method. |
| [**Route**::match](#Routematch) | Create a route that matches multiple HTTP methods. |
| [*RouteNotFoundException*](#RouteNotFoundException) | Exception thrown when no matching route is found for the HTTP request. |
| [**RouteNotFoundException**::handle](#RouteNotFoundExceptionhandle) | Handles the exception by returning an HTTP 404 response. |
| [*Router*](#Router) | Router service for dispatching HTTP requests to their corresponding handlers. |
| [**Router**::dispatch](#Routerdispatch) | Dispatches an HTTP request to its associated route handler. |
| [*RouterDispatch*](#RouterDispatch) | Middleware for dispatching routes through the router. |
| [**RouterDispatch**::__construct](#RouterDispatch__construct) | Constructor. |
| [**RouterDispatch**::process](#RouterDispatchprocess) | Process the request by dispatching it to the appropriate route handler. |
| [*Session*](#Session) | Session management class for handling PHP session data. |
| [**Session**::start](#Sessionstart) | Start a new session |
| [**Session**::set](#Sessionset) | Set a session value. |
| [**Session**::get](#Sessionget) | Get a session value. |
| [**Session**::remove](#Sessionremove) | Remove a session value. |
| [**Session**::destroy](#Sessiondestroy) | Destroy the entire session. |
| [**Session**::has](#Sessionhas) | Check if a session key exists. |
| [**Session**::getId](#SessiongetId) | Get session ID. |
| [**Session**::regenerate](#Sessionregenerate) | Regenerate session ID. |
| [**Session**::all](#Sessionall) | Get all session data. |
| [**Session**::clear](#Sessionclear) | Clear all session data without destroying the session. |
| [**Session**::clearFlash](#SessionclearFlash) | Clear all flash session data without destroying the session. |
| [**Session**::flash](#Sessionflash) | Set flash message for next request. |
| [**Session**::getFlash](#SessiongetFlash) | Get flash message and remove it. |
| [**Session**::hasFlash](#SessionhasFlash) | Check if flash message exists. |
| [*StartSession*](#StartSession) |  |
| [**StartSession**::__construct](#StartSession__construct) |  |
| [**StartSession**::process](#StartSessionprocess) | Process an incoming HTTP request. |
| [*TwigFactory*](#TwigFactory) | Factory for creating and configuring Twig environment instances. |
| [**TwigFactory**::__construct](#TwigFactory__construct) | Constructor. |
| [**TwigFactory**::create](#TwigFactorycreate) | Create and configure Twig environment. |
| [**TwigFactory**::getSession](#TwigFactorygetSession) | Get session instance for Twig templates. |
| [*WhoopsDebugger*](#WhoopsDebugger) | Debugger class responsible for registeringerror handlers like Whoops based on debug mode. |
| [**WhoopsDebugger**::register](#WhoopsDebuggerregister) | Registers the Whoops error handler if debugging is enabled. |

## Colors

ANSI color codes for console output.

Use these constants to style text in CLI applications.

* Full name: `\meowprd\FelinePHP\Console\Colors`


## ConnectionFactory

Factory for creating Doctrine DBAL Connection instances.

This class encapsulates the database configuration and
provides a method to create a ready-to-use DBAL connection.

* Full name: `\meowprd\FelinePHP\Database\ConnectionFactory`


### ConnectionFactory::__construct



```php
ConnectionFactory::__construct( array&lt;string,mixed&gt; databaseConfig ): mixed
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `databaseConfig` | **array&lt;string,mixed&gt;** |  |


**Return Value:**





---
### ConnectionFactory::create

Create a new Doctrine DBAL Connection.

```php
ConnectionFactory::create(  ): \Doctrine\DBAL\Connection
```





**Return Value:**

A configured DBAL connection instance.



---
## ConsoleException

Custom exception for console application errors.

This exception handles fatal errors in console commands and provides colored output.

* Full name: `\meowprd\FelinePHP\Exceptions\ConsoleException`
* Parent class: ``


### ConsoleException::__construct



```php
ConsoleException::__construct( string message = "", int code, \Throwable|null previous = null ): mixed
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `message` | **string** | The error message |
| `code` | **int** | The exception code |
| `previous` | **\Throwable\|null** | Previous exception for chaining |


**Return Value:**





---
## Container

Simple service container implementing PSR-11 ContainerInterface.

This container stores service definitions as class names or objects
and can instantiate services on demand, resolving dependencies automatically.

* Full name: `\meowprd\FelinePHP\Container\Container`
* This class implements: `\Psr\Container\ContainerInterface`


### Container::add

Registers a service definition or instance in the container.

```php
Container::add( string id, string|object|null definition = null ): void
```

If $definition is null, tries to treat $id as a class name.
Throws ContainerException if class does not exist.


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `id` | **string** | Service identifier. |
| `definition` | **string\|object\|null** | Class name or object instance for the service.
If null, $id is treated as class name. |


**Return Value:**





---
### Container::get

Retrieves the service by its identifier.

```php
Container::get( string id ): mixed
```

Instantiates the service resolving constructor dependencies recursively.
If the service is not registered but class exists, it registers and resolves it automatically.


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `id` | **string** | Service identifier. |


**Return Value:**

The resolved service instance.



---
### Container::has

Checks if the container has a service with the given identifier.

```php
Container::has( string id ): bool
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `id` | **string** | Service identifier. |


**Return Value:**

True if service exists, false otherwise.



---
## ContainerException

Exception thrown when a container-related error occurs.

This exception implements PSR-11 ContainerExceptionInterface and should be thrown
when errors occur during dependency resolution or container operations.

* Full name: `\meowprd\FelinePHP\Exceptions\ContainerException`
* Parent class: ``
* This class implements: `\Psr\Container\ContainerExceptionInterface`


### ContainerException::__construct



```php
ContainerException::__construct( string message = "", int code, \Throwable|null previous = null ): mixed
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `message` | **string** | The exception message |
| `code` | **int** | The exception code |
| `previous` | **\Throwable\|null** | Previous exception for chaining |


**Return Value:**





---
## DatabaseFreshCommand

Database fresh command handler.

This command drops all database tables and re-runs all migrations,
effectively resetting the database to a fresh state.

* Full name: `\meowprd\FelinePHP\Console\Commands\DatabaseFreshCommand`
* This class implements: `\meowprd\FelinePHP\Console\CommandInterface`


### DatabaseFreshCommand::__construct



```php
DatabaseFreshCommand::__construct( \Doctrine\DBAL\Connection connection, \meowprd\FelinePHP\Console\Commands\DatabaseMigrateCommand migrateCommand ): mixed
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `connection` | **\Doctrine\DBAL\Connection** | Database connection |
| `migrateCommand` | **\meowprd\FelinePHP\Console\Commands\DatabaseMigrateCommand** | Migration command instance |


**Return Value:**





---
### DatabaseFreshCommand::execute

Execute the command.

```php
DatabaseFreshCommand::execute( array params = [] ): int
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `params` | **array** | Command parameters |


**Return Value:**

Exit code (0 on success)



---
## DatabaseMigrateCommand

Database migration command handler.

This command applies pending database migrations.

* Full name: `\meowprd\FelinePHP\Console\Commands\DatabaseMigrateCommand`
* This class implements: `\meowprd\FelinePHP\Console\CommandInterface`


### DatabaseMigrateCommand::__construct



```php
DatabaseMigrateCommand::__construct( \Doctrine\DBAL\Connection connection ): mixed
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `connection` | **\Doctrine\DBAL\Connection** | Database connection |


**Return Value:**





---
### DatabaseMigrateCommand::execute

Execute the migration command.

```php
DatabaseMigrateCommand::execute( array params = [] ): int
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `params` | **array** | Command parameters |


**Return Value:**

Exit code (0 on success)



---
## DatabaseRollbackCommand

Database rollback command handler.

This command rolls back the most recently applied migration.

* Full name: `\meowprd\FelinePHP\Console\Commands\DatabaseRollbackCommand`
* This class implements: `\meowprd\FelinePHP\Console\CommandInterface`


### DatabaseRollbackCommand::__construct



```php
DatabaseRollbackCommand::__construct( \Doctrine\DBAL\Connection connection ): mixed
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `connection` | **\Doctrine\DBAL\Connection** | Database connection |


**Return Value:**





---
### DatabaseRollbackCommand::execute

Execute the rollback command.

```php
DatabaseRollbackCommand::execute( array params = [] ): int
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `params` | **array** | Command parameters |


**Return Value:**

Exit code (0 on success)



---
## DatabaseWipeCommand

Database wipe command handler.

This command drops all tables from the database while handling foreign key constraints.

* Full name: `\meowprd\FelinePHP\Console\Commands\DatabaseWipeCommand`
* This class implements: `\meowprd\FelinePHP\Console\CommandInterface`


### DatabaseWipeCommand::__construct



```php
DatabaseWipeCommand::__construct( \Doctrine\DBAL\Connection connection ): mixed
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `connection` | **\Doctrine\DBAL\Connection** | Database connection |


**Return Value:**





---
### DatabaseWipeCommand::execute

Execute the wipe command.

```php
DatabaseWipeCommand::execute( array params = [] ): int
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `params` | **array** | Command parameters |


**Return Value:**

Exit code (0 on success)



---
## EventDispatcher

PSR-14 compliant event dispatcher implementation.

Provides a simple event dispatcher that allows registering listeners
and dispatching events to those listeners.

* Full name: `\meowprd\FelinePHP\Event\EventDispatcher`
* This class implements: `\Psr\EventDispatcher\EventDispatcherInterface`


### EventDispatcher::dispatch

Dispatch an event to all registered listeners.

```php
EventDispatcher::dispatch( object event ): object
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `event` | **object** | The event to dispatch |


**Return Value:**

The dispatched event



---
### EventDispatcher::addListener

Add a listener for a specific event.

```php
EventDispatcher::addListener( string event, callable listener ): self
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `event` | **string** | Event class name to listen for |
| `listener` | **callable** | Callable to execute when event is dispatched |


**Return Value:**

Returns instance for method chaining



---
### EventDispatcher::getListenersForEvent

Get all listeners for a given event.

```php
EventDispatcher::getListenersForEvent( object event ): iterable&lt;callable&gt;
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `event` | **object** | Event instance |


**Return Value:**

Iterable of listeners for the event



---
## HttpException

Base HTTP exception class.

Provides a default handler to generate an HTTP response
with the exception message and status code.

* Full name: `\meowprd\FelinePHP\Exceptions\HttpException`
* Parent class: ``


### HttpException::handle

Handle the exception by returning an HTTP response.

```php
HttpException::handle(  ): \meowprd\FelinePHP\Http\Response
```

The response content is a JSON string containing the error message.
If the exception code is not set, defaults to HTTP 500 status code.



**Return Value:**

HTTP response containing JSON error message.



---
## InjectRouteMiddlewares

Middleware for injecting route-specific middlewares into the request handler.

This middleware processes the request through the router, matches the route,
and injects route-specific middlewares into the handler pipeline before
continuing with the request processing.

* Full name: `\meowprd\FelinePHP\Http\Middleware\Handlers\InjectRouteMiddlewares`
* This class implements: `\meowprd\FelinePHP\Http\Middleware\MiddlewareInterface`


### InjectRouteMiddlewares::process

Process the HTTP request by routing it and injecting route-specific middlewares.

```php
InjectRouteMiddlewares::process( \meowprd\FelinePHP\Http\Request request, \meowprd\FelinePHP\Http\Middleware\RequestHandlerInterface handler ): \meowprd\FelinePHP\Http\Response
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `request` | **\meowprd\FelinePHP\Http\Request** | The HTTP request to process |
| `handler` | **\meowprd\FelinePHP\Http\Middleware\RequestHandlerInterface** | The next handler in the pipeline |


**Return Value:**

The HTTP response



---
## Kernel

Console application kernel.

Handles command registration, parsing, and execution.

* Full name: `\meowprd\FelinePHP\Console\Kernel`


### Kernel::__construct



```php
Kernel::__construct( \League\Container\Container container ): mixed
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `container` | **\League\Container\Container** |  |


**Return Value:**





---
### Kernel::handle

Handle the console command execution.

```php
Kernel::handle(  ): int
```





**Return Value:**

Exit status code (0 on success)



---
## Kernel

Application kernel.

The Kernel coordinates the handling of incoming HTTP requests
by dispatching them through the router, invoking the matched handler,
and returning an HTTP response.

It also provides a centralized exception handling mechanism to
convert errors into valid HTTP responses or rethrow them in debug mode.

* Full name: `\meowprd\FelinePHP\Http\Kernel`


### Kernel::__construct

Creates a new Kernel instance.

```php
Kernel::__construct( \meowprd\FelinePHP\Http\Middleware\RequestHandlerInterface requestHandler ): mixed
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `requestHandler` | **\meowprd\FelinePHP\Http\Middleware\RequestHandlerInterface** | Middlewares runner |


**Return Value:**





---
### Kernel::handle

Handles an HTTP request and returns a response.

```php
Kernel::handle( \meowprd\FelinePHP\Http\Request request ): \meowprd\FelinePHP\Http\Response
```

The method delegates routing to the Router, executes the resolved
request handler, and returns its response.
If an exception is thrown, it is passed to {@see \meowprd\FelinePHP\Http\Kernel::handleException()}.


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `request` | **\meowprd\FelinePHP\Http\Request** | The HTTP request object. |


**Return Value:**

The HTTP response produced by the handler or generated from an exception.



---
### Kernel::terminate



```php
Kernel::terminate( \meowprd\FelinePHP\Http\Request request, \meowprd\FelinePHP\Http\Response response ): void
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `request` | **\meowprd\FelinePHP\Http\Request** |  |
| `response` | **\meowprd\FelinePHP\Http\Response** |  |


**Return Value:**





---
## MakeControllerCommand





* Full name: `\meowprd\FelinePHP\Console\Commands\MakeControllerCommand`
* This class implements: `\meowprd\FelinePHP\Console\CommandInterface`


### MakeControllerCommand::__construct



```php
MakeControllerCommand::__construct(  ): mixed
```





**Return Value:**





---
### MakeControllerCommand::execute

Execute the command.

```php
MakeControllerCommand::execute( array params = [] ): int
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `params` | **array** | Command parameters |


**Return Value:**

Exit code (0 on success)



---
## MakeEntityCommand





* Full name: `\meowprd\FelinePHP\Console\Commands\MakeEntityCommand`
* This class implements: `\meowprd\FelinePHP\Console\CommandInterface`


### MakeEntityCommand::__construct



```php
MakeEntityCommand::__construct(  ): mixed
```





**Return Value:**





---
### MakeEntityCommand::execute

Execute the command.

```php
MakeEntityCommand::execute( array params = [] ): int
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `params` | **array** | Command parameters |


**Return Value:**

Exit code (0 on success)



---
## MakeMigrationCommand

Command to create new database migrations.

This command generates new migration files using a stub template.

* Full name: `\meowprd\FelinePHP\Console\Commands\MakeMigrationCommand`
* This class implements: `\meowprd\FelinePHP\Console\CommandInterface`


### MakeMigrationCommand::execute

Execute the migration creation command.

```php
MakeMigrationCommand::execute( array params = [] ): int
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `params` | **array** | Command parameters (requires &#039;name&#039; parameter) |


**Return Value:**

Exit code (0 on success)



---
## MakeRepositoryCommand





* Full name: `\meowprd\FelinePHP\Console\Commands\MakeRepositoryCommand`
* This class implements: `\meowprd\FelinePHP\Console\CommandInterface`


### MakeRepositoryCommand::__construct



```php
MakeRepositoryCommand::__construct(  ): mixed
```





**Return Value:**





---
### MakeRepositoryCommand::execute

Execute the command.

```php
MakeRepositoryCommand::execute( array params = [] ): int
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `params` | **array** | Command parameters |


**Return Value:**

Exit code (0 on success)



---
## MethodNotAllowedException

Exception thrown when the HTTP method used in the request
is not allowed for the targeted route.

This exception can handle itself by returning a 405 HTTP response.

* Full name: `\meowprd\FelinePHP\Exceptions\Http\MethodNotAllowedException`
* Parent class: `\meowprd\FelinePHP\Exceptions\HttpException`


### MethodNotAllowedException::handle

Handles the exception by returning an HTTP 405 response.

```php
MethodNotAllowedException::handle(  ): \meowprd\FelinePHP\Http\Response
```





**Return Value:**

HTTP response with 405 status code and exception message as content.



---
## Request

Immutable HTTP request object.

Provides read-only access to the PHP superglobals ($_GET, $_POST, $_FILES, $_COOKIE, $_SERVER)
for representing an HTTP request in an object-oriented way.

* Full name: `\meowprd\FelinePHP\Http\Request`


### Request::__construct



```php
Request::__construct( array&lt;string,mixed&gt; get, array&lt;string,mixed&gt; post, array&lt;string,mixed&gt; files, array&lt;string,mixed&gt; cookies, array&lt;string,mixed&gt; server ): mixed
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `get` | **array&lt;string,mixed&gt;** | HTTP GET parameters (usually from $_GET) |
| `post` | **array&lt;string,mixed&gt;** | HTTP POST parameters (usually from $_POST) |
| `files` | **array&lt;string,mixed&gt;** | Uploaded files information (usually from $_FILES) |
| `cookies` | **array&lt;string,mixed&gt;** | HTTP cookies (usually from $_COOKIE) |
| `server` | **array&lt;string,mixed&gt;** | Server and execution environment information (usually from $_SERVER) |


**Return Value:**





---
### Request::createFromGlobals

Create a Request instance from PHP superglobals.

```php
Request::createFromGlobals(  ): static
```



* This method is **static**.

**Return Value:**





---
### Request::getMethod

Returns the HTTP method of the request.

```php
Request::getMethod(  ): string
```





**Return Value:**

The request method (e.g., GET, POST, PUT, DELETE).



---
### Request::getUri

Returns the request URI.

```php
Request::getUri(  ): string
```





**Return Value:**

The URI path and query string (without scheme/host).



---
### Request::getPath

Returns the request path without query string.

```php
Request::getPath(  ): string
```





**Return Value:**

The URI path only.



---
### Request::getQueryParams

Returns the GET query parameters.

```php
Request::getQueryParams(  ): array&lt;string,mixed&gt;
```





**Return Value:**





---
### Request::getPostParams

Returns the POST parameters.

```php
Request::getPostParams(  ): array&lt;string,mixed&gt;
```





**Return Value:**





---
### Request::getHeader

Returns a specific HTTP header by name.

```php
Request::getHeader( string name, mixed default = null ): string|mixed
```

Header name is case-insensitive.


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `name` | **string** | Header name (e.g. &#039;Content-Type&#039;). |
| `default` | **mixed** | Default value if header is not found. |


**Return Value:**





---
### Request::getHeaders

Returns all HTTP headers as an associative array.

```php
Request::getHeaders(  ): array&lt;string,string&gt;
```

Header names are normalized to their typical case with dashes.



**Return Value:**

Array of headers ['Content-Type' => 'application/json', ...]



---
### Request::setSession

Set the session instance.

```php
Request::setSession( \meowprd\FelinePHP\Http\Session session ): self
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `session` | **\meowprd\FelinePHP\Http\Session** | Session instance to set |


**Return Value:**

Returns instance for method chaining



---
### Request::session

Get the session instance.

```php
Request::session(  ): \meowprd\FelinePHP\Http\Session
```





**Return Value:**

Current session instance



---
### Request::routeVars

Get route variables extracted from the URI.

```php
Request::routeVars(  ): array&lt;string,mixed&gt;
```





**Return Value:**

Route parameters



---
### Request::setRouteVars

Set route variables extracted from the URI.

```php
Request::setRouteVars( array&lt;string,mixed&gt; routeVars ): self
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `routeVars` | **array&lt;string,mixed&gt;** | Route parameters |


**Return Value:**





---
### Request::routeHandler

Get the route handler callable.

```php
Request::routeHandler(  ): mixed
```





**Return Value:**

Route handler (callable or controller specification)



---
### Request::setRouteHandler

Set the route handler callable.

```php
Request::setRouteHandler( mixed routeHandler ): self
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `routeHandler` | **mixed** | Route handler (callable or controller specification) |


**Return Value:**





---
## RequestHandler

Request handler implementation for processing middleware pipelines.

This class manages a stack of middleware classes and processes them sequentially.
It uses dependency injection container to resolve middleware instances.

* Full name: `\meowprd\FelinePHP\Http\Middleware\RequestHandler`
* This class implements: `\meowprd\FelinePHP\Http\Middleware\RequestHandlerInterface`


### RequestHandler::__construct

Constructor.

```php
RequestHandler::__construct( \League\Container\Container container ): mixed
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `container` | **\League\Container\Container** | Dependency injection container |


**Return Value:**





---
### RequestHandler::handle

Handle an incoming HTTP request through the middleware pipeline.

```php
RequestHandler::handle( \meowprd\FelinePHP\Http\Request request ): \meowprd\FelinePHP\Http\Response
```

Processes the middleware stack sequentially. Each middleware is resolved
from the container and invoked with the current request and itself as next handler.


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `request` | **\meowprd\FelinePHP\Http\Request** | The HTTP request to handle |


**Return Value:**

The HTTP response



---
### RequestHandler::injectMiddleware

Inject middleware into the pipeline.

```php
RequestHandler::injectMiddleware( string[] middleware ): void
```

Adds middleware classes to the beginning of the processing stack.
Useful for adding global middleware or conditionally adding middleware.


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `middleware` | **string[]** | Array of middleware class names |


**Return Value:**





---
### RequestHandler::addMiddleware

Add middleware to the end of the pipeline.

```php
RequestHandler::addMiddleware( string middlewareClass ): self
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `middlewareClass` | **string** | Middleware class name |


**Return Value:**





---
### RequestHandler::setMiddleware

Set the entire middleware stack.

```php
RequestHandler::setMiddleware( string[] middleware ): self
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `middleware` | **string[]** | Array of middleware class names |


**Return Value:**





---
### RequestHandler::getMiddleware

Get the current middleware stack.

```php
RequestHandler::getMiddleware(  ): string[]
```





**Return Value:**

Array of middleware class names



---
### RequestHandler::clearMiddleware

Clear the middleware stack.

```php
RequestHandler::clearMiddleware(  ): self
```





**Return Value:**





---
### RequestHandler::isEmpty

Check if middleware stack is empty.

```php
RequestHandler::isEmpty(  ): bool
```





**Return Value:**

True if no middleware is configured



---
### RequestHandler::count

Get the number of middleware in the stack.

```php
RequestHandler::count(  ): int
```





**Return Value:**

Count of middleware



---
## Response

Represents an HTTP response.

Encapsulates the HTTP status code, headers, and body content.
Provides a fluent interface for building and sending the response.

* Full name: `\meowprd\FelinePHP\Http\Response`


### Response::__construct



```php
Response::__construct( mixed content, int statusCode = 200, array&lt;string,string&gt; headers = [] ): mixed
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `content` | **mixed** | The response body content (string, numeric, or object convertible to string). |
| `statusCode` | **int** | HTTP status code (default 200). |
| `headers` | **array&lt;string,string&gt;** | HTTP headers as an associative array: [&#039;Header-Name&#039; =&gt; &#039;Value&#039;]. |


**Return Value:**





---
### Response::setStatusCode

Sets the HTTP status code.

```php
Response::setStatusCode( int statusCode ): $this
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `statusCode` | **int** |  |


**Return Value:**





---
### Response::setHeader

Sets or replaces a header.

```php
Response::setHeader( string name, string value ): $this
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `name` | **string** |  |
| `value` | **string** |  |


**Return Value:**





---
### Response::setHeaders

Sets multiple headers at once.

```php
Response::setHeaders( array&lt;string,string&gt; headers ): $this
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `headers` | **array&lt;string,string&gt;** |  |


**Return Value:**





---
### Response::setContent

Sets the response body content.

```php
Response::setContent( mixed content ): $this
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `content` | **mixed** |  |


**Return Value:**





---
### Response::send

Sends the HTTP response to the client.

```php
Response::send(  ): void
```

This method sets the HTTP status code, outputs all headers,
and then echoes the response body content.



**Return Value:**





---
## Route

Static factory class for creating HTTP routes.

Provides a fluent interface for defining routes with HTTP methods, URIs,
handlers, and middleware. This class cannot be instantiated.

* Full name: `\meowprd\FelinePHP\Routing\Route`


### Route::get

Create a GET route.

```php
Route::get( string uri, callable|string[] handler, string[] middleware = [] ): array{0: string, 1: string, 2: array{0: callable|string[], 1: string[]}}
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `uri` | **string** | The route URI pattern (e.g. &#039;/users/{id}&#039;) |
| `handler` | **callable\|string[]** | Route handler (callable or [Controller::class, &#039;method&#039;]) |
| `middleware` | **string[]** | Array of middleware class names |


**Return Value:**

Route definition array



---
### Route::post

Create a POST route.

```php
Route::post( string uri, callable|string[] handler, string[] middleware = [] ): array{0: string, 1: string, 2: array{0: callable|string[], 1: string[]}}
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `uri` | **string** | The route URI pattern |
| `handler` | **callable\|string[]** | Route handler |
| `middleware` | **string[]** | Array of middleware class names |


**Return Value:**

Route definition array



---
### Route::put

Create a PUT route.

```php
Route::put( string uri, callable|string[] handler, string[] middleware = [] ): array{0: string, 1: string, 2: array{0: callable|string[], 1: string[]}}
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `uri` | **string** | The route URI pattern |
| `handler` | **callable\|string[]** | Route handler |
| `middleware` | **string[]** | Array of middleware class names |


**Return Value:**

Route definition array



---
### Route::delete

Create a DELETE route.

```php
Route::delete( string uri, callable|string[] handler, string[] middleware = [] ): array{0: string, 1: string, 2: array{0: callable|string[], 1: string[]}}
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `uri` | **string** | The route URI pattern |
| `handler` | **callable\|string[]** | Route handler |
| `middleware` | **string[]** | Array of middleware class names |


**Return Value:**

Route definition array



---
### Route::patch

Create a PATCH route.

```php
Route::patch( string uri, callable|string[] handler, string[] middleware = [] ): array{0: string, 1: string, 2: array{0: callable|string[], 1: string[]}}
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `uri` | **string** | The route URI pattern |
| `handler` | **callable\|string[]** | Route handler |
| `middleware` | **string[]** | Array of middleware class names |


**Return Value:**

Route definition array



---
### Route::any

Create a route that matches any HTTP method.

```php
Route::any( string uri, callable|string[] handler, string[] middleware = [] ): array{0: string, 1: string, 2: array{0: callable|string[], 1: string[]}}
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `uri` | **string** | The route URI pattern |
| `handler` | **callable\|string[]** | Route handler |
| `middleware` | **string[]** | Array of middleware class names |


**Return Value:**

Route definition array



---
### Route::match

Create a route that matches multiple HTTP methods.

```php
Route::match( string[] methods, string uri, callable|string[] handler, string[] middleware = [] ): array{0: string[], 1: string, 2: array{0: callable|string[], 1: string[]}}
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `methods` | **string[]** | Array of HTTP methods (e.g. [&#039;GET&#039;, &#039;POST&#039;]) |
| `uri` | **string** | The route URI pattern |
| `handler` | **callable\|string[]** | Route handler |
| `middleware` | **string[]** | Array of middleware class names |


**Return Value:**

Route definition array



---
## RouteNotFoundException

Exception thrown when no matching route is found for the HTTP request.

This exception can handle itself by returning a 404 HTTP response.

* Full name: `\meowprd\FelinePHP\Exceptions\Http\RouteNotFoundException`
* Parent class: `\meowprd\FelinePHP\Exceptions\HttpException`


### RouteNotFoundException::handle

Handles the exception by returning an HTTP 404 response.

```php
RouteNotFoundException::handle(  ): \meowprd\FelinePHP\Http\Response
```





**Return Value:**

HTTP response with 404 status code and exception message as content.



---
## Router

Router service for dispatching HTTP requests to their corresponding handlers.

This class uses FastRoute for routing and integrates with a dependency
injection container to resolve controller instances.

* Full name: `\meowprd\FelinePHP\Routing\Router`


### Router::dispatch

Dispatches an HTTP request to its associated route handler.

```php
Router::dispatch( \meowprd\FelinePHP\Http\Request request, \League\Container\Container container, \Rakit\Validation\Validator validator ): array{0: callable, 1: array}
```

If the resolved handler is specified as an array `[ControllerClass, method]`,
the controller instance is retrieved from the container before invocation.


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `request` | **\meowprd\FelinePHP\Http\Request** | The HTTP request object |
| `container` | **\League\Container\Container** | The DI container for resolving controllers |
| `validator` | **\Rakit\Validation\Validator** | The validation service |


**Return Value:**

A tuple containing:
- 0: The resolved handler (callable)
- 1: An array of extracted route parameters



---
## RouterDispatch

Middleware for dispatching routes through the router.

This middleware is typically placed at the end of the middleware pipeline.
It uses the router to resolve the route handler and executes it with
the appropriate parameters.

* Full name: `\meowprd\FelinePHP\Http\Middleware\Handlers\RouterDispatch`
* This class implements: `\meowprd\FelinePHP\Http\Middleware\MiddlewareInterface`


### RouterDispatch::__construct

Constructor.

```php
RouterDispatch::__construct( \meowprd\FelinePHP\Routing\Router router, \League\Container\Container container, \Rakit\Validation\Validator validator ): mixed
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `router` | **\meowprd\FelinePHP\Routing\Router** | Router instance for route resolution |
| `container` | **\League\Container\Container** | Dependency injection container |
| `validator` | **\Rakit\Validation\Validator** | Validation service |


**Return Value:**





---
### RouterDispatch::process

Process the request by dispatching it to the appropriate route handler.

```php
RouterDispatch::process( \meowprd\FelinePHP\Http\Request request, \meowprd\FelinePHP\Http\Middleware\RequestHandlerInterface handler ): \meowprd\FelinePHP\Http\Response
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `request` | **\meowprd\FelinePHP\Http\Request** | The HTTP request to process |
| `handler` | **\meowprd\FelinePHP\Http\Middleware\RequestHandlerInterface** | The next handler in the pipeline |


**Return Value:**

The HTTP response from the route handler



---
## Session

Session management class for handling PHP session data.

Provides a simple, object-oriented interface for working with session storage.
Automatically starts session upon instantiation.

* Full name: `\meowprd\FelinePHP\Http\Session`


### Session::start

Start a new session

```php
Session::start(  ): self
```





**Return Value:**





---
### Session::set

Set a session value.

```php
Session::set( string key, mixed value ): self
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `key` | **string** | Session key |
| `value` | **mixed** | Value to store |


**Return Value:**

Returns instance for method chaining



---
### Session::get

Get a session value.

```php
Session::get( string key, mixed default = null ): mixed
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `key` | **string** | Session key to retrieve |
| `default` | **mixed** | Default value if key doesn&#039;t exist |


**Return Value:**

Stored value or default



---
### Session::remove

Remove a session value.

```php
Session::remove( string key ): self
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `key` | **string** | Session key to remove |


**Return Value:**

Returns instance for method chaining



---
### Session::destroy

Destroy the entire session.

```php
Session::destroy(  ): self
```





**Return Value:**

Returns instance for method chaining



---
### Session::has

Check if a session key exists.

```php
Session::has( string key ): bool
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `key` | **string** | Session key to check |


**Return Value:**

True if key exists, false otherwise



---
### Session::getId

Get session ID.

```php
Session::getId(  ): string
```





**Return Value:**

Current session ID



---
### Session::regenerate

Regenerate session ID.

```php
Session::regenerate( bool deleteOldSession = true ): self
```

Useful for security purposes to prevent session fixation attacks.


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `deleteOldSession` | **bool** | Whether to delete the old session |


**Return Value:**

Returns instance for method chaining



---
### Session::all

Get all session data.

```php
Session::all(  ): array
```





**Return Value:**

Complete session data



---
### Session::clear

Clear all session data without destroying the session.

```php
Session::clear(  ): self
```





**Return Value:**

Returns instance for method chaining



---
### Session::clearFlash

Clear all flash session data without destroying the session.

```php
Session::clearFlash(  ): self
```





**Return Value:**

Returns instance for method chaining



---
### Session::flash

Set flash message for next request.

```php
Session::flash( string key, mixed value ): self
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `key` | **string** | Flash message key |
| `value` | **mixed** | Flash message value |


**Return Value:**

Returns instance for method chaining



---
### Session::getFlash

Get flash message and remove it.

```php
Session::getFlash( string key, mixed default = null ): mixed
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `key` | **string** | Flash message key |
| `default` | **mixed** | Default value if key doesn&#039;t exist |


**Return Value:**

Flash message value or default



---
### Session::hasFlash

Check if flash message exists.

```php
Session::hasFlash( string key ): bool
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `key` | **string** | Flash message key |


**Return Value:**

True if flash message exists



---
## StartSession





* Full name: `\meowprd\FelinePHP\Http\Middleware\Handlers\StartSession`
* This class implements: `\meowprd\FelinePHP\Http\Middleware\MiddlewareInterface`


### StartSession::__construct



```php
StartSession::__construct( \meowprd\FelinePHP\Http\Session session ): mixed
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `session` | **\meowprd\FelinePHP\Http\Session** |  |


**Return Value:**





---
### StartSession::process

Process an incoming HTTP request.

```php
StartSession::process( \meowprd\FelinePHP\Http\Request request, \meowprd\FelinePHP\Http\Middleware\RequestHandlerInterface handler ): \meowprd\FelinePHP\Http\Response
```

Middleware components can:
- Modify the request before passing it to the handler
- Modify the response returned by the handler
- Short-circuit the pipeline and return a response directly
- Perform side effects (logging, metrics, etc.)


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `request` | **\meowprd\FelinePHP\Http\Request** | The HTTP request to process |
| `handler` | **\meowprd\FelinePHP\Http\Middleware\RequestHandlerInterface** | The next handler in the pipeline |


**Return Value:**

The HTTP response



---
## TwigFactory

Factory for creating and configuring Twig environment instances.

Handles Twig initialization with proper settings, extensions, and custom functions.
Provides integration with application components like session management.

* Full name: `\meowprd\FelinePHP\Template\TwigFactory`


### TwigFactory::__construct

Constructor.

```php
TwigFactory::__construct( \meowprd\FelinePHP\Http\Session session ): mixed
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `session` | **\meowprd\FelinePHP\Http\Session** | Session instance for template integration |


**Return Value:**





---
### TwigFactory::create

Create and configure Twig environment.

```php
TwigFactory::create(  ): \Twig\Environment
```





**Return Value:**

Configured Twig instance



---
### TwigFactory::getSession

Get session instance for Twig templates.

```php
TwigFactory::getSession(  ): \meowprd\FelinePHP\Http\Session
```





**Return Value:**

Session instance



---
## WhoopsDebugger

Debugger class responsible for registering
error handlers like Whoops based on debug mode.



* Full name: `\meowprd\FelinePHP\Debug\WhoopsDebugger`


### WhoopsDebugger::register

Registers the Whoops error handler if debugging is enabled.

```php
WhoopsDebugger::register( bool debug ): void
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `debug` | **bool** | Indicates whether debugging is enabled. |


**Return Value:**





---
