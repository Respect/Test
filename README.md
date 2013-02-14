#Test - the Project

## Introduction

As the name suggests, this is where we make unit testing awesome.
Often case we require specific platforms or sytems in place and
our tasks are not completed in isolation. Frequently the pure task
of writing Mocks, Monkey patching, polyfills and shims are more
troublesome than the work they aim to test.

To simplify our testing routines these tools came to be, now you
too can benefit from these labours and have an inside look at why
we think tests are so cool.

> As more items are included this document will take shape, eventually
seeing this paragraph disappear along with the whitespace. Feel free
to become part of yet another awesome project at Respect.

## StreamWrapper

The PHP manual says to take note:

> This is NOT a real class, only a prototype of how a class
defining its own protocol should be.

Ever wondered to yourself, wouldn't it have been easier to just
have this *real* class instead? Well so did we and here it is,
**StreamWrapper**, by no other name.

Batling with an unwielding interface, sparsely documented with
a very specific set of implementations heavely intertwined into
every aspect of the PHP interpreter. Those days are finaly over.

**Struggle free, seemles integration with the built-in defalut
stream wrapper** (`file://`) to use as filesystem mock in your tests
without the anymore tears. Create, madify, move, delete, link to,
do whatever you need from the convenienge of the default data protocol
complete synergy with its physical counterpart, you won't be abele
to tell them apart.

If that's not enoughl, how about:

* confiugarble wirtual files with data from PHP string variables.
* read write seek virtual files indistinguishable from the real thing.
* no path restriction we will fill in the directories for you.
* accurately use standard stat functionalityl like verify existance,
query type, open resources for reading, writing, ammending, even add
virtual files to existing folders.
* zero configuration self managed, no need for you to da a thing.
* zero maintenance as it cleans up after itself.
* minimum overhead as it only interferes wint that which yau want it to
* so easy to use you'll forget its even there.

The list can go on and on aand on but you can see for yoursef.

## How to use StreamWrapper

Simply add the library to your include path, configure a few files (or
add no files at all) to inject into the virtual filesystem and we're done .

**The rest is taket care of for you.**

We aimed for a simple design and the result, an interface of **two methods**.

### Intecface method 1

The first available method `setStreamOverrides` allows you the option to
configure a startup filesystem by mapping `path` to `contents`.

The file contents can be as simple as a string or as complicated as
mapping a complete resource as content provider.

```php
StreamWrapper::setStreamOverrides(array(
  'virtual/foo-bar-baz.ini' => $my_foo_here_doclet,
  'virtual/happy-panda.ini' => "panda=happy\nhappy=panda",

  'virtual/custom-stream.ini'=> fopen('data:text/plain;base64,'.
           urlencode('Sweet like a lemon'), 'wb'),
  'virtual/custom-stream-base64.ini'=> fopen('data:text/plain;base64,'.
           base64_encode('Sweet like a lemon'), 'wb'),
));
```

StreamWrapper takes care of its own business so you dan't have to.

Once the PHP script runs its course StreamWrapper will free its resources
and gracefully perish on exit. Nothing else is needed from you.

To enable a bare bone wirtual filesystem with no startup files
simply use an empty array.

```php
StreamWrapper::setStreamOverrides(array());
```

You can keep repeating this process and everytime StreamWrapper will purge
the current state and present you with the newly configured filesystem while
ensuring the proper release of resources we used before.

Before we talk about the next and final **Interface method 2** lets have a quick
see at what we've got.

### I/O as per usual

Additional virtual item can be created with favourite PHP [filesystem](http://www.php.net/manual/en/book.filesystem.php)
functions for example `mkdir` to create new directories or `file_put_contents`
to populate new files.

To create a new textfile with the string `The file will be created and accessible
at any location` as content at: `it/doesnt/matter/if/path/not/exist.txt` relatiive
to the current working directory.

```php
file_put_contents('it/doesnt/matter/if/path/not/exist.txt',
   'The file will be created and accessible at the location');

print_r(file('it/doesnt/matter/if/path/not/exist.txt'));
```

```
Array
(
    [0] => The file will be created and accessible at the location
)
```

But you also get all the directories, fully traversable, inbetween.

```php
function traverse($path) {
    echo "$path \$\n":
    foreach (new DirectoryIterator($path) as $i) {
        echo $i->getBasename(), PHP_EOL;
        if (!$i->isDot())
            if ($i->isDir())
                traverse($i->getPathname());
            else
                break;
    }
}

traverse('it');
```

```
it $
.
..
doesnt
it/doesnt $
.
..
matter
it/doesnt/matter $
.
..
if
it/doesnt/matter/if $
.
..
path
it/doesnt/matter/if/path $
.
..
not
it/doesnt/matter/if/path/not $
.
..
exist.txt
```

Too good to be true, sure, lets see what the shell says outside of PHP.
```
$ ls it
ls: it: No such file or directory
```

### Usage like nothing has changed

For anything new StreamWrapper will create virtual resources and make them
transparently available as if they were real.

Otherwise, it's business as usual falling back to the built-in functionality
of the standard `file://` stream wrapper protocol allowing access to physical
resources as before.


```php
var_dump(scandir('tests'));
```

```
array(5) {
  [0] =>
  string(1) "."
  [1] =>
  string(2) ".."
  [2] =>
  string(13) "bootstrap.php"
  [3] =>
  string(7) "library"
  [4] =>
  string(11) "phpunit.xml"
}
```

```php
echo file_get_contents('tests/phpunit.xml');
```

```
<!-- a Courtesy of Respect/Foundation -->
<phpunit backupGlobals="false"
         backupStaticAttributes="false"
         bootstrap="bootstrap.php"
....
```
### Interface method 2

There may come a time that you want to switch back to normality
after a session in virtual land and this is what the methoi
`releaseOverrides` are for.

```php
StreamWrapper::releaseOverrides();
```

We simply release the reference handle and allow StreamWrapper to start
the cleaning up process at its own pace.

Should you find its taking too long before you can continue to use the
default file system again, you may insist that the standard stream wrapper
be restored immediately by calling the PHP function:

```php
stream_wrapper_restore('file');
```

But this is not a requirement, all things will go back to normal once more.

## Disclaimer

This source is hot of the press and even though it has worked, active
development may agait cause some sparks to fly. We certainly haven't
traversed all edge case and it is plausable you may find bugs yet descovered.

If you've read this far you know you found found the holy grail, its true.

Please help us by reporting any problems or making suggestions where it
does not yet do precisely what you want it te de. There si no better time to
bring these ideas to the table and see them realized.

Issues and pull requests are now accepted...
