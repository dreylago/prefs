# Prefs-common

Store and retrieve user preferences (common files).

1. personalize the look and
feel of a website. 
2. Remember form default values according
to the last submit (for instance, repeat the date limits
or the selection of an account in a dropdown 
list, according to the last search).
3. etc.

**Prefs-common** is *framework agnostic*, but it needs a bridge to
a framework to retrieve system information such as the current
username.

You need a bridge package 
(such as **[prefs-yii](https://github.com/dreylago/prefs-yii)**) to 
install or test this package.  


## Usage


```php
    use drey\Prefs\DB\FileSystem;
    use drey\Prefs\Prefs;

    # filesystem storage
    $storage = new FileSystem('/path/to/dir');

    # init prefs object
    $prefs = new Prefs($storage);

    # set preference "color" for current user
    $prefs->set('color','red');
    # (...)
    # get color preference of current user, with 'blue' as default
    $color = $prefs->get('color','blue');
    #
    # color is set to 'red'
```

### Store preferences in a table

Change the storage medium accordingly.

```php

    use drey\Prefs\DB\MySQL;
    use drey\Prefs\Prefs;

    # DB storage (MySQL), table_name is optional, defaults to 'prefs'
    $storage = new MySQL('table_name');

    # init prefs object
    $prefs = new Prefs($storage);

    $prefs->set('fruit','lemmon');
    # (...)
    $fruit = $prefs->get('fruit','pear');
```

The table schema for MySQL should be (see `prefs-common/src/sql`):

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

System administrators on sessions with enough privileges 
could assign/read the preferences of other users:

```php
    $prefs->set('fruit','lemmon','bob');
```

### Global preferences

A fake username could be used to handle preferences for all users. All
users must agree on the fake username.

```php
    # one user, maybe an administrator
    $prefs->set('closing_date',$form->closing_date,'*');

    (...)

    # remaining users
    $closing_date = $prefs->get('closing_date',date('Y-m-d'),'*');
   
 
```

### Populate form fields (Yii):

We can populate fields if the related model has not any value and
it is a new record.

```php
    # before showing the form
    if ($model->isNewRecord && !$model->date) {
        $model->date = $prefs->get('invoice_date',date('Y-m-d'));
    }

    # after post ...
    if (post) {
        $prefs->set('invoice_date',$model->date);
    }
```


## Install

You need to install a bridge package 
(such as **[prefs-yii](https://github.com/dreylago/prefs-yii)**) to 
install or test this package.  


