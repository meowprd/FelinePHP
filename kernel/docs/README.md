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
| [*HttpException*](#HttpException) | Base HTTP exception class. |
| [**HttpException**::handle](#HttpExceptionhandle) | Handle the exception by returning an HTTP response. |
| [*Kernel*](#Kernel) | Console application kernel. |
| [**Kernel**::__construct](#Kernel__construct) |  |
| [**Kernel**::handle](#Kernelhandle) | Handle the console command execution. |
| [*Kernel*](#Kernel) | Application kernel. |
| [**Kernel**::__construct](#Kernel__construct) | Creates a new Kernel instance. |
| [**Kernel**::handle](#Kernelhandle) | Handles an HTTP request and returns a response. |
| [*MakeMigrationCommand*](#MakeMigrationCommand) | Command to create new database migrations. |
| [**MakeMigrationCommand**::execute](#MakeMigrationCommandexecute) | Execute the migration creation command. |
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
| [*RouteNotFoundException*](#RouteNotFoundException) | Exception thrown when no matching route is found for the HTTP request. |
| [**RouteNotFoundException**::handle](#RouteNotFoundExceptionhandle) | Handles the exception by returning an HTTP 404 response. |
| [*Router*](#Router) | Router service for dispatching HTTP requests to their corresponding handlers. |
| [**Router**::dispatch](#Routerdispatch) | Dispatches an HTTP request to its associated route handler. |
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
* This class implements: \Psr\Container\ContainerInterface


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
* This class implements: \Psr\Container\ContainerExceptionInterface


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
* This class implements: \meowprd\FelinePHP\Console\CommandInterface


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
* This class implements: \meowprd\FelinePHP\Console\CommandInterface


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
* This class implements: \meowprd\FelinePHP\Console\CommandInterface


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
* This class implements: \meowprd\FelinePHP\Console\CommandInterface


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
Kernel::__construct( \meowprd\FelinePHP\Routing\Router router, \League\Container\Container container ): mixed
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `router` | **\meowprd\FelinePHP\Routing\Router** | Router instance used for request dispatching. |
| `container` | **\League\Container\Container** | Dependency injection container for resolving services. |


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
## MakeMigrationCommand

Command to create new database migrations.

This command generates new migration files using a stub template.

* Full name: `\meowprd\FelinePHP\Console\Commands\MakeMigrationCommand`
* This class implements: \meowprd\FelinePHP\Console\CommandInterface


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

Used to define routes by HTTP method, URI, and handler (callable or controller method).

* Full name: `\meowprd\FelinePHP\Routing\Route`


### Route::get

Create a GET route.

```php
Route::get( string uri, callable|string[] handler ): array{0: string, 1: string, 2: callable|string[]}
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `uri` | **string** | The route URI (e.g. &#039;/users&#039;) |
| `handler` | **callable\|string[]** | Callable or array [ControllerClass::class, &#039;method&#039;] |


**Return Value:**

Route definition array



---
### Route::post

Create a POST route.

```php
Route::post( string uri, callable|string[] handler ): array{0: string, 1: string, 2: callable|string[]}
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `uri` | **string** | The route URI |
| `handler` | **callable\|string[]** | The handler |


**Return Value:**

Route definition array



---
### Route::put

Create a PUT route.

```php
Route::put( string uri, callable|string[] handler ): array{0: string, 1: string, 2: callable|string[]}
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `uri` | **string** | The route URI |
| `handler` | **callable\|string[]** | The handler |


**Return Value:**

Route definition array



---
### Route::delete

Create a DELETE route.

```php
Route::delete( string uri, callable|string[] handler ): array{0: string, 1: string, 2: callable|string[]}
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `uri` | **string** | The route URI |
| `handler` | **callable\|string[]** | The handler |


**Return Value:**

Route definition array



---
### Route::patch

Create a PATCH route.

```php
Route::patch( string uri, callable|string[] handler ): array{0: string, 1: string, 2: callable|string[]}
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `uri` | **string** | The route URI |
| `handler` | **callable\|string[]** | The handler |


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
Router::dispatch( \meowprd\FelinePHP\Http\Request request, \League\Container\Container container ): array{0: callable, 1: array}
```

If the resolved handler is specified as an array `[ControllerClass, method]`,
the controller instance is retrieved from the container before invocation.


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `request` | **\meowprd\FelinePHP\Http\Request** | The HTTP request object. |
| `container` | **\League\Container\Container** | The DI container for resolving controllers. |


**Return Value:**

A tuple containing:
- 0: The resolved handler (callable).
- 1: An array of extracted route parameters.



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
