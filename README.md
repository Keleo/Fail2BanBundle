# Fail2BanBundle

A Kimai plugin, which logs an error message for every failed login attempt to a dedicated logfile.

This logfile can be analyzed by `fail2ban` to block access and prevent authentication attacks.

## Installation

This plugin is compatible with the following Kimai releases:

| Bundle version | Minimum Kimai version |
|----------------|-----------------------|
| 2.0            | 2.0.0                 |
| 1.1 - 1.2      | 1.18                  |
| 1.0 - 1.0.1    | 1.0                   |

You find the most notable changes between the versions in the file [CHANGELOG.md](CHANGELOG.md).

Download and extract the [compatible release](https://github.com/Keleo/Fail2BanBundle/releases) in `var/plugins/` (see [plugin docs](https://www.kimai.org/documentation/plugin-management.html)).

The file structure needs to look like this afterwards:

```bash
var/plugins/
├── Fail2BanBundle
│   ├── Fail2BanBundle.php
|   └ ... more files and directories follow here ... 
```

Then rebuild the cache:
```bash
bin/console kimai:reload --env=prod
```

## Fail2Ban configurations

You should know how to use and configure `fail2ban`, we cannot help with that part!
Having said that, here are some possible rules for your `fail2ban` configuration.

First the Kimai specific filter:
```
#/etc/fail2ban/filter.d/kimai2.conf
[Definition]
failregex = fail2ban.ERROR: <HOST> \[.*\] \[.*\]$
```

And the additional jail.local for Kimai2:
```
#/etc/fail2ban/jail.local
[kimai2]
enabled   = true
filter    = kimai2
logpath   = /var/www/kimai2/var/log/fail2ban.log
port      = http,https
bantime   = 600
banaction = iptables-multiport
maxretry  = 3
```

Now touch the file to [make sure it exists](https://github.com/Keleo/Fail2BanBundle/issues/2):
```bash
touch /var/www/kimai2/var/log/fail2ban.log
```

## Credits

- Bundle inspired by [this blog entry](https://www.nomisoft.co.uk/articles/symfony-fail2ban-ip-blocking) 
- Thanks to [@BeckeBauer](https://github.com/kimai/kimai/issues/951) for the idea
- Documentation in the [fail2ban wiki](http://www.fail2ban.org/wiki/index.php/Main_Page)
