# SITVEE

Special Events Virtual Tickets System

Our project is to provide a web service of virtual tickets that are used in mobile phones by the implementation of QR codes, which will be sent to the emails of each one of the attendees of the event that is being organized.

This system of tickets for events comes to digitize and organize the process of exchanging benefits by companies during the events that take place, this digitization and order are achieved from the content of a friendly website for the person in charge of organizing the event in the company, giving you the opportunity to introduce each of the attendees and the benefits that are going to be able to exchange during your participation in the activity.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

For working on this project you need to install the software listed below:

* [Visual Studio Code](https://code.visualstudio.com/) - The editor for working on the code and manage the repository
* [XAMPP](https://www.apachefriends.org/index.html) - The PHP development enviroment
* [GitHub Desktop](https://desktop.github.com/) - A tool for an easy repository cloning

### Installing

* **Cloning the repository**

The idea of this proccess is to have the repository cloned using an application that facilitates the work

```
1-Start up the GitHub desktop application and login with your account
2-Press in the 'Clone a repository' option
3-Select the repository to clone
4-Select the ubication for the folder in which the repository is going to be clone, in this case, de ideal is to create a 'SITVEE' folder into C:/xampp/htdocs
5-Press the 'Clone' button and verify that the repository is cloned into the folder
6-You can close the application and continue with the next steps, this application only is needed for cloning the repository
```

* **Using Visual Studio for code editing and push/pull changes**

Whith this proccess you are going to be able to edit code into the Visual Studio Code editor and also make the necessary commits into the repository

```
1-Open Visual Studio Code Application
2-Press the 'Paper' icon in the left
3-Press the 'Open Folder' option
4-Search for the SITVEE folder where is the repository cloned
5-In the left-bottom corner of visual studio you can select the branch in which you are going to work
6-Next to the branch you can find de 'Synchronize changes' option that allows to to pull/push commits to and from the branch you are working on
7-As extra tip, you can press 'Ctrl+Shift+P' and write '>Git:' to see all the possible commands for Git
8-With the folder of the repository open, the branch selected and knowing how to pull and push, you can now start editing the code
```

* **Using the PHP enviroment**

This will allows you to set up a PHP enviroment in your computer for running the SITVEE application you are working on

```
For using the enviroment to see the code running:

1-Go and run the XAMPP application instaled in the Prerequisites
2-Start the Apache and MySQL server
3-Go to the xampp folder created in your computer, by default is created in Local Disk (C:)
4-Ensure that inside the htdocs folder is the folder that contains the project you are working on
5-Open a web browser and type the url 'localhost/folderOfTheProject' and press enter
6-The files of the folder should be displayed and you can open the files of the pages you need to see
```

* **Setting up the database**

This process will provide you the steps for setting up a copy of the database needed for SITVEE to work

```
1-In the setting up of the PHP enviroment you already have the MySQL server running
2-Open the web browser
3-Type in the url 'http://localhost/phpmyadmin/'
```

## Deployment

For deploying this project on a live system you will need to add the files that are into the master branch into the [File Manager](https://files.000webhost.com/) of the host application

The database is already created into the host and the installing steps includes making a data base that is equals to the one in production for not havin the conections changing

## Built With

* [PHP](http://www.php.net/) - The web language used
* [Javascript](https://www.javascript.com/) - The web language used
* [000webhost](https://www.000webhost.com/cpanel-login) - The hosting for the aplication


## Authors

* **Cristian Alvarado Arias** - *Development* - [qky110796](https://github.com/qky110796)
* **Franklin Astorga Pacheco** - *Quality Assurance* - [rambolisis](https://github.com/rambolisis)
* **Andrey Palma Jiménez** - *Development* - [AndreyPalma](https://github.com/AndreyPalma)
* **Rubén Ureña Gómez** - *Management* - [RubenUG18](https://github.com/RubenUG18)
