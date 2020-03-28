# Windows 10: Using Chocolatey to Install and Maintain Python 3

I do my development work on a Mac. But I also run Windows 10 using [Parallels Desktop](https://www.parallels.com/).  What follows are the steps I took to set up a Python 3.x/Django 2.x dev environment in Windows, based in part on Lisa Tagliaferri's excellent [guide](#tagliaferri).
 
Outside the Parallels virtual machine (VM) I use [Homebrew](https://brew.sh/), a macOS package manager, to acquire and maintain a good deal of the software I use on a daily basis. Within Windows I turned to [Chocolatey](https://chocolatey.org/) to manage my installs of nano, Python and Git.  I use the [MySQL 8.0.x installer](https://dev.mysql.com/downloads/windows/installer/8.0.html) to install MySQL Server, MySQL Workbench and other related MySQL products. 

I installed Chocolatey using Windows [PowerShell](https://docs.microsoft.com/en-us/powershell/scripting/getting-started/getting-started-with-windows-powershell?view=powershell-6). Chocolatey can also be installed using `cmd.exe`. See the Chocolatey [install page](https://chocolatey.org/docs/installation) for directions.

The Chocolatey approach is but one way to manage software installs.  You may already have [Python 3.7.x](https://www.python.org/downloads/windows/), [nano](https://www.nano-editor.org/download.php), and [Git](https://git-scm.com/download/win) installed, and perhaps [MySQL 8.0.x](https://dev.mysql.com/downloads/windows/installer/8.0.html) too using each product's own installers.  If so, you can proceed directly to section 4.0 and review/follow the set up instructions for installing Django, initializing a Git working directory, and connecting your Django project to a MySQL 8.0.x database.

## <a name="powershell">1.0 Configure Windows PowerShell</a>
Windows PowerShell is a command line shell for system administrators built on top of .Net. Administrative tasks are performed by running `cmdlets` (pronounced "command-lets").

### 1.1 Open PowerShell
Click the start menu icon (lower left corner).  Type "PowerShell" in the search box.  Then *right-click* on the "Windows PowerShell Desktop app" option and select "Run as administrator".  If prompted, click "Yes" to allow PowerShell to make changes to your device.  The PowerShell command line shell will then open displaying a prefix prompt of "PS".

:warning: Be sure that you are running PowerShell _as an administrator_ before executing the following commands.

```commandline
Windows PowerShell
Copyright (C) Microsoft Corporation. All rights reserved.

PS C:\Windows\system32>
```

Enter the following command in order to change directories to your user directory:

```commandline
PS C:\Windows\system32> cd ~
PS C:\Users\arwhyte>
```

When done with PowerShell (though not now), type "exit" and click enter.

```commandline
PS C:\Users\arwhyte> exit
```

### 1.2 Change PowerShell's Execution Policy
"Restricted" is the default execution policy.  It prevents you from running scripts.  Change PowerShell's execution policy to "RemoteSigned".  "RemoteSigned" will let you run scripts and configuration files downloaded from the Internet and signed by trusted publishers.

:warning: Note that a "trusted" script could still include malicious code so consider carefully what scripts you choose to execute when running under the new execution policy.

First, set the scope of the new execution policy to the current user (i.e., you).

```commandline
PS C:\Users\arwhyte> Set-ExecutionPolicy -Scope CurrentUser
```

PowerShell will then prompt you to select an Execution Policy.  Type "RemoteSigned" and then press `Enter`. PowerShell will then ask if you to change the current execution policy.  Type "y" (yes) and the "RemoteSigned" execution policy will be instituted.  To confirm the policy change enter the following command:

```commandline
PS C:\Users\arwhyte> Get-ExecutionPolicy -List
```

PowerShell's response should resemble the following output:

```
        Scope ExecutionPolicy
        ----- ---------------
MachinePolicy       Undefined
   UserPolicy       Undefined
      Process       Undefined
  CurrentUser    RemoteSigned
 LocalMachine       Undefined
```

## <a name="chocoinstall">2.0 Install Chocolatey</a>
[Chocolatey](https://chocolatey.org/) is a package manager for Windows. Like [Homebrew]
(https://brew.sh/) it simplifies installing, configuring, updating, and removing Windows software. Before downloading and running the Chocolatey install script, create a WebClient object called `$script` in order to share the Internet connection settings with Internet Explorer:

```commandline
PS C:\Users\arwhyte> $script = New-Object Net.WebClient
```

Then review the available properties and methods of the `$script` object by piping it to the `Get-Member` class:

```commandline
$script | Get-Member
```

A long list of methods and properties will be outputed to the screen. The `DownloadString` method 
is what we will use to download the Chocolatey install script.

```
...
DownloadString Method string DownloadString(string address), string DownloadString(uri address)
...
```

Implement the method:

```commandline
PS C:\Users\arwhyte> $script.DownloadString("https://chocolatey.org/install.ps1")
```

Then install Chocolatey:

```commandline
PS C:\Users\arwhyte> iwr https://chocolatey.org/install.ps1 -UseBasicParsing | iex
```

The `iwr`("Invoke-WebRequest") cmdlet will download and parse the Chocolatey install script before piping it on to the `iex` (Invoke-Expression) cmdlet which will execute install script.

Allow PowerShell to install Chocolatey.

## <a name="chocopkgs">3.0 Add Chocolatey Packages</a>
Now let's install nano, Python and Git.

### 3.1 nano
nano is a text editor with a command line interface that can be invoked within PowerShell to 
write programs.

:bulb: nano is not required for this exercise but since it can be [run inside](#masek) PowerShell as a file editor I went ahead and installed it. 

Issue the following `choco` command to install the nano [package](https://chocolatey.org/packages/nano):

```commandline
PS C:\Users\arwhyte> choco install -y nano
```

_Note_: The `-y` flag tells Chocolatey to execute the script without a formal confirmation prompt.

### 3.2 Python 3.7.x
Issue the following `choco` command to install the latest version of Python 3.7.x (currently 3.7.0) using the Chocolatey Python [package](https://chocolatey.org/packages/python):

```commandline
PS C:\Users\arwhyte> choco install -y python
```

_Note_: The default location of the Chocolatey Python 3.7.x install is:

```
C:\Python37
```

If you want to install Python in another location set the `/InstallDir` parameter to the location of your choice.

```commandline
PS C:\Users\arwhyte> choco install python3 --params "/InstallDir:C:\your\install\path"
```

The Windows `Path` environment variable is also updated as is indicated in the install output:

```
Chocolatey v0.10.11
Installing the following packages:
python
By installing you accept licenses for the packages.
Progress: Downloading python3 3.7.0... 100%
Progress: Downloading python 3.7.0... 100%

python3 v3.7.0 [Approved]
python3 package files install completed. Performing other installation steps.
Installing 64-bit python3...
python3 has been installed.
Installed to: 'C:\Python37'
  python3 can be automatically uninstalled.
Environment Vars (like PATH) have changed. Close/reopen your shell to
 see the changes (or in powershell/cmd.exe just type `refreshenv`).
 The install of python3 was successful.
  Software installed as 'exe', install location is likely default.

python v3.7.0 [Approved]
python package files install completed. Performing other installation steps.
 The install of python was successful.
  Software install location not explicitly set, could be in package or
  default install location if installer.

Chocolatey installed 2/2 packages.
 See the log for details (C:\ProgramData\chocolatey\logs\chocolatey.log).
 ```
You can check the Python installation location by starting Python in the shell and returning the path to the system executable:

```commandline
PS C:\> python
Python 3.7.0 (v3.7.0:1bf9cc5093, Jun 27 2018, 04:59:51) [MSC v.1914 64 bit (AMD64)] on win32
Type "help", "copyright", "credits" or "license" for more information.
>>> import os
>>> import sys
>>> os.path.dirname(sys.executable)
'C:\\Python37'
>>> exit()
```

You can also confirm if the `PATH` environment variable has been updated by clicking the start menu icon (lower left corner) and searching for the "SystemPropertiesAdvanced" run command.  Then *right-click* on the "SystemPropertiesAdvanced" option and select "Run as administrator" to open the System Properties Advanced tab.  Click "Environment Variables . . ." and check the System variables `PATH` variable.  It should include paths to the Python 3.7.x directory:

```
C:\Python37\Scripts;
C:\Python37\;
```

Confirm that Python has been successfully installed by typing the command `refreshenv` to close/reopen PowerShell.

```commandline
PS C:\Users\arwhyte> refreshenv
Refreshing environment variables from registry for cmd.exe. Please wait...Finished..
PS C:\Users\arwhyte> python -V
Python 3.7.0
```

:confused: Running `refreshenv` did not work for me.  I had to exit PowerShell and then restart it
 (as administrator) in order to get it to recognize the addition of Python in the `PATH` environment variable.

### 3.4 Confirm Chocolatey package installs
Let's check what packages we've installed so far:

```commandline
PS C:\Users\arwhyte> choco list --local-only
Chocolatey v0.10.11
chocolatey 0.10.11
chocolatey-core.extension 1.3.3
git 2.18.0
git.install 2.18.0
nano 2.5.3
python 3.7.0
python3 3.7.0
7 packages installed.
```

Looks good. By the way, upgrading Chocolatey itself is easy:

```commandline
PS C:\Users\arwhyte> choco upgrade chocolatey
```

For other `choco` commands see the [Chocolatey Wiki](https://github.com/chocolatey/choco/wiki/CommandsReference) on Github.

## <a name="venv">4.0 Set up a Virtual Environment</a>

### 4.1 Upgrade pip
Before installing `virtualenv` make sure that the latest version of `pip`, Python's own package manager, is installed locally:

```commandline
PS C:\Users\arwhyte> python -m pip install --upgrade pip
Collecting pip
  Using cached https://files.pythonhosted.org/packages/5f/25/e52d3f31441505a5f3af41213346e5b6c221c9e086a166f3703d2ddaf940/pip-18.0-py2.py3-none-any.whl
Installing collected packages: pip
  Found existing installation: pip 10.0.1
    Uninstalling pip-10.0.1:
      Successfully uninstalled pip-10.0.1
Successfully installed pip-18.0
```

### 4.2 Install virtualenv
Once `pip` is updated, use it to install the `virtualenv` package.

```commandline
PS PS C:\Users\arwhyte> pip install virtualenv
```

### 4.3 Create the Virtual Environment
Now create a virtual environment for your django project.  Create it from within the project root directory:

```commandline
PS C:\Users\arwhyte> cd Development\repos\github\arwhyte\django_tutorial
PS C:\Users\arwhyte\Development\repos\github\arwhyte\django_tutorial> virtualenv venv
Using base prefix 'c:\\python37'
New python executable in C:\Users\arwhyte\Development\repos\github\arwhyte\django_tutorial\venv\Scripts\python.exe
Installing setuptools, pip, wheel...done.
```

### 4.4 Activate the Virtual Environment
:warning: You __must__ activate the virtual environment before adding project-specific Python 
packages such as Django.

```commandline
PS C:\Users\arwhyte\Development\repos\github\arwhyte\django_tutorial> venv\Scripts\activate
(venv) PS C:\Users\arwhyte\Development\repos\github\arwhyte\django_tutorial>
```

When activated the prompt is prefixed with the name of the virtual environment (e.g., "(venv)").

To deactivate the virtual environment run:

```commandline
(venv) PS C:\Users\arwhyte\Development\repos\github\arwhyte\django_tutorial> deactivate
PS C:\Users\arwhyte\Development\repos\github\arwhyte\django_tutorial>
```

## License
<a rel="license" href="http://creativecommons.org/licenses/by/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/88x31.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by/4.0/">Creative Commons Attribution 4.0 International License</a>.
