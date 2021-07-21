
Python for Everybody (PY4E)
===========================

Course materials for www.py4e.com

The Python3 versions of the code is all in code3

If you are interested in the Python for Everybody book
see the folders

* [book3](book3/)
* [figures](figures/)
* [images](images/)
* [code3](code3/)

See the file [`book3/README.md`](book3/README.md) for more details.

Setup On Localhost
------------------

Here are the steps to set this up on localhost on a Macintosh using MAMP.

Install MAMP (or similar) using https://www.wa4e.com/install

Check out this repo into a top level folder in htdocs

    cd /Applications/MAMP/htdocs
    git clone https://github.com/csev/py4e.git

Go into the newly checked out folder and get a copy of Tsugi:

    cd py4e
    git clone https://github.com/csev/tsugi.git

Create a database in your SQL server:

    CREATE DATABASE tsugi DEFAULT CHARACTER SET utf8;
    CREATE USER 'ltiuser'@'localhost' IDENTIFIED BY 'ltipassword';
    GRANT ALL ON tsugi.* TO 'ltiuser'@'localhost';
    CREATE USER 'ltiuser'@'127.0.0.1' IDENTIFIED BY 'ltipassword';
    GRANT ALL ON tsugi.* TO 'ltiuser'@'127.0.0.1';

Still in the tsugi folder set up config.php:

    cp config-dist.php config.php

Edit the config.php file, scroll through and set up all the variables.  As you scroll through the file
some of the following values are the values I use on my MAMP:

    $wwwroot = 'http://localhost:8888/py4e/tsugi';   // Embedded Tsugi localhost
    
    ...
    
    $CFG->pdo = 'mysql:host=127.0.0.1;port=8889;dbname=tsugi'; // MAMP
    $CFG->dbuser    = 'ltiuser';
    $CFG->dbpass    = 'ltipassword';
    
    ...
    
    $CFG->adminpw = 'short';
    
    ...
    
    $CFG->apphome = 'http://localhost:8888/py4e';
    $CFG->context_title = "Python for Everybody";
    $CFG->lessons = $CFG->dirroot.'/../lessons.json';
    
    ... 
    
    $CFG->tool_folders = array("admin", "../tools", "../mod");
    $CFG->install_folder = $CFG->dirroot.'./../mod'; // Tsugi as a store
    
    ...
    
    $CFG->servicename = 'PY4E';

(Optional) If you want to use Google Login,
go to https://console.developers.google.com/apis/credentials and
create an "OAuth Client ID".  Make it a "Web Application", give it a name,
put the following into "Authorized JavaScript Origins":

        http://localhost

And these into Authorized redirect URIs:

    http://localhost/py4e/tsugi/login.php
    http://localhost/py4e/tsugi/login

Note: You do not need port numbers for either of these values in your Google
configuration.

Google will give you a 'client ID' and 'client secret', add them to `config.php`
as follows:

    $CFG->google_client_id = '96..snip..oogleusercontent.com';
    $CFG->google_client_secret = 'R6..snip..29a';

While you are there, you could "Create credentials", select "API
key", and name the key "My Google MAP API Key" and put the API
key into `config.php` like the following:

    $CFG->google_map_api_key = 'AIza..snip..9e8';

Starting the Application
------------------------

After the above configuration is done, navigate to your application:

    http://localhost:8888/py4e/tsugi/

It should complain that you have not created tables and suggest you 
use the Admin console to do that:

    http://localhost:8888/py4e/tsugi/admin

It will demand the `$CFG->adminpw` from `config.php` (above) before 
unlocking the admin console.  Run the "Upgrade Database" option and
it should create lots of tables in the database and the red warning
message about bad database, should go away.

Alternately, you can create all the databases on the command line using:

    cd py4e/tsugi/admin
    php upgrade.php

Keep refreshing the `/py4e/tsugi` page until all the error messages go away.
Once the error messages are gone, the main page should also have no errors.

    http://localhost:8888/py4e/

Go into the database and the `lti_key` table, find the row with the `key_key`
of google.com and put a value in the `secret` column - anything will do - 
just don't leave it empty or the internal LTI tools will not launch.

Next use the administrator interface to install the peer-grading tool
from the github repository:

    http://localhost:8888/py4e/tsugi/admin/install

Click on "Available Modules" and install https://github.com/tsugitools/peer-grade - 
you will need to re-run the database upgrade process to create the peer-grader tables.

Then install the "Gift Quiz" tool and re-run the database upgrade.  

If you want to have access to the quiz content, please contact Chuck for access 
to the private py4e repository.  Access will only be given to those seriously installing
the software and verified as teaching the course and adopting the materials.
To checkout the private repo:

    cd py4e
    git clone https://github.com/csev/py4e-private.git

Then add the following line to your `config.php`:

    $CFG->giftquizzes = $CFG->dirroot.'/../py4e-private/quiz';

At this point, you will need the "quiz unlock password" (also from Chuck) and at that point,
you should be able to launch and load all the quizzes (one at a time) from the repository.  You
need to load the quiz content for every course (context) separately.  But at least you don't have
to ttype them all in.

The other two LTI tools that are required are already part of the py4e repo and in `py4e/tools`
folder.

You can always test the tools using the "App Store" at:

    http://localhost:8888/py4e/tools/

This allows you to do test launches as the instructor and student in a test environment using the
key '12345'.

Using the Application
---------------------

Navigate to:

    http://localhost:8888/py4e/

You should click around without logging in and see if things work.

Then log in with your Google account and the UI should change.  In particular you should
see 'Assignments' and in Lessons you should start seeing LTI autograders.

Becoming Instructor in the Global Course
----------------------------------------

Tsugi can support using the content in a Learning Management system through LTI launches and LTI Keys.

You can also run a "MOOC" where students directly log in using Google to your site and do the homework,
track their grades, and earn badges.

You will want to "promote" your student account to a teacher account as follows.

* Log in with your Google account

* Go to `/tsugi/admin` - Note that you won't see the Admin option in your drop down until you visit it
once and successfully log in to the Admin UI.

* Enter the admin password you chose in `config.php` to log into Admin. 

* In the Administration Console, choose `View Contexts` - These are the "courses" - if you just set things
up there will be just one course.  Otherwise find the course that matches your configured `context_name`
and go into it.

* Find your account in the membership records.  You can search using your gmail address if there are a lot.  Go into
your membership record.

* Edit your membership record and change your "Role Override" value to 1000 and save your record.

Poof! You (and as many of the other folks you give this power to) are now the "instructors" of the global class.

Becoming Instructor for an LTI-Launched Course when the LMS Does not support the Instructor Role
------------------------------------------------------------------------------------------------

Some LMS systems do not send the Instructor role "the way you would like it to".  Sometimes it never
sends the instructor role and in other cases it does not send the instructor role for teaching assistants
or perhaps you want to promote some students into teaching assistants.   

It is pretty simple to do this in Tsugi.

* Log in to `/tsugi/admin`  as in the previous instructions.

* Find the context that corresponds to your LTI-Launched course.  Enter the context.

* Find the membership record (often searching on email address) and then edit the membership
record, setting "Role Override" to 1000 and saving the membership record.

From that point forward regardless of the role sent by the LMS - that use will be seen as an instructor
by Tsugi.



   
