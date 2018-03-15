@echo off
call :check_Requirements

echo Parando a maquina...

:: O `vagrant halt` serve pra parar a máquina "graciosamente"
vagrant halt

echo A maquina virtual foi parada. Para executar novamente, execute o start.bat
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