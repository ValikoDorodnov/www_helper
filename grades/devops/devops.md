# Devops

## Рекомендации по защите Linux VPS сервера

### Создание отдельного пользователя sudo
Пользователь root является администратором в среде Linux и имеет весьма широкие права.  
Ввиду расширенных прав учетной записи root не рекомендуется использовать ее на постоянной основе,  
поскольку некоторые права, предоставляемые учетной записи root, дают возможность вносить  
деструктивные изменения, в том числе случайно.  
```
#create new User
adduser sammy

#add new user to sudo
usermod -aG sudo sammy

#checkout to new user
su - sammy

#test new user sudo accept
sudo command_to_run
```

### Дать возможность запускать sudo без пароля
```

#редактирование файла /etc/sudoers
sudo visudo 

#добавить строчку
sammy ALL=(ALL) NOPASSWD:ALL

```

### Добавить пользователя в docker группу
```
sudo usermod -aG docker sammy
```

[Редактирование файла Sudoers](https://www.digitalocean.com/community/tutorials/how-to-edit-the-sudoers-file-ru)  

### Добавить ключ ssh на сервер
```
ssh-copy-id sammy@22.33.44.55
```

### Сменить порт ssh
```
sudo nano /etc/ssh/sshd_config

Port 9999

sudo systemctl restart ssh/sshd
```

### Отключить аутентификацию по паролю SSH
Прежде чем сделать это, вы должны помнить следующее:
- Обязательно создайте пару ключей ssh на своем персональном/рабочем компьютере и добавьте этот открытый ключ SSH на сервер, чтобы по крайней мере вы могли войти на сервер.
- Отключение аутентификации на основе пароля означает, что вы не можете подключиться к серверу ssh со случайных компьютеров.
- Вы не должны терять свои ключи SSH. Если вы отформатируете свой персональный компьютер и потеряете ssh-ключи, вы никогда не сможете получить доступ к серверу.
- Если вы заблокированы, вы никогда не сможете получить доступ к вашему серверу.
```
sudo nano /etc/ssh/sshd_config

PasswordAuthentication no

sudo systemctl restart ssh/sshd
```

#### Если Вам не нужны другие методы, то их тоже можно отключить, оставив только publickey

### Отключить возможность аутентификации root'ом
Учетная запись root по протоколу SSH должна быть отключена во всех случаях, чтобы повысить  
безопасность вашего сервера. Вы должны войти в систему через SSH на удаленном сервере  
только с обычной учетной записи пользователя, а затем изменить права на учетную  
запись root с помощью команды sudo или su.  
```
sudo nano /etc/ssh/sshd_config

PermitRootLogin no

sudo systemctl restart ssh/sshd
```

### Включаем использование только 2й версии SSH протокола.
```
sudo nano /etc/ssh/sshd_config

Protocol 2

sudo systemctl restart ssh/sshd
```

## Fail2Ban

### Установка
```
sudo apt update
sudo apt install fail2ban
```

### Для хранения ваших собственных настроек надо создать файл jail.local.
```
sudo cp /etc/fail2ban/jail.conf /etc/fail2ban/jail.local
```

### Дефолтные настройки
```
[DEFAULT]

ignoreip = 23.34.45.56
ignorecommand =
bantime  = 10w
findtime  = 10
maxretry = 2

maxmatches = %(maxretry)s
backend = auto

usedns = warn
logencoding = auto

enabled = false
mode = normal

#Jails

[sshd]

enabled = true
port    = ssh (или другой порт, если у вас не дефолтный 22 порт 9999)
logpath = %(sshd_log)s
backend = %(sshd_backend)s
```

## Перезагрузить fail2ban
```
sudo systemctl restart fail2ban
```

### Узнать статус fail2ban
```
sudo systemctl status fail2ban
sudo fail2ban-client status sshd
```

### Разбанить
```
sudo fail2ban-client set sshd unbanip 23.34.45.56
```

Iptables. Действуем по принципу "запрещено все, что не разрешено". Запрещаем по умолчанию весь INPUT и FORWARD трафик снаружи. Открываем на INPUT'е 22 порт. В дальнейшем открываем порты/forwarding по мере необходимости. Если у нас предполагаются сервисы на соседних серверах нужные только для внутренней коммуникации (Memcached, Redis, и т.д.), то открываем для них порты только для определенных IP. Просто так торчать наружу для всех они не должны.  

Настраиваем автоматические обновления apt-пакетов. Уровень security. То есть так, чтобы обновления безопасности накатывались автоматически, но при этом не выполнялись обновления со сменой мажорной версии (дабы обезопасить себя от "само сломалось").  

Устанавливаем ntpd. Серверное время должно быть точным. Также временную зону сервера лучше всего установить в UTC.  

Правильный менеджмент пользователей/групп. Приложения/сервисы не должны запускаться под root'ом (разве что они действительно этого требуют и иначе никак). Для каждого сервиса создается свой пользователь.  

Если предполагается upload файлов через PHP (либо другие скриптовые языки), в директории, куда эти файлы загружаются (и которая доступна снаружи), должно быть жестко отключено любое выполнение скриптов/бинарников, что на уровне ОС (x права), что на уровне веб-сервера.  