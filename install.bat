@echo off
:: Verifica se está com permissão de admin
call :check_Permissions

:: Verifica se o Vagrant está instalado e disponível
call :check_Requirements

:: Verifica se a box está na mesma pasta
IF [%1]==[] (
	IF exist %0/../virtualbox.box (
		:: Executa o comando de instalação
		call :Run %0/../virtualbox.box
	)
	
	IF NOT exist %0/../virtualbox.box (
		echo Nao foi encontrado o "virtualbox.box" nessa pasta
	)
)

pause
exit \b

:Run
IF "%~1"=="" (
	echo O arquivo da box nao existe
) ELSE (
	:: Instalação da box
	echo Encontrei o virtualbox.box, boa man :)
	echo Instalando box...
	vagrant box add laravel/homestead file:///%~1

	:: Como a box foi instalada com o arquivo local, é necessário definir a versão manualmente
	echo Configurando box...
	cd %APPDATA%/../../.vagrant.d/boxes/laravel-VAGRANTSLASH-homestead
	echo https://app.vagrantup.com/laravel/boxes/homestead >> metadata_url
	rename 0 5.2.0

	:: A adição da URL no hosts torna o "homestead.test" disponível por HTTPS e por HTTP
	echo Adicionando url homestead.test...
	echo 192.168.10.10  homestead.test >> %windir%/system32/drivers/etc/hosts
	echo Muito bom! Pode executar o start.bat ja :)
)


:check_Permissions
    net session >nul 2>&1
    IF NOT %errorLevel% == 0 (
		echo Executa isso como administrador
		pause
		exit \b
    )

:check_Requirements
	WHERE vagrant >nul 2>nul
	IF NOT %errorlevel% == 0 (
		echo Instala o Vagrant primeiro, Ze
		echo https://www.vagrantup.com/downloads.html
		pause
		exit \b
	)