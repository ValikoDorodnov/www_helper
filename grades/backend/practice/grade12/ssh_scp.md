## SSH

### Пример конфигурационного файла
```
# .ssh/config

Host dev
    HostName dev.example.com
    User john
    Port 2322
```

### Команда для входа на сервер по ssh
```
# login@ip_address
ssh sammy@255.256.257.258
```

### Команда для копирования своего id_rsa.pub ключа на сервер
```
# login@ip_address
ssh-copy-id sammy@255.256.257.258
```

### Дополнительные настройки ssh на сервере
```
sudo nano /etc/ssh/sshd_config

PasswordAuthentication no --- запрещает вход при помощи пароля
PermitRootLogin no --- запрещает вход через пользователя root
Protocol 2 --- форсированное использование протокола версии 2
```

## SCP
```
# -P порт login@ip_address:file_to_copy dir_to_paste
scp -P 1501 sammy@255.256.257.258:~/static/dump.sql.gz ~/Documents
```