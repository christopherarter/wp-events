## WP Events

** This repo has been archived. Please use WP's actions / filters features instead. **

**WP Events** is a super-simple event / listener pattern library for Wordpress and other applications. Example use:

### Declaring events
```
wp_events_register([
    ...
    'user_signup' => [
    'send_welcome_email',
    'send_slack_notification'
    ],
]);
```

In this example, the `user_signup_event` will call the `send_welcome_email` and `send_slack_notification` listeners. It will also deliver a payload to each listener.

### Dispatching events

Using the example above, this is how we can dispatch an event anywhere in our application.

```
wp_events_dispatch('user_signup', $email);

```

### Handling events in listeners

Next, each listener we registered will be provided the payload from our `wp_events_dispatch()` function.

```
function send_welcome_email($email)
{
    // do something with $email
}
```

```
function send_slack_notification($email)
{
    // do something with $email
}
```

### Multiple inputs

This can also handle multiple inputs:

```
wp_events_dispatch('user_signup', $name, $email);
```

Which you can accept in your listeners:

```
function send_slack_notification($name, $email)
{
    // do something with $name and $email
}
```

### Tests

To test, run:

`./vendor/bin/phpunit ./tests/EventServiceTest.php --testdox`
