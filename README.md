# Fail2BanBundle

A Kimai 2 plugin, which allows to log all failed logins with their IP to a log file.

This logfile can be consumed by `fail2ban` to prevent authentication attacks.


## Installation

First clone it to your Kimai installation `plugins` directory:
```
cd /kimai/var/plugins/
git clone https://github.com/Keleo/Fail2BanBundle.git
```

And then rebuild the cache: 
```
cd /kimai/
bin/console cache:clear
bin/console cache:warmup
```

You could also [download it as zip](https://github.com/keleo/Fail2BanBundle/archive/master.zip) and upload the directory via FTP:

```
/kimai/var/plugins/
├── Fail2BanBundle
│   ├── Fail2BanBundle.php
|   └ ... more files and directories follow here ... 
```

## Fail2Ban configurations

You should know how to use and configure fail2ban, we cannot help with that part!

Having said that, here are some possible rules for your fail2ban configuration.

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
filter    = symfony
logpath   = /var/www/kimai2/var/log/fail2ban.log
port      = http,https
bantime   = 600
banaction = iptables-multiport
maxretry  = 3
```

## Credits

Bundle inspired by the blog entry: https://www.nomisoft.co.uk/articles/symfony-fail2ban-ip-blocking

Thanks also to @BeckeBauer for the inspiration and the initial try!
