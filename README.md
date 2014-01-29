# Test - the Project

[![Latest Stable Version](https://poser.pugx.org/respect/test/v/stable.png)](https://packagist.org/packages/respect/test) [![Total Downloads](https://poser.pugx.org/respect/test/downloads.png)](https://packagist.org/packages/respect/test) [![Latest Unstable Version](https://poser.pugx.org/respect/test/v/unstable.png)](https://packagist.org/packages/respect/test) [![License](https://poser.pugx.org/respect/test/license.png)](https://packagist.org/packages/respect/test)

## Introduction

As the name suggests, this is where we make unit testing awesome.
Often case we require specific platforms or systems in place and
our tasks are not completed in isolation. Frequently the pure task
of writing Mocks, Monkey patching, poly fills and shims are more
troublesome than the work they aim to test.

To simplify our testing routines these tools came to be, now you
too can benefit from these labours and have an inside look at why
we think tests are so cool.

As more items are included this document will take shape, eventually
seeing this paragraph disappear along with the white space. Feel free
to become part of yet another awesome project at Respect.

## Reflect

Access properties of classes or objects without the fuss, `Reflect`
makes it transparent whether you are accessing or changing properties
for a class or an object or whether these properties are static or
instance variables, whether they are public, private or protected.
It's all the same for us.

Example class and object instance:

```php

    use Respect\Test\Reflect;

    class HappyPanda
    {
        private $p = 'private';
        protected $pr = 'protected';
        public $pu = 'public';
    }

    $hp = new HappyPanda();

```

### Reflect::on

To get an instance of the `Respect\Test\Reflect` helper call the static
`on` methoud and supply either an object or a string as class name.

```php

    $reflect = Reflect::on($hp);

    /** or */

    $reflect = Reflect::on('HappyPanda');

```

### getProperty($name)

The `getProperty` method will return the value of the named property.

```php

    echo $reflect->getProperty('pu');

    // public

```

But due to fluent interface design to get a property from our `HappyPanda`
using the instance object simply write a one-liner.

```php

    echo Reflect::on($hp)->getProperty('p');

    // private

```

We can do exactly the same with only the class name.

```php

    echo Reflect::on('HappyPanda')->getProperty('pr');

    // protected

```

### setProperty($name, $value)

So you want to change a property, do you? Why this is what testing is all about.

```php

    $reflect->setProperty('pu', 1234);
    echo $reflect->getProperty('pu');

    // 1234

```

Or through the magic of chaining giving you the freedom to combine it all
on a single line once again.

```php

    echo Reflect::on($hp)->setProperty('p', 'owned')->getProperty('p');

    // owned

```

We can do exactly the same with only the class name, what did I tell you.

```php

    echo Reflect::on('HappyPanda')->setProperty('pu', 'easy')->getProperty('pr');

    // easy

```

### getInstance()

As you may well know we need an instance (object) to modify these
instance properties so it makes sense that you might want to get
that instance itself back eventually. It doesn't matter if your
class is abstract, has no constructor, constructor with required parameters or
whether it is marked private or protected, `Reflect` will see to it
that you get an instance back no matter what it takes.

Lets look at a new class definition with a private constructor that
requires 2 non-optional parameters. We also load it up with some static
properties but to us that is all the same now.

```php

    class Panda
    {
        private $p = 'private';
        protected $pr;
        public $pu;
        private static $ps;
        protected static $prs;
        public static $pus;

        private function __construct($a, $b)
        {
        }
    }

```

Utilising the fluent interface to the maximum!

```php

    $object = Reflect::on('Panda')
        ->setProperty('p', 1)
        ->setProperty('pr', 2)
        ->setProperty('pu', 3)
        ->setProperty('ps', 4)
        ->setProperty('prs',5)
        ->setProperty('pus',6)
        ->getInstance();

```

That will leave you with a new instance of class `Panda` with each
and every property changed, assigned to the variable $object. Looks
something like this:

```php

    class Panda
    {
        private $p = 1;
        protected $pr = 2;
        public $pu = 3;
        private static $ps = 4;
        protected static $prs = 5;
        public static $pus = 6;

        private function __construct($a, $b)
        {
        }
    }

```
Lets turn things up a notch, how about an abstract class? When you Reflect
on an abstract class things are a little different. We can't have an instance
of an abstract class, its not possible. So lets see what happens.

Lets make our Happy Panda abstract

```
    abstract class Panda
    {
        private $val = 'private';

        abstract protected function eatBamboo(array $sticks=array());

        private function __construct(&$a, $b)
        {
            $a++;
            $this->val = $b;
        }
    }

```

We Reflect on the abstract class and retrieve the instance.

```php

    $object = Reflect::on('Panda')->getInstance();

```

Reflect will generate a Mock class for you so that you can have a valid instance
of the abstract class to test against. The Mock class will be in the same namespace
(if applicable) with the word "Mock" Prepended to the classname.

```php

    class MockPanda extends Panda
    {
        public function eatBamboo($sticks=array ())
        {
        }
    }
```

As you can see we can get an instance of an abstract class from a private constructor
but what if we wanted to execute that constructor? No problem just pass an array of
the parameters you want to use to `getInstance()` and Reflect will call the private
constructor for you. **Note:** example uses the new shorthand for arrays introduced
in PHP 5.4 for 5.3 use `array()` instead of `[ ]`


```php
    echo Reflect::on('Panda')->getProperty('val');

    // private

    $object = Reflect::on('Panda')->getInstance([&$a, 'New Value']);

    echo Reflect::on('Panda')->getProperty('val');

    // New Value

    echo $a;

    // 1

    $object = Reflect::on('Panda')->getInstance([&$a, 'New Value']);

    echo $a;

    // 2

    $object = Reflect::on('Panda')->getInstance([&$a, 'New Value']);

    echo $a;

    // 3
```


## StreamWrapper

The PHP manual says, [about the StreamWrapper](http://www.php.net/manual/en/class.streamwrapper.php), to take note:

> This is NOT a real class, only a prototype of how a class
defining its own protocol should be.

If you also agree, that sucks. Wouldn't it be so much easier to
just have this *real* class instead? Well so did we and here it is,
**StreamWrapper**, by no other name.

Battling with an unwieldy interface, sparsely documented with
a very specific set of implementations heavily intertwined into
every aspect of the PHP interpreter. Those days are finally over.

**Struggle free, seamless integration with the built-in default
stream wrapper** (`file://`) to use as file system mock in your tests
without anymore tears. Create, modify, move, delete, link to,
do whatever you need from the convenience of the default data protocol
complete synergy with its physical counterparts, you won't be able
to tell them apart.

If that's not cool enough already, how about:

* configurable virtual files with data from PHP string variables.
* read write seek virtual files indistinguishable from the real thing.
* no path restriction we will fill in the directories for you.
* accurately use standard stat functionality like verify existence,
query type, open resources for reading, writing, amending, even add
virtual files to existing folders.
* zero configuration self managed, no need for you to do a thing.
* zero maintenance as it cleans up after itself.
* minimum overhead as it only interferes where it's intended
* so easy to use you'll forget its even there.

The list can go on and on and on but you should rather see for yourself.

## How to use StreamWrapper

Simply add the library to your include path, configure a few files (or
add no files at all) to inject into the virtual file system and we're done .

**The rest is taken care of for you.**

We aimed for a simple design and the result, an interface of **two methods**.

### StreamWrapper::setStreamOverrides($virtual_fs)

The first available method `setStreamOverrides` allows you the option to
configure a start up file system by mapping `path` to `contents`.

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

StreamWrapper takes care of its own business so you don't have to.

Once the PHP script runs its course StreamWrapper will free its resources
and gracefully perish on exit.

Nothing else is needed from you.

To enable a bare bone virtual file system with no start up files
simply use an empty array.

```php

    StreamWrapper::setStreamOverrides(array());

```

You can keep repeating this process and every time StreamWrapper will purge
the current state and present you with the newly configured file system while
ensuring the proper release of resources we used before.

Before we talk about the next and final **Interface method # 2** lets have a quick
look see at what we've got.

### I/O as per usual

Additional virtual item can be created with your favourite PHP [filesystem](http://www.php.net/manual/en/book.filesystem.php)
functions for example `mkdir` to create new directories or `file_put_contents`
to populate new files.

To create a new text file with the string `"The file will be created and accessible
at any location"` as content at: `it/doesnt/matter/if/path/not/exist.txt` relative
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

But you also get all the directories, fully traversable, in between.

Lets try this simple recursion:

```php

    function traverse($path) {
        echo "$path \$\n":
        foreach (new DirectoryIterator($path) as $i) {
            echo $i->getBasename(), PHP_EOL;
            if ($i->isDir())
                traverse($i->getPathname());
            else
                break;
        }
    }

    traverse('it');

```
See what do we get?

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

    var_export(scandir('tests'));

```

```php

    array (
      0 => '.',
      1 => '..',
      2 => 'bootstrap.php',
      3 => 'library',
      4 => 'phpunit.xml',
    )
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
### StreamWrapper::releaseOverrides()

There may come a time when you want to switch back to normality
after a session in virtual land and this is what the method
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
development may again cause some sparks to fly. We certainly haven't
explored all edge cases and it is plausible you may find bugs yet undiscovered.

If you've read this far you know you found the holy grail of testing, its true.

Please help us by reporting any problems or making suggestions where it
does not yet do precisely what you want it to do. There is no better time to
bring these ideas to the table and see them realize.

Issues and pull requests are now being accepted...
