# Analyse and describe attached PHP class

1. What is TodoNotifier for?
2. Add PHPDoc for each method in class (at least input parameters and return values)
3. Tell about each method: what it does and why it may exist (also in phpdoc)
4. Provide an example how this class may be used
5. What is NotifierInterface for? Which methods the interface may potentially declare?
6. What are the potential problems with this code? What is suspicious? How it can be fixed?

# Answers

1. This class allows to create comment for task and send emails
2. Ready
3. I've added methods description in code-1.php
4. Probably something like this
```
$message = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';
$authorEmail = 'user@example.com';
$notifier = new TodoNotifier();
$notifier->notify($authorEmail, $message);
TodoNotifier::sendEmail(false, $message, [$authorEmail]);
```
5. I assume it should have only one method `notify` 
6. There are a lot of problems with code styling and SOLID principles. 
E.g. single responsibility and dependency inversion. It will be difficult to test such class.
I don't understand why methods like this `sendEmail`, `createAuthentication` were added to this class.
In addition there is possible sql injection through method `createAuthentication` - it's private 
but it was used in method `notify` and there enough to pass `$authorEmail` like `'` and it will cause sql error. 
 