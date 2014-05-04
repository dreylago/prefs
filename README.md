# Prefs-common

Store and retrieve user preferences.

1. Remember form default values according
to the last submit (for instance, repeat the date limits
or the selection of an account in a dropdown 
list, according to the last search).
1. Customize the look and
feel of a website. 
1. etc.


## Usage


```php
    use drey\Prefs\Prefs;
    use drey\Prefs\DB\FileSystem;

    $db = new FileSystem('/tmp');
    $prefs = new Prefs($db);
    $prefs->setDefaultUsername('drey');

    # set preference "color" for current user (drey)
    $prefs->set('color','red');
    
    # get color preference of current user
    $color = $prefs->get('color');
    
    # $color is set to 'red'
```

### Default values

```php
    $bird = $prefs->get('bird','eagle');
    
    # $bird if set to 'eagle' if key 'bird' not found
```

### Store preferences in a table

Change the DB medium accordingly.

```php
    use drey\Prefs\Prefs;
    use drey\Prefs\DB\PDOInstance;

    $pdo = myConnect();
    $db = new PDOInstance($pdo);
    $prefs = new Prefs($db);
    $prefs->setDefaultUsername('bob');

    # (...)
```

The table schema for MySQL should be (see `prefs-common/sql`):

```sql
        CREATE TABLE `prefs`  (
          `name` varchar(255) NOT NULL,
          `value` varchar(255) NOT NULL,
          `username` varchar(32) NOT NULL,
          PRIMARY KEY (`name`,`username`),
          KEY (`username`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```


### Specify preferences for other users

To assign/read the preferences of other users:

```php
    $prefs->set('fruit','lemmon','bob');

    $prefs->get('fruit','pear','bob')
```

### Global preferences

A fake username could be used to handle preferences for all users. All
users must agree on the fake username.

```php
    # one user
    $prefs->set('closing_date',$form->closing_date,'*');

    (...)

    # other users
    $closing_date = $prefs->get('closing_date',date('Y-m-d'),'*');
   
 
```

### Populate form fields (Yii):

We can populate fields if the related model has not any value and it is a new record.

```php
    # before showing the form get the last value entered
    if ($model->isNewRecord && !$model->date) {
        $model->date = $prefs->get('invoice_date',date('Y-m-d'));
    }

    # after post, update value entered
    if (post) {
        $prefs->set('invoice_date',$model->date);
    }
```


## Install

Best way is via [composer](https://getcomposer.org/)/[Packagist](https://packagist.org/):

``` json
{
    "minimum-stability" : "dev",
    "require": {
        "drey/prefs-common": "dev-master"
    }
}

See [drey/prefs-common](https://packagist.org/packages/drey/prefs-common).
```


