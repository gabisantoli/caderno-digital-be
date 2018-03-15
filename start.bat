@echo off
call :check_Requirements

echo Iniciando maquina virtual...

:: O Vagrant Up inicializa a máquina em segundo plano
vagrant up

echo A maquina virtual foi iniciada. Para parar a execucao, execute o stop.bat
pause


:check_Requirements
	WHERE vagrant >nul 2>nul
	IF NOT %errorlevel% == 0 (
		echo Instala o Vagrant primeiro, Zé
		echo https://www.vagrantup.com/downloads.html
		pause
		exit \b
	)
	pause