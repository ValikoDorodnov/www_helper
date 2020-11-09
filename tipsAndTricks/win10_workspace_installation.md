# Установка окружения для веб разработки на windows 10

## В ходе этого мануала будет установлено:
- git
- php
- composer
- docker (docker-compose)
- npm

### Установка git
1. перейдите на https://git-scm.com/download/win выберите нужную вам разрядность ОС
(например 64-bit Git for Windows Setup.)
2. запустите установщик и не меняя предложенных настроек установите git
3. после установки закройте все терминалы и откройте git bash
4. выполните проверочную команду git --version
![git](../assets/images/win10/git.png)  
5. выполните [первоначальную настройку](https://git-scm.com/book/ru/v2/%D0%92%D0%B2%D0%B5%D0%B4%D0%B5%D0%BD%D0%B8%D0%B5-%D0%9F%D0%B5%D1%80%D0%B2%D0%BE%D0%BD%D0%B0%D1%87%D0%B0%D0%BB%D1%8C%D0%BD%D0%B0%D1%8F-%D0%BD%D0%B0%D1%81%D1%82%D1%80%D0%BE%D0%B9%D0%BA%D0%B0-Git)
6. добавьте [ssh key](https://only-to-top.ru/blog/tools/2019-12-08-git-ssh-windows.html)

**Далее при работе с командной строкой я буду использовать git bash**

### Установка php
1. установите [Visual C++ Redistributable for Visual Studio 2015](http://www.microsoft.com/en-us/download/details.aspx?id=48145)
2. скачайте архив с [php](https://windows.php.net/download/) и выберете нужную вам версию
![php1](../assets/images/win10/php1.png) 
3. извлеките архив в папку и скопируйте ее в C:/имя папки
![php2](../assets/images/win10/php2.png) 
![php3](../assets/images/win10/php3.png) 
4. замените php.ini-development на php.ini. Раскомментируйте строчки (просто удалите ; перед строкой)  
extension_dir = "ext"  
extension=curl  
extension=gd2  
extension=mbstring  
extension=mysqli  
extension=openssl  
extension=pdo_mysql  
extension=pdo_pgsql  
extension=pdo_sqlite  
extension=pgsql  
extension=sockets  
extension=xsl  

5. Перейдите в настройки системы
![php4](../assets/images/win10/php4.png)
Откройте "Дополнительные параметры системы"
![php5](../assets/images/win10/php5.png)
Откройте "Переменные среды"
![php6](../assets/images/win10/php6.png)
Найдите переменную Path (PATH) и нажмите "изменить"
![php8](../assets/images/win10/php8.png)
В новом окне нажмите "Создать" и добавьте путь до папки с php C:/имя папки
![php7](../assets/images/win10/php7.png)

6. после установки закройте все терминалы и откройте git bash
7. выполните проверочную команду php -v
![php9](../assets/images/win10/php9.png)

### Установка composer
1. Скачайте установочник composer для windows https://getcomposer.org/download/

2. Во время установки кажите путь до исполняемого файла php
![composer1](../assets/images/win10/composer1.png)

3. после установки закройте все терминалы и откройте git bash
4. выполните проверочную команду composer
![composer2](../assets/images/win10/composer2.png)

### Установка docker
1. Скачайте установочник docker для windows https://hub.docker.com/editions/community/docker-ce-desktop-windows/
2. После установки запустите Docker Desktop и при ошибке дополнительно установите пакет linux kernel https://docs.microsoft.com/ru-ru/windows/wsl/wsl2-kernel
![docker1](../assets/images/win10/docker1.png)
3. после установки закройте все терминалы и откройте git bash
4. выполните проверочную команду docker -v && docker-compose -v
![docker2](../assets/images/win10/docker2.png)

### Установка npm

1. скачайте установочник nodejs для windows https://nodejs.org/en/download/
2. установите node js в штатном режиме
3. после установки закройте все терминалы и откройте git bash
4. выполните проверочную команду npm -v
![npm1](../assets/images/win10/npm1.png)